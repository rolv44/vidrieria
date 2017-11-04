<?php
include "carrito.php";
class lista_carrito{
    
    private $carro=array();
    
    public function add($carro){
        array_push($this->carro,$carro);
    }
    public function remove($indice){
        
        unset($this->carro[$indice]);
    }
    public function get_carro(){
        return $this->carro;
    }     
}


?>