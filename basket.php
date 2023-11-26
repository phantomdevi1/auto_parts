<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_order'])) {
        $queryCartData = "SELECT product_id, quantity FROM cart WHERE user_id = ?";
        $stmtCartData = mysqli_prepare($conn, $queryCartData);
        mysqli_stmt_bind_param($stmtCartData, "i", $user_id);
        mysqli_stmt_execute($stmtCartData);
        $resultCartData = mysqli_stmt_get_result($stmtCartData);
        
        // Получаем общую стоимость
        $totalPrice = 0;
        while ($cartDataRow = mysqli_fetch_assoc($resultCartData)) {
            $product_id = $cartDataRow['product_id'];
            $quantity = $cartDataRow['quantity'];
        
            $queryProductPrice = "SELECT price FROM product WHERE ID = ?";
            $stmtProductPrice = mysqli_prepare($conn, $queryProductPrice);
            mysqli_stmt_bind_param($stmtProductPrice, "i", $product_id);
            mysqli_stmt_execute($stmtProductPrice);
            $resultProductPrice = mysqli_stmt_get_result($stmtProductPrice);
        
            $productPrice = mysqli_fetch_assoc($resultProductPrice)['price'];
            $totalPrice += $productPrice * $quantity;
        }
        
        // Сбрасываем указатель результата к началу
        mysqli_data_seek($resultCartData, 0);

        // Создаем заказ
        $createOrderQuery = "INSERT INTO orders (user_id, order_date, status, full_price) VALUES (?, NOW(), 'В обработке', ?)";
        $stmtOrder = mysqli_prepare($conn, $createOrderQuery);
        mysqli_stmt_bind_param($stmtOrder, "id", $user_id, $totalPrice);
        $resultOrder = mysqli_stmt_execute($stmtOrder);

        if ($resultOrder) {
            // Получаем ID последнего созданного заказа
            $order_id = mysqli_insert_id($conn);

            // Обрабатываем товары в корзине и создаем записи в order_items
            $queryOrderItem = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
            $stmtOrderItem = mysqli_prepare($conn, $queryOrderItem);

            $stmtCartData->data_seek(0); // Сбрасываем указатель результата к началу
            while ($cartDataRow = mysqli_fetch_assoc($resultCartData)) {
                $product_id = $cartDataRow['product_id'];
                $quantity = $cartDataRow['quantity'];

                mysqli_stmt_bind_param($stmtOrderItem, "iii", $order_id, $product_id, $quantity);
                $resultOrderItem = mysqli_stmt_execute($stmtOrderItem);

                if (!$resultOrderItem) {
                    echo "Ошибка при создании записи в order_items: " . mysqli_error($conn);
                    exit();
                }
            }

            // Очищаем корзину
            $clearCartQuery = "DELETE FROM cart WHERE user_id = ?";
            $stmtClearCart = mysqli_prepare($conn, $clearCartQuery);
            mysqli_stmt_bind_param($stmtClearCart, "i", $user_id);
            mysqli_stmt_execute($stmtClearCart);

            echo "<script>alert('Заказ успешно оформлен! Общая стоимость: $totalPrice ₽');</script>";            
            exit();
        } else {
            echo "Ошибка при создании заказа: " . mysqli_error($conn);
            exit();
        }
    }

    // Запрос к таблице cart
    $query = "SELECT cart.cart_id, cart.product_id, cart.date_added, cart.quantity, product.name, product.image, product.price
              FROM cart
              INNER JOIN product ON cart.product_id = product.ID
              WHERE cart.user_id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <link rel="stylesheet" href="style.css"/>
            <title>Корзина</title>
        </head>
        <body>
        <header class="header_index">
            <img src="img/logo.svg" alt=""/>
            <h1 class="heading_text">КОРЗИНА</h1>
            <div class="toolbar">
                <a href="catalog.php">КАТАЛОГ</a>
                <a href="">КОРЗИНА</a>
                <a href="reviews.php">ОТЗЫВЫ</a>
                <a href="">КОНТАКТЫ</a>
                <a href="profile.php" class="last">ПРОФИЛЬ</a>
            </div>
        </header>
        <div class="content_basket">
            <div class="price_basket">
                <p>Итого:</p>
                <span id="total_price" data-total="<?php echo $totalPrice; ?>">0 ₽</span>
            </div>
            <?php
            $totalPrice = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $totalPrice += $row['price'];
                ?>
                <div class="basket_cart">
                    <img class="basket_cart_img" src="<?php echo $row['image']; ?>" alt=""/>
                    <div class="info_basket_cart">
                        <p class="nametovar_basket"><?php echo $row['name']; ?></p>
                        <input
                            type="number"
                            id="quantity_<?php echo $row['cart_id']; ?>"
                            class="quantity_basket_cart"
                            name="quantity_<?php echo $row['cart_id']; ?>"
                            value="<?php echo $row['quantity'];?>"
                            min="1"
                            max="10"
                            onchange="updateTotal(<?php echo $row['cart_id']; ?>, <?php echo $row['price']; ?>)"
                        />
                        <span class="fullprice_tovar" id="fullprice_<?php echo $row['cart_id']; ?>">
                            <?php echo $row['price'] * $row['quantity']; ?> ₽
                        </span>
                        <button class="delete_button"></button>
                    </div>
                </div>
                <?php
            }
            ?>
            <form method="post">
                <input class="submit_order_btn" type="submit" value="Оформить заказ" name="submit_order">
            </form>

            <script>
                function calculateTotalPrice() {
                    var totalPrice = 0;
                    var cartItems = document.querySelectorAll('.basket_cart');
                    cartItems.forEach(function (item) {
                        var price = parseFloat(item.querySelector('.fullprice_tovar').textContent);
                        totalPrice += price;
                    });

                    // Обновляем общую стоимость в span
                    var totalSpan = document.getElementById('total_price');
                    totalSpan.textContent = totalPrice + ' ₽';
                    totalSpan.dataset.total = totalPrice; // Обновляем значение в data-атрибуте
                }

                document.addEventListener("DOMContentLoaded", function () {
                    calculateTotalPrice(); // Вызываем функцию при загрузке страницы
                });

                function updateTotal(cartId, price) {
                    var quantity = document.getElementById('quantity_' + cartId).value;
                    var total = quantity * price;
                    document.getElementById('fullprice_' + cartId).textContent = total + ' ₽';
                    calculateTotalPrice(); 
                }
            </script>

        </body>
        </html>
        <?php
    } else {
        echo "Ошибка выполнения запроса: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: auth.php");
    exit();
}
?>
