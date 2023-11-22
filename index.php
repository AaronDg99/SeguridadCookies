<?php
session_start();

if (isset($_SESSION['user'])) {
    include('home.php');
} else {
    include('login.php');
}
?>
