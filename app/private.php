<?php 
session_start();

if ($user['password'] === $password) {
    $_SESSION['connected'] = true;
    header('Location: /cache/login.php');
}

echo 'Bienvenue';

?>