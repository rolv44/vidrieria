<?php

include "cliente.php";
include "conexion.php";

class metodo_clie{

    public function fill_cliente($id,$nombre,$razon,$dni,$ruc,$dire,$celu){

        $cliente=new cliente();

        $cliente->set_id($id);
        $cliente->set_nombre($nombre);
        $cliente->set_razon($razon);
        $cliente->set_dni($dni);
        $cliente->set_ruc($ruc);
        $cliente->set_dire($dire);
        $cliente->set_cel($celu);

        return $cliente;
    }


      public function reg_cliente($cliente){
        $cn=new conexion();
        $con=$cn->conectar();
    
        $id=htmlentities($cliente->get_id());
        $n=htmlentities($cliente->get_nombre());
        $r=htmlentities($cliente->get_razon());
        $d=htmlentities($cliente->get_dni());
        $ru=htmlentities($cliente->get_ruc());
        $di=htmlentities($cliente->get_dire());
        $c=htmlentities($cliente->get_cel());
        mysqli_query($con,"insert into cliente values('$id','$n','$r','$d','$ru','$di','$c')")or die(mysqli_error());

    }


}

?>
