

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

					{"data" : "id_equipo"},

					{"data" : "numero_serie"},

					{"data" : "codigo"},

					{"data" : "marca"},

					{"data" : "modelo"},

					{"data" : "descripcion"},

					{"data" : "razon_social"},


					{"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"},

					{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md'><i class='fas fa-trash-alt'></i></button>"},
					// mantenimiento correctivo
					{
						render:function(data,type,row){
							var registrado;

									return "<form-group style='text-align:center;'>"+
									"<a id='printer' disabled target='_blank' href='../eb_equipos/tabla_equipo_cor.php?id_equipo="+row['id_equipo']+"' class='btn btn-info btn-md' role='button'><i class='fa fa-cogs' ></i></a>"+
									"</form-group>";

						},
					},
					// calendario mnto preventivo
					{
						render:function(data,type,row){
							var registrado;

									return "<form-group style='text-align:center;'>"+
									"<a id='printer' target='_blank' href='../eb_equipos/tabla_equipo_cal.php?id_equipo="+row['id_equipo']+"' class='btn btn-light btn-md' role='button'><i class='fa fa-calendar' ></i></a>"+
									"</form-group>";

						},
					},
					//Documentos PDF
					{
						render:function(data,type,row){
							var registrado;
/*
									return "<form-group style='text-align:center;'>"+
									"<a id='printer' target='_blank' href='reports/tikets.php?codigo="+row['codigo']+"' class='btn btn-success btn-md' role='button'><i class='fas fa-file-pdf' ></i></a>"+
									"</form-group>";
									*/
									return "<form-group style='text-align:center;'>"+
									"<a id='printer'  href='../eb_equipos/tabla_imagenes.php?id_equipo="+row['id_equipo']+"' class='btn btn-success' role='button'><span  class='fa fa-image'></span></a>"+
									"</form-group>";

						},
					},
					//Calibracion
					{
						render:function(data,type,row){
							var registrado;

									return "<form-group style='text-align:center;'>"+
									"<a id='printer' target='_blank' href='reports/tikets.php?codigo="+row['codigo']+"' class='btn btn-primary btn-md' role='button'><i class='fa fa-stethoscope' ></i></a>"+
									"</form-group>";

						},
					},
					//Check - list
					{
						render:function(data,type,row){
							var registrado;

									return "<form-group style='text-align:center;'>"+
									"<a id='printer' target='_blank' href='reports/tikets.php?codigo="+row['codigo']+"' class='btn btn-secondary btn-md' role='button'><i class='fa fa-list' ></i></a>"+
									"</form-group>";

						},
					},
					//Codigo de barras
					{
						render:function(data,type,row){
							var registrado;

									return "<form-group style='text-align:center;'>"+
									"<a id='printer' target='_blank' href='reports/tikets.php?codigo="+row['codigo']+"' class='btn btn-warning btn-md' role='button'><i class='fa fa-barcode' ></i></a>"+
									"</form-group>";

						},
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

				$("#frmedit  #dc").val(data.id_equipo)

				$("#frmedit  #pro").val(data.id_equipo)

				$("#frmedit  #codigo").val(data.id_equipo)

				$("#frmedit  #descripcion").val(data.descripcion)

				$("#frmedit  #vminimo").val(data.valor_minimo)

				$("#frmedit  #vmaximo").val(data.valor_maximo)

				$("#frmedit  #servicio").val(data.fk_id_servicio)

				$("#frmedit  #area").val(data.fk_id_area)

				$("#frmedit  #gpo_conta").val(data.fk_id_gpo_conta)		
				$("#frmedit  #conse").val(data.conse)
				$("#frmedit  #serie").val(data.numero_serie)

				$("#frmedit  #marca").val(data.marca)
				$("#frmedit  #modelo").val(data.modelo)
				//$("#frmedit  #fcalibra").val(data.fecha_calibracion)
				//$("#frmedit  #fultimo").val(data.fecha_ult_mto)	
				//$("#frmedit  #vcorrige").val(data.valor_corre)
				//$("#frmedit  #dmto").val(data.dias_mto)

				$("#frmedit  #sucursal").val(data.fk_id_sucursal)
				$("#frmedit  #servicio").val(data.fk_id_servicio)
				$("#frmedit  #area").val(data.fk_id_area)
				$("#frmedit  #gpo_conta").val(data.fk_id_gpo_conta)
				$("#frmedit  #conse").val(data.conse)

				$("#frmedit  #fecha_alta").val(data.fecha_alta)
				// $("#frmedit  #fecha_rece").val(data.fecha_rece)
				$("#frmedit  #fecha_marcha").val(data.fecha_marcha)
				$("#frmedit  #fecha_expira_g").val(data.fecha_expira_g)

				$("#frmedit  #proveedor").val(data.fk_id_proveedor)

				$("#frmedit  #usuario").val(data.usuario)
				$("#frmedit  #pass").val(data.contra)

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

					 $.post("./controladores/eliminar.php", {'id_equipo' : data.id_equipo}  , function(data,status)

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





