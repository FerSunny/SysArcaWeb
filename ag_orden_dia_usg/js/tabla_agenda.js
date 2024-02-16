$(document).ready(function(){
	listar();
});


		function listar(){
			var table=$('#dt_agenda').DataTable({
				processing: true,
				serverSide: false,
				lengthMenu: [10, 25, 50],
				select: true,
				"ajax":{
					"url":"listar.php",
					"type": "POST",
				},
				"columns":[
					{"data" : "id_factura"},
					{"data" : "fecha_factura"},
					{"data" : "fecha_entrega"},
					{"data" : "sucursal"},
					{"data" : "paciente"},
					{"data" : "estudio"},
					{"data" : "diagnostico"},
					{"data" : "Registrado"},
                    //{"data" : "num_imp"},

// Boton de validar

					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md'><i class='fa fa-check'></i></button>"},
					{
						render:function(data,type,row){
							var validado;
							validado=row['validado'];
							id_usuario=row['id_usuario'];
							fk_id_medico=row['fk_id_medico'];
							switch (validado) {
								case '0':
									if( id_usuario == fk_id_medico){
										return "<form-group style='text-align:center;'>"+
										"<button type='button' class='eliminar btn btn-warning btn-md' style='margin: 0 auto;'><i class='fa fa-check'></i></button>"		
										"</form-group>"						
										break;
									}else{
										return "<form-group style='text-align:center;'>"+
										"<button type='button' class='eliminar btn btn-danger btn-md' style='margin: 0 auto;' disabled ><i class='fa fa-check'></i></button>"		
										"</form-group>"						
										break;										
									}
							
								default:
									return "<form-group style='text-align:center;'>"+
									"<button type='button' class='eliminar btn btn-success btn-md' style='margin: 0 auto;' disabled ><i class='fa fa-check'></i></button>"		
									"</form-group>"						
									break;
							}
	
	
	
							}
						},	

// Boton para registrar el resultado
										{
						render:function(data,type,row){
							var saldo;
							saldo=row['resta'];
							registrado=row['Registrado'];
							switch(saldo)
							 {
							 	case '0.00':
							 		switch(registrado)
									 {
									 	case 'No':
											return "<form-group style='text-align:center;'>"+
											"<a id='printer'  href='../ag_orden_dia_usg/tabla_plantillas.php?numero_factura="+row['id_factura']+"&studio="+row['fk_id_estudio']+"' class='btn btn-success btn-md' role='button'><span class='fas fa-stethoscope' style='color: white;'></span></a>"+
											"</form-group>";
											break;
										default:
											return "<form-group style='text-align:center;'>"+
											"<a id='printer' target='_blank'  class='btn btn-success btn-md' role='button'><i class='fas fa-thumbs-up'></i></a>"+
											"</form-group>";
									}

								default:
									return "<form-group style='text-align:center;'>"+
									"<a id='printer' target='_blank'  class='btn btn-info btn-md' role='button'><i class='fas fa-hand-holding-usd'></i></a>"+
									"</form-group>";

								
							}
							},

					},



//boton de editar	
					{
						render:function(data,type,row){
							var registrado;
							registrado=row['Registrado'];
							switch(registrado)
							{
								case 'Si':
									return "<form-group style='text-align:center;'>"+
									"<button type='button' class='editar btn btn-warning btn-md' style='margin: 0 auto;'><i class='fas fa-pen'></i></button>"
									"</form-group>";
									break;
								default:
									return  "<form-group style='text-align:center;'>"+
											"<a id='printer' target='_blank'  class='btn btn-warning btn-md' role='button'><span  class='fa fa-exclamation-triangle'></span></a>"+
											"</form-group>";

								
							}
						},
					},



// boton de imagenes					
					{
						render:function(data,type,row){
							var registrado;
							registrado=row['Registrado'];
							switch(registrado)
							{
								case 'Si':
									return "<form-group style='text-align:center;'>"+
									"<a id='printer'  href='../ag_orden_dia_usg/tabla_imagenes.php?numero_factura="+row['id_factura']+"&studio="+row['fk_id_estudio']+"' class='btn btn-blue-grey btn-md' role='button'><span  class='fa fa-image' style='color: white;'></span></a>"+
									"</form-group>";
									break;
								default:
									return "<form-group style='text-align:center;'>"+
											"<a id='printer' target='_blank'  class='btn btn-warning btn-md' role='button'><span  class='fa fa-exclamation-triangle'></span></a>"+
											"</form-group>";

								
							}
						},
					},


// Boton de imprimir interpretacion
					{
						render:function(data,type,row){
							var registrado;
							registrado=row['Registrado'];
							validado=row['validado'];
							switch(registrado)
							{
								case 'Si':
									if(validado == 1){
										return "<form-group style='text-align:center;'>"+
										"<a id='printer' target='_blank' href='reports/print_result.php?numero_factura="+row['id_factura']+"&studio="+row['fk_id_estudio']+"' class='btn btn-dark btn-md' role='button'><i class='fas fa-print' style='color: white;'></i></a>"+
										"</form-group>";
									}else{
										return "<form-group style='text-align:center;'>"+
										"<a id='printer' target='_blank'  class='btn btn-danger btn-md' role='button'><span  class='fa fa-exclamation-triangle'></span></a>"+
										"</form-group>";										
									}
									break;
								default:
									return "<form-group style='text-align:center;'>"+
											"<a id='printer' target='_blank'  class='btn btn-warning btn-md' role='button'><span  class='fa fa-exclamation-triangle'></span></a>"+
											"</form-group>";
							}
						},
					},

// Boton de imprimir imagenes
					{
						render:function(data,type,row){
							var registrado;
							registrado=row['Registrado'];
							validado=row['validado'];
							switch(registrado)
							{
								case 'Si':
									if(validado == 1){
										return "<form-group style='text-align:center;'>"+
										"<a id='printer' target='_blank' href='reports/print_imagen.php?numero_factura="+row['id_factura']+"&studio="+row['fk_id_estudio']+"' class='btn btn-dark btn-md' role='button'><i class='fas fa-camera-retro' style='color: white;'></i></a>"+
										"</form-group>";
									}else{
										return "<form-group style='text-align:center;'>"+
										"<a id='printer' target='_blank'  class='btn btn-danger btn-md' role='button'><span  class='fa fa-exclamation-triangle'></span></a>"+
										"</form-group>";
									}
									break;
								default:
									return "<form-group style='text-align:center;'>"+
											"<a id='printer' target='_blank'  class='btn btn-warning btn-md' role='button'><span  class='fa fa-exclamation-triangle'></span></a>"+
											"</form-group>";

						
							}
						},
					}
				],
				"language": idioma_espanol
			});

	//		mostrar("#dt_agenda tbody", table)
            editar("#dt_agenda tbody", table)
			eliminar("#dt_agenda tbody", table)

}




		var editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#resultado_usg").modal("show")
				var fac = data.fk_id_factura
			$.post('controladores/buscar_estudio.php',{'val':data.id_factura,'val2': data.fk_id_estudio}, function(data, status){
				
				var datos = jQuery.parseJSON(data);

				console.log(datos) 
				$("#frm-edit label").attr("class","active")
       			$("#frm-edit #id_factura").val(datos.fk_id_factura)

				$("#frm-edit #desc_estudio").val(datos.desc_estudio)
				$("#frm-edit #nombre_plantilla").val(datos.nombre_plantilla)
				$("#frm-edit #titulo_desc").val(datos.titulo_desc)
				$("#frm-edit #descripcion").val(datos.descripcion)
				$("#frm-edit #firma").val(datos.firma)
				})

			});
		}




$("#frm-edit").on('submit', function (e) 
    {
      e.preventDefault()

        $.ajax({
            type: "POST",                 
            url: "controladores/editar_resultado.php",                    
            data: $("#frm-edit").serialize(),
            beforeSend: function(){
            },
            success: function(data)            
            {
              if(data==1)
              {
                var table = $('#dt_agenda').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                Swal.fire("Agregados correctamente")
                console.log(data)
              }
              else
              {
                Swal.fire('Error en MySQL, Error numero:  '+ data)
                console.log(data)
              }
            }
          });          
    });
// validar
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

			confirmButtonText: 'Si, Validarlo!',

			reverseButtons: true

		}).then((result) => {

			if (result.value) {

				 $.post("./controladores/validar.php", {'id_factura' : data.id_factura}  , function(data,status)

				{

					swalWithBootstrapButtons(

					'Validado!',

					'El estudio a sido validado',

					'success'

				)

					console.log(data)

					var table = $('#dt_agenda').DataTable(); // accede de nuevo a la DataTable.

							table.ajax.reload(); // linea 106 del error de la consola



				});

				

			} else if (

				// Read more about handling dismissals

				result.dismiss === swal.DismissReason.cancel

			) {

				swalWithBootstrapButtons(

					'Cancelado',

					'El estudio no fue validado :)',

					'error'

				)

			}

		})

			

	});

}

		var idioma_espanol = {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}