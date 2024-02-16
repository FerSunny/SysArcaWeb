<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>
<head>
	<meta charset="UTF-8">
</head>


<div class="modal fade" id="myModals" role="dialog">
  <div class="modal-dialog">

      <!-- Modal content-->
   <form name="AltasPlantilla_cvr" action="controladores/registro_plantilla_cvr.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="color:blue;text-align:center" class="modal-title">Nuevo Concepto</h2>
          <h5 style="color:blue;text-align:center" class="modal-title">Registro de valores</h5>
        </div>
        <!--<div style="color:#000000;background:#EFFBF5" class="modal-body"> -->
        <div style="color:##fff;background:#e3f2fd" class="modal-body">
          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
              
              <!-- Id valor -->
              <tr>
                <td class="renglon_titulo"> Id Valor: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_valor" id="fi_id_valor" readonly="readonly" maxlength="11" size="11" placeholder="Asignado por el sistema"/>
                </td>
              </tr>

              <!-- orden -->
              <tr>
                  <td class="renglon_titulo">Orden:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_orden" id="fi_orden" maxlength="5" size="5" placeholder="Orden"/>
                  </td>
              </tr>

              <!-- estudio -->  
              <tr>
                <td class="renglon_titulo">Estudio: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_estudio" id="fi_estudio" style="width:350px">
                    <?php
                      $sql="SELECT * FROM km_estudios where estatus = 'A' order by desc_estudio";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_estudio']."' >";
                          echo $row['desc_estudio'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

              <!-- tipo -->
              <tr>
                <td>Tipo</td>
                <td>
                    <select class="" id="fi_tipo" name="fn_tipo">
                       <option value="T">Titulo</option>
                       <option value="P">Parametro</option>
                       <option value="B">Linea Blanca</option>
                       <option value="O">Observaciones</option>
                       <option value="F">Firma</option>
                    </select>
                </td>
              </tr>

              <!-- concepto-->
              <tr>
                  <td class="renglon_titulo">Concepto: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_concepto" id="fi_concepto" maxlength="70" size="50" placeholder="Concepto"/>
                  </td> 
              </tr>

              <!-- valor_referencia-->
              <tr>
                  <td class="renglon_titulo">V. Referencia: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_valor_referencia" id="fi_valor_referencia" maxlength="20" size="20" placeholder="Valor de Referencia"/>
                  </td> 
              </tr>

              <!-- estado -->
              <tr>
                <td>Estado</td>
                <td>
                    <select class="" id="fi_estado" name="fn_estado">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>
                </td>
              </tr>     
                
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>



<!--Editar usuario-->
<!-- SCRIPT PARA ACTUALIZAR -->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST">
  <div class="row">
    <!-- REVISAR -->
    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">Editar Conceptos</h2>
              <h5 style="color:blue;text-align:center" class="modal-title">Cambio de valores</h5>
            </div>

            <!-- INICIA EL BODY -->
            <div style="color:#000000;background:#EFFBF5" class="modal-body">
             <input type="hidden" id="idvalor" name="idvalor" value="0">
             <input type="hidden" id="opcion" name="opcion" value="modificar">
             <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
                  
            <!-- Id valor -->
              <tr>
                <td class="renglon_titulo"> Id Valor: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_valor" id="fi_id_valor" readonly="readonly" maxlength="11" size="11" placeholder="Asignado por el sistema"/>
                </td>
              </tr>

              <!-- orden -->
              <tr>
                  <td class="renglon_titulo">Orden:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_orden" id="fi_orden" maxlength="5" size="5" placeholder="Orden"/>
                  </td>
              </tr>

              <!-- estudio -->  
              <tr>
                <td class="renglon_titulo">Estudio: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_estudio" id="fi_estudio" style="width:350px">
                    <?php
                      $sql="SELECT * FROM km_estudios where estatus = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_estudio']."' >";
                          echo $row['desc_estudio'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

              <!-- tipo -->
              <tr>
                <td>Tipo</td>
                <td>
                    <select class="" id="fi_tipo" name="fn_tipo">
                       <option value="T">Titulo</option>
                       <option value="P">Parametro</option>
                       <option value="B">Linea Blanca</option>
                       <option value="O">Observaciones</option>
                       <option value="F">Firma</option>
                    </select>
                </td>
              </tr>

              <!-- concepto-->
              <tr>
                  <td class="renglon_titulo">Concepto: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_concepto" id="fi_concepto" maxlength="70" size="50" placeholder="Concepto"/>
                  </td> 
              </tr>

              <!-- valor referencia-->
              <tr>
                  <td class="renglon_titulo">V. Referencia: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_valor_referencia" id="fi_valor_referencia" maxlength="20" size="20" placeholder="Valor de Referencia"/>
                  </td> 
              </tr>

              <!-- estado -->
              <tr>
                <td>Estado</td>
                <td>
                    <select class="" id="fi_estado" name="fn_estado">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>
                </td>
              </tr>             
                
             </table>  
            </div><!--Cierre modal body-->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
     </div>
   </div>
  </div>
</form>


 <!-- Modal Eliminar-->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalEliminarLabel">Eliminar Concepto</h4>
      </div>
      <div class="modal-body">
        <form id="frmEliminarvalor" action="controladores/eliminar_plantilla_cvr.php" method="POST">
          Esta seguro de eliminar el concepto? <strong data-name=""></strong>
           <input type="hidden" id="idvalor" name="idvalor" value="">
            <input type="hidden" id="opcion" name="opcion" value="eliminar">
                ID
              <input id="valor" name="valor" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
                Nombre
              <input id="nombre" name="nombre" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
      </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btniniciar"  >Aceptar</button>
        <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>
