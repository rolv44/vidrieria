<?php
	include('conexion.php');
	$cn=new conexion();
    $con=$cn->conectar();
    $res=mysqli_query($con,"select *from producto")or die(mysqli_error($con));
    $fil=0;
    $egreso=array();
    $c=0;
 while($r=mysqli_fetch_array($res)){
       array_push($egreso,array( "ID"=>$r[0],"NOMBRE"=>$r[1],"DESCRIPCION"=>$r[2],"MARCA"=>$r[3],"P_U"=>$r[4],"P_B"=>$r[6],"STOCK"=>$r[7],"TIPO"=>$r[9],"G_R"=>$r[10],"PROVEEDOR"=>$r[11],"FECHA"=>$r[12] ));
   }
                                          
    echo json_encode($egreso); 
	
?>