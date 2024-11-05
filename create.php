<?php
include 'conectar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $imagen = $_FILES['imagen']['name'];
    $rutaImagen = 'uploads/' . $imagen;

    move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);

    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $nombre, $descripcion, $precio, $imagen);
    $stmt->execute();
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
</head>
<body>
    <h1>Agregar Producto</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <textarea name="descripcion" placeholder="Descripción"></textarea>
        <input type="number" name="precio" placeholder="Precio" step="0.01" required>
        <input type="file" name="imagen" required>
        <button type="submit">Agregar</button>
    </form>
    <a href="index.php">Volver a la lista</a>
</body>
</html>
