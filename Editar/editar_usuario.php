<?php
include "../php/conexion.php";
session_start();

$cn=new conexion();
$con=$cn->conectar();
$usu=$_SESSION['usuario'];
$nombre=htmlentities($_POST['edt_nom']);
$id=$_POST['edt_cod'];
$tipo=$_POST['edt_tip'];
$pass1=$_POST['edt_passadmin'];
$pass2=$_POST['edt_pass'];
$resultado=mysqli_query($con,"select *from usuario where nom_usu='$usu' and pass_usu=sha1('$pass1') ")or die(mysqli_error());
$cont=0;
while($f=mysqli_fetch_array($resultado)){
    $cont++;
}
if($cont==1){
    $resultado2=mysqli_query($con,"update usuario set nom_usu='$nombre', pass_usu=sha1('$pass2'), tip_usu='$tipo' where id_usu='$id' ")or die(mysqli_error());
    if($resultado2){ 
      if(strcmp($tipo,"ADMINISTRADOR")==0){
          header("Location:../index.php");
      }else{header("Location:../controlAdmin.php");}
    }
}else{
    header("Location:../controlAdmin.php");
}


?>