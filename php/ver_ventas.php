<?php
include "conexion.php";
$c=new conexion();
$con=$c->conectar();

$result=mysqli_query($con,"select *from venta");
 echo "<table border='1'>";  
echo "<tr>";  
echo "<th>ID CLIENTE</th>";  
echo "<th style='width:90px'>CODIGO VENTA</th>";  
echo "<th>TIPO COMPROBANTE</th>";  
echo "<th>TOTAL</th>";
echo "<th>FECHA</th>";
echo "</tr>";  
while ($row = mysqli_fetch_row($result)){   
    echo "<tr>";  
    echo "<td>$row[0]</td>";  
    echo "<td>$row[1]</td>";  
    echo "<td>$row[2]</td>";  
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "<td><a href='ver_detalles.php?id=$row[1]'>DETALLES</a></td>";
    echo "</tr>";  
}  
echo "</table>"; 



?>