<?php
    session_start();

    require 'C:/xampp/htdocs/desarrollo/Model/db_handler.php';

    if(empty($_SESSION)) {
        // session isn't started
        header('Location: login.php');
    }

    if(isset($_POST['invioP'])) {
        require_once "C:/xampp/htdocs/desarrollo/Model/db_progetto.php";

        $mailU = $_POST['email'];
        $nomeProg = $_POST['nome'];
        $descrizione = $_POST['descrizione'];
        $dataSca = $_POST['dataScadenza'];
        $dataCrea = date("Y-m-d");

        $progetto = new db_progetto();

        if ($_POST['nome'] != "" && $_POST['descrizione'] != "") {
            $array = array("Leader" => $_POST['email'],
                "NomeP" => $_POST['nome'],
                "DescrizioneP" => $_POST['descrizione'],
                "DataScadenzaP" => $dataSca,
                "DataCreazioneP" => $dataCrea);
            $progetto->register($array);
        }

        $ID_Progetto = $progetto->getIdUltimoProgetto($mailU, $dataCrea);
    }

    if(isset($_POST['invioT'])) {
        require "C:/xampp/htdocs/desarrollo/Model/db_task.php";

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

        if ($_GET['id'] != "") {
            $array = array("Progetto" => $_GET['id'],
                "NomeT" => $_POST['nome'],
                "DescrizioneT" => $_POST['descrizione'],
                "DataScadenzaT" => $dataScaTask,
                "DataCreazioneT" => $dataCreaTask,
                "Priorita" => $priorita);
            $task->register($array);
        }
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


    <div class="container-fluid">
        <div class="row">
            <div class="col-4 offset-2">
                <form action='nuova_task.php?id=<?php echo $ID_Progetto ?>' method="POST">
                    <label>
                        <h1>Project:</h1>
                        <h2>
                            <?php
                                require_once "C:/xampp/htdocs/desarrollo/Model/db_progetto.php";
                                $progetti2 = new db_progetto();
                                if(isset($_POST['invioT'])) {
                                    $result = $progetti2->getArrayProgetti($_GET['id']);
                                    echo $result[0]->getNomeP();
                                } else{
                                    $result = $progetti2->getArrayProgetti($ID_Progetto);
                                    echo $result[0]->getNomeP();
                                }
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
                        ?>>

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
                </form>
    </body>
</html>
