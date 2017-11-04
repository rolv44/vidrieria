<?php
include "../php/conexion.php";

$cn=new conexion();
$con=$cn->conectar();
session_start();
$id_producto=$_POST['id_producto'];
$tipo=$_POST['t_producto'];
$nombre=htmlentities($_POST['n_producto']);
$descripcion=htmlentities($_POST['d_producto']);
$marca=htmlentities($_POST['m_producto']);
$stock=$_POST['s_producto'];
$guia=$_POST['g_producto'];
$proveedor=htmlentities($_POST['np_producto']);
$tip_usu=$_SESSION['tipo_usu'];
$pvario=$_POST['pbvariado'];
if(strcmp($tipo,"NORMAL")==0){
    $resultado=mysqli_query($con,"update producto set nom_pro='$nombre', des_pro='$descripcion', mar_pro='$marca', stock_pro='$stock', guia_rem='$guia', nom_provee='$proveedor',pre_blo='$pvario' where id_pro='$id_producto' ") or die(mysqli_error());
    if($resultado){
        if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../productoEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../productoAdmin.php");}
        
                  }else{echo "<h3 align='center'>Error¡¡ </h3>";}

}elseif(strcmp($tipo,"ESPECIAL")==0){
    $result=mysqli_query($con,"update producto set nom_pro='$nombre', des_pro='$descripcion', mar_pro='$marca', stock_pro='$stock', guia_rem='$guia', nom_provee='$proveedor' where id_pro='$id_producto' ") or die(mysqli_error());
    $rs=mysqli_query($con,"update almacen_especial set guia_rem='$guia', nom_provee='$proveedor' where id_pro='$id_producto' ") or die(mysqli_error());
    if($result && $rs){ 
       if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../productoEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../productoAdmin.php");}
    
}
}




?>