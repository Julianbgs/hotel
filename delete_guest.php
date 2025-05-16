<?php
session_start();
include 'db.php';
global $conn;

header('Content-Type: application/json');

if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'error' => 'Доступ запрещен']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Неверный метод запроса']);
    exit();
}

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo json_encode(['success' => false, 'error' => 'Неверный ID гостя']);
    exit();
}

$id = intval($_POST['id']);

$check = mysqli_query($conn, "SELECT id FROM guests WHERE id = $id");
if (mysqli_num_rows($check) == 0) {
    echo json_encode(['success' => false, 'error' => 'Гость не найден']);
    exit();
}

if (mysqli_query($conn, "DELETE FROM guests WHERE id = $id")) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
