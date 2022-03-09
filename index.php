<?php

    session_start();

    require 'BackEnd/db_handler.php';

    if(isset($_SESSION['mail'])) {
        header('Location: Homepage.php');
    }

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pwd = $_POST['password'];

        require "BackEnd/db_utente.php";
        $utente = new db_utente();
        if($utente->access_User($email, $pwd)){
            header("location: Homepage.php");
        } else{
            session_destroy();
        }
    }
?>

<html lang="it">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title>ToDoGS</title>
    </head>

    <body>
        <form>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </body>

</html>
