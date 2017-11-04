<?php
                              
include "conexion.php";
session_start();
$c=new conexion();
$con=$c->conectar();
$varsession=$_SESSION['idcarrito'];
$tipodeusuario=$_SESSION['tipo_usu'];
$tipo=$_GET["tipoproducto"];
if(strcmp($varsession,"0")==0){
      $cn=new conexion();
      $con=$cn->conectar();
       $rs=mysqli_query($con,"SELECT trae_id_carrito() as opcion");
    $f=mysqli_fetch_array($rs);
    $r=$f['opcion'];
    $_SESSION['idcarrito']=$r;
   }

if(strcmp($tipo,"NORMAL")==0){
$producto=$_POST["pnom"];
$cant=$_POST['numberprod'];
$idp=str_replace('¿', ' ',$_POST['idpr']);
$des=$_POST['descripcion'];
$puni=$_POST['preuni'];
$pb=$_POST['preblo'];
$stk=$_POST['prostock'];
$guia=$_POST['guiarem'];
$proveedor=$_POST['nomproveedor'];
$fechareg=$_POST['fechareg'];
$nuecant=$stk-$cant;
$vs=$_SESSION['idcarrito'];
 
if(strcmp($pb,"0")==0){
    $subtot=$cant*$puni;
    }else{
    
    $prices=explode(",", $pb);
$j=0;
$montofinal=0;
foreach ($prices as &$valor) {
    $j++;
    }
unset($valor);
while ($j>0) {
    $j--;
    $price=explode("x",$prices[$j]);
    $aux1=$cant/$price[0];
    $aux=(string)$aux1;
   // echo "String: $aux<br />\n";
    $aux=explode(".",$aux);
    $aux2=(int)$aux1;
    if($aux2>=1){
        $aux4=$aux2*$price[1];
        $montofinal=$montofinal+$aux4;
        if(isset($aux[1])){
            $cant=$aux[1];
        }else{$j=0;}
    }
}
    $subtot=$montofinal;
}  
    
    $result=mysqli_query($con,"insert into carrito values('$vs','$idp','$producto',$cant,'','$tipo','','$des','$puni','$pb','$guia','$proveedor','$fechareg','$subtot');") or die (mysqli_error());
 $resul=mysqli_query($con,"update producto set stock_pro='$nuecant' where id_pro='$idp'") or die(mysqli_error());
  if($result && $resul){
      if(strcmp($tipodeusuario,"ADMINISTRADOR")==0){
          header("Location:../indexAdmin.php");
      }elseif(strcmp($tipodeusuario,"EMPLEADO")==0){
           header("Location:../ventaEmp.php");
      }
  }else{echo "<h2>ERROR</h2>";} 
    
}
if(strcmp($tipo,"ESPECIAL")==0){
$idcarrito=$_SESSION['idcarrito'];
$cant=$_POST["tps"];
$ipd=$_POST["idpr"];
$cd=str_replace('¿', ' ', $_POST["codpr"]);
$resulta2=mysqli_query($con,"select tam_pro as ta from almacen_especial where cod_stock='$cd'") or die(mysqli_error());
$row4=mysqli_fetch_array($resulta2);
$tamanio_prod_alm=$row4[0];
if($cant<=$tamanio_prod_alm){
    
$pu=$_POST['punitario'];
$pb=$_POST['pbloque'];
$tam_actual=$_POST['tamAct'];
$cant_act_stock=$_POST['canti_stock'];
$guiarem=$_POST['guia'];
$proveedor=$_POST['nombre_prov'];
$fecreg=$_POST['fecharegis'];    
$ncs=$cant_act_stock-1;
$resul=mysqli_query($con,"select des_pro,tam_prod,nom_pro from producto where id_pro='$ipd'") or die(mysqli_error());
$rr=mysqli_fetch_array($resul);
$tamanio_prod=$rr['tam_prod'];
$descri_prod=$rr['des_pro'];
$nombre_prod=$rr['nom_pro'];
$tre=$tam_actual-$cant;
if($cant<$tamanio_prod){
    $subto=$pu/$tamanio_prod;
    $ssub=$cant*$subto;
}elseif($cant==$tamanio_prod){
    $ssub=$pb;
}
    
$res=mysqli_query($con,"insert into carrito values('$idcarrito','$ipd','$nombre_prod',1,'$cd','$tipo','$cant','$descri_prod','$pu','$pb','$guiarem','$proveedor','$fecreg','$ssub');") or die (mysqli_error());

    if(strcmp($cant,$tam_actual)==0){
        mysqli_query($con,"delete from almacen_especial where cod_stock='$cd' ")or die(mysqli_error());
        mysqli_query($con,"update producto set stock_pro=$ncs where id_pro='$ipd' ")or die(mysqli_error());
    }elseif($tam_actual>$cant){
       mysqli_query($con,"update almacen_especial set tam_pro='$tre' where cod_stock='$cd' ")or die(mysqli_error()); 
    }

if($res){
      if(strcmp($tipodeusuario,"ADMINISTRADOR")==0){
          header("Location:../indexAdmin.php");
      }elseif(strcmp($tipodeusuario,"EMPLEADO")==0){
           header("Location:../ventaEmp.php");
      }
  }else{echo "<h2>ERROR</h2>";}  

}elseif($cant>$tamanio_prod_alm){
    header("Location:../ver_almacen.php?valor_id=$ipd&tipoprod=$tipo&op=1");
}

}

if(strcmp($tipo,"SERVICIO")==0){
    $ica=$_SESSION['idcarrito'];
    $descripcion=$_POST['descripcion'];
    $monto=$_POST['monto'];
    $da=date('Y-m-d');
    $r=mysqli_query($con,"insert into carrito values('$ica','0','SERVICIO','1','0','SERVICIO','0','$descripcion','0','0','0',' ','$da','$monto'); ") or die (mysqli_error($con));
    if($r){
      if(strcmp($tipodeusuario,"ADMINISTRADOR")==0){
          header("Location:../indexAdmin.php");
      }elseif(strcmp($tipodeusuario,"EMPLEADO")==0){
           header("Location:../ventaEmp.php");
      }
  }else{echo "<h2>ERROR</h2>";}  
    
}else{echo "<script>alert('error¡¡¡¡');</script>";}

/*
call ingresar_carrito('$ica','0','servicio',1,'0','SERVICIO','0','$descripcion','$monto','0','0','0','$da');

echo"<script>alert($varsession);</script>";
 $q=$_SESSION['idcarrito'];
    echo"<script>alert('hol.$q');</script>";

list(, $valor) = each($prices)
*/

?>
