<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];

    // Password hashing using password_hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //Query ready to insert a new user
    $query = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ss", $email, $hashedPassword); // "ss" indicates that they are strings

    if ($stmt->execute() === TRUE) {
        //Successful registration, redirect to login form
        header('Location: login.php');
    } else {
        // Registration error, redirect to registration form
        echo "Error en la inserción: " . $stmt->error;
        // You can direct or handle the error in another way according to your needs
    }
} else {
    // Redirect if trying to access directly
    header('Location: index.php');
}
?>
