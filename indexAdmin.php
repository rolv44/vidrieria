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
    <script src="js/scriptVentaAdmin.js" type="text/javascript"></script>
</head>

<body id="page1" >

    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">   <div class="logo"> <img src="images/logo.jpg" alt="" />  </div>  </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1" aria-expanded="false">
                       <span class="sr-only"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   </button>
                </div>  
                <div class="collapse navbar-collapse" id="navbar-1">
                    <ul class="nav navbar-nav">
                        <li role="presentation"  class="active"><a href=""><span>VENTAS</span></a></li>
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
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search" size="15">
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

    <?php include("modal.php");?>
    
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

