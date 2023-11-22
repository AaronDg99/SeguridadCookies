<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Hash de la contraseña utilizando password_hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Consulta preparada para verificar el usuario y la contraseña
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $email); // "s" indica que es una cadena
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Contraseña válida
            $_SESSION['user'] = $email;

            // Regenerar el ID de sesión después de un inicio de sesión exitoso
            session_regenerate_id(true);

            // Configurar la cookie de manera segura
            setcookie('user_insecure', $email, time() + (86400 * 30), "/", "", false, true);

            // No almacenes contraseñas en cookies

            header('Location: home.php');
        } else {
            // Contraseña incorrecta
            header('Location: login.php');
        }
    } else {
        // Usuario no autenticado, redirigir al formulario de inicio de sesión
        header('Location: login.php');
    }
} else {
    // Redirigir si se intenta acceder directamente
    header('Location: index.php');
}
?>

