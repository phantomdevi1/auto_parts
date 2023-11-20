<?php
$host = "localhost";
$user = "root";
$pass = "root";
$database = "auto_parts";

// Создаем подключение
$conn = mysqli_connect($host, $user, $pass, $database);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

session_start();
?>
