<?php 
include "metodo_clie.php";
session_start();
$c=new conexion();
$co=$c->conectar();
$rs=mysqli_query($co,"select trae_id_clie() as id");
$arreglo=mysqli_fetch_array($rs);
$id=$arreglo['id'];
if(isset($_POST['botonclie'])){
$nom=$_POST['nombre'];
$raz=$_POST['razon'];
$dni=$_POST["dni"];
$ruc=$_POST["ruc"];
$dir=$_POST["dire"];
$tel=$_POST["tel"];
$tip_usu=$_SESSION['tipo_usu'];
try{ 
    
$metodos=new metodo_clie();
$newclie= $metodos->fill_cliente($id,$nom,$raz,$dni,$ruc,$dir,$tel);
    
$metodos->reg_cliente($newclie); 
    if(strcmp($tip_usu,"EMPLEADO")==0){
header("Location:../clienteEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../clienteAdmin.php");}
    
}catch(Exception $e){
    echo("<script>alert('no se ha podido guardar');</script>");}
  
    
    
}else{ echo"Error!!!";}
/*
echo("<script>alert('no se ha podido guardar');</script>");
*/
 
?>