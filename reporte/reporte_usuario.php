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
    <div class="row container">
        <div class="panel panel-success col-lg-offset-2 col-md-offset-2">
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <input type="text" name="fech1" id="fech1" class="date form-control" placeholder="FECHA INICIAL">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  ">
                    <input type="text" name="fech2" id="fech2" class="date form-control" placeholder="FECHA FINAL">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 ">
                    <button class="btn btn-success btn-block" type="button" onclick="javascript: mostrarResultados();"><span class="glyphicon glyphicon-ok-sign"></span> ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container jumbotron">
        <div class="resultados"><canvas id="grafico" width="1100" height="500"></canvas></div>
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
        $(".date").calendarioDW();
    })

    function formatear(fecha) {
        var d = fecha.split("/");
        var f = d[2] + "-" + d[1] + "-" + d[0];
        return f;
    }
    //$(document).ready(mostrarResultados());  
    function mostrarResultados() {
        var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        var fecha1 = document.getElementById('fech1').value;
        var fecha2 = document.getElementById('fech2').value;
        var f1 = formatear(fecha1);
        var f2 = formatear(fecha2);

        var parametros = {
            "fecha1": f1,
            "fecha2": f2
        };
        $.ajax({
            type: 'POST',
            url: 'venta_usu.php',
            data: parametros,
            dataType: 'json',
            success: function(data) {

                var valores = eval(data);
                var tam = Object.keys(valores).length;
                var nombre = new Array();
                var det = new Array();
                var cont = 0;
                for (var key in valores) {
                    if (valores.hasOwnProperty(key)) {
                        nombre.push(key);
                        det.push(valores[key]);
                    }
                }
                var Datos = {
                    labels: nombre,
                    datasets: [{
                        fillColor: 'rgba(91,228,146,0.6)', //COLOR DE LAS BARRAS
                        strokeColor: 'rgba(57,194,112,0.7)', //COLOR DEL BORDE DE LAS BARRAS
                        highlightFill: 'rgba(73,206,180,0.6)', //COLOR "HOVER" DE LAS BARRAS
                        highlightStroke: 'rgba(66,196,157,0.7)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                        data: det
                    }]
                }

                var contexto = document.getElementById('grafico').getContext('2d');
                window.Barra = new Chart(contexto).Bar(Datos, {
                    responsive: true
                });
            }
        });
        return false;
    }

</script>
<?php
                   /* for($i=2000;$i<2020;$i++){
                        if($i == 2015){
                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                        }else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    }
                    "{'fecha1':'" +fecha1+ "', 'fecha2':'" +fecha2+ "'}",
                    */
                ?>
