<?php
    if(!isset($_SESSION)){
        session_start();
    } else {
        header('Location: homepage.php');
    }

    session_destroy();

    header('Location: index.php');
?>
