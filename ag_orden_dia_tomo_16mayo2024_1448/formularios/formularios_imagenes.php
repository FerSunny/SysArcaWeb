<?php 
  //session_start();
  include("../controladores/conex.php");
  $numero_factura= $_SESSION['numero_factura'];
  $studio= $_SESSION['studio'];

  $nombre='0';

  $sql="SELECT  ui.id_imagen,ui.nombre FROM cr_plantilla_colpo_img ui
        WHERE ui.fk_id_factura = ".$numero_factura."
        AND ui.fk_id_estudio =".$studio;
//echo $sql;

  if ($result = mysqli_query($conexion, $sql)) {
    while($row = $result->fetch_assoc())
    {
        $nombre=$row['nombre'];
    }
  }

  $imagen='img_ekg/'.$numero_factura.'/'.$nombre;

?>
<link rel="stylesheet" href="../css/estilos.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.imageLens.js"></script>


<script type="text/javascript">
  $(document).ready(function(){
      $('#img_01').imageLens();
  })

</script>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<div class="modal fade" id="myModals" role="dialog">
  <div class="modal-dialog">

      <!-- Modal content-->
   <form name="AltasEstudio" action="controladores/registro_imagenes.php" method="post" enctype="multipart/form-data" id="fileforms">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="color:blue;text-align:center" class="modal-title">Nueva Imagen</h2>
    <!--      <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5> -->
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
<!-- Id nota -->
            <tr>
                <td class="renglon_titulo"> Nota: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_medico" id="fi_id_medico" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema" value="<?php echo $numero_factura ?>" />
                </td>
            </tr>  
<!-- Id estudio -->
            <tr>
                <td class="renglon_titulo"> Estudio: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_medico" id="fi_id_medico" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema" value="<?php echo $studio ?>" />
                </td>
            </tr>

<!-- imagen, seleccion -->       
             <tr>
                  <div class="form-group row" align="">
                    <div class="col-xs-8">
                      <td><label>Seleccione:</label></td>
                      <td><input type="file" class="form-control" id="fn_archivo" required name="fn_archivo[]" multiple ></td>
                    </div>
                  </div>
            </tr>
<!-- imagenes por hoja -->


            <tr>
              <td>  <label for="" class="col-sm-2 control-label">Imagenes x hoja</label></td>
              <td>  <div class="form-group">

                  <select class="col-sm-5 selectpicker" name="fn_img_x_hoja" id="fi_img_x_hoja">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                  </select>
                </div></td>
            </tr>

<!-- estado del registro --> 

            <tr>
              <td>  <label for="" class="col-sm-2 control-label">Estado</label></td>
              <td>  <div class="form-group">

                  <select class="col-sm-5 selectpicker" name="fn_estado" id="fi_estado">
                    <option value="A">Activo</option>
                    <option value="S">Suspendido</option>
                  </select>
                </div></td>
            </tr>
           </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
          <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
        </form>
      </div>

    </div>
  </div>
<!--</div> -->

<!--Editar imagenes-->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Ver Imagen</h4>
            </div>
            <div class="modal-body">

              <input type="hidden" id="idimagen" name="idimagen" value="0">
              <input type="hidden" id="opcion" name="opcion" value="modificar">
<!-- Nota -->              
              <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">Nota</label>
                <div class="col-sm-8">
                  <input id="edit1" name="edit1" maxkength="50" required type="text" class="form-control" readonly="readonly">
                 </div>
              </div>

<!-- Esudio -->              
              <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">Estudio</label>
                <div class="col-sm-8">
                  <input id="fi_desc_estudio" name="fn_desc_estudio" maxkength="50" required type="text" class="form-control" readonly="readonly">
                 </div>
              </div>
<!-- nomb imagen -->              
              <div class="form-group">
                <label for="nombre_img" class="col-sm-2 control-label">Imagen</label>
                <div class="col-sm-8">
                  <input id="fi_nombre" name="fn_nombre" maxkength="50" required="no entry" required type="text" class="form-control" readonly="readonly">
                 </div>
              </div>
<!-- Imagen -->  
              <div class="form-group">
                <!--
                  <label for="descripcion" class="col-sm-2 control-label">Estudio</label>
                -->
                <div class="col-sm-8">

    

                  
                  <img src="" id="img_01" alt="500" width="500" >

                  <!--
                  <input id="fi_desc_estudio" name="fn_desc_estudio" maxkength="50" required type="text" class="form-control" >
                -->
                 </div>
              </div>


              
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8"></div>
              </div>

              <div class="modal-footer">
                <!--
                  <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
                -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal Eliminar-->
<form id="frmEliminarzona" action="controladores/eliminar_imagenes.php" method="POST">
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Imagenes</h4>
            </div>
            <div class="modal-body">
              
                ¿Está seguro de eliminar la imagen?<strong data-name=""></strong>
                    <input type="hidden" id="idimagen" name="idimagen" value="">
                    <input type="hidden" id="opcion" name="opcion" value="eliminar">
                    <div class="form-group">
                      <div class="col-sm-8">
                        <input id="zona" name="zona" type="text" class="form-control" maxlength="8" >
                      </div>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="btniniciar"  >Aceptar</button>
            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
           
          </div>
        </div>
      </div>
      <!-- Modal -->
    </form>
