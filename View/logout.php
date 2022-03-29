<?php

if(!isset($_SESSION)){
    session_start();
} else {
    header('Location: login.php');
}

session_destroy();

header('Location: login.php');
?>
