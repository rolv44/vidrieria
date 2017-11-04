<?php
class carrito{
    private $nombre;
    private $idprod;
    private $cant;
    private $codstock;
    private $tip;
    private $tam;
    private $subtotal;

    public function get_nombre(){
        return $this->nombre;
    }
    public function set_nombre($nombre){
        $this->nombre=$nombre;
    }
    public function get_idprod(){
        return $this->idprod;
    }
    public function set_idprod($idprod){
        $this->idprod=$idprod;
    }
    public function get_cant(){
        return $this->cant;
    }
    public function set_cant($cant){
        $this->cant=$cant;
    }
    public function get_codstock(){
        return $this->codstock;
    }
    public function set_codstock($codstock){
        $this->codstock=$codstock;
    }
    public function get_tip(){
        return $this->tip;
    }
    public function set_tip($tip){
        $this->tip=$tip;
    }
    public function get_tam(){
         return $this->tam;
     } 
     public function set_tam($tam){
         $this->tam=$tam;
     }    

    
    public function get_subtotal(){
         return $this->subtotal;
     } 
     public function set_subtotal($subtotal){
         $this->subtotal=$subtotal;
     }    

}

?>