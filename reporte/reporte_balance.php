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
    <link href="../estilos/layout.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="../js/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script src="../js/jquery.js" type="text/javascript"></script>
    <script src="../bootstrap-3.3.7-dist/js/bootstrap.js"></script>
    <script src="../js/cufon-yui.js" type="text/javascript"></script>
    <script src="../js/cufon-replace.js" type="text/javascript"></script>
    <script src="../js/Myriad_Pro_400.font.js" type="text/javascript"></script>
    <script src="../js/Myriad_Pro_600.font.js" type="text/javascript"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/chartJS/Chart.min.js"></script>

    <link href="../calendario_dw/calendario_dw-estilos.css" type="text/css" rel="STYLESHEET">
    <script type="text/javascript" src="../calendario_dw/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="../calendario_dw/calendario_dw.js"></script>
</head>

<body id="page1">
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">
                        <div class="logo"> <img src="../images/logo.jpg" alt="" /> </div>
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1" aria-expanded="false">
                       <span class="sr-only"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-1">
                    <form action="" class="navbar-form navbar-right" role="search">
                        <div class="form-group"> <input type="text" class="form-control" placeholder="Search"> </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <br>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                <div class="panel panel-success">
                    <div class="panel-body">
                        <form action="" class="form-inline">
                            <div class="form-group">
                                <input type="text" name="fech1" id="fech1" class="cd form-control" placeholder="FECHA INICIAL">
                            </div>
                            <div class="form-group">
                                <input type="text" name="fech2" id="fech2" class="cd form-control" placeholder="FECHA FINAL">
                            </div>
                            <button class="btn btn-success" type="button" onclick="javascript:buscar_ingreso(); buscar_egreso();"><span class="glyphicon glyphicon-ok-sign"></span> ACEPTAR</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                <div class="panel panel-success">
                    <div class="panel-body">
                        <form action="" class="form-inline">
                            <div class="form-group">
                                <button type="button" class="btn btn-success" onclick="javascript:calculartotal();" data-toggle="tooltip" data-placement="bottom" title="CALCULAR"><span class="glyphicon glyphicon-bed"></span> CALCULAR TOTAL</button>
                            </div>
                            <div class="form-group">
                                <label for="" class="sr-only">INGRESO</label>
                                <input class="form-control" type="text" name="ingre" id="ingre" readonly placeholder="TOTAL INGRESO">
                            </div>
                            <div class="form-group">
                                <label for="" class="sr-only">EGRESO</label>
                                <input class="form-control" type="text" name="egre" id="egre" readonly placeholder="TOTAL EGRESO">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 ">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4 align="center">TABLA DE INGRESOS</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive" style="height:270px;">
                            <table id="tblingreso" class="table table-striped table-hover table-bordered table-condensed">
                                <tr>
                                    <th>IDventa</th>
                                    <th>Usuario</th>
                                    <th>Cliente</th>
                                    <th>Tipo</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4 align="center">TABLA DE EGRESOS</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive" style="height:270px;">
                            <table id="tblegreso" class="table table-bordered table-hover table-striped table-condensed">
                                <tr>
                                    <th>Descripcion</th>
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                </tr>
                            </table>
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
    $(document).ready(function() {
        $(".cd").calendarioDW();
    })

</script>
<script>
    function formatear(fecha) {
        var d = fecha.split("/");
        var f = d[2] + "-" + d[1] + "-" + d[0];
        return f;
    }

    function buscar_ingreso() {
        var fe1 = document.getElementById("fech1").value;
        var fe2 = document.getElementById("fech2").value;
        var ffe1 = formatear(fe1);
        var ffe2 = formatear(fe2);
        var parametro = {
            "fecha1": ffe1,
            "fecha2": ffe2
        };
        $.ajax({
            type: 'POST',
            url: 'ingreso.php',
            data: parametro,
            dataType: 'json',
            success: function(datos) {
                var val = eval(datos);
                var con = 0;
                for (var i in val) {
                    con++;
                }
                var tabla = document.getElementById('tblingreso');
                var filas = tabla.getElementsByTagName('tr');
                if (tabla.rows.length > 2) {
                    for (var f = 1; f <= tabla.rows.length; f++) {
                        tabla.removeChild(filas[f]);
                    }
                }
                var i = 0;
                while (i <= con) {
                    var fila1 = tabla.insertRow(i + 1);
                    fila1.insertCell(0).innerHTML = val[i].idventa;
                    fila1.insertCell(1).innerHTML = val[i].usuario;
                    fila1.insertCell(2).innerHTML = val[i].cliente;
                    fila1.insertCell(3).innerHTML = val[i].tipo;
                    fila1.insertCell(4).innerHTML = val[i].total;
                    fila1.insertCell(5).innerHTML = val[i].fecha;
                    i++;
                }
            }
        });

        // setTimeout('act_pedido()',3000);
    }

    function buscar_egreso() {
        var f1 = document.getElementById("fech1").value;
        var f2 = document.getElementById("fech2").value;
        var ff1 = formatear(f1);
        var ff2 = formatear(f2);
        var parametros = {
            "fecha1": ff1,
            "fecha2": ff2
        };
        $.ajax({
            type: 'POST',
            url: 'egreso.php',
            data: parametros,
            dataType: 'json',
            success: function(datos) {
                var valor = eval(datos);
                var cont = 0;
                for (var i in valor) {
                    cont++;
                }
                var tabla = document.getElementById('tblegreso');
                var fila = tabla.getElementsByTagName('tr');
                if (tabla.rows.length > 2) {
                    for (var f = 1; f <= tabla.rows.length; f++) {
                        tabla.removeChild(fila[f]);
                    }
                }
                var i = 0;
                while (i <= cont) {
                    var fila = tabla.insertRow(i + 1);
                    fila.insertCell(0).innerHTML = valor[i].descripcion;
                    fila.insertCell(1).innerHTML = valor[i].monto;
                    fila.insertCell(2).innerHTML = valor[i].fecha;
                    i++;
                }

            }
        });

        // setTimeout('act_pedido()',3000);
    }

    function calculartotal() {
        var tabla = document.getElementById('tblingreso');
        var tabla2 = document.getElementById('tblegreso');
        var totalegre = 0.0;
        var totalingre = 0.0;
        if (tabla.rows.length > 1) {
            for (var i = 2; i < tabla.rows.length; i++) {
                var r = parseFloat(document.getElementById('tblingreso').rows[i - 1].cells[4].innerText);
                totalingre = totalingre + r;
            }
            document.getElementById('ingre').value = totalingre;
        }
        if (tabla2.rows.length > 1) {
            for (var i = 2; i < tabla2.rows.length; i++) {
                var r = parseFloat(document.getElementById('tblegreso').rows[i - 1].cells[1].innerText);
                totalegre = totalegre + r;
            }
            document.getElementById('egre').value = totalegre;
        }

    }

</script>
