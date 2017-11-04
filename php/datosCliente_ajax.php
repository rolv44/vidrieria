<?php
	include('conexion.php');
	$cn=new conexion();
    $con=$cn->conectar();
    $res=mysqli_query($con,"select *from cliente")or die(mysqli_error($con));
    $fil=0;
    $egreso=array();
    $c=0;
 while($r=mysqli_fetch_array($res)){
       array_push($egreso,array( "ID"=>$r[0],"NOMBRE"=>$r[1],"RAZON_SOCIAL"=>$r[2],"DNI"=>$r[3],"RUC"=>$r[4],"DIRECCION"=>$r[5],"TELEFONO"=>$r[6] ));
   }
                                          
    echo json_encode($egreso); 
	
?>