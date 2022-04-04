<?php
    session_start();

    require 'C:/xampp/htdocs/desarrollo/Model/db_handler.php';

    if(empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }

    require 'C:/xampp/htdocs/desarrollo/Model/db_utente.php';
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

    </head>

    <body>
        <?php
            if($array == false){
                echo "<b>Nessun utente trovato</b>";
            } else {
                foreach ($array as $value) {
                    echo"
                        <form action='gestione_utenti.php' method='POST'>
                            <label>Nome</label>
                            <input type='text' id='nome' name='nome' placeholder='Nome' value=" . $value->getNome() ." required>
                            
                            <label>Cognome</label>
                            <input type='text' id='cognome' name='cognome' placeholder='Cognome' value=" . $value->getCognome() . " required>
                            
                            <label>Email</label>
                            <input type='text' id='mail' name='mail' placeholder='Mail' value=" . $value->getMail() . " required>
                       ";
                    echo "
                            <form action='' method='POST'>
                                <input type='submit' name='elimina' value='elimina'>
                            </form>
                            <button type='submit' name='modifica'>Modifica dati</button>
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
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];

        $array = array("Nome" => $_POST['nome'],
            "Cognome" => $_POST['cognome'],
            "Mail" => $_POST['mail'],
            "Password" => $value->getPassword(),
            "Ruolo" => "U");

        $utente->UpdateUser($array);

        $flag = true;
    }

    if($flag){
        header("Refresh:0");
    }
?>