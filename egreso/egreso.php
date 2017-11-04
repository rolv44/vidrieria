<?php
include "../php/conexion.php";

$cn=new conexion();
$con=$cn->conectar();
$rs=mysqli_query($con,"select trae_id_egre() as egreso") or die(mysqli_error());
$fila=mysqli_fetch_array($rs);
$idegreso=$fila['egreso'];
$descripcion=$_POST['descr'];
$monto=$_POST['mon'];
$fecha=date('Y-m-d');
$resultado=mysqli_query($con,"insert into egreso values('$idegreso','$descripcion','$monto','$fecha');")or die(mysqli_error());
 if($resultado){
     header("Location:../reporteAdmin.php");
 }else{echo "<h2>ERROR ¡¡¡</h2>";}

?>