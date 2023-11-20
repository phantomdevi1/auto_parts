<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Профиль</title>
</head>
<body>
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php#section_auth");
    exit;
}

$user_id = $_SESSION['user_id'];

include 'config.php';

if (!$conn) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

$query = "SELECT user_name, user_email, user_phone, discount_card FROM users WHERE ID = $user_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) 
{
    $row = mysqli_fetch_assoc($result);
    $user_name = $row['user_name'];
    $user_email = $row['user_email'];
    $user_phone = $row['user_phone'];
    $discount_card_status = $row['discount_card'] == 1 ? 'активна' : 'не активна';
} 
else {
    // Handle the case where user data is not found
}

// Функция для выхода из профиля
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: auth.php");
    exit;
}

mysqli_close($conn);
?>

<header class="header_index">
    <img src="img/logo.svg" alt="">
    <h1 class="heading_text">ПРОФИЛЬ</h1>
    <div class="toolbar">
        <a href="catalog.php">КАТАЛОГ</a>
        <a href="basket.php">КОРЗИНА</a>
        <a href="reviews.php">ОТЗЫВЫ</a>
        <a href="">КОНТАКТЫ</a>
        <a href="profile.php" class="last">ПРОФИЛЬ</a>
    </div>
</header>

<div class="content_profile" id="profile_block">
    <div class="profile_block_left">
        <img src="img/default_ava.svg" alt="Аватарка" class="ava_img">
        <p class="name_profile"><?php echo $user_name; ?></p>
        <form method="post">
            <button class="exit_profile" name="logout">Выйти</button>
        </form>
        <img class="img_profile_card" src="img/discount_cart.svg" alt="">
        <p class="status_discount_card"><?php echo $discount_card_status; ?></p>
    </div>
    <div class="profile_block_right">
        <p class="title_info_profile">Информация</p>
        <hr>
        <div class="user_info">
            <div class="usermail">
                <p>Почта</p>
                <span class="usermail_email"><?php echo $user_email; ?></span>
            </div>
            <div class="usernumber">
                <p>Телефон</p>
                <span class="usernumber_phone"><?php echo $user_phone; ?></span>
            </div>
        </div>
        <div class="user_order">
            <p class="title_info_profile">Заказы</p>
            <hr>
            <div class="order_profile">
                <a href=""><img src="img/actual_order.svg" alt=""></a>
                <a href=""><img src="img/history_order.svg" alt=""></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
