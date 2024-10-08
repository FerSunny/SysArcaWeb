

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

					"url": "listar_principal.php"

				},

				"columns":[

					{"data" : "id_doc"},

					{"data" : "desc_tipo_docu"},

					{"data" : "desc_grupo"},

					{"data" : "clave"},

					{"data" : "desc_doc"},

					{"data" : "ele_numcopias"},

					{"data" : "ele_ubica"},

					{"data" : "imp_numcopias"},

					{"data" : "imp_ubica"},

					{"data" : "num_revision"},

					{"data" : "num_version"},

					{"data" : "fecha_emision"},

					{"data" : "fecha_pro_rev"},

					//{"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"},
					// boton de modificar
					{
						render:function(data,type,row){
							var id_usuario = row['id_usuario']

							if(id_usuario == 1 || id_usuario == 2 || id_usuario == 114 || id_usuario == 30)
								{
									return "<button type='button' class='editar btn btn-success btn-md'><i class='fas fa-edit'></i></button>"
								}else
								{
									return "<button disabled type='button' class='editar btn btn-danger btn-md'><i class='fas fa-stop'></i> </button>"
								}

						}
									
					},

					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md'><i class='fas fa-trash-alt'></i></button>"},
					{
						render:function(data,type,row){
							var id_usuario = row['id_usuario']

							if(id_usuario == 1 || id_usuario == 2 || id_usuario == 114 || id_usuario == 30)
								{
									return "<button type='button' class='eliminar btn btn-success btn-md'><i class='fas fa-trash-alt'></i></button>"
								}else
								{
									return "<button disabled type='button' class='eliminar btn btn-danger btn-md'><i class='fas fa-stop'></i> </button>"
								}

						}
									
					},


					{
						render:function(data,type,row){

							
							return "<form-group style='text-align:center;'>"+
							"<a id='printer' target='_blank'  href='./tabla_ficheros.php?id_doc="+row['id_doc']+"&num_version="+row['num_version']+"&desc_doc="+row['desc_doc']+"&fk_id_numeral_1="+row['fk_id_numeral_1']+"&fk_id_numeral_2="+row['fk_id_numeral_2']+"' class='btn btn-success btn-md'  role='button'><span class='fas fa-file' style='color: white;'></span></a>"+
							"</form-group>";

										
									}


					}

				],

				"language": idioma_espanol

			});

			agregar("#dt_productos tbody", table)

			editar("#dt_productos tbody", table)

			eliminar("#dt_productos tbody", table)

			subir("#dt_productos tbody", table)	

}

var agregar= function(tbody, table) {

		$(tbody).on("click", "button.agregar", function() 

		{

				var data = table.row($(this).parents("tr")).data();

				$("#form_productos  #dc").val(data.id_doc)

				$("#form_productos  #pro").val(data.id_doc)

				$("#form_productos").modal("show")



		});

}



/* Agregamos una nueva clasificacion  para q no se recargue la pagina */

$("#form_productos").on('submit', function (e) 

	{

			e.preventDefault()

			$.ajax({

					type: "POST",                 

					url: "controladores/agregar_lista.php",                    

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

				$("#frmedit  #dc").val(data.id_doc)

				//$("#frmedit  #dc").val(data.desc_tipo_docu)

				$("#frmedit  #pro").val(data.id_doc)

				$("#frmedit  #codigo").val(data.id_doc)

				$("#frmedit  #grupo").val(data.fk_id_grupo)

				$("#frmedit  #tipo").val(data.fk_id_tipo)

				$("#frmedit  #modulo").val(data.fk_id_modulo)

				$("#frmedit  #consecutivo").val(data.consecutivo)

				$("#frmedit  #descripcion").val(data.desc_doc)

				$("#frmedit  #encopias").val(data.ele_numcopias)

				$("#frmedit  #eubicacion").val(data.ele_ubica)

				$("#frmedit  #fncopias").val(data.imp_numcopias)

				$("#frmedit  #fubicacion").val(data.imp_ubica)

				$("#frmedit  #revision").val(data.num_revision)
				$("#frmedit  #version").val(data.num_version)
				$("#frmedit  #femision").val(data.fecha_emision)
				$("#frmedit  #frevision").val(data.fecha_pro_rev)
				$("#frmedit  #lista").val(data.fk_id_docu)
			 

		});

}



$("#frmedit").on('submit', function (e) 

	{

			e.preventDefault()

			$.ajax({

					type: "POST",                 

					url: "controladores/editar_lista.php",                    

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

					 $.post("./controladores/eliminar_lista.php", {'id_doc' : data.id_doc}  , function(data,status)

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





