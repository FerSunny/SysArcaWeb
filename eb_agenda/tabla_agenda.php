<?php
include ("../controladores/conex.php");
 
 
$sql = "SELECT id_evento, title, notas, start, start_time, end, end_time, color FROM eb_eventos WHERE estado = 'A'";

 $stmt = $conexion->prepare($sql);
 $stmt->execute();
 $stmt->bind_result($id,$title,$notas,$start,$start_t,$end,$end_t, $color);
 session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
    
  {
?>
 
<!DOCTYPE html>
<html lang="es">
 
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
 
    <title>Inicio</title>
 
    <!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">
    <!-- FontAwesome 5 14/03/2019-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	
	<!-- FullCalendar -->
	<link href='./calendar/css/fullcalendar.css' rel='stylesheet' />
 
 
    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        
    }
	#calendar {
		max-width: 800px;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}
    </style>
 
 
 
</head>
 
<body background="../imagenes/logo_arca_sys_web.jpg">
    <?php 
      include "../includes/barra.php";
      include "./forms/forms.php";
     ?>
    <!-- Page Content -->
    <div class="container">
 
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Eventos</h1>
                <p class="lead">Agenda de proveedores.</p>
                <div id="calendar" class="col-centered">
                </div>
            </div>
			
        </div>
        <!-- /.row -->
		
		
    </div>
    <script src="../media/alert/dist/sweetalert2.js"></script>
    <!-- /.container -->
 
    <!-- jQuery Version 1.11.1 -->
    <script src="./calendar/js/jquery.js"></script>
 
    <!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>
    
    <!-- DataTable 1.10.19 14/03/2019-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='./calendar/js/moment.min.js'></script>
	<script src='./calendar/js/fullcalendar/fullcalendar.min.js'></script>
	<script src='./calendar/js/fullcalendar/fullcalendar.js'></script>
	<script src='./calendar/js/fullcalendar/locale/es.js'></script>
	<script type="text/javascript">
  window.onload=function(){
    alert('Evento pendiente ');
  }
  </script> 
  <script>
  var f = new Date();
  document.write(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
  </script>
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
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$("#form-edit label").attr("class","active")
					$('#form-edit #id').val(event.id);
					$('#form-edit #title').val(event.title);
					$('#form-edit #notas').val(event.notas);
					$('#form-edit #start').val(event.s1);
					$('#form-edit #start-time').val(event.s2);
					$('#form-edit #end').val(event.e1);
					$('#form-edit #end-time').val(event.e2);
					$('#form-edit #color-fecha').val(event.color);
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
				while ($stmt->fetch()) 
				{
					$events = array($id,$title,$notas,$start,$start_t,$end,$end_t,$color);
 				
			?>


				{
					id: '<?php echo $events[0]; ?>',
					title: '<?php echo $events[1]; ?>',
					notas: '<?php echo $events[2]; ?>',
					start: '<?php echo $events[3]." " .$events[4]; ?>',
					end: '<?php echo $events[5]." " .$events[6]; ?>',
					color: '<?php echo $events[7]; ?>',
					s1: '<?php echo $events[3]; ?>',
					s2: '<?php echo $events[4]; ?>',
					e1: '<?php echo $events[5]; ?>',
					e2: '<?php echo $events[6]; ?>',
				},
			<?php } ?>
			]
		});
		
		function edit(event,e){
			
			e.preventDefault()

			Event = [];
			Event[0] = id;
			Event[1] = title;
			Event[2] = notas;
			Event[3] = s1;
			Event[4] = s2;
			Event[5] = e1;
			Event[6] = e2;
			Event[7] = color;
			
			
			$.ajax({
			 url: './controladores/editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Evento se ha guardado correctamente');

					}else{
						alert('No se pudo guardar. Inténtalo de nuevo.'); 
					}
				}
			});
		}
		
	});


	$("#form-add").on('submit', function (e) 
  {
      e.preventDefault()
      $.ajax({
          type: "POST",                 
          url: "./controladores/addEvent.php",                    
          data: $("#form-add").serialize(),
          beforeSend: function(){
          },
          success: function(data)            
            {
              if(data==1)
              {
              	Swal.fire({
                  title: 'Evento Agregado Correctamente',
                  text: "Click continuar",
                  type: 'success',
                  confirmButtonText: 'Continuar'
                }).then((result) => {
                  if (result.value) {
                    location.reload()
                  }
                })
                console.log(data)
              }
              else
              {
                swal('Error en MySQL, Error numero:  '+ data)
                console.log(data)
              }
            }
          });          
  });


  $("#form-edit").on('submit', function (e) 
  {
      e.preventDefault()
      $.ajax({
          type: "POST",                 
          url: "./controladores/editEventDate.php",                    
          data: $("#form-edit").serialize(),
          beforeSend: function(){
          },
          success: function(data)            
            {
              if(data==1)
              {
                Swal.fire({
                  title: 'Evento Actualizado Correctamente',
                  text: "Click continuar",
                  type: 'success',
                  confirmButtonText: 'Continuar'
                }).then((result) => {
                  if (result.value) {
                    location.reload()
                  }
                })
                console.log(data)
              }else
              if(data == 2)
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
                swal('Error en MySQL, Error numero:  '+ data)
                console.log(data)
              }
            }
          });          
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