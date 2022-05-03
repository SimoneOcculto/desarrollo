<?php
    session_start();

    require 'C:/xampp/htdocs/desarrollo/Controller/db_handler.php';

    if(empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }

    $flag=0;
    $flagError=0;
    require 'C:/xampp/htdocs/desarrollo/Controller/db_utente.php';
    require 'C:/xampp/htdocs/desarrollo/Controller/db_partecipazione.php';
    $utente = new db_utente();
    $array = $utente->getAllMembri();
    $ID_Progetto=$_GET['id'];

    if(isset($_POST['invita'])){

        $MailU=$_POST['mail'];
        $ID_Progetto=$_GET['id'];
        $Stato=1;
        $partecipazione=new db_partecipazione();

        if(!$utente->checkUtente($MailU)){

            $array = array("Invitante" => $_SESSION['mail'],
                "Invitato" => $MailU,
                "Progetto" => $ID_Progetto,
                "Stato" => $Stato);



            if($partecipazione->ControlloMail($_SESSION['mail'], $MailU)){
                if(strcmp($MailU,$_SESSION['mail'])!=0){
                    $partecipazione->NewRelazione($array);
                }else{
                    $flagError=3;
                }
            }else {
                $flagError = 1;
            }

        }else{
            $flagError=2;
        }



    }



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
                            echo "
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
                                    <a class='nav-link' href = 'gestione_utenti.php'> Users management </a>
                                </li>";
                        }
                        ?>
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
        <?php
        echo "
            <form action='elenco_utenti.php?id=".$ID_Progetto."' method='POST'>
                <div class='supremo'>                            
                    <div class='riga'>
                        <div class='etichetta'><label>Email</label></div>
                        <input class='tony' type='text' id='mail' name='mail' placeholder='Email' required>
                                    
                    <div class='riga-button'>
                        <span class='pull-right button-group'>
                            <a class='btn btn-secondary'  href='elenco_progetti.php'>Cancel</a>
                            <button class='btn btn-primary' type='submit' name='invita'>Invite</button>
                        </span>
                    </div>               
                </div>
            </form>
            
            <br>";

        if ($flagError==1){
            echo "
                <div class='supremo'>
                    <h3>User already invited!</h3>
                    <span class='pull-right button-group'> 
                        <a href='elenco_progetti.php' class='btn btn-primary'>Back</a>
                    </span>
                    <br>
                </div>";
        } elseif ($flagError==2){
            echo "
                <div class='supremo'>
                    <h3>User not found!</h3>
                        <span class='pull-right button-group'> 
                            <a href='elenco_progetti.php' class='btn btn-primary'>Back</a>
                        </span>
                        <br>
                </div>";
        } elseif ($flagError==3) {
            echo "
                <div class='supremo'>
                    <h3>You can't invite this user!</h3>
                        <span class='pull-right button-group'> 
                            <a href='elenco_progetti.php' class='btn btn-primary'>Back</a>
                        </span>
                        <br>
                </div>";
        }
        ?>
    </body>
</html>
