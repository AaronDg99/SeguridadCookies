<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];

    // Hash de la contraseña utilizando password_hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Consulta preparada para insertar un nuevo usuario
    $query = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ss", $email, $hashedPassword); // "ss" indica que son cadenas

    if ($stmt->execute() === TRUE) {
        // Registro exitoso, redirigir al formulario de inicio de sesión
        header('Location: login.php');
    } else {
        // Error en el registro, redirigir al formulario de registro
        echo "Error en la inserción: " . $stmt->error;
        // Puedes redirigir o manejar el error de otra manera según tus necesidades
    }
} else {
    // Redirigir si se intenta acceder directamente
    header('Location: index.php');
}
?>
