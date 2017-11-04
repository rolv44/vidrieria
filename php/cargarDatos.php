<!DOCTYPE html>
<html lang="en">
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
</head>
<body>
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
                    
                </div>
            </div>
        </nav>
    </header>
    <br>
  
  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-2">
          <?php
                    include "../php_excel/PHPExcel/IOFactory.php";
                    include "conexion.php";
                    $archivo = $_FILES['arch']['name'];
                    $tipo = $_FILES['arch']['type'];
                    $cn=new conexion();
                    $con=$cn->conectar();
                    $titu1="";
                    $titu2="";
                    $titu3="";
                    $titu4="";
                    $i=0;
                    $destino = "bak_" . $archivo;
                            try{
                                if (copy($_FILES['arch']['tmp_name'], $destino)){
                                    $titu1="ARCHIVO CARGADO" ;
                                }
                                else{
                                    $titu1="ERROR";
                                }
                            }catch(Exception $e){$titu3="Acceso denegado: Nose ha podido copiar archivo temporalmente.";}
                            if (file_exists("bak_" . $archivo)) {
                                /** Clases necesarias */
                                require_once('../php_excel/PHPExcel.php');
                                require_once('../php_excel/PHPExcel/Reader/Excel2007.php');
                                // Cargando la hoja de cálculo
                               
                                
                                $file = $_FILES["arch"]["tmp_name"];
                                $objPHPExcel = PHPExcel_IOFactory::load($file);
                                
                          
                                
                                //traemos el ultimo id del producto para iniciar desde esa posicion el ingreso de id.
                                $qry=mysqli_query($con,"SELECT trae_id_pro() AS ID")or die(mysqli_error($con));
                                $rw=mysqli_fetch_array($qry);
                                $id_last=$rw['ID'];
                                $error=0; 
                                   
                                   
                                   foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
                                      {
                                          $highestRow = $worksheet->getHighestRow();
                                             for($row=3; $row<=$highestRow; $row++)
                                      {
                                          $id=$id_last;
                                           $nombre=" ";
                                           $dd=htmlentities($worksheet->getCellByColumnAndRow(2, $row)->getValue());
                                           $ub=htmlentities($worksheet->getCellByColumnAndRow(0, $row)->getValue());
                                           $cc=htmlentities($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                                           $desc=$cc."-".$dd." - ".$ub;
                                           $marca=" ";
                                           $pre_com=" ";
                                           $pre_ven=" ";
                                           $pro_blo=" ";
                                           $stock=htmlentities($worksheet->getCellByColumnAndRow(11, $row)->getValue());
                                           $unid=" ";
                                           $tipo="NORMAL";
                                           $guia=" ";
                                           $provee=" ";  
                                           $fecha=date("Y-m-d");
                                           $size=" ";
                                           if(isset($desc) || isset($stock)){
                                        $query=mysqli_query($con,"insert into producto VALUES('$id','$nombre','$desc','$marca','$pre_com','$pre_ven','$pre_blo','$stock','$unid','NORMAL','$guia','$provee','$fecha','$size')")or die($error++);
                                           $id_last++;
                                           $i++;
                                           } 
                                          
                                }
                                           } 
                                   
                                   
                                   
                                $titu2="Subida esxitosa";
                                $titu4="alert alert-success";
                            }
                            //si por algo no cargo el archivo bak_
                            else {
                                $titu2="Necesitas primero importar el archivo";
                                $titu4="alert alert-danger";
                            }
                            $titu3="ingresado ".$i." columnas";
                            //una vez terminado el proceso borramos el archivo que esta en el servidor el bak_
                            

                    ?>
          <div class='panel panel-default'>
                         <div class='panel-heading'><h2 align='center'><?=$titu1 ?></h2></div>
                        <div class='panel-body'>
                              <div class="<?=$titu4 ?>" role='alert'><?=$titu2 ?></div>
                            </div>
                            <div class='panel-footer'><?=$titu3 ?></div>
                          </div>
          
          
      </div>
  </div>

  
</body>
</html>

