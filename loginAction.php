<?php

require 'config.php';
require 'models/Auth.php';

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$pass = filter_input(INPUT_POST,'password');

if($email && $pass) {

    $auth = new Auth($pdo, $base);

    if($auth->validateLogin($email, $pass)) {
        header("Location: ".$base);
        exit;
    }   
}

$_SESSION['alert'] = "Usuario ou senha incorreto";

header("Location: ".$base."/login.php");