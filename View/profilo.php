<?php
    session_start();

    require 'C:/xampp/htdocs/desarrollo/Model/db_handler.php';

    if(empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }

    require "C:/xampp/htdocs/desarrollo/Model/db_utente.php";
    $utente = new db_utente();
    $result = $utente->getUtente($_SESSION['mail']);

    $flag = false;

    if(isset($_POST['modifica'])){
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];

        $array = array("Nome" => $_POST['nome'],
            "Cognome" => $_POST['cognome'],
            "Mail" => $_SESSION['mail'],
            "Password" => $result->getPassword(),
            "Ruolo" => $_SESSION['ruolo']);

        $utente->UpdateUser($array);

        $flag = true;
    }

    if(isset($_POST['elimina'])){

        $utente->EliminaUtente($_SESSION['mail']);

        session_destroy();

        header('Location: index.php');
    }

    if($flag){
        header("Refresh:0");
    }
?>

<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <form action="profilo.php" method="POST">
            <label>Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" value="<?php echo $result->getNome(); ?>">

            <label>Cognome</label>
            <input type="text" id="cognome" name="cognome" placeholder="Cognome" value="<?php echo $result->getCognome(); ?>">

            <label>Email</label>
            <input type="text" id="mail" name="mail" placeholder="Mail" value="<?php echo $_SESSION['mail']; ?>">

            <form action="" method="POST">
                <input type="submit" name="elimina" value="elimina">
            </form>

            <button type="submit" name="modifica">Modifica dati</button>
        </form>
    </body>
</html>
