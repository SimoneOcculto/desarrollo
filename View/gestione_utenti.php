<?php
    session_start();

    require 'C:/xampp/htdocs/desarrollo/Controller/db_handler.php';

    if(empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }

    require 'C:/xampp/htdocs/desarrollo/Controller/db_utente.php';
    $utente = new db_utente();
    $array = $utente->getAllUtenti();

    if(isset($_POST['elimina'])){

        $utente->EliminaUtente($_POST['mail']);

        header('Location: gestione_utenti.php');
    }

    if(strcmp($_SESSION['ruolo'], "A") != 0) {
        header("Location: nuovo_progetto.php");
    } else{
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
        <nav class="navbar navbar-light bg-light justify-content-between">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php" style="font-size: 25px;"><b>ToDoGGS</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="elenco_progetti.php">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profilo.php">Profile</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="gestione_utenti.php">Users Management</a>
                    </li>
                    <li class="nav-item ">
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

    <body>
        <?php
            if($array == false){
                echo "<b>Nessun utente trovato</b>";
            } else {
                foreach ($array as $value) {
                    $flag2 = true;

                    if ($flag2){
                        $_SESSION['mailpre'] = $value->getMail();
                    }

                    echo"
                        <form action='gestione_utenti.php' method='POST'>
                        
                            <div class='supremo'>
                            <div class='riga'>
                            <div class='etichetta'><label>Name</label></div>
                            <input class='tony' type='text' id='nome' name='nome' placeholder='Nome' value=" . $value->getNome() ." required>
                            </div>
                            
                            <div class='riga'>
                            <div class='etichetta'><label>Surname</label></div>
                            <input class='tony' type='text' id='cognome' name='cognome' placeholder='Cognome' value=" . $value->getCognome() . " required>
                            </div>
                            
                            <div class='riga'>
                             <div class='etichetta'><label>Email</label></div>
                            <input class='tony' type='text' id='mail' name='mail' placeholder='Mail' value=" . $value->getMail() . " required>
                            </div>
                            
                            <div class='riga'>
                            <span class='pull-right button-group'>
                            <a class='btn btn-secondary'  href='elenco_progetti.php'>Cancel</a>
                            <button class='btn btn-danger' type='submit' name='elimina' value='elimina'>Delete Profile</button>
                                               
                            <button class='btn btn-primary' type='submit' name='modifica'>Save Changes</button>
                           </span>
                           </div>
                            </div>
                            </form>";
                    echo "<br>";
                }
            }
        }
        ?>
    </body>
</html>

<?php
    $flag = false;

    if(isset($_POST['modifica'])){
        $array = array("Nome" => $_POST['nome'],
            "Cognome" => $_POST['cognome'],
            "Mail" => $_SESSION['mailpre'],
            "Password" => $value->getPassword(),
            "Ruolo" => "U");

        $utente->UpdateUser($array);

        if(strcmp($_SESSION['mailpre'], $_POST['mail']) != 0){
            $utente->updateMail($_SESSION['mailpre'], $_POST['mail']);
            $flag2 = false;
        }

        $flag = true;
    }

    if($flag){
        header("Refresh:0");
    }
?>