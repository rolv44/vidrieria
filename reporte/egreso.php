<?php
	include('../php/conexion.php');
	$cn=new conexion();
    $con=$cn->conectar();
	$fecha1 = $_POST['fecha1']; 
    $fecha2=$_POST['fecha2'];
    $res=mysqli_query($con,"select *from egreso where fecha between '$fecha1' and '$fecha2' ")or die(mysqli_error());
    $fil=0;
    $egreso=array();
    $c=0;
 while($r=mysqli_fetch_array($res)){
       array_push($egreso,array( "idegreso"=>$r[0],"descripcion"=>$r[1],"monto"=>$r[2],"fecha"=>$r[3] ));
   }
                                          
    echo json_encode($egreso); 
	
?>