<?php
include "conexion.php";
$cn=new conexion();
date_default_timezone_set('America/Lima');
$con=$cn->conectar();
$id=$_GET['idpro'];
$rs1=mysqli_query($con,"select *from actual_stock where id_pro='$id'")or die(mysqli_error());
echo"<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Document</title>
    
    <style type='text/css'>
  body {font-family: Arial, Helvetica, sans-serif;}
  table {  font-family: 'Lucida Sans Unicode', 'Lucida Grande', Sans-Serif;
    font-size: 12px;    margin: 5px;     width: 1050px; text-align: center;    border-collapse: collapse; }

   th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

    td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; }

    tr:hover td { background: #d0dafd; color: #339; }
</style>
    
</head>";
echo"<body>";
echo"<center>";
echo"<h2>TABLA DE DETALLES DE ACTUALIZACION DEL STOCK</h2>";
echo"<table>
    <tr>
        <th>CODIGO</th>
        <th>NOMBRE</th>
        <th>STOCK ANT.</th>
        <th>CANT. AGREGADA</th>
        <th>GUIA REMISION</th>
        <th>NOMBRE PROVEEDOR</th>
        <th>USUARIO</th>
        <th>FECHA</th>
    </tr>";
while($row=mysqli_fetch_array($rs1)){
echo"<tr>
    <td>$row[0]</td>
    <td>$row[1]</td>
    <td>$row[2]</td>
    <td>$row[3]</td>
    <td>$row[4]</td>
    <td>$row[5]</td>
    <td>$row[6]</td>
    <td>$row[7]</td>
</tr>"; 
    
}   
echo"</table>";
echo"</center>";

echo"</body>
</html>";

?>