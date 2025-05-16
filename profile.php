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
    <title>Профиль</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body class="index">

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
    <h1>Личный кабинет</h1>
    <div class="nav-container">
        <p>Имя пользователя: <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p><a class="btn primary" href="adding_guests.php">Добавить гостя</a></p>
    </div>
</div>

</body>
</html>
