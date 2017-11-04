<?php

include "producto.php";
include "conexion.php";

class metodo_producto{
    
    public function fill_producto($id,$nombre,$descripcion,$marca,$tama,$cantidad,$pcompra,$pventa,$pbloque,$guia,$nprovee,$medida,$tipo,$fecha,$codigo){
        
        $producto=new producto();
        
        $producto->set_id($id);
        $producto->set_nombre($nombre);
        $producto->set_descripcion($descripcion);
        $producto->set_marca($marca);
        $producto->set_cantidad($cantidad);
        $producto->set_tama($tama);
        $producto->set_pcompra($pcompra);
        $producto->set_pventa($pventa);
        $producto->set_pbloque($pbloque);
        $producto->set_guia($guia);
        $producto->set_nprovee($nprovee);
        $producto->set_medida($medida);
        $producto->set_tipo($tipo);
        $producto->set_fecha($fecha);
        $producto->set_codigo($codigo);
        
        return $producto;        
    }
    
    public function reg_producto($producto,$tipo){
        $cn=new conexion();
        $con=$cn->conectar();
        
        $id=htmlentities($producto->get_id());
        $n=htmlentities($producto->get_nombre());
        $d=htmlentities($producto->get_descripcion());
        $m=htmlentities($producto->get_marca());
        $pc=htmlentities($producto->get_pcompra());
        $pv=htmlentities($producto->get_pventa());
        $pb=htmlentities($producto->get_pbloque());
        $c=htmlentities($producto->get_cantidad());
        $md=htmlentities($producto->get_medida());
        $t=htmlentities($producto->get_tipo());
        $g=htmlentities($producto->get_guia());
        $np=htmlentities($producto->get_nprovee());
        $f=htmlentities($producto->get_fecha());
        $cd=htmlentities($producto->get_codigo());
        $tm=htmlentities($producto->get_tama());
        
        if(strcmp($tipo,'NORMAL')==0){
        
        mysqli_query($con,"insert into producto values('$id','$n','$d','$m','$pc','$pv','$pb','$c','$md','$t','$g','$np','$f','null')");
        }
        if(strcmp($tipo,'ESPECIAL')==0){
          mysqli_query($con,"insert into producto values('$id','$n','$d','$m','$pc','$pv','$pb','$c','$md','$t','$g','$np','$f','$tm')");
        $i=1;
        while($i<=$c){
        	$codigo=strval($i);
            mysqli_query($con,"call ingresar_almacen_especial('$id','$cd$codigo','$pc','$pv','$pb','$tm','$g','$np','$f')");
            $i++;
        }  
            
        }
    }
    
    public function show_prod(){
      
        
        
    }
    
}


?>