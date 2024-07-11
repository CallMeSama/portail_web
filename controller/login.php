<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'admin' && $password == 'passer') {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: ../view/listeFilmsVueAdmin.php');
        exit();
    } else {
        $_SESSION['error'] = "Cet utilisateur n'existe pas.";
        header('Location: ../view/login.php');
        exit();
    }
} else {
    header('Location: ../view/login.php');
    exit();
}
?>
