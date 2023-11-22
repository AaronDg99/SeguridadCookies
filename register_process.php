<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];

    // Hash de la contraseña (deberías usar password_hash() en un entorno de producción)
    $hashedPassword = md5($password);

    // Consulta para insertar un nuevo usuario
    $query = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";

    if ($conexion->query($query) === TRUE) {
        // Registro exitoso, redirigir al formulario de inicio de sesión
        header('Location: login.php');
    } else {
        // Error en el registro, redirigir al formulario de registro
        header('Location: register.php');
    }
} else {
    // Redirigir si se intenta acceder directamente
    header('Location: index.php');
}
?>
