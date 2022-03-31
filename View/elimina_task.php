<?php
    session_start();

    require 'C:/xampp/htdocs/desarrollo/Model/db_handler.php';

    if(empty($_SESSION)) {
        // session isn't started
        header('Location: index.php');
    }

    require "C:/xampp/htdocs/desarrollo/Model/db_task.php";

    $task = new db_task();

    if(isset($_POST['elimina'])){

        $task->EliminaSingleTask($_GET['id']);

        header('Location: elenco_progetti.php');
    }

    $array=$task->getArrayTask($_GET['id']);

    if ($array == false) {
        echo "<b>Errore</b>";
    } else {
        foreach ($array as $value) {
            echo "<table>
                    <tr><td>" . $value->getId_task() . "</td>
                        <td>" . $value->getId_progetto() . "</td>
                        <td>" . $value->getNomeT() ."</td>
                        <td>" . $value->getDescrizioneT() ."</td>
                        <td>" . $value->getDataScadenzaT() . "</td>
                        <td>
                            <form action='' method='POST'>
                                <input type='submit' name='elimina' value='elimina'>
                            </form>
                        </td>
                        <td>
                            <a href='elenco_task.php'><button>Annulla</button></a>
                        </td>
                    </tr>
                  </table>";
        }
    }
?>