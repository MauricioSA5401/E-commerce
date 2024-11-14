<?php
include 'conexion.php'; // Archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Encriptar la contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Verificar si el usuario ya existe
    $query = "SELECT * FROM usuarios WHERE username = :username";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':username', $username);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo "El nombre de usuario ya existe. Elige otro.";
    } else {
        // Insertar el nuevo usuario en la base de datos
        $query = "INSERT INTO usuarios (username, password, role) VALUES (:username, :password, :role)";
        $statement = $conexion->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $passwordHash);
        $statement->bindParam(':role', $role);

        if ($statement->execute()) {
            echo "Usuario registrado exitosamente. <a href='../login.html'>Iniciar sesión</a>";
        } else {
            echo "Error al registrar el usuario. Intenta nuevamente.";
        }
    }
}
?>
