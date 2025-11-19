<?php
// Datos de conexión
$servidor = "localhost";
$usuario = "root";
$contraseña = "tu_contraseña_segura"; 
$base_datos = "Restaurante";

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $contraseña, $base_datos);

// Comprobar si hay error
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conexión correcta a la base de datos.";
?>
