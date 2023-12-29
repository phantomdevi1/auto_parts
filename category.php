 <?php
  session_start();
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
  if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    include 'config.php';

    $sql = "SELECT * FROM category WHERE ID = $category_id";
    $result = mysqli_query($conn, $sql);
  } else {
    echo "Категория не выбрана";
  }
  ?>
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Категория</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header class="header_index">
    <img src="img/logo.svg" alt="">
    <h1 class="heading_text_category">
      <?php
      if (isset($result)) {
        $row = mysqli_fetch_assoc($result);
        $category_name = $row['category_name'];
        echo $category_name;
      } else {
        echo "Категория не выбрана";
      }
      ?>
    </h1>
    <div class="toolbar">
        <a href="index.html">ГЛАВНАЯ</a>
        <a href="catalog.php">КАТАЛОГ</a>
        <a href="basket.php">КОРЗИНА</a>
        <a href="reviews.php">ОТЗЫВЫ</a>        
        <a href="profile.php" class="last">ПРОФИЛЬ</a>
      </div>
  </header>
  <div class="content_category">
  
    <?php
    $sql = "SELECT * FROM product WHERE category = $category_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="block_category">';
        echo '<img src="' . $row['image'] . '" alt="" />';
        echo '<span class="block_category_count">' . $row['price'] . ' ₽/шт</span>';
        echo '<span class="block_category_name">' . $row['name'] . '</span>';
        
        
        if (!empty($row['description'])) {
          echo '<span class="block_category_description">' . $row['description'] . '</span>';
        }
        
        echo '<a href="#" class="read-more-link">Читать далее</a>';
        ?>
        <form method="POST" action="">
        <span>Количество:</span><input class="quantity_category" type="number" value="1" min="1" name="quantity_category">        
        <input type="hidden" name="product_id" value="<?php echo $row['ID']; ?>">
        <button type="submit" class="block_category_btn" name="add_to_cart">Добавить в корзину</button>
      </form>

        <?php
        echo '</div>';
      }
    } else {
      echo "Нет продуктов в выбранной категории";
    }

    if (isset($_POST['add_to_cart'])) {
      $product_id = $_POST['product_id'];
      $quantity_category = isset($_POST['quantity_category']) ? intval($_POST['quantity_category']) : 1;
  
      
      $insert_sql = "INSERT INTO cart (user_id, product_id, quantity, date_added) VALUES ($user_id, $product_id, $quantity_category, NOW())";
      mysqli_query($conn, $insert_sql);
  
      echo "<script>alert('Товар добавлен в корзину!');</script>";
  }
  
    ?>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var descriptions = document.querySelectorAll('.block_category_description');

      descriptions.forEach(function (description) {
        var readMoreLink = description.nextElementSibling;

        if (description.offsetHeight < description.scrollHeight) {
          readMoreLink.classList.add('active');

          readMoreLink.addEventListener('click', function (event) {
            event.preventDefault();
            description.style.maxHeight = 'none';
            readMoreLink.style.display = 'none';
          });
        }
      });
    });
    <? }
    else{
      header("Location: auth.php");
      exit();
    } ?>
  </script>
</body>
</html>
