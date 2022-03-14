<?php
    session_start();

    require 'C:/xampp/htdocs/desarrollo/Model/db_handler.php';

    if(!empty($_SESSION)) {
        // session isn't started
        header('Location: homepage.php');
    }

    $flag = false;

    if(isset($_POST['hashedPassword'])) {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        require "C:/xampp/htdocs/desarrollo/Model/db_utente.php";
        $utente = new db_utente();
        if($utente->checkUtente($email)){
            $array = array("email" => $email,
                "nome" => $nome,
                "cognome" => $cognome,
                "password" => $password);
            $utente = new db_utente();
            $utente->register($array);

            header('Location: index.php');

            $flag = false;
        } else {
            $flag = true;
        }
    }
?>

<html>
    <head>

    </head>

    <body>
        <form>
            <label>Nome</label>
            <input type="nome" id="nome" placeholder="nome" required>

            <label>Cognome</label>
            <input type="cognome" id="cognome" placeholder="cognome" required>

            <label>Email address</label>
            <input type="email" id="email" placeholder="email" required>

            <label>Password</label>
            <input type="password" id="password" placeholder="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$" required>
        </form>
    </body>
</html>
