
		$(document).on("ready", function(){
			listar();
      $("#frmedit  #codigo").focus();
    $.fn.dataTable.ext.errMode = 'none';
		});

// listar datos en la tabla de perfiles
		var listar = function(){
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_repo").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "desc_sucursal"},
					{"data" : "fk_id_factura"},
					{"data" : "desc_estudio"},
					{"data" : "fecha_factura"},
          {"data" : "fecha_registro"},
          {"data" : "fecha_validacion"},
          {"data" : "fecha_entrega"},
          {"data" : "fecha_impresion"},
          {
            render: function (data,type,row,meta)
            {
              var dias = row['dias']
              var horas = row['horas']
              var hora1 = '00:00:00'
              


              if(dias == '' || dias == null || horas == '' || horas == null)
              {
                return '<button class="btn btn-info btn-md">Sin Datos</button>'
              }else
              if(dias == 0)
              {
                if( horas <=  hora1)
                {
                  return '<button class="btn btn-success btn-md">A tiempo</button>'
                }else
                {
                  return '<button class="btn btn-warning btn-md">'+horas+' horas de retraso</button>'
                }
                
              }else
              if(dias > 0)
              {
                return '<button class="btn btn-danger btn-md">'+dias+' dias de retraso</button>'
              }else
              {
                return '<button class="btn btn-success btn-md">A tiempo</button>'
              }
            }
          }
        ],
				"language": idioma_espanol
			}); 
}


/* Agregamos una nueva clasificacion  para q no se recargue la pagina */
$("#form_obs").on('submit', function (e) 
  {
      e.preventDefault()
      $.ajax({
          type: "POST",                 
          url: "controladores/agregar.php",                    
          data: $("#form_obs").serialize(),
          beforeSend: function(){
          },
          success: function(data)            
            {
              if(data==1)
              {
                var table = $('#dt_repo').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                document.getElementById("form_obs").reset();
                swal('datos agregados correctamente')
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


    /* Idioma para el DataTable */
var idioma_espanol = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}


