<?php
session_start();
if (isset($_SESSION['user_id'])) {
$user_id = $_SESSION['user_id'];
}
else{
  header("Location: auth.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Каталог</title>
  </head>
  <body>
    <header class="header_index">
    <img src="img/logo.svg" alt="">
      <h1 class="heading_text">КАТАЛОГ</h1>
      <div class="toolbar">
        <a href="index.html">ГЛАВНАЯ</a>
        <a href="catalog.php">КАТАЛОГ</a>
        <a href="basket.php">КОРЗИНА</a>
        <a href="reviews.php">ОТЗЫВЫ</a>        
        <a href="profile.php" class="last">ПРОФИЛЬ</a>
      </div>
    </header>

    <div class="content_catalog">
      <div class="cart_catalog first tires">
        <a href="category.php?id=1">
          <img src="img/tires_icon.svg" alt="" />
          <p>ШИНЫ</p>
        </a>
      </div>
      <div class="cart_catalog disk">
        <a href="category.php?id=2">
          <img src="img/disk_icon.svg" alt="" />
          <p>ДИСКИ</p>
        </a>
      </div>
      <div class="cart_catalog oil">
        <a href="category.php?id=3">
          <img src="img/oil_icon.svg" alt="" />
          <p>МАСЛА И ФИЛЬТРЫ</p>
        </a>
      </div>
      <div class="cart_catalog first brake">
        <a href="category.php?id=4">
          <img src="img/brake_icon.svg" alt="" />
          <p>ТОРМОЗНАЯ СИСТЕМА</p>
        </a>
      </div>
      <div class="cart_catalog battery">
        <a href="category.php?id=5">
          <img src="img/battery_icon.svg" alt="" />
          <p>АККУМУЛЯТОРЫ</p>
        </a>
      </div>
      <div class="cart_catalog filter">
        <a href="category.php?id=6">
          <img src="img/filter_icon.svg" alt="" />
          <p>ВОЗДУШНЫЕ ФИЛЬТРЫ</p>
        </a>
      </div>
    </div>
  </body>
</html>
