<?php
include "conexion.php";
$c=new conexion();
$con=$c->conectar();
$idcarro=$_GET['id'];

$result=mysqli_query($con,"select *from carrito where idcarrito='$idcarro'");
echo"<form action='../indexAdmin.php' >";
 echo "<table border='1'>";  
echo "<tr>";  
echo "<th>ID VENTA</th>";  
echo "<th style='width:90px'>CODIGO PRODUCTO</th>";  
echo "<th>PRODUCTO</th>";  
echo "<th>CODIGO STOCK</th>";
echo "<th>TIPO</th>";
echo "<th>CANTIDAD</th>";
echo "</tr>";  
while ($row = mysqli_fetch_row($result)){   
    echo "<tr>";  
    echo "<td>$row[0]</td>";  
    echo "<td>$row[1]</td>";  
    echo "<td>$row[2]</td>";  
    echo "<td>$row[4]</td>";
    echo "<td>$row[5]</td>";
    echo "<td>$row[6]</td>";
    echo "</tr>";  
}  
echo "<tr><td colspan='6' align='center'><input type='submit' value='REGRESAR'></td></tr>";
echo "</table>"; 
echo"</form>";



?>