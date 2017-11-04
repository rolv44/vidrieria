<?php
include "../php/conexion.php";

$c=new conexion();
$con=$c->conectar();

$id=$_GET['idproducto'];
$tipo=$_GET['tipo'];
$cantidad=$_GET['cantidad'];
                                   
if(strcmp($tipo,"NORMAL")==0){
    $resultado=mysqli_query($con,"delete from producto where id_pro='$id' ") or die(mysqli_error());
    if($resultado){
        header("Location:../productoAdmin.php");
    }
}elseif(strcmp($tipo,"ESPECIAL")==0){
    $resul=mysqli_query($con,"delete from producto where id_pro='$id' ") or die(mysqli_error());
    $rs=mysqli_query($con,"delete from almacen_especial where id_pro='$id' ") or die(mysqli_error());
     if($resul && $rs){
        header("Location:../productoAdmin.php");
    }
}




?>



