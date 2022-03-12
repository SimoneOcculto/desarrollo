<?php

    //session_start();

    require 'BackEnd/db_handler.php';

    /*if(empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }*/

?>

<html>
    <head>

    </head>

    <body>
        <form action="nuova_task.php" method="POST">
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
            <input type="submit" name="invioP">
        </form>

        <form method="POST" action="search.php">
            <input type="text" placeholder="Search" aria-label="Search" name="search">
            <button type="submit">Ricerca</button>
        </form>
    </body>
</html>
