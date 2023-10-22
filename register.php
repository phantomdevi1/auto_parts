<?php
$host = "localhost"; // Хост MySQL-сервера
$username = "root"; // Имя пользователя MySQL
$password = ""; // Пароль MySQL
$database = "auto_parts"; // Имя базы данных

// Устанавливаем соединение с базой данных
$conn = new mysqli($host, $username, $password, $database);

// Проверяем соединение на ошибки
if ($conn->connect_error) {
    die("Ошибка соединения с базой данных: " . $conn->connect_error);
}

// Получаем данные из POST-запроса
$user_email = $_POST['user_email'];
$user_phone = $_POST['user_phone'];
$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];

// Защитите данные перед вставкой в базу данных, чтобы избежать SQL-инъекций

// Готовим SQL-запрос для вставки данных
$sql = "INSERT INTO users (user_email, user_phone, user_name, user_password) VALUES (?, ?, ?, ?)";

// Подготавливаем запрос
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $user_email, $user_phone, $user_name, $user_password);

// Выполняем запрос
if ($stmt->execute()) {
    echo "Данные успешно добавлены в базу данных.";
} else {
    echo "Ошибка при добавлении данных: " . $stmt->error;
}

// Закрываем соединение с базой данных
$stmt->close();
$conn->close();
?>
