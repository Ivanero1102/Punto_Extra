<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="./Juego_Coche.css"/>
    </head>
    <body>
        <table>
            <!-- Codigo php para general el tablero aleatorio -->
            <?php
                $tamaño = (int)$_POST['tamaño'];
                print_r($_POST);
                for($i=0; $i<1; $i++){
                    //array_fill
                    for ($t=0; $t < $tamaño ; $t++) {
                        echo "<tr>";
                        for ($s=0; $s < $tamaño ; $s++) { 
                            echo "<td></td>";
                        }
                        echo "</tr>";
                    }
                }
            ?>
        </table>
    </body>
</html>