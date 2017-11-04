<?php
date_default_timezone_set('America/Lima');
include "../php/conexion.php";
session_start();
$idcarro=$_SESSION['idcarrito'];
$idcliente=$_POST["idcliente"]; 
$nomclie=$_POST['cnom'];
$usu=$_SESSION['usuario'];
$tipo=$_POST["dtlist"];

$c=new conexion();
$con=$c->conectar();

$rs=mysqli_query($con,"select trae_id_pedido() as id");
$arre=mysqli_fetch_array($rs);
$idventa=$arre['id'];
$resultado=mysqli_query($con,"select subtotal from carrito where idcarrito='$idcarro' ") or die(mysqli_error());
$total=0;
$subtotal=0;
while($row = mysqli_fetch_array($resultado)){
    $total=$total+$row[0];
}
$fecha=date('Y-m-d');
$hora=date('H').":".date('i').":".date('s');
    $resu=mysqli_query($con,"insert into pedido values('$idventa','$idcliente','$usu','$nomclie','$idcarro','$tipo','$total','$hora','$fecha');") or die( mysqli_error('Error'));
       if($resu==true){
    $_SESSION['idcarrito']="0";
    header("Location:../ventaEmp.php");
           }else{ header("Location:../ventaEmp.php");}

?>