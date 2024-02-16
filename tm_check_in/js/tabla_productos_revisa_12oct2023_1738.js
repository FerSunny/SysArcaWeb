

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

					"url": "listar_revisa.php"

				},

				"columns":[

					{"data" : "id_toma"},
					{"data" : "desc_corta"},

					{"data" : "fk_id_factura"},
					{"data" : "iniciales"},

					{"data" : "fecha_toma"},

					{"data" : "fk_id_usuario"},

					{"data" : "desc_muestra"},

					{"data" : "estatus"},
					{
						render:function(data,type,row){
							estatus=row['check_in'];
							rechazo=row['fk_id_rechazo'];

							if ((estatus == 0) && (rechazo == 0)) {
								return "<button  type='button' class='todo btn btn-danger btn-md'><i class='fas fa-user-check'></i></button>";
							}else{
								return "<button disabled type='button' class='todo btn btn-success btn-md'><i class='fas fa-user-check'></i></button>";	
							}
						
						}
					},
// rechazo de muestras.
					{
						render:function(data,type,row){
							estatus=row['check_in'];
							rechazo=row['fk_id_rechazo'];

							if ((estatus == 0) && (rechazo == 0)) {
								return "<button  type='button' class='editar btn btn-danger btn-md'><i class='fas fa-user-edit'></i></button>";
							}else{
								return "<button disabled type='button' class='editar btn btn-success btn-md'><i class='fas fa-user-edit'></i></button>";	
							}
						
						}
					}



					//{"defaultContent":"<button type='button' class='todo btn btn-success btn-md'><i class='fas fa-user-check'></i></button>"},
					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md'><i class='fas fa-user-edit'></i></button>"}

				],

				"language": idioma_espanol

			});

			agregar("#dt_productos tbody", table)

			editar("#dt_productos tbody", table) // acepta todas las muestras

			eliminar("#dt_productos tbody", table)

			todo("#dt_productos tbody", table)

				

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

				$("#frmedit  #dc").val(data.id_toma)

				$("#frmedit  #pro").val(data.id_toma)

				$("#frmedit  #codigo").val(data.id_toma)

				$("#frmedit  #email_paciente").val(data.email_paciente)

				$("#frmedit  #email_medico").val(data.email_medico)

				$("#frmedit  #email_sucursal").val(data.email_sucursal)

			 

		});

}



$("#frmedit").on('submit', function (e) 

	{

			e.preventDefault()

			$.ajax({

					type: "POST",                 

					url: "controladores/editar_revisa.php",                    

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

								console.log(data)

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

					 $.post("./controladores/eliminar.php", {'id_producto' : data.id_producto}  , function(data,status)

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


/* aceptamos todas las muestras */

var todo= function(tbody, table) {

		$(tbody).on("click", "button.todo", function() {

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

				confirmButtonText: 'Si, Aceptarlas!',

				reverseButtons: true

			}).then((result) => {

				if (result.value) {

					 $.post("./controladores/todo_revisa.php", {'id_toma' : data.id_toma}, function(data,status)

					{

						swalWithBootstrapButtons(

						'Aceptadas!',

						'La Muestras han sido aceptadas!!!!',

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





