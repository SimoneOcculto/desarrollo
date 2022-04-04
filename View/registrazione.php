<?php
    session_start();

    require 'C:/xampp/htdocs/desarrollo/Controller/db_handler.php';

    if(!empty($_SESSION)) {
        // session isn't started
        header('Location: nuovo_progetto.php');
    }

    $flag = false;

    if(isset($_POST['conferma'])) {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $ruolo = 'U';

        require "C:/xampp/htdocs/desarrollo/Controller/db_utente.php";
        $utente = new db_utente();
        if($utente->checkUtente($email)){
            $array = array("Mail" => $email,
                "Password" => $password,
                "Nome" => $nome,
                "Cognome" => $cognome,
                "Ruolo" => $ruolo);
            $utente->register($array);

            $_SESSION['mail'] = $email;
            $_SESSION['ruolo'] = $ruolo;

            header('Location: nuovo_progetto.php');

            $flag = false;
        } else {
            $flag = true;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="//code.jquery.com/jquery.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="utf-8">
        <script type="text/javascript">
            function controllo(){
                var password = document.getElementById("password").value;
                var conferma = document.getElementById("confermaPassword").value;
                if(password == conferma){
                    return true;
                }else{
                    //document.getElementById("confermaPassword").classList.add("is-invalid");
                    return false;
                }
            }
        </script>
    </head>

    <body>
    <nav class="navbar navbar-light bg-light justify-content-between">
        <div class="col 1 offset-2">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php" style="font-size: 25px;"><b>ToDoGGS</b></a>


        </nav>

    </nav>
                    <form onsubmit="return controllo();" action="registrazione.php" method="POST">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-4 offset-2">
                                    <label for="nome">Name</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Name" pattern="[a-zA-Z]{2,40}" required>
                                    <label>Surname</label>
                                    <input type="text" id="cognome"  class="form-control" name="cognome" placeholder="Surname" pattern="[a-zA-Z]{2,50}" required>
                                    <label for="inputEmail4">Email</label>
                                    <?php
                                    if($flag) {
                                        echo "<input type=\"email\" class=\"form-control is-invalid\" id=\"email\" name=\"email\" placeholder=\"Email\" required>";
                                    } else{
                                        echo "<input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" placeholder=\"Email\" required>";
                                    }
                                    ?>
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>


                                    <label for="inputPassword4" >Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$" required>

                                    <label for="inputPassword4" >Confirm password</label>
                                    <input type="password" class="form-control" id="confermaPassword" name="confermaPassword" placeholder="Confirm password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$" required>
                                    <br>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-4 offset-2">
                                        <div align="right">
                                            <button type="submit" class="btn btn-primary" name="conferma" onclick="controllo()">Sign up</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

        <script type="text/javascript" src="Script.js"></script>
    </body>
</html>
