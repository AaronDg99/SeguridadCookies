<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Password hash (you should use password_hash() in a production environment)
    $hashedPassword = md5($password);

    // Query to verify username and password
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$hashedPassword'";
    $result = $conexion->query($query);

    if ($result->num_rows == 1) {
        $_SESSION['user'] = $email;

        // Set the cookie without security
        setcookie('user_insecure', $email, time() + (86400 * 30), "/");
        setcookie('password', $password, time() + (86400 * 30), '/');


        header('Location: home.php');
    } else {
        // Unauthenticated user, redirect to login form
        header('Location: login.php');
    }
} else {
    // Redirect if trying to access directly
    header('Location: index.php');
}
?>