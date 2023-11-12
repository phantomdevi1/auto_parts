<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <?php
    session_start();
    $user_id = $_SESSION['user_id'];
    if (isset($_GET['id'])) {
      $category_id = $_GET['id'];
      include 'config.php';

    $sql = "SELECT * FROM category WHERE ID = $category_id";
    $result = mysqli_query($conn, $sql);
    } 
    else
    {
    echo "Категория не выбрана";
    }
    ?>
    <header class="header_index">
    <h1 class="heading_text_category">
    <?php
    if (isset($result)) {
        $row = mysqli_fetch_assoc($result); // Извлекаем данные из результата запроса
        $category_name = $row['category_name']; // Получаем значение столбца category_name
        echo $category_name;
    } else {
        echo "Категория не выбрана";
    }
    ?>
</h1>

      <div class="toolbar">
        <a href="catalog.php">КАТАЛОГ</a>
        <a href="">КОРЗИНА</a>
        <a href="reviews.php">ОТЗЫВЫ</a>
        <a href="">КОНТАКТЫ</a>
        <a href="profile.php" class="last">ПРОФИЛЬ</a>
      </div>
    </header>
    <div class="content_category">
      <?php
      $sql = "SELECT * FROM product WHERE category = $category_id";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              // Вывод информации о продукте в виде стилизованного блока
              echo '<div class="block_category">';
              echo '<img src="' . $row['image'] . '" alt="" />';
              echo '<span class="block_category_count">' . $row['price'] . ' ₽/шт</span>';
              echo '<span class="block_category_name">' . $row['name'] . '</span>';
              echo '<span class="block_category_description">' . $row['description'] . '</span>';
              echo '<button class="block_category_btn">В корзину</button>';
              echo '</div>';
          }
      } else {
          echo "Нет продуктов в выбранной категории";
      }
      ?>
          
    </div>
  </body>
</html>