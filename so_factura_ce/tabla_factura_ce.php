<?php
	header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
	session_start();
	include ("../controladores/conex.php");
	include "controladores/buscar_estudios.php";

	$buscar = new Estudios();

	$fk_id_sucursal = $_SESSION['fk_id_sucursal'];
	$sql = "SELECT fa.id_factura, 
	CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciete, 
	'Estudios' notas, fa.fecha_cita, fa.hora_cita, fa.fecha_cita, 
	ADDTIME(fa.hora_cita, '00:10:00') end_time, 
	color,
	fa.diagnostico,
	CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) medico
	FROM ce_factura fa
	LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
	LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico)
	WHERE status = 'P' AND fa.fk_id_sucursal  = $fk_id_sucursal";

	 $stmt = $conexion->prepare($sql);
	 $stmt->execute();
	 $result = $stmt->get_result();
	 $stmt->close();
	if ($_SESSION['ingreso']=='YES')
  	{
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.10.1/css/mdb.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">
    <!-- FullCalendar -->
    <link href='./calendar/css/fullcalendar.css' rel='stylesheet' />
</head>
<body background="../imagenes/logo_arca_sys_web.jpg">
	<?php include("../includes/barra.php");?>
	<div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Eventos</h1>
                <p class="lead">Citas</p>
                <div id="calendar" class="col-centered">
                </div>
            </div>
        </div>
    </div>
    <?php include "./forms/forms.php"; ?>
	<script src="../media/alert/dist/sweetalert2.js"></script>
    <!-- JQuery -->
	<script src="./calendar/js/jquery.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.10.1/js/mdb.min.js"></script>
	<!-- FullCalendar -->
	<script src='./calendar/js/moment.min.js'></script>
	<script src='./calendar/js/fullcalendar/fullcalendar.min.js'></script>
	<script src='./calendar/js/fullcalendar/fullcalendar.js'></script>
	<script src='./calendar/js/fullcalendar/locale/es.js'></script>
	<script>
		$(document).ready(function() {

	    var date = new Date();
	       var yyyy = date.getFullYear().toString();
	       var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
	       var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

	    $('#calendar').fullCalendar({
	      header: {
	         language: 'es',
	        left: 'prev,next today',
	        center: 'title',
	        right: 'month,basicWeek,basicDay',

	      },
	      defaultDate: yyyy+"-"+mm+"-"+dd,
	      editable: true,
	      eventLimit: true, // allow "more" link when too many events
	      selectable: true,
	      selectHelper: true,
	      select: function(start, end) {
	        //editEventTitle.php
	        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
	        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
	        //$('#ModalAdd').modal('show');
	      },
	      eventRender: function(event, element) {
	        element.bind('dblclick', function() {
	          $("#form-edit label").attr("class","active")
	          $('#form-edit #id').val(event.id);
	          $('#form-edit #paciente').val(event.title);
	          $("#form-edit .estudios").html(event.estudios);
	          $("#form-edit #total").val(event.costo)
	          $('#form-edit #medico').val(event.medico);
	          $('#form-edit #dx').val(event.dx);
	          $('#ModalEdit').modal('show');
	        });
	      },
	      eventDrop: function(event, delta, revertFunc) { // si changement de position

	        //edit(event);

	      },
	      eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

	        //edit(event);

	      },
	      events: [
	      <?php

	        while ($row =  $result->fetch_assoc())
	        {
	          $events = array($row['id_factura'],$row['paciete'],$row['notas'],$row['fecha_cita'],$row['hora_cita'],$row['fecha_cita'],$row['end_time'],$row['color'], $row['diagnostico'], $row['medico']);



	      ?>


	        {
	          id: '<?php echo $events[0]; ?>',
	          title: '<?php echo $events[1]; ?>',
	          estudios: '<?php echo $buscar->Buscar($conexion,$events[0]); ?>',
	          start: '<?php echo $events[3]." " .$events[4]; ?>',
	          end: '<?php echo $events[5]." " .$events[6]; ?>',
	          color: '<?php echo $events[7]; ?>',
	          medico: '<?php echo $events[9]; ?>',
	          dx: '<?php echo $events[8]; ?>',
	          costo: '<?php echo $buscar->Costo($conexion,$events[0]); ?>',
	        },
	      <?php } ?>
	      ]
	    });

	  });

		$("#form-edit").submit(function(e)
		  {
		      e.preventDefault()

		      $.ajax({
			      type: "POST",
			      url: "controladores/acciones.php",
			      data:$("#form-edit").serialize() ,
			      beforeSend: function(){
			      },
			      success: function(datas)
			        {
			         	if(datas.ok == '1')
			              {
			                Swal.fire({
			                title: 'Se registro la nota',
			                text: "Imprimir o continuar",
			                type: 'success',
			                showCancelButton: true,
			                confirmButtonColor: '#3085d6',
			                cancelButtonColor: '#d33',
			                cancelButtonText: 'Modificar',
			                confirmButtonText: 'Imprimir'
			              }).then((result) => {
			                  if (result.value)
			                  {
			                      window.open("../so_factura/reports/factura.php?numero_factura="+datas.id, '_blank')
			                      window.open("../so_factura/reports/tikets.php?numero_factura="+datas.id, '_blank')
			                      location.reload();
			                       
			                  }else
			                  {
			                    window.open("modificar_nota/editar_factura.php?id_factura="+datas.id, '_blank')
			                    location.reload();
			                  }
			              })
			              }else
			              if(datas.eliminar == '1')
			              {
			                Swal.fire({
			                  title: 'Evento Eliminado Correctamente',
			                  text: "Click continuar",
			                  type: 'success',
			                  confirmButtonText: 'Continuar'
			                }).then((result) => {
			                  if (result.value) {
			                    location.reload()
			                  }
			                })
			              }
			              else
			              {
			                swal('Error en MySQL, Error numero:  '+ datas)
			                console.log(datas)
			              }
			        }
			    });
					      
		  });


  $("#delete").change(function(){
      $("#a_cuenta").removeAttr("required","required")
      $("#entrega").removeAttr("required","required")
      $("#tipo_pago").removeAttr("required","required")
      $("#dx").removeAttr("required","required")
  }) 

  $("#a_cuenta").keyup(function(){

      var total = $("#total").val()
      var cuenta = parseFloat($("#a_cuenta").val())

      console.log(total)
      console.log(cuenta)


      resta = total-cuenta
      console.log(resta)

      if(resta < 0)
      {
        swal("El saldo no puede ser negativo")
        $("#a_cuenta").val("")
        $("#resta").val("")
      }else
      {
        $("#resta").val(resta)
      }
  });
	</script>
</body>
</html>
<?php
  }
  else
  {
    header("location: index.html");
  }
 ?>
