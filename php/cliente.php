<?php

class cliente{
    
    private $id;
    private $nombre;
    private $razon;
    private $dni;
    private $ruc;
    private $dire;
    private $cel;
    
    public function get_id(){
        return $this->id;
    }
    public function set_id($id){
        $this->id=$id;
    }
    public function get_nombre(){
        return $this->nombre;
    }
    public function set_nombre($nombre){
        $this->nombre=$nombre;
    }
    public function get_razon(){
        return $this->razon;
    }
    public function set_razon($razon){
        $this->razon=$razon;
    }
    public function get_dni(){
        return $this->dni;
    }
    public function set_dni($dni){
        $this->dni=$dni;
    }
    public function get_ruc(){
        return $this->ruc;
    }
    public function set_ruc($ruc){
        $this->ruc=$ruc;
    }
    public function get_dire(){
        return $this->dire;
    }
    public function set_dire($dire){
        $this->dire=$dire;
    }
    public function get_cel(){
        return $this->cel;
    }
    public function set_cel($cel){
        $this->cel=$cel;
    }
    
}

?>