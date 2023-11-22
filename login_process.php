<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Hash de la contraseña (deberías usar password_hash() en un entorno de producción)
    $hashedPassword = md5($password);

    // Consulta para verificar el usuario y la contraseña
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$hashedPassword'";
    $result = $conexion->query($query);

    if ($result->num_rows == 1) {
        $_SESSION['user'] = $email;

        // Configurar la cookie sin seguridad
        setcookie('user_insecure', $email, time() + (86400 * 30), "/");
        setcookie('password', $password, time() + (86400 * 30), '/');


        header('Location: home.php');
    } else {
        // Usuario no autenticado, redirigir al formulario de inicio de sesión
        header('Location: login.php');
    }
} else {
    // Redirigir si se intenta acceder directamente
    header('Location: index.php');
}
?>
