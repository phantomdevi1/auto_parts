<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Добавление товара\категории</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <?
  session_start();
  if ($_SESSION['admin_status'] == 0) {
    header("Location: profile.php");
    exit;
}
include 'config.php';

if (!$conn)
{
  die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}
$category_name_query = "SELECT ID, category_name FROM category"
// $result = mysqli_query($conn, $category_name_query);
// if ($result && mysqli_num_rows($result) > 0) {
//   $row = mysqli_fetch_assoc($result);
//   $category_name = $row['category_name'];
// }
  ?>
  <body>
    <header class="header_index">
      <img src="img/logo.svg" alt="" />
      <h1 class="heading_text">ДОБАВЛЕНИЕ</h1>
      <div class="toolbar">
        <a href="index.html">ГЛАВНАЯ</a>
        <a href="catalog.php">КАТАЛОГ</a>
        <a href="basket.php">КОРЗИНА</a>
        <a href="reviews.php">ОТЗЫВЫ</a>
        <a href="profile.php" class="last">ПРОФИЛЬ</a>
      </div>
    </header>
    <div class="content_create_product">
      <div class="add_product">
        <h2>Добавление товара</h2>
        <p>Добавьте фото:</p>
        <form action="" method = "post" class="add_product_form">
        <input type = "file" class="add_img" accept="image/*"></input>
        <input
          type="text"
          placeholder="Имя товара"
          name="name_product"
          class="add_product_name"
        />
        <select name="category" id="" class="choose_category">
          <option value="1">Масла и фильтры</option>
        </select>
        <input
          type="number"
          placeholder="Стоимость товара за шт."
          name="add_price"
          class="add_product_price"
        />
        <textarea
          id=""
          cols="30"
          rows="10"
          name="description_product"
          class="add_description_product"
          placeholder="Описание товара"
        ></textarea>
        <input
          type="submit"
          name=""
          id=""
          value="Добавить товар"
          class="add_product_btn"
        />
        </form>
      </div>
      <?
      $targetDir = "img/product/";
      $targetFile = $targetDir . auto_parts($_FILES["product_image"]["name"]);
      $imagePath = $targetFile;
      $productName = $_POST[name_product];
      $productCategory = $_POST[category];
      $productPrice = $_POST[add_price];
      $productDescription = $_POST[description_product];
      $sql = "INSER INTO product(name, description, price, image, category) VALUES ('$productName', '$productDescription', '$productPrice', '$imagePath', '$productCategory');"

      ?>
      <div class="add_category">
        <h2>Добавление категории</h2>
        <input
          type="text"
          placeholder="Название категории"
          name="name_category"
          class="add_product_name"
        />
        <input
          type="submit"
          name=""
          id=""
          value="Добавить категорию"
          class="add_product_btn"
        />
      </div>
    </div>
    <script>
     
    </script>
  </body>
</html>
