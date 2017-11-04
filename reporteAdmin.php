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

<body id="page1" onload="MakeStaticHeader('tblventa', 380, 1080,38,false)">
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
                        <div class="form-group"> <input type="text" class="form-control" placeholder="Search" size="15"> </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title" align="center">VENTAS</h4>
            </div>
            <div class="panel-body">
                <div class="" >
                    <!--style="overflow:scroll;" onscroll="OnScrollDiv(this)" -->
                    <div class="table-responsive" style="height:370px" id="DivMainContent">
                       <table id="tblventa" class="table table-striped table-hover table-bordered table-condensed">
                        <tr class="info">
                            <td><label for="">COD</label></td>
                            <td><label for="">USUARIO</label></td>
                            <td><label for="">CLIENTE</label></td>
                            <td><label for="">COMPROBANTE</label></td>
                            <td><label for="">ESTADO</label></td>
                            <td><label for="">PAGO</label></td>
                            <td><label for="">VUELTO</label></td>
                            <td><label for="">TOTAL</label></td>
                            <td colspan="2"><label for="">FECHA</label></td>
                        </tr>
                        <tr>
                            <?php
            include "php/conexion.php";
            $cn=new conexion();
            $con=$cn->conectar();
            $color="green";
            $sen="";
            $contador=1;
                $consulta=mysqli_query($con,"select *from venta order by id_venta desc");
                while($row = mysqli_fetch_array($consulta)){ 
                  if(strcmp($row[6],"PENDIENTE")==0){
                    $ncliente=str_replace(' ','+',$row[3]);
            $ss1="<td><label style='color:orange' data-toggle='modal' data-target='.PagoDeuda' onclick=script:pago1('$row[0]','$ncliente','$row[7]','$row[9]','$row[1]');>PENDIENTE</label></td>";
                }elseif(strcmp($row[6],"CANCELADO")==0){
                    $ss1="<td style='color:green'><label>$row[6]</label></td>";
                }  
	        echo "  
		<tr>
			<td>".$row[0]."</td> 
			<td>".$row[2]."</td>
			<td style='width:250px'>".$row[3]."</td>
			<td>".$row[5]."</td>";
        echo $ss1;
        echo"    <td>".$row[7]."</td>
            <td>".$row[8]."</td>
            <td>".$row[9]."</td>
            <td>".$row[10]."</td>";
       echo"<td><a type='button' class='btn btn-success' data-toggle='tooltip' data-placement='top' title='IMPRIMIR' href='php/imprimir.php?venta=$row[0]&carro=$row[4]&cliente=$row[1]' target='_blank'><span class='glyphicon glyphicon-print'></span></a></td>";       
              $contador++; 
              $color="green";
              $sen="";
             }            
            ?>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="pago" class="modal fade PagoDeuda" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div id="pago1" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="CERRAR"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" align="center">PAGO DE DEUDA</h3>
                </div>
                <div class="panel panel-info container-fluid">
                    <div class="panel-heading">
                        <h4 class="panel-title" align="center">DATOS DE VENTA</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-lg-offset-3">
                            <form action="pago/pago_deuda.php" method="post">
                                <input type="hidden" value="" name="idclie" id="idclie">
                                <input type="hidden" value="" name="pagado" id="pagado">
                                <input type="hidden" value="" name="monto_total" id="monto_total">
                                <div class="form-group">
                                    <label for="codventa" class="sr-only">COD VENTA</label>
                                    <input class="form-control" type="text" name="codventa" id="codventa" readonly placeholder="CODIGO">
                                </div>
                                <div class="form-group">
                                    <label for="cliente" class="sr-only">CLIENTE</label>
                                    <input class="form-control" type="text" name="cliente" id="cliente" required placeholder="NOMBRE CLIENTE">
                                </div>
                                <div class="form-group">
                                    <label for="deuda" class="sr-only">DEUDA</label>
                                    <input class="form-control" type="text" name="deuda" id="deuda" required placeholder="MONTO DEUDA">
                                </div>
                                <div class="form-group">
                                    <label for="pago_deuda" class="sr-only">PAGO</label>
                                    <input class="form-control" type="text" name="pago_deuda" id="pago_deuda" required placeholder="MONTO A PAGAR">
                                </div>
                                <button class="btn btn-primary form-control" type="submit"><span class="glyphicon glyphicon-ok-sign"> ACEPTAR</span></button>
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

    function editar_egreso(x, cod, des, mon) {
        document.getElementById("ediegre").style.visibility = x;
        document.getElementById("idegre").value = cod;
        document.getElementById("descripcion").value = des.split("+").join(" ");
        document.getElementById("monto").value = mon;

    }

    function pago1(cod, cli, pag, t, idc) {
        //    document.getElementById("pago").style.visibility = x;
        document.getElementById('codventa').value = cod;
        document.getElementById('cliente').value = cli.split('+').join(' ');
        var deuda = t - pag;
        document.getElementById('deuda').value = deuda.toFixed(2);
        document.getElementById('idclie').value = idc;
        document.getElementById('pagado').value = pag;
        document.getElementById('monto_total').value = t;
    }
    
    function MakeStaticHeader(gridId, height, width, headerHeight, isFooter) {
        var tbl = document.getElementById(gridId);
        if (tbl) {
        var DivHR = document.getElementById('DivHeaderRow');
        var DivMC = document.getElementById('DivMainContent');
        var DivFR = document.getElementById('DivFooterRow');

        //*** Set divheaderRow Properties ****
        DivHR.style.height = headerHeight + 'px';
        DivHR.style.width = (parseInt(width) - 16) + 'px';
        DivHR.style.position = 'relative';
        DivHR.style.top = '0px';
        DivHR.style.zIndex = '10';
        DivHR.style.verticalAlign = 'top';

        //*** Set divMainContent Properties ****
        DivMC.style.width = width + 'px';
        DivMC.style.height = height + 'px';
        DivMC.style.position = 'relative';
        DivMC.style.top = -headerHeight + 'px';
        DivMC.style.zIndex = '1';

        //*** Set divFooterRow Properties ****
        DivFR.style.width = (parseInt(width) - 16) + 'px';
        DivFR.style.position = 'relative';
        DivFR.style.top = -headerHeight + 'px';
        DivFR.style.verticalAlign = 'top';
        DivFR.style.paddingtop = '2px';

        if (isFooter) {
         var tblfr = tbl.cloneNode(true);
      tblfr.removeChild(tblfr.getElementsByTagName('tbody')[0]);
         var tblBody = document.createElement('tbody');
         tblfr.style.width = '100%';
         tblfr.cellSpacing = "0";
         //*****In the case of Footer Row *******
         tblBody.appendChild(tbl.rows[tbl.rows.length - 1]);
         tblfr.appendChild(tblBody);
         DivFR.appendChild(tblfr);
         }
        //****Copy Header in divHeaderRow****
        DivHR.appendChild(tbl.cloneNode(true));
     }
    }
     function OnScrollDiv(Scrollablediv) {
    document.getElementById('DivHeaderRow').scrollLeft = Scrollablediv.scrollLeft;
    document.getElementById('DivFooterRow').scrollLeft = Scrollablediv.scrollLeft;
    }


</script>
