<?php
session_start();
include 'db.php';
global $conn;

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Добавление гостя
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
        $_SESSION['success'] = "Гость успешно добавлен!";
        header("Location: adding_guests.php");
        exit();
    } else {
        $error = "Ошибка: " . mysqli_error($conn);
    }
}

// Удаление гостя
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $query = "DELETE FROM guests WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Гость успешно удален!";
        header("Location: adding_guests.php");
        exit();
    } else {
        $error = "Ошибка при удалении: " . mysqli_error($conn);
    }
}

// Получение списка гостей
$query = "SELECT * FROM guests ORDER BY check_in_date DESC";
$result = mysqli_query($conn, $query);
$guests = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление гостями</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body class="guests-page">

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
    <div class="header-row">
        <h1>Управление гостями</h1>
        <a href="adding_guests.php" class="btn success">+ Добавить гостя</a>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="guest-list-container">
        <table class="guest-table">
            <thead>
            <tr>
                <th>ФИО</th>
                <th>Паспорт</th>
                <th>Телефон</th>
                <th>Комната</th>
                <th>Заезд</th>
                <th>Выезд</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($guests as $guest): ?>
                <tr>
                    <td><?php echo htmlspecialchars($guest['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($guest['passport_number']); ?></td>
                    <td><?php echo htmlspecialchars($guest['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($guest['room_number']); ?></td>
                    <td><?php echo date('d.m.Y', strtotime($guest['check_in_date'])); ?></td>
                    <td><?php echo date('d.m.Y', strtotime($guest['check_out_date'])); ?></td>
                    <td class="actions">
                        <a href="#"
                           class="btn small danger delete-guest"
                           data-id="<?= $guest['id'] ?>">🗑️</a>                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-guest').on('click', function(e) {
            e.preventDefault();
            const guestId = $(this).data('id');
            const guestRow = $(this).closest('tr');

            if (confirm('Вы уверены, что хотите удалить этого гостя?')) {
                $.ajax({
                    url: 'delete_guest.php',
                    type: 'POST',
                    data: { id: guestId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            guestRow.fadeOut(300, function() {
                                $(this).remove();
                                showAlert('Гость успешно удален', 'success');
                            });
                        } else {
                            showAlert('Ошибка: ' + response.error, 'error');
                        }
                    },
                    error: function() {
                        showAlert('Ошибка соединения с сервером', 'error');
                    }
                });
            }
        });

        // Функция для показа уведомлений
        function showAlert(message, type) {
            const alert = $('<div class="alert ' + type + '">' + message + '</div>');
            $('.container').prepend(alert);
            setTimeout(() => alert.fadeOut(), 5000);
        }
    });
</script>
</body>
</html>