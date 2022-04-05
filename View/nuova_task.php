<?php
    session_start();

    require 'C:/xampp/htdocs/desarrollo/Controller/db_handler.php';

    $flag = false;

    if (empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }

    if(strcmp($_SESSION['ruolo'], "A") == 0){
        header('Location: elenco_progetti.php');
    }

    if(isset($_POST['invioT'])) {
        require "C:/xampp/htdocs/desarrollo/Controller/db_task.php";

        $nomeTask = $_POST['nome'];
        $descrizioneTask = $_POST['descrizione'];
        $dataScaTask = $_POST['dataScadenza'];
        $dataCreaTask = date("Y-m-d");
        $priorita = $_POST['priorita'];

        switch ($priorita)
        {
            case "uno":
                $priorita=1;
                break;
            case "due":
                $priorita=2;
                break;
            case "tre":
                $priorita=3;
                break;
        }

        $task = new db_task();

        $array = array("Progetto" => $_SESSION['progetto'],
            "NomeT" => $_POST['nome'],
            "DescrizioneT" => $_POST['descrizione'],
            "DataScadenzaT" => $dataScaTask,
            "DataCreazioneT" => $dataCreaTask,
            "Priorita" => $priorita);

        $task->register($array);

        header ('Refresh:0');
    }
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
                        <a class="nav-link" href="elenco_progetti.php">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profilo.php">Profile</a>
                    </li>
                    <?php
                    if(strcmp($_SESSION['ruolo'], "A") == 0) {
                        echo"
                            <li class='nav-item'>
                            <a class='nav-link' href = 'gestione_utenti.php'> Users Management </a>
                            </li>
                            ";
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


    <div class="container-fluid">
        <div class="row">
            <div class="col-4 offset-2">
                <form action='nuova_task.php' method="POST">
                    <label>
                        <h1>Project:</h1>
                        <h2>
                            <?php
                                require_once "C:/xampp/htdocs/desarrollo/Controller/db_progetto.php";
                                $progetti2 = new db_progetto();
                                $result = $progetti2->getArrayProgetti($_SESSION['progetto']);
                                echo $result[0]->getNomeP();
                            ?>
                        </h2>
                    </label></br>

                    <label for="inputPassword4">Task's name</label>
                    <input type="text" class="form-control" id="nome" placeholder="Task's name" name="nome" required></br>

                    <label for="exampleFormControlTextarea1" align="center">Description</label>
                    <textarea class="form-control" id="descrizione" rows="3" align="center" name="descrizione" required></textarea></br>

                    <label>Expiration date</label></br>
                    <input type="date" id="dataScadenza" name="dataScadenza"
                        <?php
                            $date=date_create(date("Y-m-d"));
                            echo "min=\"".date_format($date,"Y-m-d")."\" ";
                        ?> required>

                    <label>Priority:</label></form</br>
                    <select name="priorita">
                        <option value="uno">Low</option>
                        <option value="due">Medium</option>
                        <option value="tre">High</option>
                    </select>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 offset-2">
                        <div align="right">
                            <button type="submit" class="btn btn-primary" name="invioT">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                </form>
    </body>
</html>
