<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Получаем информацию о дисконтной карте пользователя
    $queryDiscount = "SELECT discount_card FROM users WHERE ID = $user_id";
    $resultDiscount = mysqli_query($conn, $queryDiscount);

    if ($resultDiscount && mysqli_num_rows($resultDiscount) > 0) {
        $rowDiscount = mysqli_fetch_assoc($resultDiscount);
        $user_has_discount_card = $rowDiscount['discount_card'];
    } else {
        $user_has_discount_card = 0; // По умолчанию предполагаем, что у пользователя нет дисконтной карты
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_order'])) {
        // Создаем заказ
        $createOrderQuery = "INSERT INTO orders (user_id, order_date, status) VALUES ($user_id, NOW(), 'В обработке')";
        $resultOrder = mysqli_query($conn, $createOrderQuery);

        if ($resultOrder) {
            // Получаем ID последнего созданного заказа
            $order_id = mysqli_insert_id($conn);

            // Обрабатываем товары в корзине
            $queryCart = "SELECT cart_id, product_id, quantity FROM cart WHERE user_id = $user_id";
            $resultCart = mysqli_query($conn, $queryCart);

            while ($cartRow = mysqli_fetch_assoc($resultCart)) {
                $product_id = $cartRow['product_id'];
                $quantity = $cartRow['quantity'];

                // Создаем запись в таблице order_items
                $createOrderItemQuery = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ($order_id, $product_id, $quantity)";
                mysqli_query($conn, $createOrderItemQuery);
            }

            // Очищаем корзину
            $clearCartQuery = "DELETE FROM cart WHERE user_id = $user_id";
            mysqli_query($conn, $clearCartQuery);

            echo "Заказ успешно оформлен!";
            exit();
        } else {
            echo "Ошибка при создании заказа: " . mysqli_error($conn);
            exit(); // Added exit to stop execution after encountering an error
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
                <span id="total_price">0 ₽</span>
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
                document.getElementById('total_price').textContent = '<?php echo $totalPrice; ?> ₽';

                function updateTotal(cartId, price) {
                    var quantity = document.getElementById('quantity_' + cartId).value;
                    var total = quantity * price;
                    document.getElementById('fullprice_' + cartId).textContent = total + ' ₽';
                    updateTotalPrice();
                }

                function updateTotalPrice() {
                    var totalPrice = 0;
                    var cartItems = document.querySelectorAll('.basket_cart');

                    cartItems.forEach(function (item) {
                        var price = parseFloat(item.querySelector('.fullprice_tovar').textContent);
                        totalPrice += price;
                    });

                    // Проверяем, есть ли у пользователя дисконтная карта
                    var hasDiscountCard = <?php echo $user_has_discount_card; ?>;

                    // Применяем скидку 3%, если у пользователя есть дисконтная карта
                    if (hasDiscountCard) {
                        var discount = 0.03; // 3%
                        totalPrice -= totalPrice * discount;
                    }

                    document.getElementById('total_price').textContent = totalPrice.toFixed(2) + ' ₽';
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
