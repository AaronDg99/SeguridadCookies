<?php
//Database configuration
$host = '127.0.0.1';
$usuario = 'root';
$contrasena = '';
$base_datos = 'seguridad';

// Create connection
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verify connection
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
