<?php 
include "metodo_prod.php";
session_start();
$c=new conexion();
$co=$c->conectar();
$rs=mysqli_query($co,"select trae_id_pro() as id");
$arreglo=mysqli_fetch_array($rs);
$id=$arreglo['id'];
$tip_usu=$_SESSION['tipo_usu'];
if(isset($_POST['botonpro'])){
$nom=$_POST['nombre'];
$des=$_POST["desc"];
$mar=$_POST["marca"];
$tam=$_POST["tamanio"];
$can=$_POST["cant"];
$pcom=$_POST["pc"];
$pven=$_POST["pv"];
$pblo=$_POST["pbl"];
$gui=$_POST["guia"];
$npro=$_POST["nomprove"];
$med=$_POST["medidas"];
$tipo=$_POST["radio"]; 
        
    
try{ 
$codi=substr($nom,0,2).substr($des,0,2).substr($mar,0,2);
    
$metodos=new metodo_producto();
$newprod= $metodos->fill_producto($id,$nom,$des,$mar,$tam,$can,$pcom,$pven,$pblo,$gui,$npro,$med,$tipo,date('Y-m-d'),$codi);
    
$metodos->reg_producto($newprod,$tipo); 
if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../productoEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../productoAdmin.php");}
  }catch(Exception $e){
    echo("<script>alert('no se ha podido guardar');</script>");}
    
    
}
/*
echo("<script>alert('no se ha podido guardar');</script>");
*/
 
?>
