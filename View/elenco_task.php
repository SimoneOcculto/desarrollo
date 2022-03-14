<?php

require "Model/db_task.php";

$task = new db_task();

$array=$task->getAllTask($_GET['id']);
?>

<html>
<head>

    <h1>Elenco Task</h1>
<body>

<?php
if ($array == false) {
    echo "<b>Non ci sono task</b> <a href='elenco_progetti.php'><button>Annulla</button></a>";
} else {
    foreach ($array as $value) {
        echo "<table>
                        <tr><td>
                            " . $value->getId_task() . "
                        </td><td>
                            " . $value->getId_progetto() . "
                        </td><td>
                            " . $value->getNomeT() ."
                        </td><td>
                            " . $value->getDescrizioneT() ."
                        </td><td>
                            " . $value->getDataScadenzaT() . "
                        </td><td>
                           <a href='elimina_progetto.php?id=".$value->getId_task()."'><button>Elimina</button></a>
                        </td><td>
                           <a href='modifica_progetto.php?id=".$value->getId_task()."'><button>Modifica</button></a>
                        </td><td>
                           <a href='elenco_progetti.php'><button>Annulla</button></a>
                        </td></tr>
                        </table>";
    }
}
?>
</body>
</head>
</html>