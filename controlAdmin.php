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
                        <li role="presentation"><a href="reporteAdmin.php"><span>REPORTES</span></a></li>
                        <li role="presentation" class="active"><a href=""><span>CONTROL</span></a></li>
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
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-lg-offset-1">
          <div class="panel panel-info">
              <div class="panel-heading">
                  <h2 align="center" class="panel-title">USUARIOS</h2>
              </div>
              <div class="panel-body">
                  <div class="table-responsive" style="height:350px;">
                      <table id="tblusu" class="table table-striped table-hover table-bordered table-condensed">
                          <tr>
                              <th><label for="">COD</label></th>
                              <th><label for="">NOMBRE</label></th>
                              <th><label for="">TIPO</label></th>
                              <th colspan="2"><button class="btn btn-primary form-control" type="button" data-toggle="modal" data-target=".RegistrarUsuario"><span class="glyphicon glyphicon-plus-sign">AGREGAR</span></button></th>
                          </tr>
                          <?php
              include "php/conexion.php";
              $cn=new conexion();
              $con=$cn->conectar();
              $consulta=mysqli_query($con,"select *from usuario");
              $contador=1;
              while($row = mysqli_fetch_array($consulta)){

  	        echo "
  		       <tr>
  			<td>".$row[0]."</td>
  			<td>".$row[1]."</td>
  			<td>".$row[3]."</td>";
                 $row[1]=str_replace(' ','+',$row[1]);
               echo"  <td><button type='button' class='btn btn-primary form-control' rel='tooltip' data-placement='top' title='EDITAR USUARIO'  onclick=mostrar_edit('$row[1]',$row[0],'$row[3]') data-toggle='modal' data-target='.EditarUsuario'><span class='glyphicon glyphicon-edit'></span></button></td>";
            if(strcmp($row[3],"ADMINISTRADOR")==0){
             echo" <td><button type='button' class='btn btn-warning form-control' rel='tooltip' data-placement='top' title='ELIMINAR USUARIO'  onclick='script:alerta();'><span class='glyphicon glyphicon-trash'></span></label></td>";
               }else{
              echo" <td><a type='button' class='btn btn-primary form-control' rel='tooltip' data-placement='left' title='ELIMINAR USUARIO' href='elimina/elim_usuario.php?cod=$row[0]'><span class='glyphicon glyphicon-trash'></span></a></td>";
                   }
                     echo"	</tr>";
                $contador++;
               }
              ?>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title" align="center">CARGAR PRODUCTOS AL SISTEMA</h3>
  </div>
  <div class="panel-body" >
    <form class="" action="php/cargarDatos.php" target="_blank" method="post" enctype="multipart/form-data">
   
   <div class="form-group">
     <label for="exampleInputFile">Buscar Archivo </label>
     <input  type="file" id="arch" name="arch" accept=".xlsx" >
     <p class="help-block">Archivo con extención .xlxs </p>
   </div>
   <button type="submit" class="btn btn-primary btn-block">SUBIR</button>
    </form>
  </div>
</div>
      </div>
    </div>

    <div id="editusu2" class="modal fade EditarUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 align="center" class="modal-title">EDITAR USUARIO</h2>
                </div>
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div id="editusu" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3 ">
                            <form action="Editar/editar_usuario.php" method="post">
                                <input type="hidden" value="" name="edt_cod" id="edt_cod">
                                <div class="form-group">
                                    <label for="edt_nom">NOMBRE</label>
                                    <input class="form-control" type="text" name="edt_nom" id="edt_nom">
                                </div>
                                <div class="form-group">
                                    <label for="edt_pass">CONTRASEÑA</label>
                                    <input class="form-control" type="password" name="edt_pass" id="edt_pass" placeholder="*******" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="edt_tip">TIPO</label>
                                    <select class="form-control" name="edt_tip" id="edt_tip">
                                             <option value="EMPLEADO">EMPLEADO</option>
                                            <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                          </select>
                                </div>
                                <div class="form-group">
                                    <label for="edt_passadmin">CONTRASEÑA ADMINISTRADOR</label>
                                    <input class="form-control" type="password" placeholder="*******" name="edt_passadmin" id="edt_passadmin" autocomplete="new-password">
                                </div>
                                <button class="btn btn-primary form-control" type="submit"><span class="glyphicon glyphicon-ok-sign"></span> ACEPTAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="creausu" class="modal fade RegistrarUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 align="center" class="modal-title">REGISTRAR USUARIO</h2>
                </div>
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3 ">
                            <form action="php/registrar_usu.php" method="post">
                                <div class="form-group">
                                    <label for="reg_name" class="sr-only">NOMBRE</label>
                                        <input class="form-control" type="text" name="reg_name" id="reg_name" placeholder="NOMBRES">
                                </div>
                                <div class="form-group">
                                   <label for="reg_pass" class="sr-only">CONTRASEÑA</label>
                                        <input class="form-control" type="text" name="reg_pass" id="reg_pass" placeholder="CONTRASEÑA">
                                </div>
                                <div class="form-group">
                                    <label for="reg_tip" class="sr-only">TIPO DE USUARIO</label>
                                        <select class="form-control" name="reg_tip" id="reg_tip">
                                            <option value="EMPLEADO">EMPLEADO</option>
                                            <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                                      </select>
                                </div>
                                <button class="btn btn-primary form-control" type="submit"><span class="glyphicon glyphicon-ok-sign"></span> ACEPTAR</button>
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
    function mostrar_edit(nom, cod, tipo) {
        var opc = 0;
        document.getElementById('edt_nom').value = nom.split('+').join(' ');
        document.getElementById('edt_cod').value = cod;
        if (tipo == "ADMINISTRADOR") {
            opc = 1;
        } else {
            opc = 0;
        }
        document.getElementById('edt_tip').selectedIndex = opc;
    }

    function alerta() {
        window.alert("No es posible eliminar usuario de tipo ADMINISTRADOR ¡");
    }

</script>
