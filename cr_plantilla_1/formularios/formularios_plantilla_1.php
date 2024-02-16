<?php 

  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
  $studio= $_SESSION['studio'];
?>
<head><meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
	
</head>

<form id="plantilla_add">
<div class="modal fade" id="myModals" role="dialog">
  <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h2 style="color: blue; margin-left: auto; text-align: center;">Nuevo Concepto<br><small style="font-size: 14px">Registro de valores</small></h2>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                      $sql="SELECT * FROM km_estudios where estatus = 'A' AND id_estudio = ".$studio;
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
                       <option value="M">Metodo</option>
                       <option value="R">R. Verificado</option>
                    </select>
                </td>
              </tr>

              <!-- interface-->
              <tr>
                  <td class="renglon_titulo">Interface 240: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_interface" id="fi_interface" maxlength="10" size="9" placeholder="Interface"/>
                  </td> 
              </tr>

              <!-- interface-->
              <tr>
                  <td class="renglon_titulo">Interface 680: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_interface2" id="fi_interface2" maxlength="10" size="9" placeholder="Interface"/>
                  </td> 
              </tr>

              <!-- concepto-->
              <tr>
                  <td class="renglon_titulo">Concepto: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_concepto" id="fi_concepto" maxlength="150" size="50" placeholder="Concepto"/>
                  </td> 
              </tr>

              <!-- vr_minimo-->
              <tr>
                  <td class="renglon_titulo">V. Referencia: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_valor_refe" id="fi_valor_refe" maxlength="70" size="70" placeholder="Valor de referencia"/>
                  </td> 
              </tr>
            
              <!-- UNidad de medida -->
              <tr>
                  <td class="renglon_titulo">U. Medida: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_unidad_medida" id="fi_unidad_medida" maxlength="30" size="30" placeholder="U. Medida"/>
                  </td> 
              </tr>

              <!-- posicion Inicial -->
              <tr>
                  <td class="renglon_titulo">P. Inicial: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="number"  name="fn_posini" id="fi_posini" maxlength="3" size="3" placeholder="P. Inicial" value="0" />
                  </td> 
              </tr>

              <!-- Tamaño de la fuente -->
              <tr>
                  <td class="renglon_titulo">Tamano F.: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="number"  name="fn_tamfue" id="fi_tamfue" maxlength="3" size="3" placeholder="T. Fuente" value="10" />
                  </td> 
              </tr>

              <!-- Tipo de la fuente 
              <tr>
                  <td class="renglon_titulo">T. Fuente: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_tipfue" id="fi_tipfue" maxlength="1" size="1" placeholder="Tipo Fuente"/>
                  </td> 
              </tr>
              -->
              <tr>
                <td>T. Fuente</td>
                <td>
                    <select class="" id="fi_tipfue" name="fn_tipfue">
                       <option value="B">Bold</option>
                       <option value="I">Italic</option>
                       <option value="U">Underline</option>
                       <option value="">Normal</option>
                    </select>
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
<form id="plantilla_edit">
    <!-- REVISAR -->
    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h2 style="color: blue; margin-left: auto; text-align: center;">Editar Conceptos<br><small style="font-size: 14px">Cambio de valores</small></h2>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                      $sql="SELECT * FROM km_estudios where estatus = 'A' AND id_estudio = ".$studio;
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
                       <option value="M">Metodo</option>
                       <option value="R">R. Verificado</option>
                    </select>
                </td>
              </tr>

              <!-- interface-->
              <tr>
                  <td class="renglon_titulo">Interface 240: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_interface" id="fi_interface" maxlength="10" size="9" placeholder="Interface"/>
                  </td> 
              </tr>

              <!-- interface-->
              <tr>
                  <td class="renglon_titulo">Interface 680: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_interface2" id="fi_interface2" maxlength="10" size="9" placeholder="Interface"/>
                  </td> 
              </tr>

              <!-- concepto-->
              <tr>
                  <td class="renglon_titulo">Concepto: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_concepto" id="fi_concepto" maxlength="150" size="50" placeholder="Concepto"/>
                  </td> 
              </tr>

              <!-- vr_minimo-->
              <tr>
                  <td class="renglon_titulo">V. Referencia: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_valor_refe" id="fi_valor_refe" maxlength="70" size="70" placeholder="V-R Minimo"/>
                  </td> 
              </tr>
            
              <!-- UNidad de medida -->
              <tr>
                  <td class="renglon_titulo">U. Medida: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_unidad_medida" id="fi_unidad_medida" maxlength="30" size="30" placeholder="U. Medida"/>
                  </td> 
              </tr>

              <!-- posicion Inicial -->
              <tr>
                  <td class="renglon_titulo">Inicial: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="number"  name="fn_posini" id="fi_posini" maxlength="3" size="3" placeholder="P. Inicial"/>
                  </td> 
              </tr>

              <!-- Tamaño de la fuente -->
              <tr>
                  <td class="renglon_titulo">Tamano: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="number"  name="fn_tamfue" id="fi_tamfue" maxlength="3" size="3" placeholder="T. Fuente"/>
                  </td> 
              </tr>

              <!-- Tipo de la fuente 
              <tr>
                  <td class="renglon_titulo">Fuente: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_tipfue" id="fi_tipfue" maxlength="1" size="1" placeholder="Tipo Fuente"/>
                  </td> 
              </tr>
              -->
              <tr>
                <td>T. Fuente</td>
                <td>
                    <select class="" id="fi_tipfue" name="fn_tipfue">
                       <option value="B">Bold</option>
                       <option value="I">Italic</option>
                       <option value="U">Underline</option>
                       <option value="">Normal</option>
                    </select>
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
        <form id="frmEliminarvalor" action="controladores/eliminar_plantilla_1.php" method="POST">
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
