<?php
class producto{
    private $id;
    private $nombre;
    private $descripcion;
    private $marca;
    private $tama;
    private $cantidad;
    private $pcompra;
    private $pventa;
    private $pbloque;
    private $guia;
    private $nprovee;
    private $medida;
    private $tipo;
    private $fecha;
    private $codigo;
    
    public function get_codigo(){
        return $this->codigo;
    }
    public function set_codigo($codigo){
        $this->codigo=$codigo;
    }
    public function get_id(){
		return $this->id;
	}
	public function set_id($id){
		$this->id = $id;
	}
    public function get_nombre(){
        return $this->nombre;
    }
    public function set_nombre($nombre){
        $this->nombre=$nombre;
    }
    public function get_descripcion(){
        return $this->descripcion;
    }
    public function set_descripcion($descripcion){
        $this->descripcion=$descripcion;
    }
    public function get_marca(){
		return $this->marca;
	}
	public function set_marca($marca){
		$this->marca = $marca;
	}
    public function get_tama(){
		return $this->tama;
	}
	public function set_tama($tama){
		$this->tama = $tama;
	}
    public function get_cantidad(){
        return $this->cantidad;
    }
    public function set_cantidad($cantidad){
        $this->cantidad=$cantidad;
    }
    public function get_pcompra(){
        return $this->pcompra;
    }
    public function set_pcompra($pcompra){
        $this->pcompra=$pcompra;
    }
    public function get_pventa(){
		return $this->pventa;
	}
	public function set_pventa($pventa){
		$this->pventa = $pventa;
	}
    public function get_pbloque(){
        return $this->pbloque;
    }
    public function set_pbloque($pbloque){
        $this->pbloque=$pbloque;
    }
    public function get_guia(){
        return $this->guia;
    }
    public function set_guia($guia){
        $this->guia=$guia;
    }
    public function get_nprovee(){
		return $this->nprovee;
	}
	public function set_nprovee($nprovee){
		$this->nprovee = $nprovee;
	}
    public function get_medida(){
        return $this->medida;
    }
    public function set_medida($medida){
        $this->medida=$medida;
    }
    public function get_tipo(){
        return $this->tipo;
    }
    public function set_tipo($tipo){
        $this->tipo=$tipo;
    }
    public function get_fecha(){
        return $this->fecha;
    }
    public function set_fecha($fecha){
        $this->fecha=$fecha;
    }
    

}

?>