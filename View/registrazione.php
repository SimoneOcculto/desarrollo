<?php

    session_start();

    require 'C:/xampp/htdocs/desarrollo/Model/db_handler.php';

    if(!empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }

    $flag = false;

    if(isset($_POST['conferma'])) {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        require "C:/xampp/htdocs/desarrollo/Model/db_utente.php";
        $utente = new db_utente();
        if($utente->checkUtente($email)){
            $array = array("mail" => $email,
                "password" => $password,
                "nome" => $nome,
                "cognome" => $cognome);
            $utente->register($array);

            header('Location: index.php');

            $flag = false;
        } else {
            $flag = true;
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript">
            function controllo(){
                var password = document.getElementById("password").value;
                var conferma = document.getElementById("confermaPassword").value;
                if(password == conferma){
                    return true;
                }else{
                    //document.getElementById("confermaPassword").classList.add("is-invalid");
                    return false;
                }
            }
        </script>
    </head>

    <body>
        <form onsubmit="return controllo();" action="registrazione.php" method="POST">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" pattern="[a-zA-Z]{2,40}" >

            <label>Cognome</label>
            <input type="text" id="cognome" name="cognome" placeholder="Cognome" pattern="[a-zA-Z]{2,50}">

            <label>Email</label>
            <?php
                if($flag) {
                    echo "<input type=\"email\" class=\"form-control is-invalid\" id=\"email\" name=\"email\" placeholder=\"Email\">";
                } else{
                    echo "<input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" placeholder=\"Email\">";
                }
            ?>

            <label>Password</label>
            <input type="password" id="password" name="password" placeholder="Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$">

            <label>Conferma password</label>
            <input type="password" id="confermaPassword" name="confermaPassword" placeholder="Conferma password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$">

            <button type="submit" name="conferma" onclick="controllo()">Registrati</button>
        </form>

        <script type="text/javascript" src="Script.js"></script>
    </body>
</html>
