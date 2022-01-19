<?php

require 'config.php';
require 'models/Auth.php';

$name = filter_input(INPUT_POST,'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$pass = filter_input(INPUT_POST,'password');
$birthdate = filter_input(INPUT_POST,'birthdate'); //00/00/0000

if($email && $pass && $birthdate && $name) {

    $auth = new Auth($pdo, $base);

    $birthdate = explode('/', $birthdate);

    if(count($birthdate) != 3){
        $_SESSION['alert'] = 'Preencha a data no formato dd/mm/yyyy';
        header('Location: '.$base.'signup.php');
        exit;
    }

    $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];

    if(!strtotime($birthdate)){
        $_SESSION['alert'] = 'Data de nascimento invalida';
        header('Location: '.$base.'signup.php');
        exit;
    }

    if($auth->emailExist($email)) {
        $_SESSION['alert'] = 'Email ja cadastrado';
        header('Location: '.$base.'signup.php');
        exit;
    } else {
        $auth->registerUser($name, $email, $pass, $birthdate);
        header('Location: '.$base);
        exit;
    } 
}

$_SESSION['alert'] = "Erro ao cadastrar";
header("Location: ".$base."signup.php");