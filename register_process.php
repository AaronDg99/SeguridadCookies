<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];

    // Password hash (you should use password_hash() in a production environment)
    $hashedPassword = md5($password);

    // Query to insert a new user
    $query = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";

    if ($conexion->query($query) === TRUE) {
        // Successful registration, redirect to login form
        header('Location: login.php');
    } else {
        // Registration error, redirect to registration form
        header('Location: register.php');
    }
} else {
    // Redirect if trying to access directly
    header('Location: index.php');
}
?>
