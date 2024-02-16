<?php 
  //session_start();
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");

  $numero_factura=$_SESSION['numero_factura'];

?>
<div class="modal fade" id="myModals" role="dialog">
  <div class="modal-dialog">

      <!-- Modal content-->
   <form name="AltasMedico" action="controladores/registro_plantilla.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="color:blue;text-align:center" class="modal-title">Nuevo Medico</h2>
          <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5>
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
              <!-- Id medico -->
              <tr>
                <td class="renglon_titulo"> Id Medico: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_medico" id="fi_id_medico" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema"/>
                </td>
              </tr>
              <!-- Zona -->     
              <tr>
                <td class="renglon_titulo">Zona: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="zona" >
                    <?php
                      $sql="SELECT * FROM kg_zonas where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_zona']."' >";
                          echo $row['desc_zona'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>
              <!-- Nombre -->
              <tr>
                  <td class="renglon_titulo">Nombre:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="35" size="35" placeholder="Nombre"/>
                   </td>
              </tr>
              <!-- Apellido Paterno -->
              <tr>
                  <td class="renglon_titulo">A. Paterno:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_apaterno" id="fi_apaterno" maxlength="35" size="35" placeholder="Apellido Paterno"/>
                   </td>
              </tr>
              <!-- Apellido Materno -->
              <tr>
                  <td class="renglon_titulo">A. Materno:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_amaterno" id="fi_amaterno" maxlength="35" size="35" placeholder="Apellido Materno"/>
                   </td>
              </tr>   

              <!-- RFC -->
              <tr>
                  <td class="renglon_titulo">RFC:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_rfc" id="fi_rfc" maxlength="15" size="20" placeholder="RFC"/>
                   </td>
              </tr>

              <!-- Sexo -->  
              <tr>
                <td class="renglon_titulo">Sexo: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_sexo" id="fi_sexo">
                    <?php
                      $sql="SELECT * FROM so_sexo where activo = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_sexo']."' >";
                          echo $row['desc_sexo'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

              <!-- Especialidades -->  
              <tr>
                <td class="renglon_titulo">Especialidad: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="especialidad" >
                    <?php
                      $sql="SELECT * FROM km_especialidades where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_especialidad']."' >";
                          echo $row['desc_especialidad'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>
              <!-- Estado de la republica -->  
              <tr>
                <td class="renglon_titulo">Estado: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="Estado" >
                    <?php
                      $sql="SELECT * FROM ku_estados where estado = 'A' AND id_estado IN ('9','15')";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$estado=$row['id_estado']."' >";
                          echo $row['desc_estado'];
                          echo "</option>";
                        }
                        
                        echo $estado ;
                    ?>
                  </select>
                </td>
              </tr>   
              <!-- Municipio -->  
              <tr>
                <td class="renglon_titulo">Municipio: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="Municipio" >
                    <?php
                      $sql="SELECT * FROM ku_municipios where estado = 'A' and  fk_id_estado = 9 ";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_municipio']."' >";
                          echo $row['desc_municipio'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>      
              <!-- Localidades -->  
              <tr>
                <td class="renglon_titulo">Localidad: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="Localidad" >
                    <?php
                      $sql="SELECT * FROM ku_localidades WHERE estado = 'A' AND fk_id_municipio IN (273,275,277)
ORDER BY desc_localidad";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_localidad']."' >";
                          echo $row['desc_localidad'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>  
              <!-- Colonia -->
              <tr>
                  <td class="renglon_titulo">Colonia:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_colonia" id="fi_colonia" maxlength="50" size="50" placeholder="Colonia"/>
                  </td>
              </tr>   
              <!-- CP -->
              <tr>
                  <td class="renglon_titulo">CP:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="number" required name="fn_cp" id="fi_cp" maxlength="6" size="6" placeholder="CP"/>
                  </td>
              </tr> 
              <!-- Calle -->
              <tr>
                  <td class="renglon_titulo">Cale:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_calle" id="fi_calle" maxlength="150" size="60" placeholder="Calle"/>
                  </td>
              </tr>               
              <!-- Numero -->
              <tr>
                  <td class="renglon_titulo">Numero:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_numero" id="fi_numero" maxlength="35" size="35" placeholder="Numero"/>
                  </td>
              </tr> 
              <!-- Referencia -->
              <tr>
                  <td class="renglon_titulo">Referencia:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_referencia" id="fi_referencia" maxlength="200" size="60" placeholder="Referencia"/>
                  </td>
              </tr> 
              <!-- Telefono fijo -->
              <tr>
                  <td class="renglon_titulo">Tel. Fijo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_tfijo" id="fi_tfijo" maxlength="15" size="15" placeholder="Telefono  Fijo"/>
                  </td> 
              </tr>     
              <!-- Telefono movil -->
              <tr>
                  <td class="renglon_titulo">Tel. Movil: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_movil" id="fi_movil" maxlength="15" size="15" placeholder="Telefono  Movil"/>
                  </td> 
              </tr>
              <!-- mail -->
              <tr>
                  <td class="renglon_titulo">Mail: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="mail" required name="fn_mail" id="fi_mail" maxlength="45" size="45" placeholder="Mail de contacto"/>
                  </td> 
              </tr>

              <!-- Horario -->
              <tr>
                  <td class="renglon_titulo">Horario: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_horario" id="fi_horario" maxlength="35" size="35" placeholder="Horario de atencion"/>
                  </td> 
              </tr>    
              <!-- Cuenta banacaria -->
              <tr>
                  <td class="renglon_titulo">Cuenta Banco: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_cbanco" id="fi_cbanco" maxlength="25" size="25" placeholder="Cuenta Bancaria"/>
                  </td> 
              </tr>   

              <!-- Adscrito -->
              <tr>
                  <td class="renglon_titulo">Adscrito ARCA: </td>
                  <td  class="renglon_valor">
                      <input type="radio" required name="adscrito" value="Si"/>Si
                      <input type="radio" required name="adscrito" value="No"/>No
                  </td>                
              </tr>

              <!-- Sucursl adscripcion -->  
              <tr>
                <td class="renglon_titulo">Adscripcion: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_sucursal" id="fi_sucursal">
                    <?php
                      $sql="SELECT * FROM kg_sucursales where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_sucursal']."' >";
                          echo $row['desc_sucursal'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>


              <!-- Fecha de alta -->
              <tr>
                  <td class="renglon_titulo">Fecha Alta: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="date" required name="fn_falta" id="fi_falta" maxlength="15" size="15" placeholder="Fecha  Alta"/>
                  </td> 
              </tr>
              <!-- Fecha de actualización -->
              <tr>
                  <td class="renglon_titulo">Fecha Actuaizacion: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" readonly="readonly" disabled  value="<?php echo $FechaHoy;?>" name="fn_factualiza" id="fi_factualiza" maxlength="15" size="20" placeholder="Fecha  Alta"/>
                  </td> 
              </tr>              

              <!-- Estado del registro -->
              <tr>
                <td>Estado</td>
                <td>
                    <select class="" id="estado_re" name="estado_reg">
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



<!--Editar medicos-->
<!-- SCRIPT PARA ACTUALIZAR -->
<?php 
  $sql="SELECT fa.`diagnostico`,
    CONCAT(cl.nombre,' ',cl.`a_paterno`,' ',cl.`a_materno`) AS nombre,
    DATE(fa.`fecha_factura`) AS fecha,
    cl.`anios`,
    CASE
      WHEN LENGTH(fa.vmedico) > 1 THEN
        fa.vmedico
      ELSE
        CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno)
    END AS medico
    FROM so_factura fa,
      so_clientes cl,
      so_medicos me
    WHERE fa.`fk_id_cliente` = cl.`id_cliente` 
    AND fa.`fk_id_medico` = me.`id_medico`
    AND fa.`id_factura`=".$numero_factura;
    
    if ($result = mysqli_query($conexion, $sql)) {
      while($row = $result->fetch_assoc())
      {
          $nombre=$row['nombre'];
          $edad=$row['anios'];
          $diagnostico=$row['diagnostico'];
      }
    }
 ?>
<form id="frmedit"  action="controladores/registro_plantilla_ekg.php" method="POST">
  <div class="row">
    <!-- REVISAR -->
    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h2 style="color:blue;text-align:center;margin: auto;" class="modal-title" id="modalEliminarLabel">Captura de Resultados</h2>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div style="color:#000000;background:#EFFBF5" class="modal-body">
              <input type="hidden" id="idplantilla" name="idplantilla" value="0">
              <input type="hidden" id="opcion" name="opcion" value="modificar">

                <input type="hidden" id="fi_id_plantilla" name="fn_id_plantilla">

                <div class="md-form">
                  <label for="codigo">Paciente </label>
                <?php echo $nombre." -- Edad:".$edad." --dx:".$diagnostico ?>  
                
                </div> 

                 <div class="md-form">
                <input type="text"  name="fn_nombre_plantilla" id="fi_nombre_plantilla" class="form-control" >
                <label for="codigo">Nombre </label>
                </div>  

                <div class="md-form">
                <input type="text"  name="fn_titulo_desc" id="fi_titulo_desc" class="form-control" >
                <label for="codigo">Titulo </label>
                </div>  


                <div class="md-form">
                  <textarea  name="fn_descripcion" id="fi_descripcion" class="md-textarea form-control" rows="25"> 
                  </textarea>
                  <label for="form7">Descripci&oacute;n</label>
                </div>




            
            </div><!--Cierre modal body-->

            <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
               <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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
        <h4 class="modal-title" id="modalEliminarLabel">Eliminar Medico</h4>
      </div>
      <div class="modal-body">
        <form id="frmEliminarmedico" action="controladores/eliminar_medicos.php" method="POST">
          ¿Está seguro de eliminar el Medico?<strong data-name=""></strong>
           <input type="hidden" id="idmedico" name="idmedico" value="">
            <input type="hidden" id="opcion" name="opcion" value="eliminar">
                ID
              <input id="medico" name="medico" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
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
