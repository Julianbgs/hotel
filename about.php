<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>О нас</title>
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
    <h1>Об отеле</h1>
    <div class="nav-container">
        <p>Отель Ermilot — Ваш идеальный отдых в сердце города

            Добро пожаловать в Ermilot — отель, где современный комфорт встречается с теплотой традиционного гостеприимства. Мы создали пространство, в котором каждый гость чувствует себя особенным.

            Наша философия
            В Ermilot мы верим, что настоящий отдых начинается с мелочей:

            Индивидуальный подход к каждому гостю

            Безупречный сервис без лишней помпезности

            Гармония комфорта и стиля</p>
    </div>
</div>

</body>
</html>
