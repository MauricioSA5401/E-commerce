<?php
session_start();
include 'conexion.php'; // Archivo que contiene la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para obtener el usuario
    $query = "SELECT * FROM usuarios WHERE username = :username";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':username', $username);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirección basada en el rol
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php"); // Redirigir al panel del admin
        } else {
            header("Location: user_dashboard.php"); // Redirigir al panel del usuario
        }
        exit;
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>
