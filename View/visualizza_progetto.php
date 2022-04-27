<?php

session_start();

require 'C:/xampp/htdocs/desarrollo/Controller/db_handler.php';

if(empty($_SESSION)) {
    // session isn't started
    header('Location: index.php');
}

require "C:/xampp/htdocs/desarrollo/Controller/db_progetto.php";
require "C:/xampp/htdocs/desarrollo/Controller/db_partecipazione.php";

$flag = false;

$progetti = new db_progetto();
$ID_Progetto=$_GET['id'];
$result=$progetti->getArrayProgetti($ID_Progetto);

$partecipazione = new db_partecipazione();
$result2=$partecipazione->getStatoProg($ID_Progetto,$_SESSION['mail']);

$result3=$partecipazione->ElencoPartecipanti($ID_Progetto);

if(isset($_POST['modifica'])){
    $nomeProg = $_POST['nome'];
    $descrizione = $_POST['descrizione'];
    $dataSca = $_POST['dataScadenza'];
    $dataCrea = date("Y-m-d");
    $privacy = $_POST['privacy'];

    switch ($privacy)
    {
        case "uno":
            $privacy=1;
            break;
        case "due":
            $privacy=2;
            break;
    }

    $progetto = new db_progetto();

    if ($ID_Progetto != "") {
        $array = array("ID_Progetto" => $ID_Progetto,
            "Leader" => $_SESSION['mail'],
            "NomeP" => $_POST['nome'],
            "DescrizioneP" => $_POST['descrizione'],
            "DataScadenzaP" => $dataSca,
            "DataCreazioneP" => $dataCrea,
            "Privacy" => $privacy);

        $progetto->UpdateProg($array);
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

    <br>
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
                                    <a class='nav-link' href = 'elenco_progetti_completo.php'> All Projects </a>
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

        <div class="container-fluid">
            <div class="row">
                <div class="col-4 offset-2">
                    <label for="inputPassword4">Project's name</label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="Project's name" name="nome" value="<?php echo $result[0]->getNomeP(); ?>" disabled>
                    <br>

                    <label for="exampleFormControlTextarea1" align="center">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" align="center" name="descrizione" disabled><?php echo $result[0]->getDescrizioneP();?></textarea>
                    <br>

                    <label>Expiration date</label>
                    </br>
                    <input type="date" id="dataScadenza" name="dataScadenza" value="<?php echo $result[0]->getDataScadenzaP(); ?>" disabled>
                </div>
            </div>
        </div>
        </br>
        <div class='container'>
        <?php
        if($result2==false){
        ?>
            <span class='pull-center button-group'>
                <a href='elenco_task.php?id=<?php echo $_GET['id']; ?>' class="btn btn-primary"> View Tasks</a>
            </span>
            <span class='pull-right button-group'>
                <a class='btn btn-secondary'  href='elenco_progetti_invitati.php'>Cancel</a>
            </span>

            <?php
        }else if($result2[0]->getStato()==1){
            ?>
            <span class='pull-left button-group'>
                <a class="btn btn-success" href="invito.php?id=<?php echo $_GET['id']; ?>&scelta=0">Accept</a>
            </span>
            <span class='pull-center button-group'>
                <a href='elenco_task.php?id=<?php echo $_GET['id']; ?>' class="btn btn-primary"> View Tasks</a>
            </span>
            <span class='pull-right button-group'>
                <a class="btn btn-danger" href="invito.php?id=<?php echo $_GET['id']; ?>&scelta=1">Decline</a>
            </span>
            <?php
        }else{
            ?>
            <span class='pull-center button-group'>
                <a href='elenco_task.php?id=<?php echo $_GET['id']; ?>' class="btn btn-primary"> View Tasks</a>
            </span>
            <span class='pull-right button-group'>
                <a class='btn btn-secondary'  href='elenco_progetti_invitati.php'>Cancel</a>
            </span>
            <?php
        }
            ?>
        </div>
        partecipanti:</br>
    <?php
    if($result3 == false){
        echo "<b>Nessun Invitato</b>";
    } else {
    foreach ($result3 as $value) {
    ?>
                                        <?php echo "<table>";
                                        echo "<tr>
                                              <td>
                                               ".$value->getInvitato()."
                                               </td></tr>
                                               </table>";
            }
        }
    ?>
    </body>
</html>