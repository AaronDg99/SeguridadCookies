<?php
// Configuración de la base de datos
$host = '127.0.0.1';
$usuario = 'root';
$contrasena = '';
$base_datos = 'seguridad';

// Crear conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
