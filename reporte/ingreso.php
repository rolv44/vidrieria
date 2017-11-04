<?php
	include('../php/conexion.php');
	$cn=new conexion(); 
    $con=$cn->conectar();
	$fecha1 = $_POST['fecha1'];  
    $fecha2=$_POST['fecha2'];
    $res=mysqli_query($con,"select *from venta where fecha between '$fecha1' and '$fecha2' ")or die(mysqli_error());
    $fil=0;
    $venta=array();
    $c=0;
 while($r=mysqli_fetch_array($res)){
       array_push($venta,array( "idventa"=>$r[0],"usuario"=>$r[2],"cliente"=>$r[3],"tipo"=>$r[5],"total"=>$r[7],"fecha"=>$r[10] ));
   }
  
    echo json_encode($venta);   
	
?>