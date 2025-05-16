<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body class="dashboard">
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
    <div class="nav-container">
        <h2>Добро пожаловать, <?php echo $_SESSION['username']; ?>!</h2>
        <div class="nav-links">
            <a href="adding_guests.php" class="nav-button">Добавить гостя</a>
            <a href="logout.php" class="logout-button">Выйти</a>
        </div>
    </div>

    <div class="dashboard-content">
        <h3>Главное меню</h3>
        <p>Выберите раздел для работы с системой.</p>
    </div>
</div>

</body>
</html>
