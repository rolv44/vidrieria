<?php 
session_start();
if(is_null($u=$_SESSION['usuario']) && is_null($c=$_SESSION['contrasena']) && !$_SESSION['val']==1){
   header("Location:index.php");
   
}
 ?>

<!DOCTYPE html PUBLIC "InnovatioCoorp">
<html xmlns="Cesar O'Higgins" xml:lang="en" lang="en">
<head>
<title>JR - DISTRIBUIDORES</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="../estilos/report_balance.css" rel="stylesheet" type="text/css" />
<link href="../estilos/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/chartJS/Chart.min.js"></script>

<link href="../calendario_dw/calendario_dw-estilos.css" type="text/css" rel="STYLESHEET">
<script type="text/javascript" src="../calendario_dw/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../calendario_dw/calendario_dw.js"></script>

</head>
<body id="page1">
<div id="header">
	<div class="container">
		<div class="logo">
			<img src="../images/logo.jpg" alt="" />
		</div>

	</div>
</div>
    
    <div class="caja">
            <table>
                <tr>
                    <td>DESDE: </td>
                    <td><input type="text" name="fech1" id="fech1" class="cd"></td>
                </tr>
                <tr>
                    <td>HASTA: </td>
                    <td><input type="text" name="fech2" id="fech2" class="cd"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="button" value="Mostrar" onclick="javascript:buscar_ingreso(); buscar_egreso();"></td>
                </tr>
            </table>
        </div>
        
        <div class="ingreso">
       <h4 align="center">TABLA DE INGRESOS</h4>
       <table id="tblingreso" border="1" bordercolor="deepskyblue">
           <tr>
               <th>IDventa</th>
               <th style="width:100px">Usuario</th>
               <th style="width:150px">Cliente</th>
               <th style="width:100px">Tipo</th>
               <th style="width:100px">Total</th>
               <th>Fecha</th>
           </tr>
       </table>
   </div>
   
   <div class="egreso">
      <h4 align="center">TABLA DE EGRESOS</h4>
       <table id="tblegreso" border="1" bordercolor="deepskyblue">
           <tr>
               <th style="width:200px">Descripcion</th>
               <th style="width:100px">Monto</th>
               <th>Fecha</th>
           </tr>
       </table>
   </div>
    
    <div class="calcular">
        <h4 align="center">CALCULAR TOTAL</h4>
        <table id="clc">
            <tr>
                <td><input type="button" value="CALCULAR" onclick="javascript:calculartotal();"></td>
            </tr>
            <tr>
                <td><label for="">TOTAL INGRESO: </label></td>
                <td><input type="text" name="ingre" id="ingre" readonly></td>
            </tr>
            <tr>
                <td><label for="">TOTAL EGRESO: </label></td>
                <td><input type="text" name="egre" id="egre" readonly></td>
            </tr>
        </table>
    </div>

    
<div id="footer">
	<div class="container">
		<a rel="nofollow" href="https://www.facebook.com/InnovatioCoorp/" target="_blank">Sitio Web diseñado por Innovatio Coorporation </a> 
		<h4>Diseñado por Cesar O'Higgins</h4>
		
	</div>
</div>
<script type="text/javascript"> Cufon.now(); </script> 
</body> 
</html>

<script>
   $(document).ready(function(){
   $(".cd").calendarioDW();
})
</script>
<script>
    function formatear(fecha){
        var d=fecha.split("/");
        var f=d[2]+"-"+d[1]+"-"+d[0];
        return f;
    }
    
    function buscar_ingreso(){
        var fe1=document.getElementById("fech1").value;
        var fe2=document.getElementById("fech2").value;
        var ffe1=formatear(fe1);
        var ffe2=formatear(fe2);
        var parametro = { 
                                 "fecha1" : ffe1,
                                  "fecha2" :ffe2
                                            };
        $.ajax({
            type:'POST',
            url:'ingreso.php',
            data:parametro,
            dataType:'json',
            success:function(datos){
                var val=eval(datos);
                var con=0;
                for(var i in val){
                    con++;
                }
            var tabla=document.getElementById('tblingreso');
            var filas=tabla.getElementsByTagName('tr');
            if(tabla.rows.length>2){
                for(var f=1;f<=tabla.rows.length;f++){
                    tabla.removeChild(filas[f]);
                }
            }    
            var i=0;  
                while(i<=con){ 
                        var fila1=tabla.insertRow(i+1);
                fila1.insertCell(0).innerHTML=val[i].idventa;
                fila1.insertCell(1).innerHTML=val[i].usuario;
                fila1.insertCell(2).innerHTML=val[i].cliente;   
                fila1.insertCell(3).innerHTML=val[i].tipo;
                fila1.insertCell(4).innerHTML=val[i].total;  
                fila1.insertCell(5).innerHTML=val[i].fecha;
             i++; 
                }
            }
        });  
        
       // setTimeout('act_pedido()',3000);
    }
    
    function buscar_egreso(){
        var f1=document.getElementById("fech1").value;
        var f2=document.getElementById("fech2").value;
        var ff1=formatear(f1);
        var ff2=formatear(f2);
        var parametros = { 
                                 "fecha1" : ff1,
                                  "fecha2" :ff2
                                            };
        $.ajax({
            type:'POST',
            url:'egreso.php',
            data:parametros,
            dataType:'json',
            success:function(datos){
                var valor=eval(datos);
                var cont=0;
                for(var i in valor){
                    cont++;
                }
            var tabla=document.getElementById('tblegreso');
            var fila=tabla.getElementsByTagName('tr');
            if(tabla.rows.length>2){
                for(var f=1;f<=tabla.rows.length;f++){
                    tabla.removeChild(fila[f]);
                }
            }    
            var i=0;  
                while(i<=cont){
                        var fila=tabla.insertRow(i+1); 
                fila.insertCell(0).innerHTML=valor[i].descripcion;
                fila.insertCell(1).innerHTML=valor[i].monto;   
                fila.insertCell(2).innerHTML=valor[i].fecha;
             i++;
                }
                
            }
        });  
        
       // setTimeout('act_pedido()',3000);
    }
    
    function calculartotal(){
        var tabla=document.getElementById('tblingreso');
        var tabla2=document.getElementById('tblegreso');
        var totalegre=0.0;
        var totalingre=0.0;
        if(tabla.rows.length>1){
           for(var i=2;i<tabla.rows.length;i++){
               var r=parseFloat(document.getElementById('tblingreso').rows[i-1].cells[4].innerText);
               totalingre=totalingre+r;
           }
         document.getElementById('ingre').value=totalingre;   
        }
        if(tabla2.rows.length>1){  
           for(var i=2;i<tabla2.rows.length;i++){
               var r=parseFloat(document.getElementById('tblegreso').rows[i-1].cells[1].innerText);
               totalegre=totalegre+r;
           }
         document.getElementById('egre').value=totalegre;   
        }
        
    }
    

</script>





