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
                        <li><a href="ventaEmp.php"><span>VENTAS</span></a></li>
                        <li><a href="productoEmp.php"><span>PRODUCTOS</span></a></li>
                        <li class="active"><a href="#"><span>CLIENTES</span></a></li>
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
<div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-8"><input class="form-control" type="text" id="buscar" onkeyup="buscar_cliente();" placeholder="BUSCAR">
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive" style="height:370px;">
                    <table class="table table-bordered table-striped table-condensed table-hover" id="datoclie">
                        <tr bgcolor=#80deea>
                            <th><label for="">COD</label></th>
                            <th><label for="">NOMBRE</label></th>
                            <th><label for="">RAZON SOCIAL</label></th>
                            <th><label for="">DNI</label></th>
                            <th><label for="">RUC</label></th>
                            <th><label for="">DIRECCION</label></th>
                            <th><label for="">TELEFONO</label></th>
                            <th><button class="btn btn-primary form-control" type="button" data-toggle="modal" data-target=".RegistrarCliente"><span class="glyphicon glyphicon-plus-sign">AGREGAR</span></button></th>
                        </tr>
                        <?php
            include "php/conexion.php";
            $cn=new conexion();
            $con=$cn->conectar();
            $consulta=mysqli_query($con,"call trae_clie()");
            
            while($row = mysqli_fetch_array($consulta)){
	        echo "
		<tr bgcolor=#e1f5fe>
			<td>".$row[0]."</td>
			<td>".$row[1]."</td>
			<td>".$row[2]."</td>
			<td>".$row[3]."</td>
            <td>".$row[4]."</td>
            <td>".$row[5]."</td>
            <td>".$row[6]."</td>";
            $row[1]=str_replace(' ','+',$row[1]);
            $row[2]=str_replace(' ','+',$row[2]);
            $row[5]=str_replace(' ','+',$row[5]);
       echo "<td><button class='btn btn-success' data-toggle='modal' data-target='.EditarCliente' onclick=view_edit('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]');><span class='glyphicon glyphicon-edit'></span>Editar</button></td>
		</tr>";  }            ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="editar" class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-lg-offset-2">
        <div id="ven_edit" class="modal fade EditarCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="gridSystemModalLabel" align="center">EDITAR CLIENTE</h3>
                    </div>
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6 col-lg-6 col-lg-offset-3">
                                <form action="Editar/editar_cliente.php" method="post">
                                    <input type="hidden" value="" name="id_cliente" id="id_cliente">
                                    <div class="form-group">
                                        <label for="nombre" class="">Nombre</label>
                                        <input class="form-control" type="text" name="n_cliente" id="n_cliente">
                                    </div>
                                    <div class="form-group">
                                        <label for="razon" class="">Razon Social</label>
                                        <input class="form-control" type="text" name="rz_cliente" id="rz_cliente">
                                    </div>
                                    <div class="form-group">
                                        <label for="dni" class="">DNI</label>
                                        <input class="form-control" type="text" name="d_cliente" id="d_cliente">
                                    </div>
                                    <div class="form-group">
                                        <label for="ruc" class="">RUC</label>
                                        <input class="form-control" type="text" name="r_cliente" id="r_cliente">
                                    </div>
                                    <div class="form-group">
                                        <label for="dire" class="">Direccion</label>
                                        <input class="form-control" type="text" name="dir_cliente" id="dir_cliente">
                                    </div>
                                    <div class="form-group">
                                        <label for="tel" class="">Telefono/Cel.</label>
                                        <input class="form-control" type="text" name="t_cliente" id="t_cliente">
                                    </div>
                                    <button class="btn btn-success form-control" type="submit" name="botonclie" id="botonclie"><span class="glyphicon glyphicon-ok-sign"></span>ACEPTAR</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="reg1" class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-lg-offset-2">
        <div id="reg2" class="modal fade RegistrarCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel" align="center">REGISTRAR CLIENTE</h4>
                    </div>
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6 col-lg-6 col-lg-offset-3">
                                <form action="php/registrar_cliente.php" method="POST">
                                   <div class="form-group">
                                      <label for="nombre" class="sr-only">Nombre</label>
                                    <input class="form-control" type="text" name="nombre" id="nombre" placeholder="NOMBRES"> 
                                   </div>
                                    <div class="form-group">
                                       <label for="razon" class="sr-only">Razon Social</label>
                                    <input class="form-control" type="text" name="razon" id="razon" placeholder="RAZNO SOCIAL"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="dni" class="sr-only">DNI</label>
                                    <input class="form-control" type="text" name="dni" id="dni" placeholder="DNI">
                                    </div>
                                    <div class="form-group">
                                       <label for="ruc" class="sr-only">RUC</label>
                                    <input class="form-control" type="text" name="ruc" id="ruc" placeholder="RUC"> 
                                    </div>
                                    <div class="form-group">
                                       <label for="dire" class="sr-only">Direccion</label>
                                    <input class="form-control" type="text" name="dire" id="dire" placeholder="DIRECCION"> 
                                    </div>
                                    <div class="form-group">
                                      <label for="tel" class="sr-only">Telefono/Cel.</label>
                                    <input class="form-control" type="text" name="tel" id="tel" placeholder="TELEFONO">  
                                    </div>
                                    <button class="btn btn-success form-control" type="submit" name="botonclie" id="botonclie" ><span class="glyphicon glyphicon-ok-sign"></span>ACEPTAR</button>
                                </form>
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
<script>
    function view_add(x) {
        document.getElementById('reg1').style.visibility = x;
    }

    function view_cerrar(x) {
        document.getElementById('editar').style.visibility = x;
    }

    function view_edit(cod, nom, rz, dni, ruc, dir, tel) {

        document.getElementById('n_cliente').value = nom.split('+').join(' ');
        document.getElementById('id_cliente').value = cod;
        document.getElementById('rz_cliente').value = rz.split('+').join(' ');
        document.getElementById('d_cliente').value = dni;
        document.getElementById('r_cliente').value = ruc.split('+').join(' ');
        document.getElementById('dir_cliente').value = dir.split('+').join(' ');
        document.getElementById('t_cliente').value = tel.split('+').join(' ');
        document.getElementById('editar').style.visibility = x;
    }

    function buscar_cliente() {
        var tableReg = document.getElementById('datoclie');
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

    var arriba;

    function subir() {
        if (document.body.scrollTop != 0 || document.documentElement.scrollTop != 0) {
            window.scrollBy(0, -15);
            arriba = setTimeout('subir()', 10);
        } else clearTimeout(arriba);
    }

</script>
