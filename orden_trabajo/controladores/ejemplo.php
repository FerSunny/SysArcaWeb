<?php
  include("../controladores/conex.php");

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Orden de trabajo</title>
    <link rel="stylesheet" href="../media/css/bootstrap.min.css">
    <link rel="stylesheet" href="../media/css/dataTables.bootstrap.min.css">
    <!-- Buttons DataTables -->
    <link rel="stylesheet" href="../media/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="../media/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="estilos/css_arca.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/i18n/defaults-*.min.js"></script>
  </head>
  <body background="../imagenes/logo_arca_sys_web.jpg">
    <?php   include("../includes/barra.php"); ?>
<div class="row">
  <div class="col-md-6"><h1>Solicitud del Paciente</h1></div>
  <div class="col-md-6" id="boton1"><button type="button" id="myBtn" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModal"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Buscar Estudio </button></div>
</div>

<div>
<form class="" action="index.html" idmethod="post"  id="frm1">
    <table class="table" border="1px">
        <tr>
            <th id="tamano"><label for="id1">Unidad</label></th>
            <th id="tamano2" colspan="3">
              <select class="form-control op" name="edit1" >
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
            <th WIDTH="50" 
	    HEIGHT="20">Folio</th>
            <th WIDTH="50" 
	    HEIGHT="50"><input type="text" size="3" name=""  value=""></th>
            <th WIDTH="50" 
	    HEIGHT="50">Fecha</th>
            <th ><input type="text" name="" size="10" value=""></th>
        </tr>
        <tr>
            <th WIDTH="50" 
	    HEIGHT="50">Fecha Entrega</th>
            <th><input type="text" name="" size="3" value=""></th>
            <th>Hora Entrega</th>
            <th><input type="text" name="" size="10" value=""></th>
        </tr>
        <tr>
            <th>Paciente</th>
            <th ><input type="text" size="3" name=""  value=""></th>
            <th>Buscar</th>
            <th ><input type="text" size="15" name="" value=""></th>
        </tr>
        <tr>
          <th>Edad</th>
             <th><input type="number" size="3" name="" value=""></th>
             <th>Sexo</th>
             <th><select  name="" >
               <option value="Hombre">Hombre</option>
               <option value="Mujer">Mujer</option>
                 </select></th> 
        </tr>
        <tr>
            <th>Domicilio</th>
            <th colspan="4"><input type="text" name="" size="40"></th>
        </tr>
        <tr>
                <th >Telefono</th>
                <th WIDTH="50"><input type="text" size="10"></th>
                <th>Actividad</th>
                <th><input type="text" size="15"></th>
        </tr>
        <tr>
            <th>Doctor</th>
            <th><input type="text"  name="" size="3" value=""></th>
            <th>Buscar</th>
            <th><input type="text"  size="10" name="" value=""></th>
        </tr>
        <tr>
            <th>Observaciones</th>
            <th colspan="3"><input type="text" name=""  size="40" ></th>
        
        </tr>
        <tr>
            <th>Atendio</th>
            <th colspan="4"><input type="text" size="40" ></th>
        </tr>
        <tr>
            <th>Diagnostico</th>
            <th colspan="4"><input type="text" size="40"></th>
        </tr>
        <tr>
            <th colspan="4"></th>
        </tr>
    </table>
</form>

<form action="" id="formLimpiar">
<table class="table">
    <tr>
        <th>Cantidad</th>
        <th>Estudio</th>
        <th>Precio</th>
    </tr>
    <tr>
        <th>1</th>
        <th><input type="text" name="txtestudio" id="txtestudio" class="form-control txtestudio"></th>
        <th><input type="text" name="txtcosto" id="txtcosto" class="form-control txtcosto" required></th>
    </tr>
     <tr>
        <th>2</th>
        <th><input type="text" name="txtestudio1" id="txtestudio1" class="form-control txtestudio1"></th>
        <th><input type="text" name="txtcosto1" id="txtcosto1" class="form-control txtcosto1" required></th>
    </tr>
</table>
</form>

</div>


 <form action="" >
    <table class="table" border="1px">
            <tr>
                <th ><label for="">Descuento</label></th>
            <th colspan="2"><input type="text" class="form-control descuento" name="descuento" id="descuento" value="0" ></th>
            </tr>
           <tr>
            <th><label for="">Importe</label></th>
            <th colspan="2"><input type="text" name="importe" class="form-control" id="importe" value="0"></th>
            <th><label for="">Acuenta</label></th>
            <th colspan="2"><input type="text" class="form-control cuenta" name="cuenta" id="cuenta" value="0"></th>
        </tr>
        <tr>
            <th colspan=""><label for="">Total</label></th>
            <th colspan="2"><input type="text" class="form-control" name="ttotal" id="ttotal" value="0"></th>
            <th colspan=""><label for="">Resta</label></th>
            <th colspan="2"><input type="text" class="form-control resta" name="resta" id="resta" value="0"></th>
        </tr>
        <tr>
            <th colspan=""><input type="button" class="btn btn-primary" value="Cobrar" onclick="calcular_total()"/></th>
            <th colspan=""><input type="button" class="btn btn-primary" value="Guardar" onclick=""/></th>
            <th colspan=""><input type="button" class="btn btn-primary" value="Generar PDF" onclick=""/></th>
            <th colspan=""><button type="button" class="btn btn-primary" id="btnLimpiar">Limpiar</button></th>
        </tr>
    </table>  
      </form> 
       
<footer>
<h4>Laboratorios Arca</h4>
</footer>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" background="../imagenes/logo_arca_sys_web.jpg" >
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Catalogo de Estudios</h4>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" method="POST" id="modal1">
           <label for=""><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Buscar</label>
            <input type="text" name="busqueda" class="form-control" id="busqueda" value="" placeholder="Ingresa el ID de Busqueda" maxlength="30" autocomplete="off" onKeyUp="buscar();" />
          </form>
           <table>
            <div id="resultadoBusqueda"></div>
            </table>
            <input type="button" name="boton02" class="btn btn-primary" id="boton02" value="Agregar Datos">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



<!-- Inicio Scripts -->
<script type='text/javascript' src='http://code.jquery.com/jquery-1.7.2.min.js'></script>
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
<script language="javascript" src="js/lenguajeusuario.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
<script>
$(document).ready(function(){
    $("select[name=edad]").change(function(){
            alert($('select[name=edad]').val());
            var va1=$('input[name=costo]').val($(this).val());
        });
    $("select[name=edad1]").change(function(){
            alert($('select[name=edad1]').val());
            var va2=$('input[name=costo2]').val($(this).val());
        });
        
})
</script>

<script type="text/javascript">
function calcular_total() {
	importe1 = 0
    importe2=0
    cuenta=0;
	$(".txtcosto").each(
		function(index, value) {
			importe1 = eval($(this).val());
		}
	); 
    $(".txtcosto1").each(
		function(index, value) {
			importe2 =eval($(this).val());
		}
	);
     $(".cuenta").each(
		function(index, value) {
			cuenta =eval($(this).val());
		}
	);
    $("#importe").val(importe1 + importe2);
	$("#ttotal").val(importe1 + importe2);
    $("#resta").val((importe1 + importe2)-cuenta)
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
function buscar() {
    var textoBusqueda = $("input#busqueda").val();
	
    if (textoBusqueda != "") {
        $.post("Buscar.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
        }); 
    } else { 
        ("#resultadoBusqueda").html('');
	};
};
    
    $(document).ready(function() {
    $("#resultadoBusqueda").html('<label>Ningun Resultado</label>');
});
    
</script>

<script>
   $("#btnLimpiar").click(function(event) {
	   $("#formLimpiar")[0].reset();
   });
</script>

<!-- Fin Scripts -->
  </body>
</html>