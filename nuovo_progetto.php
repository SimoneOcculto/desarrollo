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
            $array = array("Leader" => $_POST['email'],
                "NomeP" => $_POST['nome'],
                "DescrizioneP" => $_POST['descrizione'],
                "DataScadenzaP" => $dataSca,
                "DataCreazioneP" => $dataCrea);
            $progetto->register($array);

        }
    }

?>

<html>
    <head>

    </head>

    <body>
        <form action="" method="POST">
            <label>Email </label></br>
            <input type="email" name="email" required></br>
            <label>Nome progetto</label></br>
            <input type="text" id="nome" name="nome" required></br>
            <label>Descrizione</label></br>
            <textarea id="descrizione" name="descrizione" required></textarea></br>
            <label>Data scadenza</label></br>
            <input type="date" id="dataScadenza" name="dataScadenza" <?php
                $date=date_create(date("Y-m-d"));
                echo "min=\"".date_format($date,"Y-m-d")."\" ";
                ?>
            ></br>
            <input type="submit" name="invio">
        </form>
    </body>
</html>
