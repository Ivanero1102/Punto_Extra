<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="Juego_Coche.css"/>
        <!-- Funciones PHP -->
        <?php
            //Generar todo lo aleatorio
            function random(){
                $elementos = array();
                $num_coches = 1;
                $num_bombas = 10;
                $num_paredes = 10;
                $num_elementos = $num_coches + $num_bombas + $num_paredes;
                while(count($elementos)<=$num_elementos){
                    $comprobar = true;
                    $x = rand(0,9);
                    $y = rand(0,9);
                    foreach ($elementos as $key => $value) {
                        if($x == $value[0] and $y == $value[1]){
                            $comprobar = false;
                        }
                        if($x == 9 and $y == 9){
                            $comprobar = false;
                        }
                    }
                    if($comprobar == true){
                        array_push($elementos ,[$x ,$y]); 
                    }
                }
                return $elementos;
            }
        ?>
    </head>
    <body>
        <table>
            <!-- Codigo php para general el tablero aleatorio -->
            <?php
                $elementos = random();
                $clase = "vacio";
                //print_r(array_values(array_values($elementos[0]))[0]);
                for($i=0; $i<1; $i++){
                    $posy = 0;
                    for ($t=0; $t<10 ; $t++) {
                        $posx = 0;
                        echo "<tr>";
                        for ($s=0; $s <10 ; $s++) { 
                            if($posx == 9 and $posy == 9){
                                $clase = "meta";
                            }
                            if($posx == array_values(array_values($elementos[0]))[0] and $posy == array_values(array_values($elementos[0]))[1]){
                                $clase = "coche";
                            }
                            echo "<td class='$clase'> x:$posx y:$posy </td>";
                            $posx++;
                            $clase = "vacio";
                        }
                        echo "</tr>";
                        $posy++;
                    }
                }
            ?>
        </table>
    </body>
</html>