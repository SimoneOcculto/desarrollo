<?php
require "C:/xampp/htdocs/desarrollo/Model/db_progetto.php";

$progetti = new db_progetto();

$array=$progetti->getAllProgetti();


?>

<html>
<head>

    <h1>Elenco progetti</h1>
<body>

<?php
if ($array == false) {
    echo "<b>Non ci sono progetti</b>";
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
                            " . $value->getDescrizioneP() ."
                        </td><td>
                            " . $value->getDataCreazioneP() . "
                        </td><td>
                           <a href='elimina_progetto.php?id=".$value->getId()."'><button>Elimina</button></a>
                        </td><td>
                           <a href='modifica_progetto.php?id=".$value->getId()."'><button>Modifica</button></a>
                        </td><td>
                           <a href='elenco_task.php?id=".$value->getId()."'><button>Visualizza Task</button></a>
                        </td></tr>
                        </table>";
    }
}
?>
</body>
</head>
</html>