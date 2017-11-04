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
                    <form action="" class="navbar-form navbar-left" role="search">
                        <div class="form-group"> <input type="text" class="form-control" placeholder="Search"> </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <div class="row">
            <div class="container col-lg-9 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 align="center">GRAFICOS</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="thumbnail">
                                <img src="images/Galeria2/report_usu.png" alt="Reporte" style="width:100px;height:100px;">
                                <div class="caption">
                                    <h3>REPORTE USUARIOS</h3>
                                    <p>Graficos de las ventas de los usuarios.</p>
                                    <p><a href="reporte/reporte_usuario.php" target="_blank" class="btn btn-primary form-control" role="button">VER</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="thumbnail">
                                <img src="images/Galeria2/estadistica_venta.jpg" alt="VENTAS" style="width:100px;height:100px;">
                                <div class="caption">
                                    <h3>REPORTE VENTAS</h3>
                                    <p>Graficos de todas las ventas realizadas.</p>
                                    <p><a href="reporte/grafica_venta.php" target="_blank" class="btn btn-primary form-control" role="button">VER</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="thumbnail">
                                <img src="images/Galeria2/estadisticas.png" alt="BALANCE" style="width:100px;height:100px;">
                                <div class="caption">
                                    <h3>BALANCE</h3>
                                    <p>Balance de las ventas y los egresos.</p>
                                    <p><a href="reporte/reporte_balance.php" target="_blank" class="btn btn-primary form-control" role="button">VER</a></p>
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

    function editar_egreso(x, cod, des, mon) {
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
