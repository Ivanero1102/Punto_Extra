<?php
class meta{
    private $caracter;
    private $positionX;
    private $positionY;

    public function __construct($positionX, $positionY)
    {
    $this->caracter = "F";
    $this->positionX = $positionX;
    $this->positionY = $positionY;
    }

    //Setters
    public function setcaracter($caracter){
        $this->caracter = $caracter;
    }
    
    public function setpositionX($positionX){
        $this->positionX = $positionX;
    }
    
    public function setpositionY($positionY){
        $this->positionY = $positionY;
    }

    //Getters
    public function getcaracter(){
        return $this->caracter;
    }

    public function getpositionX(){
        return $this->positionX;
    }

    public function getpositionY(){
        return $this->positionY;
    }

    //toString
    public function __toString()
    {
        return $this->caracter;
    }
}
?>