<?php
    //session_start();

    require 'BackEnd/db_handler.php';

    /*if(empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }*/

    if(isset($_POST['invio'])) {
        require "BackEnd/db_progetto.php";

        $mailU = $_POST['email'];
        $nomeProg = $_POST['nome'];
        $descrizione = $_POST['descrizione'];
        $dataSca = $_POST['dataScadenza'];
        $dataCrea = date("Y-m-d");

        echo $mailU;
        echo $nomeProg;

        $progetto = new db_progetto();

        if ($_POST['nome'] != "" && $_POST['descrizione'] != "") {
            $array = array("leader" => $_POST['email'],
                "nome" => $_POST['nome'],
                "descrizione" => $_POST['descrizione'],
                "data_scadenza" => $dataSca,
                "data_creazione" => $dataCrea);
            $progetto->register($array);

        }
    }


?>
