

<?php
$connect = mysqli_connect("localhost", "root", "", "test");
$output = '';
if(isset($_POST["import"]))
{
 $extension = end(explode(".", $_FILES["excel"]["name"])); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 { 
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  include("PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=2; $row<=$highestRow; $row++)
   {
    $output .= "<tr>";
    $name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $email = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $query = "INSERT INTO tbl_excel(excel_name, excel_email) VALUES ('".$name."', '".$email."')";
    mysqli_query($connect, $query);
    $output .= '<td>'.$name.'</td>';
    $output .= '<td>'.$email.'</td>';
    $output .= '</tr>';
   }
  } 
  $output .= '</table>';

 }
 else
 {
  $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
 }
}
?>

<html>
 <head>
  <title>Import Excel to Mysql using PHPExcel in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:700px;
   border:1px solid #ccc;
   background-color:#fff;
   border-radius:5px;
   margin-top:100px;
  }
  
  </style>
 </head>
 <body>
  <div class="container box">
   <h3 align="center">Import Excel to Mysql using PHPExcel in PHP</h3><br />
   <form method="post" enctype="multipart/form-data">
    <label>Select Excel File</label>
    <input type="file" name="excel" />
    <br />
    <input type="submit" name="import" class="btn btn-info" value="Import" />
   </form>
   <br />
   <br />
   <?php
   echo $output;
   ?>
  </div>
 </body>
</html>










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











