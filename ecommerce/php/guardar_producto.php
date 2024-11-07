<?php
include 'conexion.php';

// Verifica si se han enviado todos los datos necesarios
if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio']) && isset($_FILES['imagen'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    
    // Manejo de la imagen
    $imagen = $_FILES['imagen'];
    $nombreImagen = basename($imagen['name']);
    $rutaImagen = '../imagenes/' . $nombreImagen;

    // Mueve la imagen a la carpeta 'imagenes'
    if (move_uploaded_file($imagen['tmp_name'], $rutaImagen)) {
        // Inserta el producto en la base de datos
        $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (:nombre, :descripcion, :precio, :imagen)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':imagen', $nombreImagen);

        if ($stmt->execute()) {
            echo "<p>Producto agregado exitosamente.</p>";
            echo '<a href="../index.html" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Volver al Inicio</a>';
        } else {
            echo "<p>Error al agregar el producto.</p>";
        }
    } else {
        echo "<p>Error al subir la imagen.</p>";
    }
} else {
    echo "<p>Por favor, completa todos los campos.</p>";
}
?>
