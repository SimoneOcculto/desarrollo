<?php
//echo $_GET['nome'];
require "C:/xampp/htdocs/desarrollo/Model/db_progetto.php";

$progetti = new db_progetto();

if(isset($_POST['elimina'])){

    require "C:/xampp/htdocs/desarrollo/Model/db_task.php";

    $task = new db_task();
    $task->EliminaTask($_GET['id']);
    $progetti->EliminaProgetto($_GET['id']);

    header('Location: C:/xampp/htdocs/desarrollo/View/elenco_progetti.php');

}

$array=$progetti->getArrayProgetti($_GET['id']);

if ($array == false) {
    echo "<b>Errore</b>";
} else {
    foreach ($array as $value) {
        echo "<table>
                        <tr><td>
                            " . $value->getId() . "
                        </td><td>
                            " . $value->getLeader() . "
                        </td><td>
                            " . $value->getNomeP() ."
                        </td><td>
                            " . $value->getDataCreazioneP() . "
                        </td><td>
                           <form action='' method='POST'>
                           <input type='submit' name='elimina' value='elimina'>
                           </form>
                        </td><td>
                           <a href='elenco_progetti.php'><button>Annulla</button></a>
                        </td></tr>
                        </table>";
    }
}

?>
