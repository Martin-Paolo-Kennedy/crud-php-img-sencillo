<?php
$host = 'localhost';
$usuario = 'root'; // Cambia si tienes otro usuario
$contraseña = '';
$baseDeDatos = 'crud_php_img';

$conn = new mysqli($host, $usuario, $contraseña, $baseDeDatos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
