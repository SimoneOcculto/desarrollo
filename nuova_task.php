<?php
    //session_start();

    require 'BackEnd/db_handler.php';

    /*if(empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }*/

    if(isset($_POST['invio'])) {
        require "BackEnd/db_task.php";

        $nomeTask = $_POST['nome'];
        $descrizioneTask = $_POST['descrizione'];
        $dataScaTask = $_POST['dataScadenza'];
        $dataCreaTask = date("Y-m-d");
        $priorita = $_POST['priorita'];

        switch ($priorita)
        {
            case "uno":
                $priorita=1;
                break;
            case "due":
                $priorita=2;
                break;
            case "tre":
                $priorita=3;
                break;
        }

        //echo $mailU;
        //echo $nomeProg;

        $task = new db_task();

        if ($_POST['nome'] != "" && $_POST['descrizione'] != "") {
            $array = array("NomeT" => $_POST['nome'],
                "DescrizioneT" => $_POST['descrizione'],
                "DataScadenzaT" => $dataScaTask,
                "DataCreazioneT" => $dataCreaTask,
                "Priorita" => $priorita);
            $task->register($array);

        }
    }
?>

<html>
<head>

</head>

<body>
<form action="" method="POST">
    <label>Progetto numero: </label></br>
    <label>Nome task</label></br>
    <input type="text" id="nome" name="nome" required></br>
    <label>Descrizione</label></br>
    <textarea id="descrizione" name="descrizione" required></textarea></br>
    <label>Data scadenza</label></br>
    <input type="date" id="dataScadenza" name="dataScadenza" <?php
    $date=date_create(date("Y-m-d"));
    echo "min=\"".date_format($date,"Y-m-d")."\" ";
    ?>
    ></br>
    <label>Priorita:</label></form</br>
    <select name="priorita">
        <option value="uno">Bassa</option>
        <option value="due">Media</option>
        <option value="tre">Alta</option>
    </select>
    <input type="submit" name="invio">
</form>
</body>
</html>
