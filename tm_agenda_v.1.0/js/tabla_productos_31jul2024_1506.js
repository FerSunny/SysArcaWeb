
		$(document).on("ready", function(){
			listar();
			//$("#frmedit  #codigo").focus();
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
					{"data" : "id_factura"},
					{"data" : "fecha_factura"},
					{"data" : "fecha_entrega"},
					{"data" : "sucursal"},
					{"data" : "paciente"},
					{"data" : "estudio"},
					{"data" : "cubiculo"},
					{"data" : "fecha"},
					{"data" : "hora"},

					{"data" : "desc_muestra"},

					//{"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"},
					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md'><i class='fas fa-trash-alt'></i></button>"}
					/*
					{
						render: function(data,type,row)
	                    {
	                        var valid = row['cubiculo']

	                        if(valid == null)
	                        {
	                            return "<button type='button' class='directo btn btn-success btn-md'><i class='fa fa-check'></i></button>"
	                        }else
	                        {
	                            return "<button type='button' disabled class='directo btn btn-success btn-md'><i class='fas fa-times'></i></button>"
	                        }

	                    }
                	},
					*/

					{
						render: function(data,type,row)
	                    {
	                        var valid = 'No'

	                        if(valid == 'No')
	                        {
	                            return "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"
	                        }else
	                        {
	                            return "<button type='button' disabled class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"
	                        }

	                    }
                	}
/*
					{
						render: function(data,type,row)
	                    {
	                        var valid = row['cubiculo']
							var registrado = row['registrado']

	                        if(valid == null)
	                        {
	                            return "<button type='button' disabled class='eliminar btn btn-danger btn-md'><i class='fas fa-trash-alt'></i></button>"
	                        }else
	                        {
								if(registrado == 'No'){
									return "<button type='button'  class='eliminar btn btn-danger btn-md'><i class='fas fa-trash-alt'></i></button>"
								}else{
									return "<button type='button' disabled class='eliminar btn btn-danger btn-md'><i class='fas fa-trash-alt'></i></button>"
								}
	                        }

	                    }
                	}	

					*/
				],
				"language": idioma_espanol
			});
			agregar("#dt_productos tbody", table)
			directo("#dt_productos tbody", table)


			editar("#dt_productos tbody", table)
			eliminar("#dt_productos tbody", table)

				
}

var agregar= function(tbody, table) {
		$(tbody).on("click", "button.agregar", function() 
		{
				var data = table.row($(this).parents("tr")).data();
				$("#form_productos  #dc").val(data.id_factura)
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
	//$("input#codigo.form-control").focus();
}

var editar = function(tbody, table) {
		$(tbody).on("click", "button.editar", function() 
		{
				var data = table.row($(this).parents("tr")).data();
				$("#form_editar").modal("show")


				$("#frmedit  label").attr('class','active')
				$("#frmedit  #dc").val(data.id_factura)

				$("#frmedit  #control").val(data.control)
				
				$("#frmedit  #codigo").val(data.id_factura)
				$("#frmedit  #estudio").val(data.estudio)
				$("#frmedit  #id_estudio").val(data.id_estudio)
				$("#frmedit  #muestra").val(data.desc_muestra)

				$("#frmedit  #sucursal").val(data.fk_id_sucursal)
				$("#frmedit  #cubiculo").val(data.cubiculo)
				$("#frmedit  #fecha_usg").val(data.fecha)
				$("#frmedit  #hora_usg").val(data.hora)
/*				$("#frmedit  #c_total").val(data.costo_total)
				$("#frmedit  #depto").val(data.departamento)
				$("#frmedit  #proveedor").val(data.fk_id_proveedor)
				$("#frmedit  #cat").val(data.fk_id_categoria)
*/				
				$("#frmedit  #caducidad").val(data.fecha_factura)

			 
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
							if(data == 1062)
							{
								swal('Este estudio ya ha sido asignado')
							}
							else
							{
								swal('Error en MySQL, Error numero:  '+ data)
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
					 $.post("./controladores/eliminar.php", {'id_agenda' : data.id_agenda}  , function(data,status)
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

/* paso directo sin agendar */
var directo= function(tbody, table) {
	$(tbody).on("click", "button.directo", function() {
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
			confirmButtonText: 'Si, Agendar!',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				 $.post("./controladores/directo.php", {'id_factura' : data.id_factura, 'id_estudio' : data.id_estudio}  , function(data,status)
				{
					swalWithBootstrapButtons(
					'Pasa directo sin agendar!',
					'El  paciente ha sido agendado',
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
					'No se agendo al paciente',
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


