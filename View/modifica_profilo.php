<?php
    session_start();

    require "C:/xampp/htdocs/desarrollo/Model/db_utente.php";
    $utente = new db_utente();
    $result = $utente->getUtente($_SESSION['mail']);

    if(isset($_POST['modifica'])){
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];

        $array = array("Nome" => $_POST['nome'],
            "Cognome" => $_POST['cognome'],
            "Mail" => $_SESSION['mail'],
            "Password" => $result->getPassword());

        $utente->UpdateUser($array);

        header('Location: profilo.php');
    }
?>