<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>



<div class="modal fade" id="modalClientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:#9a9a9a;font-family:Mailpile-Normal;">Nuevo Cliente</h4>
            </div>
            <div class="modal-body" style="text-align:left;">
                <form id="fm_create_cliente" >

                <!-- <div class ="form-group">
                        <p class="text-muted">Id Cliente</p>
                        <div class="right-inner-addon ">
                            <input  id="fi_id_cliente" readonly="readonly" name="fn_id_cliente" type="text" class="form-control" placeholder="Asignado por el sistema" />
                        </div>
                    </div> -->

                        <div class="row">
                            <!-- Nombre -->            
                            <div class ="form-group col-md-4">
                                <p class="text-muted">Nombre:</p>
                                <div class="right-inner-addon ">
                                    <input  id="fn_nombre" name="fn_nombre" type="text" class="form-control" maxlength="35" size="35" placeholder="Nombre" />
                                </div>
                            </div>

                            <!-- Apellido Paterno -->
                            
                            <div class ="form-group col-md-4">
                                <p class="text-muted">Apellido Paterno:</p>
                                <div class="right-inner-addon ">
                                    <input  id="fi_apaterno" name="fi_apaterno" type="text" class="form-control" maxlength="35" size="35" placeholder="Apellido Paterno" />
                                </div>
                            </div>

                            <!-- Apellido Materno -->            
                            <div class ="form-group col-md-4">
                                <p class="text-muted">Apellido Materno:</p>
                                <div class="right-inner-addon ">
                                    <input  id="fi_amaterno" name="fi_amaterno" type="text" class="form-control" maxlength="35" size="35" placeholder="Apellido Materno" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Anios -->                    
                            <div class ="form-group col-md-4">
                                <p class="text-muted">Anios:</p>
                                <div class="right-inner-addon ">
                                    <input  id="fi_anios" name="fi_anios" type="number" min="0" max="105" class="form-control" maxlength="35"  placeholder="Anios" />
                                </div>
                            </div>

                            <!-- meses -->                    
                            <div class ="form-group col-md-4">
                                <p class="text-muted">Meses:</p>
                                <div class="right-inner-addon ">
                                    <input  id="fi_meses" name="fi_meses" type="number"  min="0" max="11" class="form-control" maxlength="35"  placeholder="meses" />
                                </div>
                            </div>

                            <!-- dias -->                    
                            <div class ="form-group col-md-4">
                                <p class="text-muted">Dias:</p>
                                <div class="right-inner-addon ">
                                    <input  id="fi_dias" name="fi_dias" type="number" min="0" max="30" class="form-control" maxlength="35"  placeholder="Dias" />
                                </div>
                            </div>

                            <!-- Sexo -->                                          
                            <div class ="form-group col-md-4">
                                    <p class="text-muted">Sexo:</p>
                                    <div style='border: 3px solid red;' class="right-inner-addon ">
                                    <select class="form-control" name="fi_sexo" id="fi_sexo">
                                        <?php
                                        $sql="SELECT * FROM so_sexo where activo = 'A' order by id_sexo desc";
                                        $rec=mysqli_query($conexion,$sql);
                                        while ($row=mysqli_fetch_array($rec))
                                            {
                                            echo "<option value='".$row['id_sexo']."' >";
                                            echo $row['desc_sexo'];
                                            echo "</option>";
                                            }
                                        ?>
                                    </select>
                                    </div>
                                </div>

                                <!-- Estado Civil -->             
                                <div class ="form-group col-md-4">
                                        <p class="text-muted">Estado Civil:</p>
                                        <div class="right-inner-addon ">
                                            <select  name="fi_estado_civil" id="fi_estado_civil">
                                                <?php
                                                $sql="SELECT * FROM kg_estado_civil where estado = 'A'";
                                                $rec=mysqli_query($conexion,$sql);
                                                while ($row=mysqli_fetch_array($rec))
                                                    {
                                                    echo "<option value='".$row['id_estado_civil']."' >";
                                                    echo $row['desc_estado_civil'];
                                                    echo "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                </div>
                        </div>

                        <div class="row">
                            <!-- RFC -->
                            <div class ="form-group col-md-6">
                                <p class="text-muted">RFC</p>
                                <div class="right-inner-addon ">
                                    <input  id="fi_rfc" name="fn_rfc" type="text" class="form-control" maxlength="15"  placeholder="RFC" />
                                </div>
                            </div>

                            <!-- Ocupacion -->              
                            <div class ="form-group col-md-6">
                                <p class="text-muted">Ocupacion:</p>
                                <div class="right-inner-addon ">
                                <select name="fi_ocupacion" id="fi_ocupacion">
                                    <?php
                                    $sql="SELECT * FROM kg_ocupaciones where estado = 'A' ORDER BY desc_ocupacion";
                                    $rec=mysqli_query($conexion,$sql);
                                    while ($row=mysqli_fetch_array($rec))
                                        {
                                        echo "<option value='".$row['id_ocupacion']."' >";
                                        echo $row['desc_ocupacion'];
                                        echo "</option>";
                                        }
                                    ?>
                                </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Telefono fijo -->
                            <div class ="form-group col-md-4">
                                <p class="text-muted">Tel. Fijo:</p>
                                <div class="right-inner-addon ">
                                    <input  id="fi_tfijo" name="fi_tfijo" type="text" class="form-control" maxlength="15"  placeholder="Telefono Fijo" />
                                </div>
                            </div>

                            <!-- Telefono movil -->
                            <div class ="form-group col-md-4">
                                <p class="text-muted">Tel.Movil:</p>
                                <div class="right-inner-addon ">
                                    <input  id="fi_movil" name="fi_movil" type="text" class="form-control" maxlength="15" size="15" placeholder="Telefono Movil" />
                                </div>
                            </div>   
                            
                            <!-- mail -->              
                            <div class ="form-group col-md-4">
                                    <p class="text-muted">Mail:</p>
                                    <div class="right-inner-addon ">
                                        <input  id="fi_mail" name="fi_mail" type="mail" class="form-control" maxlength="50" size="40" placeholder="Mail" />
                                    </div>
                                </div> 

                        </div>

                        <div class="row">
                            <!-- Estado de la republica -->  
                            <div class ="form-group col-md-4">
                                    <p class="text-muted">Estado:</p>
                                    <div class="right-inner-addon ">
                                    <select name="fi_Estado" id="fi_Estado" class="col-md-12">
                                        <?php
                                        $sql="SELECT * FROM ku_estados where estado = 'A' ";
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
                                    </div>
                                </div>

                            <!-- Municipio -->  
                            
                            <div class ="form-group col-md-4">
                                    <p class="text-muted">Municipio:</p>
                                    <div class="right-inner-addon ">
                                    <select name="fi_municipio" id="fi_municipio">
                                        <?php
                                        $sql="SELECT * FROM ku_municipios where estado = 'A' and  fk_id_estado in(9,15) order by desc_municipio ";
                                        $rec=mysqli_query($conexion,$sql);
                                        while ($row=mysqli_fetch_array($rec))
                                            {
                                            echo "<option value='".$row['id_municipio']."' >";
                                            echo $row['desc_municipio'];
                                            echo "</option>";
                                            }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                            <!-- Localidades -->  
                            
                            <div class ="form-group col-md-4">
                                    <p class="text-muted">Localidad:</p>
                                    <div class="right-inner-addon ">
                                    <select name="fi_Localidad" id="fi_Localidad">
                                    <?php
                                    $sql="SELECT * FROM ku_localidades WHERE estado = 'A' AND fk_id_municipio IN (273,275,277,665,681,671,695)
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
                                    </div>
                                </div>                                        
                        </div>

                        <div class="row">
                            <!-- Colonia -->            
                            <div class ="form-group col-md-4">
                                    <p class="text-muted">Colonia:</p>
                                    <div class="right-inner-addon ">
                                        <input  id="fi_colonia" name="fi_colonia" type="text" class="form-control" maxlength="50" size="50" placeholder="Colonia" />
                                    </div>
                                </div> 
                            <!-- CP -->              
                            <div class ="form-group col-md-4">
                                    <p class="text-muted">CP:</p>
                                    <div class="right-inner-addon ">
                                        <input  id="fi_cp" name="fi_cp" type="text" class="form-control" maxlength="6" size="6" placeholder="CP" />
                                    </div>
                                </div> 
                            <!-- Calle -->            
                                <div class ="form-group col-md-4">
                                    <p class="text-muted">Calle:</p>
                                    <div class="right-inner-addon ">
                                        <input  id="fi_calle" name="fi_calle" type="text" class="form-control" maxlength="150" size="60" placeholder="Calle" />
                                    </div>
                                </div>  
                        </div>
                        
                        <div class="row">
                            <!-- Numero -->              
                            <div class ="form-group col-md-4">
                                    <p class="text-muted">Número:</p>
                                    <div class="right-inner-addon ">
                                        <input  id="fi_numero" name="fi_numero" type="text" class="form-control" maxlength="35" size="35" placeholder="Número" />
                                    </div>
                                </div> 


                            <!-- Estado del registro -->
                            <div class ="form-group col-md-4">
                                <p class="text-muted">Estatus:</p>
                                <div class="right-inner-addon ">
                                <select name="estado_reg" id="estado_reg">
                                    <option value="A">Activo</option>
                                    <option value="S">Suspendido</option>
                                </select>
                                </div>
                            </div>     

                            <button id="btn_create_client" class="btn btn-success create col-md-3 " style="margin-top:1.7em;">Registrar Cliente</button>

                        </div>

                        

                  </form>
                </div><!--end of modal body-->
            </div><!--end of modal content-->
        </div><!--end of model dialog-->
    </div><!--end of moal-->