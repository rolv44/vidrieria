<?php
include "conexion.php";
require '../fpdf/fpdf.php';
$idventa=$_GET['venta'];
$idcarro=$_GET['carro'];
$idcliente=$_GET['cliente'];
$c=new conexion();
$con=$c->conectar();
$total=0;
$result=mysqli_query($con,"select *from carrito where idcarrito='$idcarro' ")or die(mysqli_error());
$res=mysqli_query($con,"select *from venta where id_venta='$idventa' ")or die(mysqli_error());
$resu=mysqli_query($con,"select *from cliente where id_clie='$idcliente' ")or die(mysqli_error());

$cliente_list=array();
$cnt=0;
while($tr=mysqli_fetch_row($resu)){
    $cnt=1;
    $cliente_list[0]=$tr[0];
    $cliente_list[1]=$tr[1];
    $cliente_list[2]=$tr[2];
    $cliente_list[3]=$tr[3];
    $cliente_list[4]=$tr[4];
    $cliente_list[5]=$tr[5];
    $cliente_list[6]=$tr[6];
}
if($res && $result){
    $ven=mysqli_fetch_array($res);
    $cifra=0;
    $numero=$ven[12];
    while($numero>=1){
        $numero=$numero/10;
        $cifra++;
    }
    $ceros="00000000";
    if($cifra==1){
        $ceros="0000000";
    }elseif($cifra==2){
        $ceros="000000";
    }elseif($cifra==3){
        $ceros="00000";
    }elseif($cifra==4){
        $ceros="00000";
    }elseif($cifra==5){
        $ceros="00000";
    }
       if(strcmp($ven[5],"FACTURA")==0){
           $pdf=new FPDF();
$pdf->AddPage();
$anio=substr($ven[10],2,2);
$mes=substr($ven[10],5,2);
$dia=substr($ven[10],8);
$pdf->SetFont('Times','B',10);
$pdf->Cell(50,40," ",0,1,'l');
$pdf->SetXY(30,43);
$pdf->Cell(100,5,$cliente_list[2],0,1,'l');
$pdf->SetXY(30,52);
$pdf->Cell(100,5,$cliente_list[5],0,1,'l');
$pdf->SetXY(30,60);
$pdf->Cell(123,5,$cliente_list[4],0,0,'l');
$pdf->Cell(25,5,$dia,0,0,'r');
$pdf->Cell(27,5,$mes,0,0,'r');
$pdf->Cell(20,5,$anio,0,1,'r');
$pdf->Cell(20,10,' ',0,1,'l');
/*echo "<tr>";
echo "<th>Cant.</th>";
echo "<th style='width:90px'>DESCRIPCION</th>";
echo "<th>P. Unitario</th>";
echo "<th>Sub. Total</th>";
echo "</tr>";  */
$total=0;
while ($row = mysqli_fetch_row($result)){
    $total=$total+$row[13];
    $pdf->Cell(20,3,$row[3],0,0,'c');
    $pdf->Cell(120,3,$row[2],0,0,'c');
    $pdf->Cell(35,3,$row[8],0,0,'l');
    $pdf->Cell(35,3,$row[13],0,1,'l');
    //$pdf->Cell(50,5,$row[5],0,1,'l');
}
//$vz="DESCUENTO:".$ven[11]."%";
 $pdf->SetXY(19,133);
 $dess=($total*$ven[11])/100;
 $newt=$total-$dess;
 $redondo=round($newt,2);
 //$pdf->Cell(20,12,$redondo,0,1,'r');
 include"../clases/NumToLett.php";
 $nn=numtoletras($redondo);
 $pdf->Cell(167,10,$nn,0,0,'r');
 $pdf->Cell(50,12,$ven[9],0,1,'r');
 $pdf->Cell(176,10,"     ",0,0,'r');
 $pdf->Cell(50,10,$ven[9],0,1,'r');

//$impor="IMPORTE:".$ven[7]." ";
//$vuelto="VUELTO:".$ven[8]." ";
$pdf->Output();

       }elseif(strcmp($ven[5],"BOLETA")==0){
//
// echo"BOLETA NUMERO: ".$ceros.$ven[12]."<br>";
// echo"CLIENTE: ".$ven[3]."<br>";
// echo "FECHA: ".$ven[10]."<br>";
// echo "<table border='1'>";
// echo "<tr>";
// echo "<th>Cant.</th>";
// echo "<th style='width:90px'>DESCRIPCION</th>";
// echo "<th>P. Unitario</th>";
// echo "<th>Sub. Total</th>";
// echo "</tr>";
// while ($row = mysqli_fetch_row($result)){
//     $total=$total+$row[13];
//
//     echo "<tr>";
//     if(strcmp($row[5],"NORMAL")==0 || strcmp($row[5],"SERVICIO")==0 ){
//         echo "<td>$row[3]</td>";
//     }elseif(strcmp($row[5],"ESPECIAL")==0){
//         echo "<td>$row[6]</td>";
//     }
//     echo "<td>$row[2]  $row[7]</td>";
//     echo "<td>$row[8]</td>";
//     echo "<td>$row[13]</td>";
//     echo "<td>$row[5]</td>";
//     echo "</tr>";
// }
// $vz="DESCUENTO:".$ven[11]."%";
// $tot="TOTAL:".$ven[9]." ";
// $impor="IMPORTE:".$ven[7]." ";
// $vuelto="VUELTO:".$ven[8]." ";
// echo "<tr><td colspan='6' align='right'><input type='text' value=$vz disabled></td></tr>";
// echo "<tr><td colspan='6' align='right'><input type='text' value=$tot disabled></td></tr>";
// echo "<tr><td colspan='6' align='right'><input type='text' value=$impor disabled></td></tr>";
// echo "<tr><td colspan='6' align='right'><input type='text' value=$vuelto disabled></td></tr>";
// echo "<a href='../indexAdmin.php'>REGRESAR</a>&nbsp";
// echo "<input type='button' value='IMPRIMIR' onclick='window.print()'> ";
//  echo "<center>";



 $pdf2=new FPDF();
 $pdf2->AddPage();
 $anio2=substr($ven[10],2,2);
 $mes2=substr($ven[10],5,2);
 $dia2=substr($ven[10],8);
 $pdf2->SetFont('Times','B',10);
 $pdf2->Cell(50,40," ",0,1,'l');
 $pdf2->SetXY(30,43);
 $pdf2->Cell(100,5,$cliente_list[2],0,1,'l');
 $pdf2->SetXY(30,52);
 $pdf2->Cell(100,5,$cliente_list[5],0,1,'l');
 $pdf2->SetXY(30,60);
 $pdf2->Cell(123,5,$cliente_list[4],0,0,'l');
 $pdf2->Cell(25,5,$dia2,0,0,'r');
 $pdf2->Cell(27,5,$mes2,0,0,'r');
 $pdf2->Cell(20,5,$anio2,0,1,'r');
 $pdf2->Cell(20,10,' ',0,1,'l');
 $total=0;
 while ($row = mysqli_fetch_row($result)){
 $total=$total+$row[13];
 $pdf2->Cell(20,3,$row[3],0,0,'c');
 $pdf2->Cell(120,3,$row[2],0,0,'c');
 $pdf2->Cell(35,3,$row[8],0,0,'l');
 $pdf2->Cell(35,3,$row[13],0,1,'l');
 //$pdf->Cell(50,5,$row[5],0,1,'l');
 }
 //$vz="DESCUENTO:".$ven[11]."%";
 $pdf2->SetXY(19,133);
 $dess=($total*$ven[11])/100;
 $newt=$total-$dess;
 $redondo=round($newt,2);
 //$pdf->Cell(20,12,$redondo,0,1,'r');
 require_once"../clases/NumToLett.php";
 $nn=numtoletras($redondo);
 $pdf2->Cell(167,10,$nn,0,0,'r');
 $pdf2->Cell(50,12,$ven[9],0,1,'r');
 $pdf2->Cell(176,10,"     ",0,0,'r');
 $pdf2->Cell(50,10,$ven[9],0,1,'r');

 //$impor="IMPORTE:".$ven[7]." ";
 //$vuelto="VUELTO:".$ven[8]." ";
 $pdf2->Output();





       }
}
// echo"
// <script type='text/javascript'>
// function imprSelec()
// {
// var ficha=document.getElementById('imp');
// var ventimp=window.open(' ','_blank');
// ventimp.document.write(ficha.innerHTML);
// ventimp.document.close();
// ventimp.print();
// ventimp.close();}
//
// </script>
//
// ";





?>
