<?php
include "conexion.php";
session_start();
date_default_timezone_set('America/Lima');
$idcarro=$_SESSION['idcarrito'];
$idcliente=$_POST["idcliente"];
$nomclie=$_POST['cnom'];   
$usu=$_SESSION['usuario'];  
$tipo=$_POST["dtlist"];
$c=new conexion();
$con=$c->conectar();  
if(isset($_POST['pago'])){
  $pago=$_POST['pago'];  
}else{$pago=0;}

if(isset($_POST['dsct'])){
  $descuento=$_POST['dsct']; 
}else{$descuento=0;}

$rs=mysqli_query($con,"select trae_id_venta() as id");
$arre=mysqli_fetch_array($rs);
$idventa=$arre['id'];

$rs4=mysqli_query($con,"select trae_id_comp('$tipo') as id");
$arre4=mysqli_fetch_array($rs4);
$id_comp=$arre4['id'];

$resultado=mysqli_query($con,"select subtotal from carrito where idcarrito='$idcarro' ") or die(mysqli_error());
$total=0;
$subtotal=0;
while($row = mysqli_fetch_array($resultado)){
    $total=$total+$row[0];
}
$ds=($total*$descuento)/100;
$mf=$total-$ds;
$total=$mf;

$fecha=date('Y-m-d');
if($pago==0){
    $resu=mysqli_query($con,"insert into venta values('$idventa','$idcliente','$usu','$nomclie','$idcarro','$tipo','PENDIENTE','0','0','$total','$fecha','$descuento','$id_comp');") or die( mysqli_error('Error'));
       if($resu==true){
    $_SESSION['idcarrito']="0";
    header("Location:imprimir.php?carro=$idcarro&venta=$idventa&cliente=$idcliente");
           }else{ header("Location:../indexAdmin.php");}
}elseif($pago<$total){
     $resu=mysqli_query($con,"insert into venta values('$idventa','$idcliente','$usu','$nomclie','$idcarro','$tipo','PENDIENTE','$pago','0','$total','$fecha','$descuento','$id_comp');") or die( mysqli_error('Error'));
       if($resu==true){
    $_SESSION['idcarrito']="0";
    header("Location:imprimir.php?carro=$idcarro&venta=$idventa&cliente=$idcliente");
                    }else{ header("Location:../indexAdmin.php");}
}elseif($pago==$total){
    $resu=mysqli_query($con,"insert into venta values('$idventa','$idcliente','$usu','$nomclie','$idcarro','$tipo','CANCELADO','$pago','0','$total','$fecha','$descuento','$id_comp');") or die( mysqli_error('Error'));
       if($resu==true){
    $_SESSION['idcarrito']="0";
    header("Location:imprimir.php?carro=$idcarro&venta=$idventa&cliente=$idcliente");
                    }else{ header("Location:../indexAdmin.php");}
}elseif($pago>$total){
    $vuelto=$pago-$total;
    $resu=mysqli_query($con,"insert into venta values('$idventa','$idcliente','$usu','$nomclie','$idcarro','$tipo','CANCELADO','$pago','$vuelto','$total','$fecha','$descuento','$id_comp');") or die( mysqli_error('Error'));
       if($resu==true){
    $_SESSION['idcarrito']="0";
    header("Location:imprimir.php?carro=$idcarro&venta=$idventa&cliente=$idcliente");
                    }else{ header("Location:../indexAdmin.php");}
}


?>