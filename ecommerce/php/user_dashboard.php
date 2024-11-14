<?php
session_start();
if ($_SESSION['role'] !== 'usuario') {
    header("Location: login.html");
    exit;
}
echo "<h1>Bienvenido, Usuario</h1>";
?>
