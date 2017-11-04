<?php
	include('../php/conexion.php');
	$cn=new conexion();
    $con=$cn->conectar();
	$fecha1 = $_POST['fecha1']; 
    $fecha2=$_POST['fecha2'];
    $resultado1=mysqli_query($con,"select id_usu,nom_usu from usuario ")or die(mysqli_error());
    $fil=0;
    $nombres=array();
    while($filas=mysqli_fetch_array($resultado1)){
        $nombres[$fil]=$filas[1];
        $fil++;
    }
   //echo print_r($nombres);
    $c=0;
   $data=array(); 
   while($c<$fil){
       $rs1=mysqli_query($con,"select sum(total) as p from venta where usuario='$nombres[$c]' and (fecha between '$fecha1' and '$fecha2'); ")or die(mysqli_error()); 
       
       if($rs1){ 
           $r=mysqli_fetch_array($rs1);
           $n=array_keys($nombres);
           $data[$nombres[$c]]=round($r['p'],2);
       }
       $c++;
   }
    echo json_encode($data); 

	
	
?>