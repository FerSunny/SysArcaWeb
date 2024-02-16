<?php
 // session_start();
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
  $id_usuario= $_SESSION['id_usuario'];

  $sql="SELECT me.id_medico, concat(me.a_paterno,' ',me.a_materno,' ',me.nombre) as nombre
  FROM so_medicos me where me.estado = 'A' and fk_id_usuario = ".$id_usuario;
	$result=mysqli_query($conexion,$sql);

?>

<!-- Funciones para que el buscador, en el nombre del mediuco -->
<link rel="stylesheet" type="text/css" href="../select2/select2.min.css">
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script src="select2/select2.min.js"></script>
<!-- Fin -->



<form id="frm_add" action="" method="post">
<div class="modal fade" id="myModals" role="dialog">
  <div class="modal-dialog modal-lg" role="document">

      <!-- Modal content-->
   
      <div class="modal-content">
        <div class="modal-header">
          
          <h2 style="color:blue;text-align:center" class="modal-title">Nuevo Medico</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>

        </div>
         <!-- Inica el body -->
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
        
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  
                  <label>Id Evento</label>
                </div>
              </div>
            </div>
<!-- Medico -->      
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">

                  Medico
                  <section style="text-align: center;">
                  <select id="controlBuscador" style="width: 75%">
			              <?php while ($ver=mysqli_fetch_row($result)) {?>

			              <option value="<?php echo $ver[0] ?>">
				              <?php echo $ver[1] ?>
			              </option>

			              <?php  }?>
		              </select>
                  </section>

                </div>
              </div>
            </div> 

          </div>


          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="date" required name="fn_fecha" id="fi_fecha"  class="form-control">
                  <label>Fecha</label>
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="time" required name="fn_hora" id="fi_hora"  class="form-control">
                  <label>Hora</label>
                </div>
              </div>
            </div>

          </div>
           

           <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                <input type="text" readonly="readonly" disabled  value="<?php echo $FechaHoy;?>" name="fn_factualiza" id="fi_factualiza" maxlength="15">
                <label>Fecha Actualización</label>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Estado del Medico 
                <select class="" id="estado" name="estado">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>


                </div>
              </div>
            </div>
          </div>  

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador').select2();
	});
</script>


<!--Editar medicos-->
<!-- SCRIPT PARA ACTUALIZAR -->

<form id="frmedit" action="" method="post">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog  modal-lg" role="document">

      <!-- Modal content-->
   
      <div class="modal-content">
        <div class="modal-header">
          
          <h2 style="color:blue;text-align:center" class="modal-title">Agendar Visita</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>

        </div>
         <!-- Inica el body -->
        <div style="color:#000000;background:#EFFBF5" class="modal-body">

        <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="hidden" id="id_agenda" name="id_agenda" >
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                  <label>Id evento</label>
                </div>
              </div>
            </div>
      
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" readonly  name="fn_medico" id="fi_medico"  class="form-control">
                  <label>Medico</label>
                </div>
              </div>
            </div>

          </div>


          
        
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="date" required name="fn_fecha" id="fi_fecha"  class="form-control">
                  <label>Fecha</label>
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="time" required name="fn_hora" id="fi_hora"  class="form-control">
                  <label>Hora</label>
                </div>
              </div>
            </div>

          </div>
           

           <div class="row">

           <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <Div>
                  Planeado
                    <select class="" name="fn_planeado" id="fiplaneado">
                              <option value="S">Si </option>
                              <OPTION VALUE="N">No </OPTION>
                      </select>
                  </div>

                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                <input type="text" readonly="readonly" disabled  value="<?php echo $FechaHoy;?>" name="fn_factualiza" id="fi_factualiza" maxlength="15">
                <label>Fecha Actualización</label>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Estado del Medico 
                <select class="" id="estado" name="estado">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>


                </div>
              </div>
            </div>
          </div> 



        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador').select2();
	});
</script>