<?php
	include('../php/conexion.php');
	$cn=new conexion();
    $con=$cn->conectar();
	$fecha1 =$_POST['fecha1'];
    $fecha2=$_POST['fecha2'];
    $f1=explode("-",$fecha1);
    $f2=explode("-",$fecha2);
     
    $data=array(); 
    
    if($f1[0]==$f2[0]){
        if($f1[1]<$f2[1]){
                for($i=$f1[1];$i<=$f2[1];$i++){
                    $result=mysqli_query($con,"select SUM(total) as s from venta WHERE month(fecha)=$i  and year(fecha)=$f1[0]")or die(mysqli_error());
                    if($result){
                        $r=mysqli_fetch_array($result);
                        $rd=round($r['s'],2);
                        array_push($data,$rd);
                    }
                }
            }elseif($f1[1]==$f2[1]){
                 $result=mysqli_query($con,"select SUM(total) as s from venta WHERE month(fecha)=$f[1]  and year(fecha)=$f1[0]")or die(mysqli_error());
                    if($result){
                        $r=mysqli_fetch_array($result);
                        $rd=round($r['s'],2);
                        array_push($data,$rd);
                    }
            }
    }elseif($f1[0]<$f2[0]){
                for($i=$f1[1];$i<=12;$i++){
                   $result=mysqli_query($con,"select SUM(total) as s from venta WHERE month(fecha)=$i  and year(fecha)=$f1[0]")or die(mysqli_error());
                    if($result){
                        $r=mysqli_fetch_array($result);
                        $rd=round($r['s'],2);
                        array_push($data,$rd);
                    }
                }
                for($i=0;$i<$f2[1];$i++){
                   $result=mysqli_query($con,"select SUM(total) as s from venta WHERE month(fecha)=$i  and year(fecha)=$f2[0]")or die(mysqli_error());
                    if($result){
                        $r=mysqli_fetch_array($result);
                        $rd=round($r['s'],2);
                        array_push($data,$rd);
                    }
                }
            
        }

    echo json_encode($data); 

	
	
?>