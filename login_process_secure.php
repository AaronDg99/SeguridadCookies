<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Password hashing using password_hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepared query to verify username and password
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $email); // "s" indicates that it is a string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            //Valid password
            $_SESSION['user'] = $email;

            // Regenerate session ID after successful login
            session_regenerate_id(true);

            // Set the cookie safely
            setcookie('user_insecure', $email, time() + (86400 * 30), "/", "", false, true);

            // Do not store passwords in cookies

            header('Location: home.php');
        } else {
            //Incorrect password
            header('Location: login.php');
        }
    } else {
        // Unauthenticated user, redirect to login form
        header('Location: login.php');
    }
} else {
    //Redirect if trying to access directly
    header('Location: index.php');
}
?>

