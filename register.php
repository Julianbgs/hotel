<?php
include 'db.php';
global $conn;

if (!$conn) {
    die('Ошибка подключения к базе данных!');
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $query)) {
        $success = "Регистрация успешна! <a href='login.php'>Войти в систему</a>";
    } else {
        $error = "Ошибка: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация в системе</title>
    <link rel="stylesheet" href="assets/styles.css">

</head>
<body class="register-page">
<!-- Плавающий фон -->
<ul class="background-bubbles">
    <li></li><li></li><li></li><li></li><li></li>
    <li></li><li></li><li></li><li></li><li></li>
</ul>

<div class="register-container">
    <h2 class="register-title">Регистрация</h2>

    <?php if (isset($error)): ?>
        <div class="alert error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" class="register-form">
        <input type="text" name="username" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>

        <button type="submit" name="register">Зарегистрироваться</button>

        <div class="login-link">
            Уже есть аккаунт? <a href="login.php">Войти</a>
        </div>
    </form>
</div>
</body>
</html>