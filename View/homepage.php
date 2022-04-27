<?php
session_start();

require 'C:/xampp/htdocs/desarrollo/Controller/db_handler.php';

if(empty($_SESSION)) {
    // session isn't started
    header('Location: index.php');
}

require 'C:/xampp/htdocs/desarrollo/Controller/db_partecipazione.php';

$partecipazione = new db_partecipazione();

$array = $partecipazione->RicercaInvitiInSospesoRicevutiUtente($_SESSION['mail']);

$array2 = $partecipazione->RicercaInvitiInSospesoInviatiUtente($_SESSION['mail']);

$array3 = $partecipazione->RicercaRichiesteInSospesoRicevutiUtente($_SESSION['mail']);

$array4 = $partecipazione->RicercaRichiesteInSospesoInviatiUtente($_SESSION['mail']);
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
                        <li class="nav-item">
                            <a class="nav-link" href="elenco_progetti.php">Projects</a>
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


        <div class="supremo">
            <?php
            echo "Invites received:";
            ?>

            </br>

            <?php
            if(!$array){
                echo "Non hai richieste di partecipazione in sospeso!";
            } else{
                foreach ($array as $value) {
            ?>
                    <div class="riga-elenco">
                        <ul class="list-group">
                            <li class="list-group-item clearfix">
                                <span style="position:absolute; top:30%;">
            <?php
                                    echo $value->getInvitante();
            ?>
                                </span>
                                <form>
                                    <span class="pull-right button-group">
                                        <a href='visualizza_progetto.php?id=<?php echo $value->getProgetto(); ?>' class="btn btn-primary">View Proyect</a>
                                        <a class="btn btn-success" href="invito.php?id=<?php echo $value->getProgetto(); ?>&scelta=0&opz=0&mInvitato=<?php echo $value->getInvitante(); ?>">Accept</a>
                                        <a class="btn btn-danger" href="invito.php?id=<?php echo $value->getProgetto(); ?>&scelta=1&opz=0&mInvitato=<?php echo $value->getInvitante(); ?>">Decline</a>
                                    </span>
                                </form>
                            </li>
                        </ul>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        </br>

        <div class="supremo">
            <?php
            echo "Invites sent:";
            ?>
            </br>

            <?php
            if(!$array2){
                echo "Non hai richieste di partecipazione in sospeso!";
            } else{
                foreach ($array2 as $value2) {
            ?>
                    <div class="riga-elenco">
                        <ul class="list-group">
                            <li class="list-group-item clearfix">
                                <span style="position:absolute; top:30%;">
            <?php
                                    echo $value2->getInvitato();
            ?>
                                </span>
                                <form>
                                    <span class="pull-right button-group">
                                        <a href='visualizza_progetto.php?id=<?php echo $value2->getProgetto(); ?>' class="btn btn-primary">View Proyect</a>
                                        <a href='invito.php?id=<?php echo $value2->getProgetto(); ?>&opz=1&mInvitato=<?php echo $value2->getInvitato(); ?>' class="btn btn-danger">Revoke</a>
                                    </span>
                                </form>
                            </li>
                        </ul>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        </br>

        <div class="supremo">
            <?php
            echo "Request received:";
            ?>

            </br>

            <?php
            if(!$array3){
                echo "Non hai richieste di partecipazione in sospeso!";
            } else{
                foreach ($array3 as $value3) {
                    ?>
                    <div class="riga-elenco">
                        <ul class="list-group">
                            <li class="list-group-item clearfix">
                                <span style="position:absolute; top:30%;">
            <?php
                                    echo $value3->getInvitato();
            ?>
                                </span>
                                <form>
                                    <span class="pull-right button-group">
                                        <a href='visualizza_progetto.php?id=<?php echo $value3->getProgetto(); ?>' class="btn btn-primary">View Proyect</a>
                                        <a class="btn btn-success" href="invito.php?id=<?php echo $value3->getProgetto(); ?>&scelta=0&opz=3&mInvitato=<?php echo $value3->getInvitato(); ?>"">Accept</a>
                                        <a class="btn btn-danger" href="invito.php?id=<?php echo $value3->getProgetto(); ?>&scelta=1&opz=3&mInvitato=<?php echo $value3->getInvitato(); ?>">Decline</a>
                                    </span>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        </br>

        <div class="supremo">
            <?php
            echo "Requests sent:";
            ?>
            </br>

            <?php
            if(!$array4){
                echo "Non hai richieste di partecipazione in sospeso!";
            } else{
                foreach ($array4 as $value4) {
                    ?>
                    <div class="riga-elenco">
                        <ul class="list-group">
                            <li class="list-group-item clearfix">
                                <span style="position:absolute; top:30%;">
            <?php
                                    echo $value4->getInvitante();
            ?>
                                </span>
                                <form>
                                    <span class="pull-right button-group">
                                        <a href='visualizza_progetto.php?id=<?php echo $value4->getProgetto(); ?>' class="btn btn-primary">View Proyect</a>
                                        <a href='invito.php?id=<?php echo $value4->getProgetto(); ?>&opz=2&mInvitato=<?php echo $value4->getInvitante(); ?>' class="btn btn-danger">Revoke</a>
                                    </span>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>