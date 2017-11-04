<?php
include "../php/conexion.php";
$cn=new conexion();
$con=$cn->conectar();
$codigo=$_POST['pedi_cod'];
$usuario=$_POST['p_usu'];
$idclie=$_POST['p_cod'];
$res=mysqli_query($con,"select trae_id_venta() as id")or die(mysqli_error());
$fila=mysqli_fetch_array($res);
$id=$fila["id"];
$tipo=$_POST['pedi_comp'];
$fecha=$_POST['p_fecha'];
$cliente=$_POST['pedi_clie'];
$total=$_POST['pedi_tot'];
$codicar=$_POST['p_codcar'];
$rs4=mysqli_query($con,"select trae_id_comp('$tipo') as id");
$arre4=mysqli_fetch_array($rs4);
$id_comp=$arre4['id'];

if(isset($_POST['pedi_pag'])){
  $pago=$_POST['pedi_pag'];  
}else{$pago=0;}

if(isset($_POST['dsct_1'])){
  $descuento=$_POST['dsct_1']; 
}else{$descuento=0;}

$ds=($total*$descuento)/100;
$mf=$total-$ds;
$total=$mf;

if($pago==0){
    $resu=mysqli_query($con,"insert into venta values('$id','$idclie','$usuario','$cliente','$codicar','$tipo','PENDIENTE','0','0','$total','$fecha','$descuento','$id_comp');") or die( mysqli_error('Error'));
       if($resu){
                $rs=mysqli_query($con,"delete from pedido where id_pedido='$codigo'")or die(mysqli_error());
           if($rs){
               $_SESSION['idcarrito']="0";
    header("Location:../php/imprimir.php?carro=$codicar&venta=$id&cliente=$idclie");
           }else{ header("Location:../indexAdmin.php");}
    
           }else{ echo"<h2>Error ¡¡</h2>";}
    
}elseif($pago<$total){
     $resu=mysqli_query($con,"insert into venta values('$id','$idclie','$usuario','$cliente','$codicar','$tipo','PENDIENTE','$pago','0','$total','$fecha','$descuento','$id_comp');") or die( mysqli_error('Error'));
       if($resu){
                $rs=mysqli_query($con,"delete from pedido where id_pedido='$codigo'")or die(mysqli_error());
           if($rs){
               $_SESSION['idcarrito']="0";
    header("Location:../php/imprimir.php?carro=$codicar&venta=$id&cliente=$idclie");
           }else{ header("Location:../indexAdmin.php");}
    
           }else{ echo"<h2>Error ¡¡</h2>";}
    
}elseif($pago==$total){
    $resu=mysqli_query($con,"insert into venta values('$id','$idclie','$usuario','$cliente','$codicar','$tipo','CANCELADO','$pago','0','$total','$fecha','$descuento','$id_comp');") or die( mysqli_error('Error'));
       if($resu){
                $rs=mysqli_query($con,"delete from pedido where id_pedido='$codigo'")or die(mysqli_error());
           if($rs){
               $_SESSION['idcarrito']="0";
    header("Location:../php/imprimir.php?carro=$codicar&venta=$id&cliente=$idclie");
           }else{ header("Location:../indexAdmin.php");}
    
           }else{ echo"<h2>Error ¡¡</h2>";}
}elseif($pago>$total){
    $vuelto=$pago-$total;
    $resu=mysqli_query($con,"insert into venta values('$id','$idclie','$usuario','$cliente','$codicar','$tipo','CANCELADO','$pago','$vuelto','$total','$fecha','$descuento','$id_comp');") or die( mysqli_error('Error'));
       if($resu){
                $rs=mysqli_query($con,"delete from pedido where id_pedido='$codigo'")or die(mysqli_error());
           if($rs){
               $_SESSION['idcarrito']="0";
    header("Location:../php/imprimir.php?carro=$codicar&venta=$id&cliente=$idclie");
           }else{ header("Location:../indexAdmin.php");}
    
           }else{ echo"<h2>Error ¡¡</h2>";}
}




?>