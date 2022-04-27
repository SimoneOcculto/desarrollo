<?php
session_start();

require 'C:/xampp/htdocs/desarrollo/Controller/db_handler.php';

if(empty($_SESSION)) {
    // session isn't started
    header('Location: index.php');
}

if(strcmp($_SESSION['ruolo'], "A") != 0) {
    header("Location: homepage.php");
} else {
    require "C:/xampp/htdocs/desarrollo/Controller/db_utente.php";
    $utente = new db_utente();
    $result = $utente->getUtente($_GET['email']);

    $flag = false;

    if (isset($_POST['modifica'])) {
        if (strcmp($_POST['ruolo'], "uno") == 0) {
            $ruolo = 'A';
        } else {
            $ruolo = 'U';
        }

        $array = array("Nome" => $_POST['nome'],
            "Cognome" => $_POST['cognome'],
            "Mail" => $_GET['email'],
            "Password" => $result->getPassword(),
            "Ruolo" => $ruolo);

        $utente->UpdateUser($array);

        if (strcmp($_GET['email'], $_POST['mail']) != 0) {
            $utente->UpdateMail($_GET['email'], $_POST['mail']);
        }

        $flag = true;
    }

    if (isset($_POST['elimina'])) {
        $utente->EliminaUtente($_GET['email']);

        $flag = true;
    }

    if ($flag) {
        header("Location: gestione_utenti.php");
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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
                        <li class="nav-item ">
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
                                        <li class='nav-item active'>
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

        <div class="piede">

            <div class="col-lg-12 text-lg-center">
                <br>
                <h2>User Profile</h2>
                <br>
            </div>

            <form action="" method="POST">

                <div class="supremo">
                    <div class="riga">
                        <div class="etichetta"><label>Name</label></div>
                        <input class="tony" type="text" id="nome" name="nome" placeholder="Nome" value="<?php echo $result->getNome(); ?>">
                    </div>

                    <div class="riga">
                        <div class="etichetta"><label>Surname</label></div>
                        <input class="tony" type="text" id="cognome" name="cognome" placeholder="Cognome" value="<?php echo $result->getCognome(); ?>">
                    </div>

                    <div class="riga">
                        <div class="etichetta"><label>Email</label></div>
                        <input class="tony" type="text" id="mail" name="mail" placeholder="Mail" value="<?php echo $_GET['email']; ?>">
                    </div>

                    <div class="riga">
                        <label>Ruolo:</label>
                        <?php
                        if(strcmp($result->getRuolo(), 'A') == 0) {
                            echo "
                            <select name = 'ruolo'>
                                <option value = 'uno' selected> Amministratore</option>
                                <option value = 'due'> Utente</option>
                            </select >";
                        } else{
                            echo "
                            <select name = 'ruolo'>
                                <option value = 'uno'> Amministratore</option>
                                <option value = 'due' selected> Utente</option>
                            </select >";
                        }
                        ?>
                    </div>

                    <div class="riga">
                        <span class="pull-right button-group">
                            <form action="" method="POST">
                                <input class="btn btn-danger" type="submit" name="elimina" value="Delete profile">
                            </form>

                            <button  class="btn btn-primary" type="submit" name="modifica">Save changes</button>
                        </span>
                    </div>
                </div>

            </form>
        </div>
    </body>
</html>
