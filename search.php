<?php
    require "BackEnd\db_progetto.php";

    $progetti = new db_progetto();

    if(isset($_POST['search'])) {
        $array = $progetti->getArrayProgetti($_POST['search']);
    }
?>

<!DOCTYPE html>
<html>

    <head>

    </head>

    <body>
        <form method="POST" action="search.php">
            <input type="text" placeholder="Search" aria-label="Search" name="search">
            <button type="submit">Ricerca</button>
        </form>

        <?php
            if(isset($_POST['search'])) {
                if ($array == false) {
                    echo "<b>Nessun progetto trovato</b>";
                } else {
                    foreach ($array as $value) {
                        echo "<table>
                        <tr><td>
                            " . $value->getNomeP() . "
                        </td><td>
                            " . $value->getDescrizioneP() . "
                        </td><td>
                            " . $value->getDataScadenzaP() . "
                        </td><td>
                            " . $value->getDataCreazioneP() . "
                        </td></tr>
                        </table>";
                    }
                }
            }
        ?>
    </body>
</html>
