<?php
date_default_timezone_set('America/Lima');
include "../php/conexion.php";
session_start();
$usu=$_SESSION['usuario'];
$tip_usu=$_SESSION['tipo_usu'];
$idp=$_POST['iddp'];
$nom=htmlentities($_POST['nnp']);
$stock=(int)$_POST['sttp'];
$add=(int)$_POST['ctta'];
$guia=htmlentities($_POST['giir']);
$prove=$_POST['prr'];
$fecha=date('Y-m-d H:i:s');
$c=new conexion();
$con=$c->conectar();
$newp=$stock+$add;

$resu=mysqli_query($con,"insert into actual_stock values('$idp','$nom','$stock','$add','$guia','$prove','$usu','$fecha'); ") or die( mysqli_error('Error'));

$resultado=mysqli_query($con,"update producto set stock_pro='$newp'  where id_pro='$idp' ") or die(mysqli_error());

if($resu && $resultado){
        if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../productoEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../productoAdmin.php");}
        
                  }else{echo "<h3 align='center'>Error¡¡ </h3>";}

?>