<?php
	include('../php/conexion.php');
	$cn=new conexion();
    $con=$cn->conectar();
    $resultado1=mysqli_query($con,"select *from pedido ")or die(mysqli_error());
    $fil=0;
    $pedido=array();
   // while($filas=mysqli_fetch_array($resultado1)){
     //   $pedido[$fil]=$filas[0];
       // $fil++;
//    }
   //echo print_r($pedido);
    $c=0;
   $data=array(); 
$rs1=mysqli_query($con,"select *from pedido")or die(mysqli_error()); 
 while($r=mysqli_fetch_array($rs1)){
       
       array_push($pedido,array( "pedido"=>$r[0],"idcliente"=>$r[1],"usuario"=>$r[2],"cliente"=>$r[3],"carrito"=>$r[4],
                                "tipo"=>$r[5],"total"=>$r[6],"hora"=>$r[7],"fecha"=>$r[8]
           ));
     
     
   }
  
    echo json_encode($pedido); 
	
?>