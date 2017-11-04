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
                        <div class="logo"> <img src="images/logo.jpg" alt="" /> </div>
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1" aria-expanded="false">
                       <span class="sr-only"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-1">
                    <ul class="nav navbar-nav">
                        <li role="presentation"><a href="indexAdmin.php"><span>VENTAS</span></a></li>
                        <li role="presentation"><a href="pedidoAdmin.php"><span>PEDIDOS</span></a></li>
                        <li role="presentation"><a href="productoAdmin.php"><span>PRODUCTOS</span></a></li>
                        <li role="presentation"><a href="clienteAdmin.php"><span>CLIENTES</span></a></li>
                        <li role="presentation" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REPORTES <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="reporteAdmin.php">LISTA DE VENTAS</a></li>
                                <li><a href="reporteAdmin2.php">EGRESOS</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="reporteAdmin3.php">GRAFICOS</a></li>
                            </ul>
                        </li>
                        <li role="presentation"><a href="controlAdmin.php"><span>CONTROL</span></a></li>
                        <li><a href="index.php">CERRAR SESION</a></li>
                    </ul>
                    <form action="" class="navbar-form navabar-left" role="search">
                        <div class="form-group"> <input type="text" class="form-control" placeholder="Search"> </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <div class="row">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4 align="center">AGREGAR EGRESO</h4>
                    </div>
                    <div class="panel-body">
                        <form action="egreso/egreso.php" method="post">
                            <div class="form-group">
                                <label for="descr" class="sr-only">Descripcion</label>
                            <input class="form-control" type="text" name="descr" id="descr" required placeholder="DESCRIPCION">
                            </div>
                            <div class="form-group">
                                <label for="mon" class="sr-only">Monto</label>
                            <input class="form-control" type="text" name="mon" id="mon" required placeholder="MONTO">
                            </div>
                            <butto class="btn btn-success form-control"><span class="glyphicon glyphicon-ok-circle"> ACEPTAR</span></butto>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <label for="">LISTA DE EGRESOS</label>
                    </div>
                    <div class="panel-body">
                       <div class="table-responsive" style="height:360px;">
                        <table id="tblegreso" class="table table-condensed table-hover table-bordered table-striped">
                            <tr>
                                <td><label for="">COD</label></td>
                                <td><label for="">DESCRIPCION</label></td>
                                <td><label for="">MONTO</label></td>
                                <td><label for="">FECHA</label></td>
                                <td></td>
                            </tr>
                            <?php
                    include "php/conexion.php";
                     $cn=new conexion();
                     $con=$cn->conectar();
                  $contador=1;
                $consulta1=mysqli_query($con,"select *from egreso order by id_egreso desc limit 150")or die(mysqli_error());
                while($row1 = mysqli_fetch_array($consulta1)){ 
	                 echo " 
		             <tr>
		            	<td>".$row1[0]."</td> 
		            	<td style='width:130px'>".$row1[1]."</td>
		            	<td>".$row1[2]."</td>
		            	<td>".$row1[3]."</td>";
                        $row1[1]=str_replace(" ","+",$row1[1]);
                   echo"<td><button type='button' class='btn btn-success form-control' data-toggle='modal' data-target='.EditarEgreso'             onclick=javascript:editar_egreso('$row1[0]','$row1[1]','$row1[2]');><span class='glyphicon glyphicon-edit'></span></button></td>";       
                          $contador++; 
                         }            
                        ?>
                        </table>
                    </div>
                </div>
            </div>
            </div>
                
        </div>
    </div>

    <div id="ediegre" class="modal fade EditarEgreso" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div id="ediegre2" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="CERRAR"><span aria-hidden="true">&times;</span></button>
                    <h3 align="center" class="modal-title">EDITAR EGRESO</h3>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title" align="center">DETALLES</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3">
                            <form action="Editar/editar_egreso.php" method="post">
                                <input type="hidden" value="" name="idegre" id="idegre">
                                <div class="form-group">
                                    <label for="codventa" class="sr-only">DESCRIPCION</label>
                                    <input class="form-control" type="text" name="descripcion" id="descripcion" required placeholder="DESCRIPCION">
                                </div>
                                <div class="form-group">
                                    <label for="cliente" class="sr-only">MONTO</label>
                                    <input class="form-control" type="text" name="monto" id="monto" required placeholder="MONTO A PAGAR">
                                </div>
                                <button class="btn btn-success form-control" type="submit"><span class="glyphicon glyphicon-ok-sign"></span> ACEPTAR</button>
                            </form>
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
                    <a class="link" rel="nofollow" href="https://www.facebook.com/InnovatioCoorp/" target="_blank">Sitio Web diseñado por Innovatio Coorporation </a>
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
    function pago(x) {
        document.getElementById("pago").style.visibility = x;

    }

    function editar_egreso(cod, des, mon) {
        document.getElementById("ediegre").style.visibility = x;
        document.getElementById("idegre").value = cod;
        document.getElementById("descripcion").value = des.split("+").join(" ");
        document.getElementById("monto").value = mon;

    }

    function pago1(x, cod, cli, pag, t, idc) {
        document.getElementById("pago").style.visibility = x;
        document.getElementById('codventa').value = cod;
        document.getElementById('cliente').value = cli.split('+').join(' ');
        var deuda = t - pag;
        document.getElementById('deuda').value = deuda.toFixed(2);
        document.getElementById('idclie').value = idc;
        document.getElementById('pagado').value = pag;
        document.getElementById('monto_total').value = t;
    }

</script>
