<?php

  include("../controladores/conex.php");
date_default_timezone_set('America/Mexico_City');


$fecha=date("d/m/Y H:i:s");
$hora=date("H:i:s");

/*$query = "SELECT id_solicitud FROM so_cabezal";
$resultado = mysqli_query($conexion, $query);
if($row = mysqli_fetch_array($resultado))
{
    $folio=$row['id_solicitud'];
    $ffolio=$folio + 1;
}
else
{
    $sinfolio = "00";
}*/
session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" type="text/css" href="estilos/css_arca.css"/>
    <link rel="stylesheet" href="../media/css/bootstrap.min.css">
    <link rel="stylesheet" href="../media/css/dataTables.bootstrap.min.css">
    <!-- Buttons DataTables -->
    <link rel="stylesheet" href="../media/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="../media/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Select Search-->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <!--Select Search-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
  <!-- DataTables -->
    <script type="text/javascript" src="js/tabla_doctor.js"></script>
    <script type="text/javascript"  src="js/tabla_clientes.js"></script>
    <script type="text/javascript" src="js/tabla_orden.js"></script>
    
</head>
<body background="../imagenes/logo_arca_sys_web.jpg">
<?php   include("../includes/barra.php"); ?>
<?php include("formularios/modales.php"); ?>

<div class="row">
  <div class="col-md-8">
  </div>
  <div class="col-md-4">
  <button type="button" class="btn btn-primary pull-right menu" id="myBtn" data-toggle="modal" data-target="#myModal"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Lista de Estudios</button>
  </div>
</div>

<div class="row">
<div class="col-sm-6">
         <div class="thumbnail" id="caja" style="background: #EFFBF5">
          <div class="table-responsive">
          <form class="" action="controladores/agregar_orden.php" method="post"  id="frm1">
               <input type="hidden" name="idpaciente" id="idpaciente" class="idpaciente" value="">
          <input type="hidden" name="idmedico" id="idmedico" class="idmedico" value="0">
           <table>
            <tr class="solicitud">
           <th colspan="4">Datos del Paciente</th>
       </tr>
        <tr>
            <th>Unidad</th>
            <th>
              <select name="unidad" >
                 <?php
                    $sql="SELECT * FROM kg_sucursales";
                    $rec=mysqli_query($conexion,$sql);
                    while ($row=mysqli_fetch_array($rec))
                    {
                      echo "<option value='".$row['id_sucursal']."' >";
                      echo $row['des_sucursal'];
                      echo "</option>";
                    }
                 ?>
              </select>
            </th>
          </tr>
          
        <tr>
            <th>Folio</th>
            <th><input type="text" size="3" name="folio"  value="<?php echo $ffolio; ?>"></th>
            <th>Fecha</th>
            <th><input type="text" name="fecha" height="" size="13" value="<?php echo $fecha; ?>"></th>
        </tr>
        <tr>
            <th>Fecha Entrega</th>
            <th><input type="date" name="fechaentrega" size="0" value=""></th>
            <th>Hora Entrega</th>
            <th><input type="time" name="hora" size="0" value=""></th>
        </tr>
        <tr>
            <th>Buscar Paciente</th>
            <th><button type="button" class="btn btn-primary pull-right menu" id="myBtn1" data-toggle="modal" data-target="#myModal"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Lista de Pacienes</button>
            </th>
            <th colspan="2"></th>
        </tr>
        <tr>
           <th>Nombre</th>
            <th colspan="3"><input type="text" name="nombre" size="45" id="nombre" class="nombre"></th>
        </tr>
        <tr>
          <th>Edad</th>
             <th><input type="number" size="3" name="edad" id="edad" class="edad" value=""></th>
             <th>Sexo</th>
             <th><select  name="sexo" id="sexo" class="sexo" >
               <option value=""></option>
               <option value="H">Hombre</option>
               <option value="M">Mujer</option>
                 </select></th> 
        </tr>
        <tr>
                <th >Telefono</th>
                <th colspan="3"><input type="text" name="telefono" id="telefono" class="telefono" size="10"></th>
        </tr>
          <tr>
            <th>Buscar Docotor</th>
            <th><button type="button" class="btn btn-primary pull-right menu" id="myBtn2" data-toggle="modal" data-target="#myModal"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Lista de Docotores</button>
            </th>
            <th colspan="2"></th>
        </tr>
        <tr>
            <th>Doctor(a)</th>
            <th colspan="4"><input type="text" name="doctor" size="45" id="doctor" class="docotor"></th>
        </tr>
        <tr>
            <th>Observaciones</th>
            <th colspan="4"><input type="text" name="obs"  size="45" ></th>
        
        </tr>
        <tr>
            <th>Atendio</th>
            <th colspan="4"><input type="text" name="atendio" size="45" ></th>
        </tr>
        <tr>
            <th>Diagnostico</th>
            <th colspan="4"><input type="text" name="diagnostico" size="45"></th>
        </tr>
          </table>
             </div>
          </div>
</div>
      <div class="col-sm-6">
          <div class="thumbnail caja" style="background: #EFFBF5">
            <div class="table-responsive">   
            <table>
               <input type="hidden" name="f1" id="f1" class="f1" value="0">
               <input type="hidden" name="f2" id="f2" class="f2" value="0">
               <input type="hidden" name="f3" id="f3" class="f3" value="0">
               <input type="hidden" name="f4" id="f4" class="f4" value="0">
               <input type="hidden" name="f5" id="f5" class="f5" value="0">
               <input type="hidden" name="c1" id="c1" class="c1" value="0">
               <input type="hidden" name="c2" id="c2" class="c2" value="0">
               <input type="hidden" name="c3" id="c3" class="c3" value="0">
               <input type="hidden" name="c4" id="c4" class="c4" value="0">
               <input type="hidden" name="c5" id="c5" class="c5" value="0">
                    <tr id="titulos">
                        <th>N°</th>
                        <th>Lista de Estudios</th>
                        <th>Precio</th>
                    </tr>
                    <tr>
                        <th>1</th>
                        <th><input type="text" name="txtestudio" id="txtestudio" class="txtestudio" size="50"></th>
                        <th id="titulos2" WIDTH="20" HEIGHT="20"><input type="text" name="txtcosto" id="txtcosto" class="txtcosto" size="6" value="0"></th>
                    </tr>
                     <tr>
                        <th>2</th>
                        <th><input type="text" name="txtestudio1" id="txtestudio1" class="txtestudio1" size="50"></th>
                        <th id="titulo2"><input type="text" name="txtcosto1" id="txtcosto1" class="txtcosto1" size="6" value="0"></th>
                    </tr>
                    <tr>
                        <th>3</th>
                        <th><input type="text" name="txtestudio2" id="txtestudio2" class="txtestudio2" size="50"></th>
                        <th id="titulos2"><input type="text" name="txtcosto2" id="txtcosto2" class="txtcosto2" size="6" value="0"></th>
                    </tr>
                    <tr>
                        <th>4</th>
                        <th><input type="text" name="txtestudio3" id="txtestudio3" class="txtestudio3" size="50"></th>
                        <th id="titulo2"><input type="text" name="txtcosto3" id="txtcosto3" class="txtcosto3" size="6" value="0"></th>
                    </tr>
                    <tr>
                        <th>5</th>
                        <th><input type="text" name="txtestudio4" id="txtestudio4" class="txtestudio4" size="50"></th>
                        <th id="titulos2"><input type="text" name="txtcosto4" id="txtcosto4" class="txtcosto4" size="6" value="0"></th>
                    </tr>
                </table>
              </div>
          </div>
      </div>
</div>
<div class="row">
      <div class="col-sm-6">
       </div>
      <div class="col-sm-6">
          <div class="thumbnail caja" style="background: #EFFBF5">
            <div class="table-responsive">   
            <table>
            <tr>
                <th>Autoriza Comision</th>
                <th colspan="3"><input type="text" size="30" name="autoriza" id="autoriza"></th>
            </tr>
            <tr>
                <th >Descuento</th>
                <th><input type="text" class="descuento" size="6" name="descuento" id="descuento" value="0" ></th>
                <th>Comision</th>
                <th><select name="comision" id="comision">
                    <option value="SI">Si</option>
                    <option value="NO">No</option>
                </select></th>
            </tr>
           <tr>
            <th>Importe</th>
            <th><input type="text" name="importe" size="6" class="importe" id="importe" value="0"></th>
            <th>Acuenta</th>
            <th><input type="text" class="cuenta" size="6" name="cuenta" id="cuenta" value="0"></th>
            
        </tr>
        <tr>
            <th>Total</th>
            <th><input type="text" class="ttotal" name="ttotal" size="6" id="ttotal" value="0"></th>
            <th>Resta</th>
            <th><input type="text" class="resta" name="resta" size="6" id="resta" value="0"></th>

        </tr>
        <tr>
            <th colspan=""><input type="" class="btn btn-primary" size="5" value="Cobrar" onclick="calcular_total()"/></th>
            <th colspan=""><input type="submit" class="btn btn-primary" size="5" value="Guardar" onclick=""/></th>
            <th colspan=""><input type="" class="btn btn-primary" size="5" value="PDF" onclick=""/></th>
            <th colspan=""><button type="" class="btn btn-primary" size="5" id="btnLimpiar">Limpiar</button></th>
        </tr>
    </table>
     </form>        
          </div>
         </div>
      </div>
</div>




    <script src="../media/js/jquery-1.12.3.js"></script>
    <script src="../media/js/bootstrap.min.js"></script>
    <script src="../media/js/jquery.dataTables.min.js"></script>
    <script src="../media/js/dataTables.bootstrap.js"></script>
    <!--botones DataTables-->
    <script src="../media/js/dataTables.buttons.min.js"></script>
    <script src="../media/js/buttons.bootstrap.min.js"></script>
    <!--Libreria para exportar Excel-->
    <script src="../media/js/jszip.min.js"></script>
    <!--Librerias para exportar PDF-->
    <script src="../media/js/pdfmake.min.js"></script>
    <script src="../media/js/vfs_fonts.js"></script>
    <!--Librerias para botones de exportación-->
    <script src="../media/js/buttons.html5.min.js"></script>
    <script src="js/modales.js"></script>
    <script languague="javascript">
        function mostrar() {
            div = document.getElementById('flotante');
            div.style.display = '';
        }

        function cerrar() {
            div = document.getElementById('flotante');
            div.style.display = 'none';
        }
</script>

<script>
$(document).ready(function(){
   $("select[name=edit2]").change(function(){
            alert($('select[name=edit2]').val());
            var va1=$('input[name=atendio]').val($(this).val());
        });
        
})
</script>

<script type="text/javascript">
function calcular_total() {
	importe1 = 0;
    importe2=0;
    importe3=0;
    importe4=0;
    importe5=0;
    des=0;
    total=0;
    cuenta=0;
     $(".cuenta").each(
		function(index, value) {
			cuenta =eval($(this).val());
		}
	);
     $(".descuento").each(
		function(index, value) {
			desc =eval($(this).val());
            porciento = desc / 100;
            alert(porciento);
		}
	);
     $(".importe").each(
		function(index, value) {
			total =eval($(this).val());
            res1=total * porciento;
            res2=total-res1;
           alert(res2);
		}
	);
    $("#ttotal").val(res2);
    total=parseFloat((res2)-cuenta);
    total=total.toFixed(1)
    $("#resta").val(total);
}
 
</script>

<script type="text/javascript">
$(document).ready(function()
	{
	$("#boton02").click(function () {
	//saco el valor accediendo a un input de tipo text y name = nombre2 y lo asigno a uno con name = nombre3 
	   
      if ($('#txtestudio').val() === '' && $('#txtcosto').val() === '' ) {
       $("#txtestudio").val($("#estudio").val());
    $("#txtcosto").val($("#costo").val());
    } else 
    if($('#txtestudio1').val() === '' && $('#txtcosto1').val() === '' ){
       $("#txtestudio1").val($("#estudio").val());
    $("#txtcosto1").val($("#costo").val()); 
    }else
     if($('#txtestudio').val() && $('#txtcosto').val()&& $('#txtestudio1').val()&& $('#txtcosto1').val()){
         alert('Ya no puedes agregar mas estudios')
     }
    
	});		
});
</script>

<script>
   $("#btnLimpiar").click(function(event) {
	   $("#formLimpiar")[0].reset();
   });
</script>
</body>
</html>
<?php
  }
  else
  {
    header("location: ../index.html");
  }
 ?>