
		$(document).on("ready", function(){
			listar();
			$("#detalles").click(function(e){
				$(".verificar p,h3,h5,button").toggleClass("detalle_asistencia");
			})
      //$.fn.dataTable.ext.errMode = 'none';
		});

// listar datos en la tabla de perfiles
		var listar = function(){

			var table = $("#dt_reportes").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "fk_id_usuario"},
					{"data" : "nombre"},
          {
						render:function(data,type,row)
						{
							var dia = row['dia']
							var mes = row['mes']
							var año = row['año']

							return dia+' '+mes+' '+año
						}
					},
					{"data" : "horario"},
					{"data" : "minimo"},
					{"data" : "maximo"},
					{"defaultContent": "<button type='button' class='obs btn btn-info btn-md'><i class='fas fa-clipboard-list' style='font-size:2em;'></i></button>"},
					{
						render: function(data,type,row)
						{
							var acceso = row['acceso']
							var por = "-00:00:00"
							if(acceso > '00:00:00'){
								return "<div class='alert alert-danger' role='alert' stylce='text-aling:center;'>"+acceso+"</div>"
							}else
							if(acceso == null)
							{
								return "<div class='alert alert-warning' role='alert' stylce='text-aling:center;'>Sin informacion</div>"
							}	else {
								return "<div class='alert alert-success' role='alert' stylce='text-aling:center;'>"+acceso+"</div>"
							}

						}
					}
					//{"defaultContent": "<button type='button' class='editar btn btn-warning'><i class='fas fa-edit'></i></button>"},
					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger'><i class='fas fa-trash-alt'></i></button>"}
				],
				"language": idioma_espanol
			});
			observaciones("#dt_reportes tbody", table)

}

$("#reporte").click(function(e){
	var fi = $("#fecha_inicio").val()
	var ff = $("#fecha_final").val()

	window.open("reportes/asistencia.php?fi="+fi+"&ff="+ff,"_blank")
})


$("#reporte_r").click(function(e){
	var fi = $("#fecha_inicio").val()
	var ff = $("#fecha_final").val()
	var idsucursal = $("#id_sucursal").val();

	window.open("reportes/asistencia_resumen.php?fi="+fi+"&ff="+ff+"&suc="+idsucursal,"_blank")
})

$("#aviso-reporte").click(function(){
	Swal.fire("Solo puedes imprimir el reporte, al finalizar la semana.")
})

var observaciones = function(tbody, table){
	$(tbody).on("click", "button.obs", function(){
		var data = table.row( $(this).parents("tr") ).data();
		$("#mdl-obs").modal("show");
		document.getElementById('nombre').innerHTML = data.nombre;
		document.getElementById('id_usuario').innerHTML = data.fk_id_usuario;
		document.getElementById('fecha').innerHTML = data.dia+' de '+data.mes+' de '+data.año;
		$("#id_usr").val(data.fk_id_usuario)
		$("#fecha_r").val(data.fecha_asistencia)
	});
}

$("#frm-obs").on('submit', function (e)
	{
			e.preventDefault()
			$.ajax({
					type: "POST",
					url: "ajax/add_observaciones.php",
					data: $("#frm-obs").serialize(),
					beforeSend: function(){
					},
					success: function(data)
						{
								var table = $('#dt_reportes').DataTable(); // accede de nuevo a la DataTable.
								table.ajax.reload(); // Recarga el  DataTable
								document.getElementById("frm-obs").reset();
								swal(data)
								console.log(data)
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
