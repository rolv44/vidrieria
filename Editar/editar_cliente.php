<?php
include "../php/conexion.php";

$cn=new conexion();
$con=$cn->conectar();
session_start();
$id_cliente=$_POST['id_cliente'];
$nombre=htmlentities($_POST['n_cliente']);
$razon=htmlentities($_POST['rz_cliente']);
$dni=$_POST['d_cliente'];
$ruc=htmlentities($_POST['r_cliente']);
$dir=htmlentities($_POST['dir_cliente']);
$tel=$_POST['t_cliente'];
$tip_usu=$_SESSION['tipo_usu'];
$resultado=mysqli_query($con,"update cliente set nom_clie='$nombre',raz_soc='$razon',dni_clie='$dni',ruc_clie='$ruc',dir_clie='$dir',cel_clie='$tel' where id_clie='$id_cliente' ") or die(mysqli_error());

if($resultado){
   if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../clienteEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../clienteAdmin.php");}
}


?>