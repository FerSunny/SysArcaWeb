
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
					{"data" : "id_usuario"},
					{"data" : "paciente"},
					{"defaultContent": "<button type='button' id='details' class='btn btn-info'><i class='fas fa-info-circle' style='font-size:2em;font-weight:800'></i></button>"}
					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger'><i class='fas fa-trash-alt'></i></button>"}
				],
				"language": idioma_espanol
			});
			detalles("#dt_reportes tbody", table)

}


var detalles = function(tbody, table){
	$(tbody).on("click", "button#details", function(){
		var data = table.row( $(this).parents("tr") ).data();
		fecha_i = $("#fecha_i").val()
		fecha_f = $("#fecha_f").val()
		window.open("reportes/reportes.php?user="+ data.id_usuario + "&inicio="+ fecha_i + "&final=" +fecha_f, "_blank")
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
