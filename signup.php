<?php 
require 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Signup</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base?>assets/css/login.css" />
</head>
<body>
    <header>
        <div class="container">
            <a href=""><img src="<?=$base?>assets/images/devsbook_logo.png" /></a>
        </div>
    </header>
    <section class="container main">
        <form method="POST" action="<?=$base?>signupAction.php">

            <?php if(!empty($_SESSION['alert'])):?>
                <?=$_SESSION['alert'];?>
                <?php $_SESSION['alert'] = '';?>
            <?php endif;?>

            <input placeholder="Digite seu nome completo" class="input" type="text" name="name"/>

            <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />

            <input placeholder="Digite sua data de nascimento" class="input" type="text" name="birthdate" id="birthdate"/>

            <input placeholder="Digite sua senha" class="input" type="password" name="password" />

            <input class="button" type="submit" value="Acessar o sistema" />

            <a href="<?=$base?>login.php">Ja tem conta? faca o login</a>
        </form>
    </section>
    <script src="https://unpkg.com/imask"></script>
    <script>
        let element = document.getElementById('birthdate');
        let mask = {
            mask: '00/00/0000'
        }
        IMask(element,mask);
    
    </script>
</body>
</html>