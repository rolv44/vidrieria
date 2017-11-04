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
                    <input type="text" name="fech1" id="fech1" class="cd form-control" placeholder="FECHA INICIAL">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  ">
                    <input type="text" name="fech2" id="fech2" class="cd form-control" placeholder="FECHA FINAL">
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
        $(".cd").calendarioDW();
    })

</script>
<script>
    function formatear(fecha) {
        var d = fecha.split("/");
        var f = d[2] + "-" + d[1] + "-" + d[0];
        return f;
    }

    function mostrar_mes(fecha1, fecha2) {
        var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        var f1 = fecha1.split("-");
        var f2 = fecha2.split("-");
        var mes = new Array();
        if (f1[0] == f2[0]) {
            if (f1[1] < f2[1]) {
                var i;
                for (i = f1[1]; i <= f2[1]; i++) {
                    mes.push(meses[i - 1]);
                }
            } else {
                if (f1[1] == f2[1]) {
                    var i = f1[1] - 1;
                    mes.push(meses[i]);
                }
            }
        }
        if (f1[0] < f2[0]) {

            var i;
            for (i = f1[1]; i <= 12; i++) {
                mes.push(meses[i - 1]);
            }
            for (i = 0; i < f2[1]; i++) {
                mes.push(meses[i]);
            }

        }
        return mes;
    }

    function mostrarResultados() {
        var fe1 = document.getElementById('fech1').value;
        var fe2 = document.getElementById('fech2').value;
        var d1 = formatear(fe1);
        var d2 = formatear(fe2);
        var parametros = {
            "fecha1": d1,
            "fecha2": d2
        };

        $.ajax({
            type: 'POST',
            url: 'venta_t.php',
            data: parametros,
            dataType: 'json',
            success: function(data) {
                var valores = eval(data);
                var v = new Array();
                for (var key in valores) {
                    if (valores.hasOwnProperty(key)) {
                        v.push(valores[key]);
                    }
                }

                var data = {
                    labels: mostrar_mes(d1, d2),
                    datasets: [{
                        labels: "My First dataset",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "#9ccc65",
                        fillColor: '#01579b',
                        borderColor: "rgba(75,192,192,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(75,192,192,1)",
                        pointBackgroundColor: "#9ccc65",
                        pointBorderWidth: 1,
                        pointStrokeColor: "#9DB86D",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(75,192,192,1)",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        data: v,
                        spanGaps: false,
                    }]
                };
                var buyers = document.getElementById('grafico').getContext('2d');
                new Chart(buyers).Line(data);

            }

        });
        return false;

        /*
        var pieData = [
	{
		value: 20,
		color:"#878BB6"   
	},
	{
		value : 40,
		color : "#4ACAB4"
	},
	{
		value : 10,
		color : "#FF8153"
	},
	{
		value : 30,
		color : "#FFEA88"
	}
];
        var pieOptions = {
	segmentShowStroke : false,
	animateScale : true
}
        var countries= document.getElementById("countries").getContext("2d");
new Chart(countries).Pie(pieData, pieOptions);
        */
    }

</script>
