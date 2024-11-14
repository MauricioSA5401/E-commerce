<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit;
}
echo "<h1>Bienvenido, Admin</h1>";
?>
