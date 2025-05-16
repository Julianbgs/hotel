<?php
session_start();
session_destroy();
setcookie("username", "", time() - 3600, "/"); // удалить куки
header("Location: login.php");
exit();
?>
