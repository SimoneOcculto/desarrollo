<?php
session_start();

require 'C:/xampp/htdocs/desarrollo/Controller/db_handler.php';

if(empty($_SESSION)) {
    // session isn't started
    header('Location: index.php');
}

require 'C:/xampp/htdocs/desarrollo/Controller/db_partecipazione.php';

$partecipazione = new db_partecipazione();

$partecipazione->AccettaRifiutoInvito($_GET['scelta'], $_GET['id'], $_SESSION['mail']);

header('Location: homepage.php');
?>
