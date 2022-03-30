<?php
    session_start();

    require 'C:/xampp/htdocs/desarrollo/Model/db_handler.php';

    if(empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }

    require "C:/xampp/htdocs/desarrollo/Model/db_utente.php";
    $utente = new db_utente();
    $result = $utente->getUtente($_SESSION['mail']);
?>

<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <form>
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" value="<?php echo $result->getNome(); ?>">

            <label>Cognome</label>
            <input type="text" id="cognome" name="cognome" placeholder="Cognome" value="<?php echo $result->getCognome(); ?>">

            <label>Email</label>
            <input type="text" id="mail" name="mail" placeholder="Mail" value="<?php echo $_SESSION['mail']; ?> ">

            <button type="submit" name="conferma" onclick="controllo()">Modifica dati</button>
        </form>
    </body>
</html>
