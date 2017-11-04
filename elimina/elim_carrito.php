<?php
include "../php/conexion.php";
session_start();
$c=new conexion();
$con=$c->conectar();
$idcarro=$_GET['idcarro'];
$idprod=$_GET['idprod'];
$cant=$_GET['cant'];
$tam=$_GET['tam'];
$tipo=$_GET['tipo'];
$codigo=$_GET['codstock'];
$tip_usu=$_SESSION['tipo_usu'];

if(strcmp($tipo,"NORMAL")==0){
    $result=mysqli_query($con,"call restore_stock($idprod,$cant)") or die(mysqli_error() );
    $result1=mysqli_query($con,"delete from carrito where idcarrito='$idcarro'and id_pro='$idprod' and cantidad='$cant'") or die(mysqli_error());
    if($result && $result1){ 
        if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../ventaEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../indexAdmin.php");}
    }
    
}elseif(strcmp($tipo,"ESPECIAL")==0){
    $res=mysqli_query($con,"select *from almacen_especial where cod_stock='$codigo'") or die(mysqli_error());
    $filas=mysqli_num_rows($res);
    if($filas==0){
        $consu=mysqli_query($con,"select *from producto where id_pro='$idprod' ");
        $row=mysqli_fetch_array($consu);
        $r1=mysqli_query($con,"call ingresar_almacen_especial('$idprod','$codigo','$row[4]','$row[5]','$row[6]','$tam','$row[10]','$row[11]','$row[12]')") or die(mysqli_error());
        $stockNuevo=$row[7]+1;
        $r2=mysqli_query($con,"delete from carrito where idcarrito='$idcarro' and id_pro='$idprod' and tam_pro='$tam'") or die(mysqli_error()); 
        $r3=mysqli_query($con,"update producto set stock_pro='$stockNuevo' where id_pro='$idprod' ") or die(mysqli_error());
        if($r2 && $r3){ 
                        if(strcmp($tip_usu,"EMPLEADO")==0){
                            header("Location:../ventaEmp.php");
                                }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){
                         header("Location:../indexAdmin.php");}
         }else{ echo "<h2>Error¡¡¡</h2>";}
    }else{
        $fila=mysqli_fetch_array($res);
        $restore=$fila[5]+$tam;
        $res1=mysqli_query($con,"update almacen_especial set tam_pro='$restore' where cod_stock='$codigo' ") or die(mysqli_error());
        $res2=mysqli_query($con,"delete from carrito where idcarrito='$idcarro' and id_pro='$idprod' and tam_pro='$tam'") or die(mysqli_error());
        if($res1 && $res2){ 
            if(strcmp($tip_usu,"EMPLEADO")==0){
              header("Location:../ventaEmp.php");
               }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){
                        header("Location:../indexAdmin.php");  }
        }else{ echo "<h2>Error¡¡¡</h2>";}
    }
}elseif(strcmp($tipo,"SERVICIO")==0){
    $desc=$_GET['descr'];
    $monto=$_GET['mon'];
    $desc=str_replace('+',' ',$desc);
    $resul2=mysqli_query($con,"delete from carrito where (idcarrito='$idcarro' and descripcion='$desc' and tip_pro='$tipo' ) ") or die(mysqli_error());
    if($resul2){
        if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../ventaEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){
            header("Location:../indexAdmin.php");}}else{echo "<h2>Error¡¡¡</h2>";}
}


?>