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
   <form name="AltasUsuario" action="controladores/registro_usuarios.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h2 style="color:blue;text-align:center" class="modal-title">
                Nuevo Usuario
            </h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
          
        <!--<div style="color:#000000;background:#EFFBF5" class="modal-body"> -->
        <div style="color:##fff;background:#e3f2fd" class="modal-body">
          <table border="0" align="center">
              <!-- Id usuario -->
              <tr>
                <td class="renglon_titulo"> Id Usuario: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_usuario" id="fi_id_usuario" readonly="readonly" maxlength="11" size="11" placeholder="Asignado por el sistema"/>
                </td>
              </tr>

              <!-- usr -->
              <tr>
                  <td class="renglon_titulo">Usuario:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="mail" required name="fn_id_usr" id="fi_id_usr" maxlength="45" size="45" placeholder="nombre@mail.com"/>
                  </td>
              </tr>

              <!-- sucursal -->  
              <tr>
                <td class="renglon_titulo">Sucursal: </td>
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


              <!-- password -->
              <tr>
                  <td class="renglon_titulo">Contraseña:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="password" required name="fn_pass" id="fi_pass" maxlength="10" size="10" placeholder="Contraseña"/>
                  </td>
              </tr>

              <!-- Estado del registro -->
              <tr>
                <td>Estado</td>
                <td>
                    <select class="" id="fi_estado" name="fn_estado">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>
                </td>
              </tr>

              <!-- perfil -->  
              <tr>
                <td class="renglon_titulo">Perfil: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_perfil" id="fi_perfil">
                    <?php
                      $sql="SELECT * FROM se_perfiles where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_perfil']."' >";
                          echo $row['desc_perfil'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>  
              <!-- servicio-->
              <tr>
                <td class="renglon_titulo">Servcio: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_servicio" id="fi_servicio">
                    <?php
                      $sql="SELECT * FROM km_servicios where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_servicio']."' >";
                          echo $row['desc_servicio'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>  





              <!-- nombre-->
              <tr>
                  <td class="renglon_titulo">Nombre: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="25" size="25" placeholder="Nombre del usuario"/>
                  </td> 
              </tr>

              <!-- paterno-->
              <tr>
                  <td class="renglon_titulo">A. Paterno: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_apaterno" id="fi_apaterno" maxlength="25" size="25" placeholder="Apellido paterno"/>
                  </td> 
              </tr>

              <!-- materno-->
              <tr>
                  <td class="renglon_titulo">A. Materno: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_amaterno" id="fi_amaterno" maxlength="25" size="25" placeholder="Apellido paterno"/>
                  </td> 
              </tr>
 
              <!-- iniciales-->
              <tr>
                  <td class="renglon_titulo">Iniciales: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_iniciales" id="fi_iniciales" maxlength="8" size="8" placeholder="Iniciales"/>
                  </td> 
              </tr>            

              <!-- Telefono fijo-->
              <tr>
                  <td class="renglon_titulo">T. Fijo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_tfijo" id="fi_tfijo" maxlength="15" size="15" placeholder="Telefono fijo"/>
                  </td> 
              </tr>

              <!-- Telefono Movil-->
              <tr>
                  <td class="renglon_titulo">T. Movil: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_tmovil" id="fi_tmovil" maxlength="15" size="15" placeholder="Telefono novil"/>
                  </td> 
              </tr>

              <!-- direccion-->
              <tr>
                  <td class="renglon_titulo">Direccion: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_direccion" id="fi_direccion" maxlength="120" size="35" placeholder="Direccion"/>
                  </td> 
              </tr>

              <!-- mail-->
              <tr>
                  <td class="renglon_titulo">Mail: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="mail" required name="fn_mail" id="fi_mail" maxlength="50" size="50" placeholder="Mail"/>
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
                  <td class="renglon_titulo">Fecha Actualizacion: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" readonly="readonly" disabled  value="<?php echo $FechaHoy;?>" name="fn_factualiza" id="fi_factualiza" maxlength="15" size="20" placeholder="Fecha  Alta"/>
                  </td> 
              </tr>      

               <!-- Hora de entrada L-V -->
              <tr>
                  <td class="renglon_titulo">Hora de Entrada L-V: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_entra" id="fi_entra" required="" />
                  </td> 
              </tr>   

              <!-- Hora de salida L-V -->
              <tr>
                  <td class="renglon_titulo">Hora de Salida L-V: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_salida" id="fi_salida" required="" />
                  </td> 
              </tr>    

               <!-- Hora de entrada sabado -->
              <tr>
                  <td class="renglon_titulo">Hora de Entrada Sabado: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_entra_s" id="fi_entra_s" required="" />
                  </td> 
              </tr>   

               <!-- Hora de salida sabado -->
              <tr>
                  <td class="renglon_titulo">Hora de Salida Sabado: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_salida_s" id="fi_salida_s" required="" />
                  </td> 
              </tr>  

               <!-- Hora de entrada domingo -->
              <tr>
                  <td class="renglon_titulo">Hora de Entrada Domingo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_entra_d" id="fi_entra_d" required="" />
                  </td> 
              </tr>  

               <!-- Hora de salida domingo -->
              <tr>
                  <td class="renglon_titulo">Hora de Salida Domingo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_salida_d" id="fi_salida_d" required="" />
                  </td> 
              </tr>  

               <!-- Hora de entrada día festivo -->
              <tr>
                  <td class="renglon_titulo">Hora de Entrada D&iacute;a Festivo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_entra_f" id="fi_entra_f" required="" />
                  </td> 
              </tr>  

               <!-- Hora de salida día festivo -->
              <tr>
                  <td class="renglon_titulo">Hora de Salida D&iacute;a Festivo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_salida_f" id="fi_salida_f" required="" />
                  </td> 
              </tr>  

              <!-- usuario-->
              <tr>
                  <td class="renglon_titulo">Usuario conex: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" name="fn_user" id="fi_user" maxlength="7" size="10" placeholder="Conex"/>
                  </td> 
              </tr>

                
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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
              <h2 style="color:blue;text-align:center" class="modal-title">
                Editar Usuario
            </h2>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- INICIA EL BODY -->
            <div style="color:#000000;background:#e3f2fd" class="modal-body">
             <input type="hidden" id="idusuario" name="idusuario" value="0">
             <input type="hidden" id="opcion" name="opcion" value="modificar">
             <table >
                  <!-- Id perfil -->
                  <tr>
                    <td class="renglon_titulo"> Id Usuario: </td>
                    <td class="renglon_valor" class="form-control" >
                        <input type="text" name="fn_id_usuario" id="fi_id_usuario" readonly="readonly" maxlength="11" size="11" placeholder="Asignado por el sistema"/>
                    </td>
                  </tr>

                  <!-- usr -->
                  <tr>
                      <td class="renglon_titulo">Usuario:</td>
                      <td class="renglon_valor" class="form-control">
                          <input type="text" required name="fn_id_usr" id="fi_id_usr" maxlength="45" size="45" placeholder="Usuario"/>
                      </td>
                  </tr>

                  <!-- sucursal -->  
                  <tr>
                    <td class="renglon_titulo">Sucursal: </td>
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


                  <!-- password -->
                  <tr>
                      <td class="renglon_titulo">Contraseña:</td>
                      <td class="renglon_valor" class="form-control">
                          <input type="password" required name="fn_pass" id="fi_pass" maxlength="10" size="10" placeholder="Contraseña"/>
                      </td>
                  </tr>

                  <!-- Estado del registro -->
                  <tr>
                    <td>Estado</td>
                    <td>
                        <select class="" id="fi_estado" name="fn_estado">
                           <option value="A">Activo</option>
                           <option value="S">Suspendido</option>
                        </select>
                    </td>
                  </tr>

                  <!-- perfil -->  
                  <tr>
                    <td class="renglon_titulo">Perfil: </td>
                    <td class="renglon_valor" class="form-control">
                      <select name="fn_perfil" id="fi_perfil">
                        <?php
                          $sql="SELECT * FROM se_perfiles where estado = 'A'";
                          $rec=mysqli_query($conexion,$sql);
                          while ($row=mysqli_fetch_array($rec))
                            {
                              echo "<option value='".$row['id_perfil']."' >";
                              echo $row['desc_perfil'];
                              echo "</option>";
                            }
                        ?>
                      </select>
                    </td>
                  </tr>  


                      <!-- servicio -->  
                  <tr>
                    <td class="renglon_titulo">Servicio: </td>
                    <td class="renglon_valor" class="form-control">
                      <select  name="fn_servicio" id="fi_servicio">
                        <?php
                          $sql="SELECT * FROM km_servicios where estado = 'A'";
                          $rec=mysqli_query($conexion,$sql);
                          while ($row=mysqli_fetch_array($rec))
                            {
                              echo "<option value='".$row['id_servicio']."' >";
                              echo $row['desc_servicio'];
                              echo "</option>";
                            }
                        ?>
                      </select>
                    </td>
                  </tr> 

                  <!-- nombre-->
                  <tr>
                      <td class="renglon_titulo">Nombre: </td>
                      <td class="renglon_valor" class="form-control">
                            <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="25" size="25" placeholder="Nombre del usuario"/>
                      </td> 
                  </tr>

                  <!-- paterno-->
                  <tr>
                      <td class="renglon_titulo">A. Paterno: </td>
                      <td class="renglon_valor" class="form-control">
                            <input type="text" required name="fn_apaterno" id="fi_apaterno" maxlength="25" size="25" placeholder="Apellido paterno"/>
                      </td> 
                  </tr>

                  <!-- materno-->
                  <tr>
                      <td class="renglon_titulo">A. Materno: </td>
                      <td class="renglon_valor" class="form-control">
                            <input type="text" required name="fn_amaterno" id="fi_amaterno" maxlength="25" size="25" placeholder="Apellido paterno"/>
                      </td> 
                  </tr>

                  
              <!-- iniciales-->
              <tr>
                  <td class="renglon_titulo">Iniciales: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_iniciales" id="fi_iniciales" maxlength="8" size="8" placeholder="Iniciales"/>
                  </td> 
              </tr>
                
                  <!-- Telefono fijo-->
                  <tr>
                      <td class="renglon_titulo">T. Fijo: </td>
                      <td class="renglon_valor" class="form-control">
                            <input type="text" required name="fn_tfijo" id="fi_tfijo" maxlength="15" size="15" placeholder="Telefono fijo"/>
                      </td> 
                  </tr>

                  <!-- Telefono Movil-->
                  <tr>
                      <td class="renglon_titulo">T. Movil: </td>
                      <td class="renglon_valor" class="form-control">
                            <input type="text" required name="fn_tmovil" id="fi_tmovil" maxlength="15" size="15" placeholder="Telefono novil"/>
                      </td> 
                  </tr>

                  <!-- direccion-->
                  <tr>
                      <td class="renglon_titulo">Direccion: </td>
                      <td class="renglon_valor" class="form-control">
                            <input type="text" required name="fn_direccion" id="fi_direccion" maxlength="120" size="35" placeholder="Direccion"/>
                      </td> 
                  </tr>

                  <!-- mail-->
                  <tr>
                      <td class="renglon_titulo">Mail: </td>
                      <td class="renglon_valor" class="form-control">
                            <input type="mail" required name="fn_mail" id="fi_mail" maxlength="50" size="50" placeholder="Mail"/>
                      </td> 
                  </tr>

                  <!-- Fecha de alta -->
                  <tr>
                      <td class="renglon_titulo">Fecha Alta: </td>
                      <td class="renglon_valor" class="form-control">
                            <input type="date" required name="fn_falta" id="fi_falta" maxlength="11" size="11" placeholder="Fecha  Alta"/>
                      </td> 
                  </tr>

                  <!-- Fecha de actualización -->
                  <tr>
                      <td class="renglon_titulo">Fecha Actualizacion: </td>
                      <td class="renglon_valor" class="form-control">
                            <input type="text" readonly="readonly" disabled  value="<?php echo $FechaHoy;?>" name="fn_factualiza" id="fi_factualiza" maxlength="15" size="20" placeholder="Fecha  Alta"/>
                      </td> 
                  </tr>              

                        <!-- Hora de entrada L-V -->
              <tr>
                  <td class="renglon_titulo">Hora de Entrada L-V: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_entra" id="fi_entra" required="" />
                  </td> 
              </tr>   

              <!-- Hora de salida L-V -->
              <tr>
                  <td class="renglon_titulo">Hora de Salida L-V: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_salida" id="fi_salida" required="" />
                  </td> 
              </tr>    

               <!-- Hora de entrada sabado -->
              <tr>
                  <td class="renglon_titulo">Hora de Entrada Sabado: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_entra_s" id="fi_entra_s" required="" />
                  </td> 
              </tr>   

               <!-- Hora de salida sabado -->
              <tr>
                  <td class="renglon_titulo">Hora de Salida Sabado: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_salida_s" id="fi_salida_s" required="" />
                  </td> 
              </tr>  

               <!-- Hora de entrada domingo -->
              <tr>
                  <td class="renglon_titulo">Hora de Entrada Domingo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_entra_d" id="fi_entra_d" required="" />
                  </td> 
              </tr>  

               <!-- Hora de salida domingo -->
              <tr>
                  <td class="renglon_titulo">Hora de Salida Domingo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_salida_d" id="fi_salida_d" required="" />
                  </td> 
              </tr>  

               <!-- Hora de entrada día festivo -->
              <tr>
                  <td class="renglon_titulo">Hora de Entrada D&iacute;a Festivo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_entra_f" id="fi_entra_f" required="" />
                  </td> 
              </tr>  

               <!-- Hora de salida día festivo -->
              <tr>
                  <td class="renglon_titulo">Hora de Salida D&iacute;a Festivo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="time" required name="fn_salida_f" id="fi_salida_f" required="" />
                  </td> 
              </tr>  
              
              <!-- usuario-->
              <tr>
                  <td class="renglon_titulo">Usuario conex: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" name="fn_user" id="fi_user" maxlength="7" size="10" placeholder="Conex"/>
                  </td> 
              </tr>
                
             </table>  
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
        <h4 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h4>
      </div>
      <div class="modal-body">
        <form id="frmEliminarusuario" action="controladores/eliminar_usuarios.php" method="POST">
          Esta seguro de eliminar el usuario? <strong data-name=""></strong>
           <input type="hidden" id="idusuario" name="idusuario" value="">
            <input type="hidden" id="opcion" name="opcion" value="eliminar">
                ID
              <input id="usuario" name="usuario" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
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
