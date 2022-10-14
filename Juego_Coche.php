<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="./Juego_Coche.css"/>
        <script type="text/javascript" src="javaScrip.js">
        </script>
    </head>
    <body>
        <table>
            <!-- Codigo php para general el tablero aleatorio -->
            <?php
                include 'Coche.php';
                include 'Muro.php';
                include 'Bomba.php';
                include 'Meta.php';
                $dificultad = $_POST['dificultad'];
                if($dificultad == "facil"){
                    $tamaño = 5;
                    $numBombas = 2;
                    $numMuros = 3;
                }elseif ($dificultad == "medio") {
                    $tamaño = 10;
                    $numBombas = 10;
                    $numMuros = 10;
                }elseif ($dificultad == "dificil") {
                    $tamaño = 25;
                    $numBombas = 100;
                    $numMuros = 100;
                }
                $matriz = array_fill(0, $tamaño, "");
                for ($i=0; $i < $tamaño ; $i++) {
                    $matriz[$i] = array_fill(0, $tamaño, "");
                }
                $meta = new meta($tamaño-1, $tamaño-1);
                $matriz[$meta->getpositionX()][$meta->getpositionY()] = $meta->__toString();
                $coche = new coche(rand(0,$tamaño-1),rand(0,$tamaño-1));
                echo "<br>";
                while($coche->getpositionX() == $tamaño-1 and $coche->getpositionY() == $tamaño-1){
                    $coche->setpositionX(rand(0,$tamaño-1));
                    $coche->setpositionY(rand(0,$tamaño-1));
                }
                $matriz[$coche->getpositionX()][$coche->getpositionY()] = $coche->__toString();
                for($i=0;$i<$numBombas; $i++){
                    //Un solo objeto en varias posiciones (idea guardar coordenadas meidnate array compaginar con matriz)
                    $bomba = new bomba(rand(0,$tamaño-1),rand(0,$tamaño-1));
                    while($matriz[$bomba->getpositionX()][$bomba->getpositionY()] != ""){
                        $bomba->setpositionX(rand(0,$tamaño-1));
                        $bomba->setpositionY(rand(0,$tamaño-1));
                    }
                    $matriz[$bomba->getpositionX()][$bomba->getpositionY()] = $bomba->__toString();
                }
                for($i=0;$i<$numMuros; $i++){
                    //Un solo objeto en varias posiciones (idea guardar coordenadas meidnate array compaginar con matriz)
                    $muro = new muro(rand(0,$tamaño-1),rand(0,$tamaño-1));
                    while($matriz[$muro->getpositionX()][$muro->getpositionY()] != ""){
                        $muro->setpositionX(rand(0,$tamaño-1));
                        $muro->setpositionY(rand(0,$tamaño-1));
                    }
                    $matriz[$muro->getpositionX()][$muro->getpositionY()] = $muro->__toString();
                }
                for ($t=0; $t < $tamaño ; $t++) {
                    echo "<tr>";
                    for ($s=0; $s < $tamaño ; $s++) { 
                        $clase = "vacio";
                        if($matriz[$t][$s] == "B"){
                            $clase = "B";
                        }elseif($matriz[$t][$s] == "M"){
                            $clase = "M";
                        }elseif($matriz[$t][$s] == "C"){
                            $clase = "C";
                        }elseif($matriz[$t][$s] == "F"){
                            $clase = "F";
                        }
                        echo "<td class='$clase'>"; 
                        print_r($matriz[$t][$s]); 
                        echo"</td>";
                    }
                    echo "</tr>";
                }
                
            ?>
        </table>
    </body>
</html>