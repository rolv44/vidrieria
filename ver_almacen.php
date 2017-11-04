<?php 
session_start();
if(is_null($u=$_SESSION['usuario']) && is_null($c=$_SESSION['contrasena']) && !$_SESSION['val']==1){

   header("Location:index.php");
}
error_reporting(E_ALL ^ E_NOTICE);
include "php/conexion.php";
$cn=new conexion();
$con=$cn->conectar();  ?>
<!DOCTYPE html PUBLIC "InnovatioCoorp">
<html xmlns="Cesar O'Higgins" xml:lang="en" lang="en">
<head>
<title>Yashimitsu - Vidrieria</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="../estilos/detalle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<?php
if($_GET['op']==0){
    
    $id=$_GET['valor_id'];

$tipoprod=$_GET['tipoprod'];

if(strcmp($tipoprod,'ESPECIAL')==0){
$res=mysqli_query($con,"select *from producto where id_pro='$id' ")or die(mysqli_error($con));
$ar=mysqli_fetch_array($res);
$tf=0;
$tf=(int)$ar[13];
$result=mysqli_query($con,"call trae_almacen_especial($id)");
    echo "<center>";
    echo "<h2>ALMACEN</h2>";
    echo "<table class='table table-striped table-bordered table-hover table-sm'  style='width:80%;'>";  
echo"<thead>";
echo "<tr>";  
echo "<th>ID</th>";  
echo "<th style='width:90px'>CODIGO</th>";  
echo "<th>P. COMPRA</th>";  
echo "<th>P. VENTA</th>";
echo "<th>P. BLOQUE</th>";
echo "<th>TAMAÑO</th>";
echo "<th>GUIA REMISION</th>";
echo "<th style='width:120px'>PROVEEDOR</th>";
echo "<th>F. INGRESO</th>";
echo "</tr>";  
echo"</thead>";
$t=0;
$total=0;
$te=0;
while ($row = mysqli_fetch_row($result)){
    $t++;
    $total=$total+$row[8];
    $e=(int)$row[8];
    if($e>$tf){$te++;}
    echo "<tr>";  
    echo "<td>$row[0]</td>";  
    echo "<td>$row[1]</td>";  
    echo "<td>$row[2]</td>";  
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "<td>$row[5]</td>";
    echo "<td>$row[6]</td>";
    echo "<td>$row[7]</td>";
    echo "<td>$row[8]</td>";
    echo "</tr>";  
}  
echo "</table>";
echo"<h4>STOCK TOTAL=$t; BLOQUES ENTEROS=$te; TOTAL PIES CUADRADOS=$total</h4>";
echo "</center>";
}else{  echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";}
    
}
elseif($_GET['op']==1){
    
     $id=$_GET['valor_id'];

$tipoprod=$_GET['tipoprod'];

    
if(strcmp($tipoprod,'ESPECIAL')==0){
$idcarro=$_SESSION['idcarrito'];
$cantidad_stock=0;
$h="ESPECIAL";
$result=mysqli_query($con,"call trae_almacen_especial($id)");
     echo "<center>";
    echo "<h2>ALMACEN</h2>";
    echo "<h3>BUSCAR POR TAMAÑO</h3><input type='text' id='bustam' onkeyup=javascript:buscar('bustam','tblalmacen');>";
    echo "<form action='php/metodo_listaCarro.php?tipoproducto=ESPECIAL&id=$idcarro' method='POST'>";
    echo "<input type='hidden' value='' name='idpr' id='idpr' >";
    echo "<input type='hidden' value='' name='pbloque' id='pbloque' >";
    echo "<input type='hidden' value='' name='punitario' id='punitario' >";
    echo "<input type='hidden' value='' name='codpr' id='codpr' >";
    echo "<input type='hidden' value='' name='tps' id='tps' >";
    echo "<input type='hidden' value='' name='tamAct' id='tamAct' >";
    echo "<input type='hidden' value='' name='canti_stock' id='canti_stock' >";
    echo "<input type='hidden' value='' name='guia' id='guia' >";
    echo "<input type='hidden' value='' name='nombre_prov' id='nombre_prov' >";
    echo "<input type='hidden' value='' name='fecharegis' id='fecharegis' >";
    
    echo "<table class='table table-striped table-bordered table-hover table-sm' id='tblalmacen' style='width:80%;'>";  
echo "<tr>";  
echo "<th>ID</th>";  
echo "<th style='width:90px'>CODIGO</th>";  
echo "<th>P. COMPRA</th>";  
echo "<th>P. VENTA</th>";
echo "<th>P. BLOQUE</th>";
echo "<th>TAMAÑO</th>";
echo "<th>GUIA REMISION</th>";
echo "<th style='width:120px'>PROVEEDOR</th>";
echo "<th>F. INGRESO</th>";
echo "<th>TAMAÑO</th>";
echo "</tr>";  
while ($row = mysqli_fetch_row($result)){   
    echo "<tr>";  
    echo "<td align='center'><input type='text' value='$row[0]' size='1' disabled></td>";  
    echo "<td align='center'><input type='text' value='$row[1]' size='7' disabled></td>";  
    echo "<td align='center'><input type='text' value='$row[2]' size='3' disabled></td>";  
    echo "<td align='center'><input type='text' value='$row[3]' size='3' disabled></td>";
    echo "<td align='center'><input type='text' value='$row[4]' size='3' disabled></td>";
    echo "<td align='center'><input type='text' value='$row[5]' size='3' disabled></td>";
    echo "<td align='center'><input type='text' value='$row[6]' size='10' disabled></td>";
    echo "<td align='center'><input type='text' value='$row[7]' size='19' disabled></td>";
    echo "<td align='center'><input type='text' value='$row[8]' size='7' disabled></td>";
    $row[7]=str_replace(' ', '+', $row[7]);
    $row[1]=str_replace(' ', '¿', $row[1]);
    echo "<td align='center'><input type='text' placeholder='Lim.:$row[5]' size='5'
    onkeyup=getdato(this.value,'$row[0]','$row[1]','$row[3]','$row[4]','$row[5]','$row[6]','$row[8]','$row[7]');></td>";
    echo "<td align='center'><input type='submit' value='ENVIAR' ></td>";
    echo "</tr>";  
    $cantidad_stock++;
}  
echo "</table>";  
    echo "</center>";
echo "</form>";
echo "
   <script>
    function getdato(x,y,f,pu,pb,tam,gu,fe,nom){
     document.getElementById('tps').value=x;
     document.getElementById('idpr').value=y;
     document.getElementById('codpr').value=f;
     document.getElementById('punitario').value=pu;
     document.getElementById('pbloque').value=pb;
     document.getElementById('tamAct').value=tam;
     document.getElementById('guia').value=gu;
     document.getElementById('fecharegis').value=fe;
     document.getElementById('nombre_prov').value=nom.split('+').join(' ');
     document.getElementById('canti_stock').value=$cantidad_stock;
    }
    function imprimir(){
    var c=document.getElementById('nombre_prov').value;
    alert(c);
    }
    
    function buscar(text,tabla){
    var tableReg = document.getElementById(tabla);
    var searchText = document.getElementById(text).value.toLowerCase();
    var cellsOfRow = '';
    var found = false;
    var compareWith = '';

    // Recorremos todas las filas con contenido de la tabla
    for (var i = 1; i < tableReg.rows.length; i++)
    {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        found = false;
        // Recorremos todas las celdas
        
            compareWith = cellsOfRow[5].innerHTML.toLowerCase();
            // Buscamos el texto en el contenido de la celda
            
            if (searchText.length == 0 || (compareWith.indexOf(searchText)>-1)) 
            {
                found = true;
            }
        
        if (found)
        {
            tableReg.rows[i].style.display = '';
        } else {
            // si no ha encontrado ninguna coincidencia, esconde la
            // fila de la tabla
            tableReg.rows[i].style.display = 'none';
        }
    }

}
    
    </script>
";    
}else{header("Location:php/metodo_listaCarrito.php");}
    
}

?>


