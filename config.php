<?php
$host = "localhost";
$user = "root"; // Ваше имя пользователя по умолчанию
$pass = "root"; // Ваш пароль по умолчанию
$database = "auto_parts";

// Создаем подключение
$conn = mysqli_connect($host, $user, $pass, $database);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
?>
