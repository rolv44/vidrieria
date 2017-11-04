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
    <link href="estilos/ventastyle.css" rel="stylesheet" type="text/css" />
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

<body id="page1" onload="setInterval('act_pedido()',3000)">

    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid barra">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">
                        <div class="logo">
                            <img src="images/logo.jpg" alt="" />
                        </div>
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
                        <li role="presentation" class="active"><a href="" ><span>PEDIDOS</span></a></li>
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
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <br>
    <div class="container-fluid">
        <section class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2" id="pedidos">
                <div class="panel panel-default">
                    <form action="" method="post">
                        <div class="table-responsive">
                            <div class="panel-heading">
                                <h4 align="center">PEDIDOS</h4>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" >
                                    <table id="tbl" class="table table-striped table-bordered table-hover table-condensed">
                                        <tr class="info">
                                            <th><label for="">COD</label></th>
                                            <th><label for="">EMPLEADO</label></th>
                                            <th><label for="">CLIENTE</label></th>
                                            <th><label for="">COMPROBANTE</label></th>
                                            <th><label for="">TOTAL</label></th>
                                            <th><label for="">HORA</label></th>
                                            <th><label for="">FECHA</label></th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <div id="venderpedido" class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
        <div id="venderpedido2" class="modal fade Pedido" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-label="CERRAR"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="gridSystemModalLabel">VENDER PEDIDO</h3>
                    </div>
                    <div class="panel panel-success">
                     
                        <div class="panel-body">
                            <form action="pedido/venderpedido.php" method="post" class="container-fluid">
                                <input type="hidden" value="" name="p_usu" id="p_usu">
                                <input type="hidden" value="" name="p_cod" id="p_cod">
                                <input type="hidden" value="" name="p_fecha" id="p_fecha">
                                <input type="hidden" value="" name="p_codcar" id="p_codcar">
                                <div class="form-group">
                                    <label for="">CODIGO DE PEDIDO</label>
                                    <input class="form-control" type="text" name="pedi_cod" id="pedi_cod" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="pedi_clie">CLIENTE</label>
                                    <input class="form-control" type="text" name="pedi_clie" id="pedi_clie" required>
                                </div>
                                <div class="form-group">
                                    <label for="pedi_comp">COMPROBANTE</label>
                                    <input class="form-control" type="text" name="pedi_comp" id="pedi_comp" required>
                                </div>
                                <div class="form-group">
                                    <label for="pedi_tot">TOTAL</label>
                                    <input class="form-control" type="text" name="pedi_tot" id="pedi_tot" required>
                                </div>
                                <div class="form-group">
                                    <label for="pedi_pag">PAGO</label>
                                    <input class="form-control" type="text" name="pedi_pag" id="pedi_pag" required>
                                </div>
                                <div class="form-group">
                                    <label for="pedi_comp">DESCUENTO</label>
                                    <input class="form-control" type="text" name="dsct_1" id="dsct_1" placeholder="PORCENTAJE" onkeyup="calcular_p();">
                                </div>
                                <button type="submit" class="btn btn-info form-control"><span class="glyphicon glyphicon-ok-sign"> ACEPTAR</span></button>
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
</body>

</html>
<script type="text/javascript">
    function act_pedido() {
        $.ajax({
            type: 'POST',
            url: 'pedido/trae_pedido.php',
            dataType: 'json',
            success: function(pedido) {
                var valor = eval(pedido);
                var cont = 0;

                for (var i in valor) {
                    cont++;
                }
                var tabla = document.getElementById('tbl');
                var i = 1;
                while (i <= cont) {
                    var found = 1;

                    for (var t = 1; t < tabla.rows.length; t++) {

                        var id = document.getElementById('tbl').rows[t].cells[0].innerText;

                        if (valor[i - 1].pedido == id) {
                            found = 0;
                        }
                    }

                    var tt = document.getElementById('tbl');
                    if (found == 1) {

                        var fil = tt.insertRow(i);
                        fil.insertCell(0).innerHTML = valor[i - 1].pedido;
                        fil.insertCell(1).innerHTML = valor[i - 1].usuario;
                        fil.insertCell(2).innerHTML = valor[i - 1].cliente;
                        fil.insertCell(3).innerHTML = valor[i - 1].tipo;
                        fil.insertCell(4).innerHTML = valor[i - 1].total;
                        fil.insertCell(5).innerHTML = valor[i - 1].hora;
                        fil.insertCell(6).innerHTML = valor[i - 1].fecha;

                        var s = i;
                        fil.insertCell(7).innerHTML = "<button type='button' class='btn btn-info' data-toggle='modal' data-target='.Pedido' onclick=script:getdatopedido('" + s + "','" + valor[i - 1].pedido + "','" + valor[i - 1].fecha + "','" + valor[i - 1].carrito + "');><span class='glyphicon glyphicon-ok'></span></button>";
                    }
                    i++;
                }
            }
        });

        // setTimeout('act_pedido()',3000);
    }

    function getdatopedido(x, clie, fe, codcar) {
        var cod = document.getElementById("tbl").rows[x].cells[0].innerText;
        var u = document.getElementById("tbl").rows[x].cells[1].innerText;
        var nom = document.getElementById("tbl").rows[x].cells[2].innerText;
        var tipo = document.getElementById("tbl").rows[x].cells[3].innerText;
        var tota = document.getElementById("tbl").rows[x].cells[4].innerText;
        document.getElementById("pedi_cod").value = cod;
        document.getElementById("pedi_clie").value = nom;
        document.getElementById("pedi_comp").value = tipo;
        document.getElementById("pedi_tot").value = tota;
        document.getElementById("p_cod").value = clie;
        document.getElementById("p_usu").value = u;
        document.getElementById("p_fecha").value = fe;
        document.getElementById("p_codcar").value = codcar;
    }

</script>
