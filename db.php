<?php
global $conn;
$host = 'localhost';
$user = 'root'; // По умолчанию в OpenServer
$pass = 'root';     // Пароль пустой
$db = 'hotel';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die('Ошибка подключения к БД: ' . mysqli_connect_error());
}
?>
