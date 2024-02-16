
		$(document).on("ready", function(){
			listar();
			entregar();
		//$.fn.dataTable.ext.errMode = 'none';
		});

// listar datos en la tabla de perfiles
var listar = function(){
		$("#cuadro").slideDown("slow");
	var table = $("#dt_resultados").DataTable({
		"destroy":true,//se elimina la tabla si ya existe
		"sRowSelect": "multi",
		"ajax":{
			"method":"POST",
			"url": "listar.php"
		},
		"columns":[
			{"data" : "id_factura"},
			{"data" : "desc_corta"},
			{"data" : "nombre"},
			{"data" : "fecha_factura"},
			{"data" : "fecha_entrega"},
			{"data" : "desc_estudio"},
			{
				render: function( data, type, row, meta )
				{
					if(row['validado'] == '0')
					{
						return '<span class="badge badge-danger">Sin Validar</span>'
					}else
					if(row['validado'] == '1')
					{
						return '<span class="badge badge-success">Validado</span>'
					}else
					{
						return '<span class="badge badge-danger">Sin Validar</span>'
					}

				}
			},			
			//{"data" : "realizado"},
			{
				render: function( data, type, row, meta )
				{
					if(row['realizado'] == '1')
					{
						return '<span class="badge badge-danger">Sin resultado en sistema</span>'
					}else
					if(row['realizado'] == '2')
					{
						return '<span class="badge badge-warning">Pendiente de entregar</span>'
					}else
					{
						return '<span class="badge badge-success">Entregada</span>'
					}

				}
			},

			{"data" : "entregada"},
			{"data" : "iniciales"},
			{
				render: function( data, type, row, meta ){
					if (row['validado']=='1' ) {
						if((row['realizado']=='3')){
							return "<button type='button' disabled class='success btn btn-warning entregar' data-toggle='modal' data-target='#modalEntregar' ><i class='fas fa-times'></i></button>";
						}else{
							return "<button type='button' class='success btn btn-success entregar' data-toggle='modal' data-target='#modalEntregar' ><i class='fa fa-check'></i></button>";
						}
					} 
					else {

						return "<button type='button' disabled class='success btn btn-warning entregar' data-toggle='modal' data-target='#modalEntregar' ><i class='fas fa-times'></i></button>";
					}
				}
			}
		],
		"language": idioma_espanol
	});

	obtenerDatos("#dt_resultados tbody", table);
}



var obtenerDatos= function(tbody, table) {
	$(tbody).on("click", "button.entregar", function(){
		var data = table.row($(this).parents("tr")).data();
		
		$("#frmEntregar #id_factura").val(data.id_factura);
		$("#frmEntregar #id_estudio").val(data.fk_id_estudio);
		$("#frmEntregar #grupo").val(data.grupo);
		$("#frmEntregar").modal("show");
		console.log(data);
	});
}
var entregar= function(){

	$('#actualizar').on('click', function(){		
		var datos = $('#frmEntregar').serialize();

		const swalWithBootstrapButtons = swal.mixin({
				confirmButtonClass: 'btn btn-danger',
				buttonsStyling: false,
				title:"ERROR",
				text: "¡Ha ocurrido un error!",
			})

		
		$.ajax({
			url: 'controladores/update.php',
			type: 'POST',
			data: datos
		})

		.success(function(info) {
			//console.log(info);
			if (info==1) {
				console.log(info);
				var table = $('#dt_resultados').DataTable(); // accede de nuevo a la DataTable.
				table.ajax.reload(); // Recarga el  DataTable
			}else{
				swalWithBootstrapButtons({});
			}
			
			
		})
		
	});

}

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


