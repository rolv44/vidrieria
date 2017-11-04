<?php
include "../php/conexion.php";

$cn=new conexion();
$con=$cn->conectar();

$des=htmlentities($_POST['descripcion']);
$monto=$_POST['monto'];
$id=$_POST['idegre'];
$resultado=mysqli_query($con,"update egreso set descripcion='$des',monto='$monto' where id_egreso='$id' ") or die(mysqli_error());

if($resultado){
    header("Location:../reporteAdmin.php");
}


?>