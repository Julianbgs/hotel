<?php
session_start();
include 'db.php';
global $conn;

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;

        if (isset($_POST['remember'])) {
            setcookie("username", $username, time() + (86400 * 30), "/");
        }

        header("Location: dashboard.php");
    } else {
        $error = "Неверный логин или пароль.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в систему</title>
    <link rel="stylesheet" href="assets/styles.css">

</head>
<body class="login-page">
<!-- Плавающий фон -->
<ul class="background-bubbles">
    <li></li><li></li><li></li><li></li><li></li>
    <li></li><li></li><li></li><li></li><li></li>
</ul>

<div class="login-container">
    <h2 class="login-title">Вход в систему</h2>

    <?php if (isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" class="login-form">
        <input type="text" name="username" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>

        <div class="remember-me">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Запомнить меня</label>
        </div>

        <button type="submit" name="login">Войти</button>

        <div class="register-link">
            Нет аккаунта? <a href="register.php">Зарегистрируйтесь</a>
        </div>
    </form>
</div>
</body>
</html>