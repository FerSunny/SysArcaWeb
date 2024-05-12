
	$(document).on("ready", function(){

			listar();

			$("#frmedit  #codigo").focus();

		$.fn.dataTable.ext.errMode = 'none';

		});



// listar datos en la tabla de perfiles

		var listar = function(){

				$("#cuadro1").slideDown("slow");

			var table = $("#dt_productos").DataTable({

				"destroy":true,

				"sRowSelect": "multi",

				"ajax":{

					"method":"POST",

					"url": "listar.php"

				},

				"columns":[

					

					{"data" : "desc_corta"},

					{"data" : "desc_area"},

					{"data" : "fecha"},

					{"data" : "num_citas"},
					/*
					{"data" : "hora_termino"},
					{"data" : "paciente"},
					{"data" : "telefono_fijo"},
					{"data" : "telefono_movil"},
					{"data" : "iniciales"},

					{"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"},
					*/
					{
						render:function(data,type,row){
							return "<form-group style='text-align:center;'>"+
							"<a id='printer' target='_blank' href='../so_agenda_rep/reports/print_agenda.php?fk_id_sucursal="+row['fk_id_sucursal']+"&fk_id_area="+row['fk_id_area']+"&fecha="+row['fecha']+"' class='btn btn-success btn-md' role='button'><i class='fa fa-print' style='color: with;'></i></a>"+
							"</form-group>";	
							}
					}

				],

				"language": idioma_espanol

			});

			agregar("#dt_productos tbody", table)

			editar("#dt_productos tbody", table)

			eliminar("#dt_productos tbody", table)

				

}

var agregar= function(tbody, table) {

		$(tbody).on("click", "button.agregar", function() 

		{

				var data = table.row($(this).parents("tr")).data();

				$("#form_productos  #dc").val(data.fk_id_cliente)

				$("#form_productos  #pro").val(data.id_producto)

				$("#form_productos").modal("show")



		});

}



/* Agregamos una nueva clasificacion  para q no se recargue la pagina */

$("#form_productos").on('submit', function (e) 

	{

			e.preventDefault()

			$.ajax({

					type: "POST",                 

					url: "controladores/agregar.php",                    

					data: $("#form_productos").serialize(),

					beforeSend: function(){

					},

					success: function(data)            

						{
							if(data==1)
							{
								var table = $('#dt_productos').DataTable(); // accede de nuevo a la DataTable.
								table.ajax.reload(); // Recarga el  DataTable
								document.getElementById("form_productos").reset();
								swal('datos agregados correctamente')
								console.log(data)
							}else
							if(data == 1062)
							{
								swal('El codigo del producto ya existe')
							}
							else
							if(data == 2)
							{
								swal('El horario ya esta ocupado')
							}
							else
							{
								swal('Error en MySQL, Error numero:  '+ data)
								console.log(data)
							}
						}
					});          

	});



function focus_btn()

{

	$("input#codigo.form-control").focus();

}



var editar = function(tbody, table) {

		$(tbody).on("click", "button.editar", function() 

		{

				var data = table.row($(this).parents("tr")).data();

				$("#form_editar").modal("show")





				$("#frmedit  label").attr('class','active')

				$("#frmedit  #dc").val(data.id_evento)

				$("#frmedit  #pro").val(data.id_evento)

				$("#frmedit  #codigo").val(data.id_evento)

				$("#frmedit  #fecha").val(data.fecha)

				$("#frmedit  #hora").val(data.hora)

				$("#frmedit  #duracion").val(data.hora_termino)

				$("#frmedit  #sucursal").val(data.fk_id_sucursal)

				$("#frmedit  #area").val(data.fk_id_area)

				$("#frmedit  #observa").val(data.observaciones)

				$("#frmedit  #cliente_id").val(data.paciente)

				$("#frmedit  #estudio_id").val(data.iniciales)
			 
		});

}



$("#frmedit").on('submit', function (e) 

	{

			e.preventDefault()

			$.ajax({

					type: "POST",                 

					url: "controladores/editar.php",                    

					data: $("#frmedit").serialize(),

					beforeSend: function(){

					},

					success: function(data)            

						{

							if( data== 1 )

							{

								var table = $('#dt_productos').DataTable(); // accede de nuevo a la DataTable.

								table.ajax.reload(); // Recarga el  DataTable

								swal('datos agregados correctamente')
							}
							else
							if(data == 2)
							{
								swal('El horario ya esta ocupado')
							}
							else
							{
								swal('Error en MySQL, Error numero:  '+data)
								console.log(data)
							}

						}

					});          

	});





/* Obtenemos los datos de un paciente */

var eliminar= function(tbody, table) {

		$(tbody).on("click", "button.eliminar", function() {

			var data = table.row($(this).parents("tr")).data();



			const swalWithBootstrapButtons = swal.mixin({

				confirmButtonClass: 'btn btn-success',

				cancelButtonClass: 'btn btn-danger',

				buttonsStyling: false,

			})



			swalWithBootstrapButtons({

				title: 'Estas segur@?',

				text: "No podras revertir esta acción",

				type: 'warning',

				showCancelButton: true,

				cancelButtonText: 'No, Cancelar!',

				confirmButtonText: 'Si, Eliminarlo!',

				reverseButtons: true

			}).then((result) => {

				if (result.value) {

					 $.post("./controladores/eliminar.php", {'id_evento' : data.id_evento}  , function(data,status)

					{

						swalWithBootstrapButtons(

						'Eliminado!',

						'La información ha sido eliminada',

						'success'

					)

						console.log(data)

						var table = $('#dt_productos').DataTable(); // accede de nuevo a la DataTable.

								table.ajax.reload(); // linea 106 del error de la consola



					});

					

				} else if (

					// Read more about handling dismissals

					result.dismiss === swal.DismissReason.cancel

				) {

					swalWithBootstrapButtons(

						'Cancelado',

						'Los archivos estan seguros :)',

						'error'

					)

				}

			})

				

		});

}
	

// Función autocompletar paciente

function autocompletar_p() {
	var minimo_letras = 0; // minimo letras visibles en el autocompletar
	var palabra = $('#cliente_id').val();
	//Contamos el valor del input mediante una condicional
	//console.log('entro a buscar:'+palabra)
	if (palabra.length >= minimo_letras) {
		$.ajax({
			url: 'mostrar_p.php',
			type: 'POST',
			data: {palabra:palabra},
			success:function(data){
				$('#lista_id').show();
				$('#lista_id').html(data);
			}
		});
	} else {
		//ocultamos la lista
		$('#lista_id').hide();
	}
}

// Funcion Mostrar valores pacientes
function set_item(opciones) {
	// Cambiar el valor del formulario input
	$('#cliente_id').val(opciones);
	// ocultar lista de proposiciones
	$('#lista_id').hide();
}

// Función autocompletar estudios

function autocompletar_e() {
	var minimo_letras = 0; // minimo letras visibles en el autocompletar
	var palabra = $('#estudio_id').val();
	//Contamos el valor del input mediante una condicional
	//console.log('entro a buscar:'+palabra)
	if (palabra.length >= minimo_letras) {
		$.ajax({
			url: 'mostrar_e.php',
			type: 'POST',
			data: {palabra:palabra},
			success:function(data){
				$('#lista_id_e').show();
				$('#lista_id_e').html(data);
			}
		});
	} else {
		//ocultamos la lista
		$('#lista_id_e').hide();
	}
}

// Funcion Mostrar valores estudio
function set_item_e(opciones) {
	// Cambiar el valor del formulario input
	$('#estudio_id').val(opciones);
	// ocultar lista de proposiciones
	$('#lista_id_e').hide();
}

/*

function calcular(val)

{

	if(val == 1)

	{

			var costo = parseFloat($("#costo").val())

			var utilidad = parseFloat($("#utilidad").val())

			var porciento = utilidad / 100

			var porcentaje = costo * porciento

			var total = costo + porcentaje

			$("#form_productos #lbl_total").attr('class','active')

			if(porciento == 0)

			{

				$("#c_total").val(costo)

			}else

			{

				$("#c_total").val(total)

			} 

	}else

	if(val == 2)

	{

			var costo = parseFloat($("#frmedit #costo").val())

			var utilidad = parseFloat($("#frmedit #utilidad").val())

			var porciento = utilidad / 100

			var porcentaje = costo * porciento

			var total = costo + porcentaje

			$("#frmedit #lbl_total").attr('class','active')

			if(porciento == 0)

			{

				$("#frmedit #c_total").val(costo)

			}else

			{

				$("#frmedit #c_total").val(total)

			} 

	}

	



}

*/

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