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
                    <a href="#" class="navbar-brand">
                        <div class="logo"><img src="images/logo.jpg" alt=""></div>
                    </a>
                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapsed" data-target="#navbar-1" aria-expanded="false">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapsed navbar-collapsed" id="navbar-1">
                    <ul class="nav navbar-nav">
                        <li><a href="ventaEmp.php"><span>VENTAS</span></a></li>
                        <li class="active"><a href="#"><span>PRODUCTOS</span></a></li>
                        <li><a href="clienteEmp.php"><span>CLIENTES</span></a></li>
                        <li><a href="index.php">CERRAR SESION</a></li>
                    </ul>
                    <form action="" class="navbar-form navbar-left" role="search">
                        <div class="form-group"> <input type="text" class="form-control" placeholder="Search"> </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <br>

     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4"><input class="form-control" type="text" id="buscar" onkeyup="buscar_producto();" placeholder="BUSCAR"></div>
                    <div class="col-lg-2 "><input class="form-control" type="text" id="fil_dat" name="fil_dat" onkeyup="mostrarLow();" placeholder="FILTRO STOCK"></div>
                    <div class="col-lg-2"><button type="button" class="btn btn-info form-control" onclick="show_dtl();"><span class="glyphicon glyphicon-print"></span> IMPRIMIR</button></div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive" style="height:370px;">
                    <table class="table table-striped table-bordered table-hover table-condensed" id="datopro">
                       <thead>
                           <tr class="success">
                            <th><label for="">COD</label></th>
                            <th><label for="">NOMBRE</label></th>
                            <th><label for="">DESCRIPCION</label></th>
                            <th><label for="">MARCA</label></th>
                            <th><label for="">P. U.</label></th>
                            <th><label for="">PRECIOS</label></th>
                            <th><label for="">STOCK</label></th>
                            <th colspan="2" align="center"><button class="btn btn-success form-control" data-toggle="modal" data-target=".RegistrarProducto"><span class="glyphicon glyphicon-plus-sign"> AGREGAR</span></button></th>
                        </tr>
                       </thead>
                        <tbody>
                           <?php 
            include "php/conexion.php";
            $cn=new conexion();
            $con=$cn->conectar();
            $consulta=mysqli_query($con,"select *from producto order by id_pro desc");
            
            while($row = mysqli_fetch_array($consulta)){
            $color='blue';
            if($row[7]<10){
                $color='red';
            }else{$color='green';}
	        echo "
		<tr bgcolor=#e1f5fe>
			<td>".$row[0]."</td>
			<td>".$row[1]."</td>
			<td>".$row[2]."</td>
			<td>".$row[3]."</td> 
            <td>".$row[5]."</td> 
            <td>".$row[6]."</td>
            <td style='color:$color'>".$row[7]."</td> ";
            $row[1]=str_replace(' ', '+', $row[1]);
            $row[2]=str_replace(' ','+',$row[2]); 
            $row[3]=str_replace(' ','+',$row[3]);
            $row[10]=str_replace(' ','+',$row[10]);
            $row[11]=str_replace(' ','+',$row[11]);
        echo "    <td><a type='button' class='btn btn-success' data-toggle='tooltip' data-placement='top' title='VER ALMACEN' target='_blank' href='ver_almacen.php?valor_id=$row[0]&tipoprod=$row[9]&op=0' ><span class='glyphicon glyphicon-list'></span></a></td>";
        echo"<td><button class='btn btn-success' rel='tooltip' data-placement='top' title='EDITAR PRODUCTO' onclick=add_act('$row[1]','$row[2]','$row[3]','$row[7]','$row[0]','$row[9]','$row[10]','$row[11]','$row[5]'); data-toggle='modal' data-target='.EditarProducto'><span class='glyphicon glyphicon-edit'></span></button></td>
        </tr>";
                       } 
            
            ?> 
                        </tbody>
                        <tfoot>
                            <tr class="success">
                            <th><label for="">COD</label></th>
                            <th><label for="">NOMBRE</label></th>
                            <th><label for="">DESCRIPCION</label></th>
                            <th><label for="">MARCA</label></th>
                            <th><label for="">P. U.</label></th>
                            <th><label for="">PRECIOS</label></th>
                            <th><label for="">STOCK</label></th>
                            <th colspan="4" align="center"><button class="btn btn-success form-control" data-toggle="modal" data-target=".RegistrarProducto"><span class="glyphicon glyphicon-plus-sign"> AGREGAR</span></button></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="actualizar" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div id="ven_act" class="modal fade EditarProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel" align="center">EDITAR</h4>
                    </div>
                    <br>
                    <div class="row container">
                        <div class="col-xs-5 col-sm-5 col-md-4 col-lg-4 col-lg-offset-1">
                           <div class="panel panel-success">
                               <div class="panel-heading">
                                   <h5 class="panel-title">PRODUCTO</h5>
                               </div>
                               <div class="panel-body">
                                   <form action="Editar/editar_producto.php" method="post" class="form-inline">
                                    <input type="hidden" value="" name="id_producto" id="id_producto">
                                    <input type="hidden" value="" name="t_producto" id="t_producto">
                                       <div class="form-group">
                                           <label for="nombre" style="width:100px">Nombre</label>
                                           <input class="form-control" type="text" name="n_producto" id="n_producto">
                                       </div> 
                                       <div class="form-group">
                                           <label for="desc" style="width:100px">Descripcion</label>
                                          <input class="form-control" type="text" name="d_producto" id="d_producto">
                                       </div>
                                       <div class="form-group">
                                           <label for="marca" style="width:100px">Marca</label>
                                           <input class="form-control" type="text" name="m_producto" id="m_producto" >
                                       </div>
                                       <div class="form-group">
                                           <label for="cant" style="width:100px">Stock</label>
                                           <input class="form-control" type="text" name="s_producto" id="s_producto" >
                                       </div>
                                       <div class="form-group">
                                         <label for="pbl" style="width:100px">P. Variado</label>
                                         <input class="form-control" type="text" name="pbvariado" id="pbvariado">   
                                       </div>
                                       <div class="form-group">
                                           <label for="guia" style="width:100px">Guia Remision</label>
                                           <input class="form-control" type="text" name="g_producto" id="g_producto">
                                       </div>
                                       <div class="form-group">
                                           <label for="nomprove" style="width:100px">N. Proveedor</label>
                                           <input class="form-control" type="text" name="np_producto" id="np_producto">
                                       </div>
                                       <button class="btn-block btn btn-primary" type="submit" name="botonpro" id="botonpro"><span class="glyphicon glyphicon-ok-sign"></span> GUARDAR</button>
                                   </form>
                                   
                               </div>
                           </div>
                            
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-4 col-lg-4">
                           <div class="panel panel-success">
                               <div class="panel-heading">
                                   <h5 class="panel-title" align="center">STOCK</h5>
                               </div>
                               <div class="panel-body">
                                   <form action="Editar/act_stock.php" method="post" class="form-inline">
                                       <input type="hidden" name="iddp" id="iddp" value="">
                                        <div class="form-group">
                                            <label for="" style="width:100px">Producto</label>
                                            <input class="form-control" type="text" name="nnp" id="nnp" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="width:100px">Stock Actual</label>
                                            <input class="form-control" type="text" name="sttp" id="sttp" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="width:100px">Agregar o Quitar</label>
                                            <input class="form-control" type="text" name="ctta" id="ctta" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="width:100px">Guia Remision</label>
                                            <input class="form-control" type="text" name="giir" id="giir"  required>
                                        </div>
                                       <div class="form-group">
                                           <label for="" style="width:100px">Proveedor</label>
                                           <input class="form-control" type="text" name="prr" id="prr">
                                       </div>
                                       <button class="btn-block btn btn-primary" type="submit" name="botonproedit" id="botonproedit"><span class="glyphicon glyphicon-ok-sign"></span> GUARDAR</button>
                                </form>
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="reggen" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div id="inreggen" class="modal fade RegistrarProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel" align="center">REGISTRAR PRODUCTO</h4>
                    </div>
                    
                    <div class="panel panel-success container-fluid">
                        <div class="panel-body">
                           <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6 col-lg-6 col-lg-offset-3">
                            <form action="php/registrar_productos.php" method="POST">
                                <div class="form-group">
                                    <label for="nombre" class="sr-only">Nombre</label>
                                    <input class="form-control" type="text" name="nombre" id="nombre" required placeholder="NOMBRE PRODUCTO">
                                </div>
                                <div class="form-group">
                                    <label for="desc" class="sr-only">Descripcion</label>
                                    <input class="form-control" type="text" name="desc" id="desc" required placeholder="DESCRIPCION">
                                </div>
                                <div class="form-group">
                                    <label for="marca" class="sr-only">Marca</label>
                                    <input class="form-control" type="text" name="marca" id="marca" size="15" required placeholder="MARCA">
                                </div>
                                <div class="form-group">
                                    <label for="tamanio" class="sr-only">Tamaño</label>
                                    <input class="form-control" type="text" name="tamanio" id="tamanio" size="10" placeholder="TAMAÑO">
                                </div>
                                <div class="form-group">
                                    <label for="cant" class="sr-only">Cantidad</label>
                                    <input class="form-control" type="text" name="cant" id="cant" size="5" required placeholder="CANTIDAD MAX.99unid">
                                </div>
                                <div class="form-group">
                                    <label for="pc" class="sr-only">P. Compra</label>
                                    <input class="form-control" type="text" name="pc" id="pc" size="5" required placeholder="PRECIO DE COMPRA">
                                </div>
                                <div class="form-group">
                                    <label for="pv" class="sr-only">P. Venta</label>
                                    <input class="form-control" type="text" name="pv" id="pv" size="5" required placeholder="PRECIO DE VENTA">
                                </div>
                                <div class="form-group">
                                    <label for="pbl" class="sr-only">P. Variado</label>
                                    <input class="form-control" type="text" name="pbl" id="pbl" size="20" placeholder="PRECIO VARIADO">
                                </div>
                                <div class="form-group">
                                    <label for="guia" class="sr-only">Guia Remision</label>
                                    <input class="form-control" type="text" name="guia" id="guia" size="10" required placeholder="GUIA DE REMISION">
                                </div>
                                <div class="form-group">
                                    <label for="nomprove" class="sr-only">N. Proveedor</label>
                                    <input class="form-control" type="text" name="nomprove" id="nomprove" placeholder="NOMBRE PROVEEDOR">
                                </div>
                                <div class="form-group">
                                    <label for="" class="sr-only">U. Medida</label>
                                    <select name="medidas" id="medidas" class="form-control">
                                         <option value="Metro">Tipo de Medida</option>
                                         <option value="Metro">Metro</option>
                                         <option value="Metro cuadrado">Pie Cuadrado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="radio1"><input type="radio" name="radio" id="radio" value="ESPECIAL">ESPECIAL</label>
                                    <label for="radio2"><input type="radio" name="radio" id="radio" value="NORMAL">NORMAL</label>
                                </div>
                                <button name="botonpro" class="btn btn-success form-control" id="botonpro"><span class="glyphicon glyphicon-ok-sign"></span> GUARDAR</button>
                            </form>
                        </div>
                    </div>
                    </div>
                    <!--
                    <table class="dgenpre">
                        <tr>
                            <td><label for="pcm">P. Compra</label></td>
                            <td><input type="text" size="10" id="pcm" onkeyup="desc();caligv();calflete();
                calgan();calcan();"></td>
                        </tr>
                        <tr>
                            <td><label for="descu">Descuento</label></td>
                            <td><input type="text" size="10" id="descu" onkeyup="desc();caligv();calflete();
                calgan();calcan();"></td>
                            <td><input type="text" size="5" id="d"></td>
                        </tr>
                        <tr>
                            <td><label for="igv">IGV</label></td>
                            <td><input type="text" size="10" id="igv" onkeyup="caligv();calflete();
                calgan();calcan();"></td>
                            <td><input type="text" size="5" id="i"></td>
                        </tr>
                        <tr>
                            <td><label for="flete">Flete</label></td>
                            <td><input type="text" size="10" id="flete" onkeyup="calflete();
                calgan();calcan();"></td>
                            <td><input type="text" size="5" id="f"></td>
                        </tr>
                        <tr>
                            <td><label for="gan">Ganancia</label></td>
                            <td><input type="text" size="10" id="gan" onkeyup="calgan();calcan();"></td>
                            <td><input type="text" size="5" id="g"></td>
                        </tr>
                        <tr>
                            <td><label for="cant">Cantidad</label></td>
                            <td><input type="text" size="10" id="canti" onkeyup="calcan()"></td>
                        </tr>
                        <tr>
                            <td><label for="ppu">P. Unidad</label></td>
                            <td><input type="text" size="10" id="ppu"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><button class="btG" onclick="send()">ENVIAR</button></td>
                        </tr>
                    </table> -->

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



<script>
    function desc() {
        var pc = parseFloat(document.getElementById('pcm').value);
        var dc = parseFloat(document.getElementById('descu').value);
        var td = (pc * dc) / 100;
        var tt = pc - td;
        var fin = tt.toFixed(2);
        if (isNaN(td)) {
            document.getElementById('d').value = '';
        } else {
            document.getElementById('d').value = fin;
        }
    }

    function caligv() {
        var d = parseFloat(document.getElementById('d').value);
        var igv = parseFloat(document.getElementById('igv').value);
        var td = (d * igv) / 100;
        var tt = d + td;
        var fin = tt.toFixed(2);
        if (isNaN(td)) {
            document.getElementById('i').value = '';
        } else {
            document.getElementById('i').value = fin;
        }
    }

    function calflete() {
        var f = parseFloat(document.getElementById('flete').value);
        var i = parseFloat(document.getElementById('i').value);
        var td = (f * i) / 100;
        var tt = i + td;
        var fin = tt.toFixed(2);
        if (isNaN(td)) {
            document.getElementById('f').value = '';
        } else {
            document.getElementById('f').value = fin;
        }
    }

    function calgan() {
        var g = parseFloat(document.getElementById('gan').value);
        var f = parseFloat(document.getElementById('f').value);
        var td = (g * f) / 100;
        var tt = f + td;
        var fin = tt.toFixed(2);
        if (isNaN(td)) {
            document.getElementById('g').value = '';
        } else {
            document.getElementById('g').value = fin;
        }
    }

    function calcan() {
        var g = parseFloat(document.getElementById('g').value);
        var c = parseInt(document.getElementById('canti').value);
        var td = g / c;
        var tt = td.toFixed(2);
        if (isNaN(td)) {
            document.getElementById('ppu').value = '';
        } else {
            document.getElementById('ppu').value = tt;
        }

    }

    function send() {
        var cantid = parseInt(document.getElementById('canti').value);
        var pc = parseFloat(document.getElementById('pcm').value);
        var pu = document.getElementById('ppu').value;
        var tt = pc / cantid;
        if (isNaN(pc)) {
            alert('CAMPOS VACIOS');
        } else {

            document.getElementById('pc').value = tt;
            document.getElementById('pv').value = pu;
        }


    }

    function buscar_producto() {
        var tableReg = document.getElementById('datopro');
        var searchText = document.getElementById('buscar').value.toLowerCase();
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

    function view_add(x) {
        document.getElementById('reggen').style.visibility = x;
    }

    function view_act(x) {
        document.getElementById('actualizar').style.visibility = x;
    }

    function add_act(x, nombre, desc, marca, s, id, tipo, rem, prov) {
        document.getElementById('n_producto').value = nombre.split('+').join(' ');
        document.getElementById('d_producto').value = desc.split('+').join(' ');
        document.getElementById('m_producto').value = marca.split('+').join(' ');
        document.getElementById('s_producto').value = s;
        document.getElementById('id_producto').value = id;
        document.getElementById('t_producto').value = tipo;
        document.getElementById('g_producto').value = rem.split('+').join(' ');
        document.getElementById('np_producto').value = prov.split('+').join(' ');
        document.getElementById('actualizar').style.visibility = x;
    }

    function mensaje(c, id, tipo) {
        if (c >= 1) {
            var opc = confirm("Esta seguro de eliminar este producto? aun quedan: " + c + " en stock.");
            if (opc) {
                window.location = "elimina/elim_producto.php?idproducto=" + id + "&tipo=" + tipo + "&cantidad=" + c;
            }

        }
        if (c == 0) {
            window.location = "elimina/elim_producto.php?idproducto=" + id + "&tipo=" + tipo + "&cantidad=" + c;
        }
    }

    var arriba;

    function subir() {
        if (document.body.scrollTop != 0 || document.documentElement.scrollTop != 0) {
            window.scrollBy(0, -15);
            arriba = setTimeout('subir()', 10);
        } else clearTimeout(arriba);
    }

    function mostrarLow() {
        var tableReg = document.getElementById('datopro');
        var searchText = parseInt(document.getElementById('fil_dat').value);
        if (isNaN(searchText)) {
            searchText = 10000000;
        }

        var cellsOfRow = "";
        var found = false;
        var compareWith = "";
        for (var i = 1; i < tableReg.rows.length; i++) {
            cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
            found = false;


            compareWith = cellsOfRow[6].innerHTML.toLowerCase();
            if (searchText.length == 0 || (compareWith < searchText)) {
                found = true;
            }

            if (found) {
                tableReg.rows[i].style.display = '';
            } else {
                tableReg.rows[i].style.display = 'none';
            }
        }
    }
    function show_dtl() {
        window.open("php/VerDetalles.php", 'IMPRIMIR', 'width=1200,height=770,scrollbars=SI');
    }

</script>
