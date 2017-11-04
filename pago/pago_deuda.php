<?php
include "../php/conexion.php";
$cn=new conexion();
$con=$cn->conectar();
$codigo=$_POST['codventa'];
$idcliente=$_POST['idclie'];
$nombre=$_POST['cliente'];
$pago_ant=$_POST['pagado'];
$monto=$_POST['monto_total'];
$pago=$_POST['pago_deuda'];
$pago_act=$pago+$pago_ant;

if($pago_act<$monto){
    $resu=mysqli_query($con,"update venta set pago='$pago_act' where id_venta='$codigo' and nom_clie='$nombre' ") or die(mysqli_error());
    if($resu){header("Location:../reporteAdmin.php");}else{echo"ERROR";}
}elseif($pago_act==$monto){
    $resu1=mysqli_query($con,"update venta set pago='$pago_act',estado='CANCELADO' where id_venta='$codigo' and nom_clie='$nombre' ") or die(mysqli_error());
    if($resu1){header("Location:../reporteAdmin.php");}else{echo"ERROR";}
}elseif($pago_act>$monto){
    $vuelto=$pago_act-$monto;
     $resu2=mysqli_query($con,"update venta set pago='$pago_act',estado='CANCELADO',vuelto='$vuelto' where id_venta='$codigo' and nom_clie='$nombre' ") or die(mysqli_error());
    if($resu2){header("Location:../reporteAdmin.php");}else{echo"ERROR";}
}


?>