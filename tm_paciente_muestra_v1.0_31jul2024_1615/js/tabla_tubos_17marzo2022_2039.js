
		$(document).on("ready", function(){
			listar();
			//alert("hola")
			$("#frmedit  #codigo").focus();
		$.fn.dataTable.ext.errMode = 'none';

		});

// listar datos en la tabla de perfiles
		var listar = function(){
			var factura=$("#factura").val()
			var studio=$("#studio").val()
			//alert(factura)
			//alert(studio)
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_productos").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					//"url": "listar_tubos.php?factura="+factura+"&studio="+studio
					"url": "listar_tubos.php?factura="+factura
				},
				"columns":[
					{"data" : "studio"},
					{"data" : "desc_estudio"},
					{"data" : "desc_muestra"},
					// {"data" : "tomadas"},
					// {"data" : "pendientes"},
					//{"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"},
					//{"defaultContent":"<button type='button' target='_blank'href='../se_modulos/tabla_modulos.php' class='btn btn-danger btn-md'><i class='fas fa-crutch'></i></button>"}
					{
						render:function(data,type,row){
							var v_pendientes;
							v_aplico=row['aplico'];

							if (v_aplico == 'N' ){

									return "<button type='button' class='registrar btn btn-warning btn-md'> <i class='fas fa-thumbs-up'></i></button>"

							}else{
								return "<button type='button' class='registrar btn btn-warning btn-md' disabled> <i class='fas fa-thumbs-up'></i></button>"
							}

						},

					},
					{
						render:function(data,type,row){
							var v_pendientes;

							v_aplico=row['aplico'];

							if (v_aplico == 'S'){

								return "<button type='button' class='no_registrar btn btn-warning btn-md'> <i class='fas fa-thumbs-down'></i></button>"

							}else{
								return "<button type='button' class='no_registrar btn btn-warning btn-md' disabled> <i class='fas fa-thumbs-down'></i></button>"
							}
						},
					},
					{
						render:function(data,type,row){
							var v_aplico;
							v_aplico=row['aplico'];
							if (v_aplico == 'N'){
								return "<button type='button' class='no_registrar btn btn-danger btn-md' > <i class='fa fa-adjust'></i></button>"
							}else{
								return "<button type='button' class='cancelar btn btn-danger btn-md' disabled > <i class='fa fa-adjust'></i></button>"
							}			
						},
					}			
				],
				"language": idioma_espanol
			});
			
			agregar("#dt_productos tbody", table)
			editar("#dt_productos tbody", table)
			eliminar("#dt_productos tbody", table)

			registrar("#dt_productos tbody", table)
			no_registrar("#dt_productos tbody", table)	
			cancelar("#dt_productos tbody", table)
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
var registrar= function(tbody, table) {
		$(tbody).on("click", "button.registrar", function() 
		{
				var data = table.row($(this).parents("tr")).data();
				var parametros={
					"id_factura":data.id_factura,
					"id_estudio":data.studio,
					"id_muestra":data.id_muestra,
					"control":data.control
				}
			$.ajax({
					type: "POST",                 
					url: "controladores/agregar_muestra.php",                    
					data:parametros,
					beforeSend: function(){
					},
					success: function(data)            
						{
							if(data==1)
							{
								var table = $('#dt_productos').DataTable(); // accede de nuevo a la DataTable.
								table.ajax.reload(); // Recarga el  DataTable
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
}

/* boton de no registrar loa muestra */
var no_registrar= function(tbody, table) {
		$(tbody).on("click", "button.no_registrar", function() 
		{
				var data = table.row($(this).parents("tr")).data();
				var parametros={
					"id_factura":data.id_factura,
					"id_estudio":data.studio,
					"id_muestra":data.id_muestra,
					"control":data.control
				}
			$.ajax({
					type: "POST",                 
					url: "controladores/no_agregar_muestra.php",                    
					data:parametros,
					beforeSend: function(){
					},
					success: function(data)            
						{
							if(data==1)
							{
								var table = $('#dt_productos').DataTable(); // accede de nuevo a la DataTable.
								table.ajax.reload(); // Recarga el  DataTable
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
				$("#frmedit  #dc").val(data.id_cliente)
				$("#frmedit  #pro").val(data.id_cliente)
				$("#frmedit  #codigo").val(data.id_cliente)
				$("#frmedit  #nombre").val(data.nombre)
				$("#frmedit  #a_paterno").val(data.a_paterno)
				$("#frmedit  #a_materno").val(data.a_materno)
				$("#frmedit  #edad").val(data.edad)
				$("#frmedit  #id_sexo").val(data.id_sexo)
			 
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

var cancelar= function(tbody, table) {
		$(tbody).on("click", "button.cancelar", function() 
		{
				var data = table.row($(this).parents("tr")).data();
				var parametros={
					"id_factura":data.id_factura,
					"id_estudio":data.studio,
					"id_muestra":data.id_muestra,
					"control":data.control
				}
			$.ajax({
					type: "POST",                 
					url: "controladores/cancelar.php",                    
					data:parametros,
					beforeSend: function(){
					},
					success: function(data)            
						{
							if(data==1)
							{
								var table = $('#dt_productos').DataTable(); // accede de nuevo a la DataTable.
								table.ajax.reload(); // Recarga el  DataTable
								swal('La muestra ha sido cancela, Por favor programe una nueva entrega')
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


