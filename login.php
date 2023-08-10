<?php
session_start();

// Check if the provided email and password match the admin credentials
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate admin credentials
    if ($email === 'warrioranime470@gmail.com' && $password === 'admin') {
        $_SESSION['admin'] = true;
    }
}

header('Location: index.php');
?>
