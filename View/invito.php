<?php
session_start();

require 'C:/xampp/htdocs/desarrollo/Controller/db_handler.php';

if(empty($_SESSION)) {
    // session isn't started
    header('Location: index.php');
}

require 'C:/xampp/htdocs/desarrollo/Controller/db_partecipazione.php';

$partecipazione = new db_partecipazione();

if ($_GET['opz'] == 0) {
    $partecipazione->AccettaRifiutoInvito($_GET['scelta'], $_GET['id'], $_SESSION['mail'], $_GET['mInvitato']);
} else if ($_GET['opz'] == 1){
    $partecipazione->RevocaInvito($_GET['id'], $_SESSION['mail'], $_GET['mInvitato']);
} else if ($_GET['opz'] == 2) {
    $partecipazione->RevocaInvito($_GET['id'], $_GET['mInvitato'], $_SESSION['mail']);
} else if ($_GET['opz'] == 3){
    $partecipazione->AccettaRifiutoRichiesta($_GET['scelta'], $_GET['id'], $_SESSION['mail'], $_GET['mInvitato']);
}

header('Location: homepage.php');
?>
