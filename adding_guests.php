<?php
session_start();
include 'db.php';
global $conn;

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_guest'])) {
    $fullName = mysqli_real_escape_string($conn, $_POST['full_name']);
    $passport = mysqli_real_escape_string($conn, $_POST['passport']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $roomNumber = mysqli_real_escape_string($conn, $_POST['room_number']);
    $checkIn = mysqli_real_escape_string($conn, $_POST['check_in']);
    $checkOut = mysqli_real_escape_string($conn, $_POST['check_out']);

    $query = "INSERT INTO guests (full_name, passport_number, phone_number, room_number, check_in_date, check_out_date) 
              VALUES ('$fullName', '$passport', '$phone', '$roomNumber', '$checkIn', '$checkOut')";

    if (mysqli_query($conn, $query)) {
        $success = "Гость успешно добавлен!";
    } else {
        $error = "Ошибка: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление гостя</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body class="add-guest-page">

<ul class="background-bubbles">
    <li></li><li></li><li></li><li></li><li></li>
    <li></li><li></li><li></li><li></li><li></li>
</ul>

<nav class="navigation">
    <div class="nav-container">
        <a href="index.php" class="nav-logo">Отель Ermilot</a>
        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <label for="nav-toggle" class="nav-burger">&#9776;</label>
        <div class="nav-links">
            <a href="index.php">Главная</a>
            <a href="about.php">О нас</a>
            <a href="profile.php">Профиль</a>
            <a href="adding_guests.php">Добавить гостя</a>
            <a href="guest-list.php">Список гостей</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php" class="danger">Выход</a>
            <?php else: ?>
                <a href="login.php">Вход</a>
                <a href="register.php">Регистрация</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">
    <h1>Добавление нового гостя</h1>

    <?php if (isset($error)): ?>
        <div class="alert error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" class="guest-form">
        <div class="form-group">
            <label for="full_name">ФИО гостя</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>

        <div class="form-group">
            <label for="passport">Паспортные данные</label>
            <input type="text" id="passport" name="passport" required>
        </div>

        <div class="form-group">
            <label for="phone">Номер телефона</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="room_number">Номер комнаты</label>
                <input type="text" id="room_number" name="room_number" required>
            </div>

            <div class="form-group">
                <label for="check_in">Дата заезда</label>
                <input type="date" id="check_in" name="check_in" required>
            </div>

            <div class="form-group">
                <label for="check_out">Дата выезда</label>
                <input type="date" id="check_out" name="check_out" required>
            </div>
        </div>

        <button type="submit" name="add_guest" class="btn primary">Добавить гостя</button>
        <a href="adding_guests.php" class="btn secondary">Отмена</a>
    </form>
</div>

</body>
</html>