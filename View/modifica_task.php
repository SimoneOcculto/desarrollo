<?php

    session_start();

    require 'C:/xampp/htdocs/desarrollo/Controller/db_handler.php';

    if(empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }

    require "C:/xampp/htdocs/desarrollo/Controller/db_task.php";

    $flag = false;

    $task = new db_task();
    $ID_task=$_GET['id'];
    $result=$task->getArrayTask($ID_task);

    if(isset($_POST['modifica'])){

        $nomeTask = $_POST['nome'];
        $descrizione = $_POST['descrizione'];
        $dataSca = $_POST['dataScadenza'];
        $priorita = $_POST['priorita'];
        $dataCrea = date("Y-m-d");

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

        $taskt = new db_task();

        if ($ID_task != "") {
            $array = array("ID_Task" => $ID_task,
                "NomeT" => $_POST['nome'],
                "DescrizioneT" => $_POST['descrizione'],
                "DataCreazioneT" => $dataCrea,
                "DataScadenzaT" => $dataSca,
                "Priorita" => $priorita);
            $taskt->UpdateTask($array);
            $flag = true;
        }
    }

    if($flag){
        header("Refresh:0");
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
                    echo"
                            <li class='nav-item'>
                            <a class='nav-link' href = 'gestione_utenti.php'> Users management </a>
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


<form action='modifica_task.php?id=<?php echo $ID_task ?>' method="POST">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 offset-2">
                <label for="inputPassword4">Task's name</label>
                <input type="text" class="form-control" id="inputPassword4" placeholder="Project's name" name="nome" value="<?php echo $result[0]->getNomeT(); ?>">
                <br>
                <label for="exampleFormControlTextarea1" align="center">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" align="center" name="descrizione" ><?php echo $result[0]->getDescrizioneT();?></textarea>
                <br>
                <label>Expiration date</label>
                <br>

                <input type="date" id="dataScadenza" name="dataScadenza" value="<?php echo $result[0]->getDataScadenzaT(); ?>"
                    <?php
                    echo "min=\"".$result[0]->getDataCreazioneT()."\" ";
                    ?>>

                <label>Priority:</label></form</br>
                <?php
                    $pr=$result[0]->getPriorita();
                    switch ($pr)
                    {
                        case 1:
                            echo"
                                <select name='priorita'>
                                    <option value='uno' selected>Low</option>
                                    <option value='due'>Medium</option>
                                    <option value='tre'>High</option>
                                </select>";
                            break;
                        case 2:
                            echo"
                                <select name='priorita'>
                                    <option value='uno'>Low</option>
                                    <option value='due' selected>Medium</option>
                                    <option value='tre'>High</option>
                                </select>";
                            break;
                        case 3:
                            echo"
                                <select name='priorita'>
                                    <option value='uno'>Low</option>
                                    <option value='due'>Medium</option>
                                    <option value='tre' selected>High</option>
                                </select>";
                            break;
                    }
                ?>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 offset-2">
                    <div align="right">
                        <button type="submit" class="btn btn-primary" name="modifica">Modifica</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>

</body>
</html>