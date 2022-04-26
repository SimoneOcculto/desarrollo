<?php
session_start();

require 'C:/xampp/htdocs/desarrollo/Controller/db_handler.php';

if(empty($_SESSION)) {
    // session isn't started
    header('Location: index.php');
}

require 'C:/xampp/htdocs/desarrollo/Controller/db_progetto.php';

$progetto = new db_progetto();

$leaderProg = $progetto->getLeaderProg($_GET['id']);

require 'C:/xampp/htdocs/desarrollo/Controller/db_partecipazione.php';

$partecipazione = new db_partecipazione();

$array = array("Invitante" => $leaderProg,
                    "Invitato" => $_SESSION['mail'],
                    "Progetto" => $_GET['id'],
                    "Stato" => '4');

$partecipazione->NewRelazione($array);

header('Location: search.php');

?>
