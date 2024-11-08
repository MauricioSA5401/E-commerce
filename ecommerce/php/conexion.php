<?php
$host = 'localhost'; // Nombre del host
$db = 'ecommerce';//Nombre de la base de datos
$user = 'root';// nombre del admin
$password = '';// contraseña

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}
?>
