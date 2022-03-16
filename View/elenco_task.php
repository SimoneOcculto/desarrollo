<?php

    require "C:/xampp/htdocs/desarrollo/Model/db_task.php";

    $task = new db_task();

    $array=$task->getAllTask($_GET['id']);

?>

<html>
    <head>
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
            <a class="navbar-brand" href="index.php" style="font-size: 25px;"><b>ToDoGGS</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="elenco_progetti.php">Projects</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Teams</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown link
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>-->
                </ul>
            </div>
        </nav>
        <form method="POST" action="search.php" class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav>
    <div class="container">
<span class="pull-left button-group">
   <a class="btn btn-success" href="nuova_task.php" role="button">New Task</a>
 </span>
    </div>
    <?php
        if ($array == false) {
            echo "<b>Non ci sono task</b> <a href='elenco_progetti.php'><button>Annulla</button></a>";
        } else {
            foreach ($array as $value) {
                echo "
                        <table>
                            <tr>
                                <td>".$value->getId_task()."</td>
                                <td>".$value->getId_progetto()."</td>
                                <td>".$value->getNomeT()."</td>
                                <td>".$value->getDescrizioneT()."</td>
                                <td>".$value->getDataScadenzaT()."</td>
                                <td><a href='elimina_task.php?id=".$value->getId_task()."'><button>Elimina</button></a></td>
                                <td><a href='modifica_progetto.php?id=".$value->getId_task()."'><button>Modifica</button></a></td>
                                <td><a href='elenco_progetti.php'><button>Annulla</button></a></td>
                            </tr>
                        </table>";
            }
        }
    ?>
    </body>
</html>