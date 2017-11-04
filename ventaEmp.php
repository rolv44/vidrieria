<?php 
session_start();
if(is_null($u=$_SESSION['usuario']) && is_null($c=$_SESSION['contrasena']) && !$_SESSION['val']==1){
   header("Location:index.php");
   
}
 ?>

<!DOCTYPE html PUBLIC "InnovatioCoorp">
<html xmlns="Cesar O'Higgins" xml:lang="en" lang="en">

<head>
    <title>Yashimitsu - Vidrieria</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <link href="estilos/layout.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>
    <script src="js/cufon-yui.js" type="text/javascript"></script>
    <script src="js/cufon-replace.js" type="text/javascript"></script>
    <script src="js/Myriad_Pro_400.font.js" type="text/javascript"></script>
    <script src="js/Myriad_Pro_600.font.js" type="text/javascript"></script>
</head>

<body id="page1">
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand"><div class="logo"><img src="images/logo.jpg" alt=""></div></a>
                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapsed" data-target="#navbar-1" aria-expanded="false">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapsed navbar-collapsed" id="navbar-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#"><span>VENTAS</span></a></li>
                        <li><a href="productoEmp.php"><span>PRODUCTOS</span></a></li>
                        <li><a href="clienteEmp.php"><span>CLIENTES</span></a></li>
                        <li><a href="index.php">CERRAR SESION</a></li>
                    </ul>
                    <form action="" class="navbar-form navbar-left" role="search">
                        <div class="form-group"> <input type="text" class="form-control" placeholder="Search">  </div>
                    </form>
                </div>    
            </div>
        </nav>
    </header>
    <br>
    <br>
    <br>    
       <div class="container-fluid">
        <section class="main row">
            <div class="carrito">

                <div class="form container col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <form action="php/metodo_listaCarro.php?tipoproducto=NORMAL" method="POST" class="panel panel-default">
                        <input type="hidden" value="" id="idpr" name="idpr">
                        <input type="hidden" value="" id="descripcion" name="descripcion">
                        <input type="hidden" value="" id="preuni" name="preuni">
                        <input type="hidden" value="" id="preblo" name="preblo">
                        <input type="hidden" value="" id="prostock" name="prostock">
                        <input type="hidden" value="" id="guiarem" name="guiarem">
                        <input type="hidden" value="" id="nomproveedor" name="nomproveedor">
                        <input type="hidden" value="" id="fechareg" name="fechareg">
                        <div class="panel-heading"><label for="">AGREGAR PRODUCTOS</label></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="sr-only" for="">Nombre Producto</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="pnom" name="pnom" placeholder="Nombre del producto" style="width:200px;" required>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".Producto" onclick="LlenarTablaProducto()"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="">Cantidad</label>
                                <input class="form-control" type="number" id="numberprod" name="numberprod" style="width:100px" placeholder="Cantidad" required>
                            </div>
                            <button type="submit" id="btnagrega" class="btn-block btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> AGREGAR</button>
                        </div>
                    </form>
                </div>

                <div id="serv" class="form container col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <form action="php/metodo_listaCarro.php?tipoproducto=SERVICIO" method="post" class="panel panel-default">
                        <div class="panel-heading"><label for="">SERVICIOS</label></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="sr-only" for="">Descripcion</label>
                                <input class="form-control" type="text" size="30" id="descripcion" name="descripcion" placeholder="Descripcion" required>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="">Monto</label>
                                <input class="form-control" type="text" size="10" id="monto" style="width:100px;" name="monto" placeholder="Monto" required>
                            </div>
                            <button type="submit" class="btn btn-primary form-control"><span class="glyphicon glyphicon-plus-sign"></span>AGREGAR</button>
                        </div>
                    </form>
                </div>


                <aside class="carro_com container col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="panel panel-success">
                        <div class="table-responsive">
                            <div class="panel-heading">
                                <h4 align="center" class="panel-title">CARRITO DE COMPRAS</h4>
                            </div>
                            <div class="panel-body">
                               <div class="table-responsive" style="height:330px;"  >
                                <table id="tblcarro" class="table table-striped table-bordered table-hover table-condensed">
                                    <tr class="info">
                                        <th><label for="">CANT.</label></th>
                                        <th style="width:150px"><label for="">NOMBRE</label></th>
                                        <th style="width:245px"><label for="">DESCRIPCION</label></th>
                                        <th><label for="">P/U</label></th>
                                        <th><label for="">P/B</label></th>
                                        <th><label for="">TAMAÑO</label></th>
                                        <th><label for="">TOTAL</label></th>
                                    </tr>
                                    <?php
            include "php/conexion.php";
            $cn=new conexion();
            $con=$cn->conectar();
            $contador=1;
            $idc=$_SESSION['idcarrito'];
            if($idc>0){
                $total=0;
                $consulta=mysqli_query($con,"call trae_carrito($idc)");
                while($row = mysqli_fetch_array($consulta)){ 
             $total=$total+$row[13];
	        echo " 
		<tr bgcolor=#e1f5fe>
			<td>".$row[3]."</td> 
			<td>".$row[2]."</td>
			<td>".$row[7]."</td>
			<td>".$row[8]."</td>
            <td>".$row[9]."</td>
            <td>".$row[6]."</td>
            <td>".$row[13]."</td>";
            $row[7]=str_replace(' ','+',$row[7]);     
        echo"<td><a href='elimina/elim_carrito.php?idcarro=$row[0]&idprod=$row[1]&cant=$row[3]&tam=$row[6]&tipo=$row[5]&codstock=$row[4]&descr=$row[7]&mon=$row[8]'>Eliminar</a></td>
		</tr>";   
              $contador++;  
             }
            echo "<tr>
            <td colspan='7' align='right'><input type='text' value='$total' size='2' disabled id='c_total'></td>
            </tr>";  
            
            }
            ?>
                                </table>
                                </div>
                                <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target=".Vender"><span class="glyphicon glyphicon-check"></span> REALIZAR VENTA</button>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

        </section>
    </div>

       
       
        <div class="venta col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="modal fade Vender " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">REGISTRAR PEDIDO</h4>
                </div>
                <div class="panel panel-info">
                    <form action="pedido/pedidoEmp.php" method="post" class="container-fluid">
                        <input type="hidden" name="idcliente" id="idcliente">
                        <input type="hidden" name="descontado" id="descontado">
                        <br>
                        <div class="panle-body">
                            <div class="form-group">
                                <label class="sr-only" for="dtlist">COMPROBANTE</label>
                                <div class="input-group">
                                    <input class="form-control" list="dtlis" name="dtlist" id="dtlist" style="width:250px;" required placeholder="Tipo de Comprobante">
                                    <datalist id="dtlis">
                                         <option value="FACTURA"></option>
                                         <option value="BOLETA"></option>
                                     </datalist>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="cnom">Cliente</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="cnom" id="cnom" style="width:250px;" onclick="comp_clie();" autocomplete="off" required placeholder="Nombre Cliente">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".BuscarCliente" onclick="LlenarTabla();"><span class="glyphicon glyphicon-list-alt"></span> CARGAR TABLA</button>
                                    <input class="form-control" type="text" id="InputCliente" onkeyup="javascript:buscar('InputCliente','TablaCliente');" placeholder="BUSCAR CLIENTE" style="width:250px;">
                                </div>
                                <div class="table-responsive" style="height:200px;">
                                    <table id="TablaCliente" class="table table-striped table-bordered table-hover">
                                        <tr class="info">
                                            <th><label for="">ID</label></th>
                                            <th><label for="">NOMBRE</label></th>
                                            <th><label for="">RAZON SOCIAL</label></th>
                                            <th><label for="">DNI</label></th>
                                            <th><label for="">RUC</label></th>
                                            <th><label for="">DIRECCION</label></th>
                                            <th><label for="">TELEFONO</label></th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="form-group"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok"></span> ENVIAR</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <div id="vemer2" class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
    <div id="busprod" class="modal fade Producto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="CERRAR"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">BUSCAR PRODUCTO</h4>
                   
                </div>
                <div class="b">
                </div>
                <div class="panel panel-info container-fluid">
                    <div class="table-responsive" style="height:500px;">
                        <div class="panel-heading">
                               <input type="text" id="bprodu" onkeyup="javascript:buscar('bprodu','tbl2');" >
                        </div>
                        <div class="panel-body">
                            <table id="tbl2" class="table table-striped table-bordered table-condensed table-hover">
                                <tr class="info">
                                    <th><label for="">ID</label></th>
                                    <th><label for="">NOMBRE</label></th>
                                    <th><label for="">DESCRIPCION</label></th>
                                    <th><label for="">MARCA</label></th>
                                    <th><label for="">P. U.</label></th>
                                    <th><label for="">P. B.</label></th>
                                    <th><label for="">STOCK</label></th>
                                    <th><label for="">TIPO</label></th>
                                    <th><label for="">G-REM.</label></th>
                                    <th><label for="">PROVEEDOR</label></th>
                                    <th><label for="">FECHA REG.</label></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


       <div class="navbar navbar-inverse navbar-fixed-bottom">
           <footer>
               <center>
                   <div class="container">
                       <a href="https://www.facebook.com/InnovatioCoorp/" rel="nofollow" target="_blank" class="link">Sitio Web diseñado por Innovatio Coorporation </a>
                       <h4>INNOVATIO CORPORATION</h4>
                   </div>
               </center>
           </footer>
       </div>
        
    <script type="text/javascript">
        Cufon.now();

    </script>
</body>

</html>

<script type="text/javascript">
    function cliente(_param) {
        document.getElementById("bcliente").style.visibility = _param;

    }

    function producto(_param) {
        document.getElementById("vemer2").style.visibility = _param;

    }

    function stock(_param) {
        document.getElementById("vemer3").style.visibility = _param;

    }

    function getdato(x) {


       var n = document.getElementById("TablaCliente").rows[x].cells[1].innerText;
       var rzsc = document.getElementById("TablaCliente").rows[x].cells[2].innerText;
       var i = document.getElementById("TablaCliente").rows[x].cells[0].innerText;

       document.getElementById("idcliente").value = i;
       if (n.length < 1) {
           document.getElementById("cnom").value = rzsc;
       } else {
           document.getElementById("cnom").value = n;
       }
   }

    function getdatoprod(x) {

        var n = document.getElementById("tbl2").rows[x].cells[1].innerText;
        var mx = document.getElementById("tbl2").rows[x].cells[6].innerText;
        var idt = document.getElementById("tbl2").rows[x].cells[0].innerText;
        var descri = document.getElementById("tbl2").rows[x].cells[2].innerText;
        var puni = document.getElementById("tbl2").rows[x].cells[4].innerText;
        var pblo = document.getElementById("tbl2").rows[x].cells[5].innerText;
        var guia = document.getElementById("tbl2").rows[x].cells[8].innerText;
        var provee = document.getElementById("tbl2").rows[x].cells[9].innerText;
        var fechareg = document.getElementById("tbl2").rows[x].cells[10].innerText;

        document.getElementById("pnom").value = n;
        document.getElementById("numberprod").setAttribute("max", mx);
        document.getElementById("numberprod").setAttribute("min", 1);
        document.getElementById("numberprod").setAttribute("placeholder", "Stock: " + mx);
        document.getElementById("idpr").value = idt;

        document.getElementById("descripcion").value = descri;
        document.getElementById("preuni").value = puni;
        document.getElementById("preblo").value = pblo;
        document.getElementById("prostock").value = mx;
        document.getElementById("guiarem").value = guia;
        document.getElementById("nomproveedor").value = provee;
        document.getElementById("fechareg").value = fechareg;
    }

    function recargar() {
        window.location.reload(true);
    }

    function buscar(text, tabla) {
        var tableReg = document.getElementById(tabla);
        var searchText = document.getElementById(text).value.toLowerCase();
        var cellsOfRow = "";
        var found = false;
        var compareWith = "";

        // Recorremos todas las filas con contenido de la tabla
        for (var i = 1; i < tableReg.rows.length; i++) {
            cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
            found = false;
            // Recorremos todas las celdas
            for (var j = 0; j < cellsOfRow.length && !found; j++) {
                compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                // Buscamos el texto en el contenido de la celda
                if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                    found = true;
                }
            }
            if (found) {
                tableReg.rows[i].style.display = '';
            } else {
                // si no ha encontrado ninguna coincidencia, esconde la
                // fila de la tabla
                tableReg.rows[i].style.display = 'none';
            }
        }

    }

       function LlenarTabla() {

       $.ajax({
           type: 'POST',
           url: 'php/datosCliente_ajax.php',
           dataType: 'json',
           success: function (pedido) {

               var valor = eval(pedido);
               var cont = 0;

               for (var i in valor) {
                   cont++;
               }
               var tabla = document.getElementById('TablaCliente');
               var i;
               for (i = 0; i <= cont; i++) {
                   var fila = tabla.insertRow(i + 1);
                   fila.insertCell(0).innerHTML = valor[i].ID;
                   fila.insertCell(1).innerHTML = valor[i].NOMBRE;
                   fila.insertCell(2).innerHTML = valor[i].RAZON_SOCIAL;
                   fila.insertCell(3).innerHTML = valor[i].DNI;
                   fila.insertCell(4).innerHTML = valor[i].RUC;
                   fila.insertCell(5).innerHTML = valor[i].DIRECCION;
                   fila.insertCell(6).innerHTML = valor[i].TELEFONO;
                   var s = i + 1;
                   fila.insertCell(7).innerHTML = "<button type='button' class='btn btn-info' onclick=script:getdato('" + s + "')><span class='glyphicon glyphicon-ok-circle'></span></button>";
               }
           },
           error: function (xhr, ajaxOptions, thrownError) {
               alert("Error!!!");
           }
       });
   }

       function LlenarTablaProducto() {

       $.ajax({
           type: 'POST',
           url: 'php/datosProducto_ajax.php',
           dataType: 'json',
           success: function (pedido) {

               var valor = eval(pedido);
               var cont = 0;

               for (var i in valor) {
                   cont++;
               }
               var tabla = document.getElementById('tbl2');
               var i;
               for (i = 0; i <= cont; i++) {
                   var fila = tabla.insertRow(i + 1);
                   fila.insertCell(0).innerHTML = valor[i].ID;
                   fila.insertCell(1).innerHTML = valor[i].NOMBRE;
                   fila.insertCell(2).innerHTML = valor[i].DESCRIPCION;
                   fila.insertCell(3).innerHTML = valor[i].MARCA;
                   fila.insertCell(4).innerHTML = valor[i].P_U;
                   fila.insertCell(5).innerHTML = valor[i].P_B;
                   fila.insertCell(6).innerHTML = valor[i].STOCK;
                   fila.insertCell(7).innerHTML = valor[i].TIPO;
                   fila.insertCell(8).innerHTML = valor[i].G_R;
                   fila.insertCell(9).innerHTML = valor[i].PROVEEDOR;
                   fila.insertCell(10).innerHTML = valor[i].FECHA;
                   var s = i + 1;
                   if (valor[i].TIPO == "ESPECIAL") {
                       fila.insertCell(11).innerHTML = "<td><a type='button' class='btn btn-info' href='ver_almacen.php?valor_id=" + valor[i].ID + "&tipoprod=" + valor[i].TIPO + "&op=1'><span class='glyphicon glyphicon-ok-circle'></span>VER</a></td>"
                   }
                   if (valor[i].TIPO == "NORMAL") {
                       fila.insertCell(11).innerHTML = "<button data-dismiss='modal' type='button' class='btn btn-info' onclick=script:getdatoprod('" + s + "')><span class='glyphicon glyphicon-ok-circle'></span></button>";
                   }
               }
           },
           error: function (xhr, ajaxOptions, thrownError) {
               alert("Error!!!");
           }
       });
   }
    
    function comp_clie() {
        var tipo = document.getElementById('dtlist').value;
        if (tipo == "BOLETA") {

        }
        if (tipo == "FACTURA") {
            alert("Seleccione un cliente del buscador para realizar factura");
        }
        if (tipo == "") {
            alert("Seleccione un tipo de comprobante antes");
        }
    }

</script>
