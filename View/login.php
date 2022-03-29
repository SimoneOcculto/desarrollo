<?php
    session_start();
    require 'C:/xampp/htdocs/desarrollo/Model/db_handler.php';

    $flag = false;

    if(!empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require "C:/xampp/htdocs/desarrollo/Model/db_utente.php";
    $utente = new db_utente();
    if($utente->accesso_utente($username,$password)){
        header("location: index.php");
    }else{
        session_destroy();
    }
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
        <a class="navbar-brand" href="index.php" style="font-size: 25px;"><b>ToDoGGS</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="elenco_progetti.php">Projects</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Teams</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>-->
            </ul>
        </div>
    </nav>
</nav>


<form action="login.php" method="POST" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 offset-2">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="email" name="username">
                <br>
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword4" placeholder="password" name="password">
                <br>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 offset-2">
                    <div align="right">
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
