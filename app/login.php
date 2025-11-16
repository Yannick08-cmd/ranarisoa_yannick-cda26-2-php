<?php

session_start();

$email = $_POST['email'];
$password = $_POST['password'];



$connectionString = "mysql:host=localhost:3306;dbname=cash;charset=utf8mb4";
$connectionOptions = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($connectionString, 'root', '', $connectionOptions);
/*  $pre = $pdo->query("SELECT * FROM users");
    $users = $pre->fetchAll();

    foreach ($users as $user) {

        if ($user['email'] === $email) {
            if ($user['password'] === $password) {
                $_SESSION['connected'] = true;
                header('Location: /cache/private.php');
            }
        }
    } 
*/

    $sql = ("SELECT email, role FROM users where email = :email AND password = :password ");
    $preq = $pdo->prepare($sql);
    $preq->execute(['email' => $email, 'password' => $password]);
    $user = $preq->fetch();

//Si l'adresse mail et le mdp sont correct par/ à la BD, alors connecté
    if ($user['email'] === $email && $user['password'] === $password) { 
        $_SESSION['connected'] = true;
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['email'];

        echo 'Vous êtes connecté';

    }


} catch (PDOException $e) {
    print_r($e);
}
