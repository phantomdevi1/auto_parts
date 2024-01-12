<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказы</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header_index">
        <img src="img/logo.svg" alt=""/>
        <h1 class="heading_text">ЗАКАЗЫ</h1>
        <div class="toolbar">
            <a href="index.html">ГЛАВНАЯ</a>
            <a href="catalog.php">КАТАЛОГ</a>
            <a href="basket.php">КОРЗИНА</a>
            <a href="reviews.php">ОТЗЫВЫ</a>        
            <a href="profile.php" class="last">ПРОФИЛЬ</a>
        </div>
    </header>
    <div class="content_order">
        <center>
            <form method="post">
                <select class="select" name="order_status">
                    <option value="В обработке">В обработке</option>
                    <option value="В доставке">В доставке</option>
                    <option value="Доставлен">Доставлен</option>
                    <option value="Готов к выдаче">Готов к выдаче</option>
                </select>
                <button type="submit" name="show_orders">Показать</button>
            </form>
        </center>

        <?php
        include 'config.php';
        session_start();

        if (isset($_POST['show_orders'])) {
            $selected_status = $_POST['order_status'];
            $query = "SELECT * FROM orders WHERE status = '$selected_status' ORDER BY order_date DESC";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $order_date = date('d.m.Y H:i', strtotime($row['order_date']));
                $status = $row['status'];
                $total_price = $row['full_price'];

                $order_id = $row['order_id'];
                $query_items = "SELECT * FROM order_items INNER JOIN product ON order_items.product_id = product.ID WHERE order_items.order_id = $order_id";
                $result_items = mysqli_query($conn, $query_items);

                echo '<div class="card_order">';
                echo '<div class="info_card_order">';
                echo '<div><p>' . $order_date . '</p></div>';
                echo '<div><p>Статус:</p><span>' . $status . '</span></div>';
                echo '<div><p>Общая стоимость:</p><span>' . $total_price . ' ₽</span></div>';

                while ($item_row = mysqli_fetch_assoc($result_items)) {
                    $product_name = $item_row['name'];
                    $product_image = $item_row['image'];
                    $item_quantity = $item_row['quantity'];
                    echo '<div><p>Товар:</p><span>' . $product_name . ' (x' . $item_quantity . ')</span></div>';
                }

                // Добавляем ссылку с ID заказа
                echo "<a class='admin_order_btn' href='admin_order_details.php?id=$order_id'>Перейти</a>";
                echo '</div>';
                echo '<div class="img_card_order">';
                echo '<img src="' . $product_image . '" alt="" width="293px">';
                echo '</div>';
                echo '</div>';
            }
        }
mysqli_close($conn);
?>

    </div>
</body>
</html>
