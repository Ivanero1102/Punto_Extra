<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Don't Crash The Car</title>
        <link rel="stylesheet" type="text/css" href="./Juego_Coche.css"/>
        <!-- Usar iframe para refrescar la página sin k se quede en blanco
        o usar un buffer -->
    </head>
    <body>
        <table>
            <!-- JavaScrip -->
            <script type="text/javascript"> 
                window.onload = function(){
                    var w = 87;
                    var a = 65;
                    var s = 83;
                    var d = 68;
  
                    window.onkeydown= function(movimiento){
                        if(movimiento.keyCode == w){
                            window.location.href = "http://localhost/Punto_Extra/Juego_Coche.php" + "?w1=" + "w";
                        };
                        if(movimiento.keyCode == a){
                            window.location.href = "http://localhost/Punto_Extra/Juego_Coche.php" + "?w1=" + "a";
                        };
                        if(movimiento.keyCode == s){
                            window.location.href = "http://localhost/Punto_Extra/Juego_Coche.php" + "?w1=" + "s";
                        };
                        if(movimiento.keyCode == d){

                            window.location.href = "http://localhost/Punto_Extra/Juego_Coche.php" + "?w1=" + "d";
                        };
                    };
                };  
            </script>
            <!-- Codigo php para general el tablero aleatorio -->
            <?php
                include 'Coche.php';
                include 'Muro.php';
                include 'Bomba.php';
                include 'Meta.php';
                session_start();
                if(!isset ($_SESSION['tamaño'])){
                    $dificultad = $_POST['dificultad'];
                    if($dificultad == "facil"){
                        $_SESSION['tamaño'] = 5;
                        $numBombas = 2;
                        $numMuros = 3;
                    }elseif ($dificultad == "medio") {
                        $_SESSION['tamaño'] = 10;
                        $numBombas = 10;
                        $numMuros = 10;
                    }elseif ($dificultad == "dificil") {
                        $_SESSION['tamaño'] = 25;
                        $numBombas = 100;
                        $numMuros = 100;
                    }
                    $tamaño = $_SESSION['tamaño'];
                    $matriz = array_fill(0, $tamaño, "");
                    for ($i=0; $i < $tamaño ; $i++) {
                        $matriz[$i] = array_fill(0, $tamaño, "");
                    }
                    $meta = new meta($tamaño-1, $tamaño-1);
                    $matriz[$meta->getpositionX()][$meta->getpositionY()] = $meta->__toString();
                    $coche = new coche(rand(0,$tamaño-1),rand(0,$tamaño-1));
                    while($coche->getpositionX() == $tamaño-1 and $coche->getpositionY() == $tamaño-1){
                        $coche->setpositionX(rand(0,$tamaño-1));
                        $coche->setpositionY(rand(0,$tamaño-1));
                    }
                    $matriz[$coche->getpositionX()][$coche->getpositionY()] = $coche->__toString();
                    for($i=0;$i<$numBombas; $i++){
                        $bomba = new bomba(rand(0,$tamaño-1),rand(0,$tamaño-1));
                        while($matriz[$bomba->getpositionX()][$bomba->getpositionY()] != ""){
                            $bomba->setpositionX(rand(0,$tamaño-1));
                            $bomba->setpositionY(rand(0,$tamaño-1));
                        }
                        $matriz[$bomba->getpositionX()][$bomba->getpositionY()] = $bomba->__toString();
                    }
                    for($i=0;$i<$numMuros; $i++){
                        $muro = new muro(rand(0,$tamaño-1),rand(0,$tamaño-1));
                        while($matriz[$muro->getpositionX()][$muro->getpositionY()] != ""){
                            $muro->setpositionX(rand(0,$tamaño-1));
                            $muro->setpositionY(rand(0,$tamaño-1));
                        }
                        $matriz[$muro->getpositionX()][$muro->getpositionY()] = $muro->__toString();
                    }
                }
                if(!isset($_SESSION['matriz'])){
                    $_SESSION['matriz'] = $matriz;
                }
                //Pntar el tablero
                $tamaño = $_SESSION['tamaño'];
                $matriz = $_SESSION['matriz'];
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
                            $posicionCX = $t;
                            $posicionCY = $s;
                            $posicionFX = $t;
                            $posicionFY = $s;
                        }elseif($matriz[$t][$s] == "F"){
                            $clase = "F";
                        }
                        echo "<td class='$clase'>"; 
                        print_r($matriz[$t][$s]); 
                        echo"</td>";
                    }
                    echo "</tr>";
                }
                //Sistema de movimiento
                if(isset($_GET["w1"])){
                    switch($_GET["w1"]){
                        case 'w':
                            if($posicionCX>0){
                                $posicionCX --;
                                if($matriz[$posicionCX][$posicionCY] == ""){
                                    $matriz[$posicionCX][$posicionCY] = "C";
                                    $matriz[$posicionFX][$posicionFY] = "";    
                                }else{
                                    if($matriz[$posicionCX][$posicionCY] == "B"){
                                        session_destroy();
                                        echo "<script> window.location.href = 'http://localhost/Punto_Extra/Game_Over.html' </script>";
                                    }else{
                                        if($matriz[$posicionCX][$posicionCY] == "F"){
                                            session_destroy();
                                            echo "<script> window.location.href = 'http://localhost/Punto_Extra/Ganaste.html' </script>";
                                        }
                                    }
                                }
                            }
                            break;
                        case 'a':
                            if($posicionCY>0){
                                $posicionCY --;
                                if($matriz[$posicionCX][$posicionCY] == ""){
                                    $matriz[$posicionCX][$posicionCY] = "C";
                                    $matriz[$posicionFX][$posicionFY] = "";
                                }else{
                                    if($matriz[$posicionCX][$posicionCY] == "B"){
                                        session_destroy();
                                        echo "<script> window.location.href = 'http://localhost/Punto_Extra/Game_Over.html' </script>";
                                    }else{
                                        if($matriz[$posicionCX][$posicionCY] == "F"){
                                            session_destroy();
                                            echo "<script> window.location.href = 'http://localhost/Punto_Extra/Ganaste.html' </script>";
                                        }
                                    }
                                }
                            }
                            break;
                        case 's':
                            if($posicionCX+1<$tamaño){
                                $posicionCX ++;
                                if($matriz[$posicionCX][$posicionCY] == ""){
                                    $matriz[$posicionCX][$posicionCY] = "C";
                                    $matriz[$posicionFX][$posicionFY] = "";
                                }else{
                                    if($matriz[$posicionCX][$posicionCY] == "B"){
                                        session_destroy();
                                        echo "<script> window.location.href = 'http://localhost/Punto_Extra/Game_Over.html' </script>";
                                    }else{
                                        if($matriz[$posicionCX][$posicionCY] == "F"){
                                            session_destroy();
                                            echo "<script> window.location.href = 'http://localhost/Punto_Extra/Ganaste.html' </script>";
                                        }
                                    }
                                }
                            }
                            break;
                        case 'd':
                            if($posicionCY+1<$tamaño){
                                $posicionCY ++;
                                if($matriz[$posicionCX][$posicionCY] == ""){
                                    $matriz[$posicionCX][$posicionCY] = "C";
                                    $matriz[$posicionFX][$posicionFY] = "";
                                }else{
                                    if($matriz[$posicionCX][$posicionCY] == "B"){
                                        session_destroy();
                                        echo "<script> window.location.href = 'http://localhost/Punto_Extra/Game_Over.html' </script>";
                                    }else{
                                        if($matriz[$posicionCX][$posicionCY] == "F"){
                                            session_destroy();
                                            echo "<script> window.location.href = 'http://localhost/Punto_Extra/Ganaste.html' </script>";
                                        }
                                    }
                                }
                            }
                            break; 
                    }
                    $_SESSION['matriz'] = $matriz;
                    echo "<script> window.location.href = 'http://localhost/Punto_Extra/Juego_Coche.php' </script>";
                }
            ?>
        </table>
    </body>
</html>