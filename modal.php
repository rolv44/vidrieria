<div class="venta col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="modal fade Vender " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">REGISTRAR VENTA</h4>
                </div>
                <div class="panel panel-info">
                    <form action="php/vender.php" method="post" class="container-fluid">
                        <input type="hidden" name="idcliente" id="idcliente">
                        <input type="hidden" name="descontado" id="descontado">
                        <br>
                        <div class="panle-body">
                            <div class="form-group">
                                <label class="sr-only" for="dtlist">COMPROBANTE</label>
                                <div class="input-group">
                                    <input class="form-control" list="dtlis" name="dtlist" id="dtlist" style="width:250px;" required placeholder="Tipo de Comprobante">
                                    <datalist id="dtlis">
                                         <option value="FACTURA"></option>
                                         <option value="BOLETA"></option>
                                     </datalist>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="cnom">Cliente</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="cnom" id="cnom" style="width:250px;" onclick="comp_clie();" autocomplete="off" required placeholder="Nombre Cliente">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".BuscarCliente" onclick="LlenarTabla();"><span class="glyphicon glyphicon-list-alt"></span> CARGAR TABLA</button>
                                    <input class="form-control" type="text" id="InputCliente" onkeyup="javascript:buscar('InputCliente','TablaCliente');" placeholder="BUSCAR CLIENTE" style="width:250px;">
                                </div>
                                <div class="table-responsive" style="height:200px;">
                                    <table id="TablaCliente" class="table table-striped table-bordered table-hover">
                                        <tr class="info">
                                            <th><label for="">ID</label></th>
                                            <th><label for="">NOMBRE</label></th>
                                            <th><label for="">RAZON SOCIAL</label></th>
                                            <th><label for="">DNI</label></th>
                                            <th><label for="">RUC</label></th>
                                            <th><label for="">DIRECCION</label></th>
                                            <th><label for="">TELEFONO</label></th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="cnom">Pago</label>
                                <input class="form-control" style="width:250px;" type="text" name="pago" id="pago" placeholder="Pago">
                            </div>
                            <div class="form-group">
                                <input class="form-control" style="width:250px;" type="text" name="dsct" id="dsct" placeholder="DESCUENTO %" onkeyup="calcular();">
                            </div>
                            <div class="form-group"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok"></span> VENDER</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="vemer2" class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
    <div id="busprod" class="modal fade Producto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="CERRAR"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">BUSCAR PRODUCTO</h4>
                   
                </div>
                <div class="b">
                </div>
                <div class="panel panel-info container-fluid">
                    <div class="table-responsive" style="height:500px;">
                        <div class="panel-heading">
                               <input type="text" id="bprodu" onkeyup="javascript:buscar('bprodu','tbl2');" >
                        </div>
                        <div class="panel-body">
                            <table id="tbl2" class="table table-striped table-bordered table-condensed table-hover">
                                <tr class="info">
                                    <th><label for="">ID</label></th>
                                    <th><label for="">NOMBRE</label></th>
                                    <th><label for="">DESCRIPCION</label></th>
                                    <th><label for="">MARCA</label></th>
                                    <th><label for="">P. U.</label></th>
                                    <th><label for="">P. B.</label></th>
                                    <th><label for="">STOCK</label></th>
                                    <th><label for="">TIPO</label></th>
                                    <th><label for="">G-REM.</label></th>
                                    <th><label for="">PROVEEDOR</label></th>
                                    <th><label for="">FECHA REG.</label></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /*
            
            $cn=new conexion();
            $con=$cn->conectar();
            $consulta=mysqli_query($con,"select *from producto order by id_pro desc");
            $contador=1;
            while($row = mysqli_fetch_array($consulta)){ 
            
	        echo " 
            
		<tr>
			<td>".$row[0]."</td>
			<td>".$row[1]."</td>
			<td>".$row[2]."</td>
			<td>".$row[3]."</td>
            <td>".$row[5]."</td>
            <td>".$row[6]."</td>
            <td>".$row[7]."</td>
            <td>".$row[9]."</td>
            <td>".$row[10]."</td>
            <td>".$row[11]."</td>
            <td>".$row[12]."</td>
            ";
            if(strcmp($row[9],"ESPECIAL")){
            echo "<td><input type='button' value='Enviar' onclick=script:getdatoprod('$contador');producto('hidden')></td>";
            }elseif(strcmp($row[9],"NORMAL")){
            echo"<td><a href='ver_almacen.php?valor_id=$row[0]&tipoprod=$row[9]&op=1'>VER</a></td>";
            }
		      echo" </tr>";  
              $contador++;  
             }    
           */
            ?>
