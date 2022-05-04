<?php
    session_start();

    require 'C:/xampp/htdocs/desarrollo/Controller/db_handler.php';

    if(empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }

    require "C:/xampp/htdocs/desarrollo/Controller/db_task.php";

    $task = new db_task();

    $array=$task->getAllTask($_GET['id']);

    $_SESSION['progetto'] = $_GET['id'];
?>

<html>
    <head>
        <style>
            <?php include 'style.css'; ?>
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="//code.jquery.com/jquery.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="utf-8">
    </head>

    <body>
        <nav class="navbar navbar-light bg-light justify-content-between">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="homepage.php" style="font-size: 25px;"><b>ToDoGGS</b></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="elenco_progetti.php">My projects</a>
                        </li>
                        <?php
                        if(strcmp($_SESSION['ruolo'], "A") == 0) {
                            echo"
                                 <li class='nav-item'>
                                    <a class='nav-link' href = 'elenco_progetti_completo.php'> All projects </a>
                                 </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profilo.php">Profile</a>
                        </li>
                        <?php
                        if(strcmp($_SESSION['ruolo'], "A") == 0) {
                            echo "
                                    <li class='nav-item'>
                                        <a class='nav-link' href = 'gestione_utenti.php'>Users management</a>
                                    </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <form method="POST" action="search.php" class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>

        <div class='container'>
            <?php
            require "C:/xampp/htdocs/desarrollo/Controller/db_progetto.php";

            $progetto = new db_progetto();

            $leaderProg = $progetto->getLeaderProg($_GET['id']);

            $flag = false;

            if(strcmp($_SESSION['mail'], $leaderProg) == 0) {
                echo "
                        <span class='pull-left button-group'>
                            <a class='btn btn-success' href='nuova_task.php?id=".$_GET['id']."' role='button'>New Task</a>
                        </span>";

                $flag = true;
            }
            ?>
            <span class='pull-right button-group'>
                <a class='btn btn-secondary' href='elenco_progetti.php' role='button'>Cancel</a>
            </span>
        </div>

        <br>

        <?php
        if ($array == false) {
            echo "
                <div class='supremo'>
                    <h3>There aren't tasks here!</h3>
                    <span class='pull-right button-group'> 
                        <a href='elenco_progetti.php' class='btn btn-primary'>Back</a>
                    </span>
                    <br>
                </div>";
        } else {
            foreach ($array as $value) {
        ?>
                <div class="container">
                    <ul class="list-group">
                        <li class="list-group-item clearfix">

                            <?php
                            echo "
                                <table>
                                    <tr>
                                        
                                        ".$value->getNomeT()."
                                        
                                        <b>
                                        ".$value->getDataScadenzaT()."
                                        </b>
                  
                                    </tr>
                                </table>"
                            ?>


                            <?php
                                echo "
                                    <span class='pull-right button-group'>
                                        <a href='modifica_task.php?id=".$value->getId_task()."' class='btn btn-primary'> <span class='glyphicon glyphicon-edit'></span> Edit</a>
                                        <a href='visualizza_task.php?id=".$value->getId_task()."' class='btn btn-primary'> View Task</a>
                                        <a href='sposta_task.php?id=".$value->getId_task()."' class='btn btn-primary'> Move Task</a>
                                        <a href='elimina_task.php?id=".$value->getId_task()."' class='btn btn-danger'> <span class='glyphicon glyphicon-remove'></span> Delete</a>
                                    </span>";

                            ?>
                        </li>
                    </ul>
                </div>
        <?php

        }
        }
        ?>
    </body>
</html>