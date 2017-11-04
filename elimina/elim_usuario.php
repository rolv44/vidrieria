<?php
include"../php/conexion.php";
$cn=new conexion();
$con=$cn->conectar();
$cod=$_GET['cod'];
$rs=mysqli_query($con,"delete from usuario where id_usu='$cod'")or die(mysqli_error());
if($rs){
    header("Location:../controlAdmin.php");
}else{
    echo "<h2>ERROR ¡¡</h2>";
}

?>