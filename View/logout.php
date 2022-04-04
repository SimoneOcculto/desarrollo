<?php
    if(!isset($_SESSION)){
        session_start();
    } else {
        header('Location: nuovo_progetto.php');
    }

    session_destroy();

    header('Location: index.php');
?>
