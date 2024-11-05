<?php
include 'conectar.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM productos WHERE id = $id");
$producto = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = $_FILES['imagen']['name'];

    if ($imagen) {
        $rutaImagen = 'uploads/' . $imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);
    } else {
        $imagen = $producto['imagen'];
    }

    $stmt = $conn->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, imagen = ? WHERE id = ?");
    $stmt->bind_param("ssdsi", $nombre, $descripcion, $precio, $imagen, $id);
    $stmt->execute();
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
        <textarea name="descripcion"><?php echo $producto['descripcion']; ?></textarea>
        <input type="number" name="precio" value="<?php echo $producto['precio']; ?>" step="0.01" required>
        <input type="file" name="imagen">
        <button type="submit">Actualizar</button>
    </form>
    <a href="index.php">Volver a la lista</a>
</body>
</html>
