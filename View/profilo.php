<?php
    session_start();

    require 'BackEnd/db_handler.php';

    if(empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Nome" value="
            <?php
                echo $_SESSION['nome'];
            ?>
        ">

        <label>Cognome</label>
        <input type="text" id="cognome" name="cognome" placeholder="Cognome" value="
            <?php
                echo $_SESSION['cognome'];
            ?>
        ">

        <label>Email</label>
        <input type="text" id="mail" name="mail" placeholder="Mail" value="
            <?php
                echo $_SESSION['mail'];
            ?>
        ">

        <label>Password</label>
        <input type="password" id="password" name="password" placeholder="Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$">

        <label>Conferma password</label>
        <input type="password" id="confermaPassword" name="confermaPassword" placeholder="Conferma password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$">

        <button type="submit" name="conferma" onclick="controllo()">Modifica dati</button>
        </form>
    </body>
</html>
