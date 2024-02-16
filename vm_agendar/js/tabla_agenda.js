
		$(document).on("ready", function(){
			listar();
			//guardar();
			//eliminar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

// listar datos en la tabla de medicos
		var listar = function(){
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_medicos").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "id_medico"},
					{"data" : "nombre"},
					{"data" : "a_paterno"},
					{"data" : "a_materno"},
					{"data" : "actual"},
					{"data" : "uno"},
					{"data" : "dos"},
					{"data" : "tres"},
					{"data" : "cuatro"},
					{"data" : "primer_fecha"},
					{"data" : "veces"},
					{"data" : "ultima_fecha"},
					{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'><i class='fa fa-edit'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-alt'></i></button>"}
				],
				"language": idioma_espanol
			});

			obtener_data_agregar("#dt_medicos tbody", table);
			obtener_data_editar("#dt_medicos tbody", table);
			obtener_id_eliminar("#dt_medicos tbody", table);
		}

// Agregamos medicos
		var obtener_data_agregar = function(tbody, table){
			$(tbody).on("click", "button.agregar", function(){
				var data = table.row($(this).parents("tr")).data();
				var id_agenda = $("#frm_add #id_agenda").val(data.id_agenda)
					fi_medico = $("#frm_add #fi_medico").val(data.fk_id_medico)
					fi_fecha = $("#frm_add #fi_fecha").val(data.fecha)
					fi_hora = $("#frm_add #fi_hora").val(data.hora)
					estado = $("#frm_add #estado").val(data.estado)
					

					console.log(data);
			});
		}	 

	$("#frm_add").on('submit', function(e)
	{
		e.preventDefault()
		$.ajax({
			type: "POST",
			url: "controladores/registro_agenda.php",
			data: $("#frm_add").serialize(),
			beforeSend: function(){
			},
			success: function(data) 
				{
					if(data == 1)
					{
						var table = $('#dt_medicos').DataTable()
						table.ajax.reload();
						document.getElementById("frm_add").reset();
						Swal('Datos guardados correctamente')
						console.log(data)	
					}
					else
					{
						if (data == 999){
							Swal("El medico ya fue asignado en este dia")
						}else{
							Swal("Error en MySQL, Error numero" + data)
							console.log(data)	
						}
						
					}
			}
		});
	});
// editamos medicos
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				//var id_agenda= $("#frmedit #id_agenda").val( data.id_agenda )
				//$("#frmedit #fi_id_medico").val( data.id_medico);			
				fi_medico = $("#frmedit #fi_medico").val( data.id_medico)
				fi_fecha = $("#frmedit #fi_fecha").val( data.ultima_fecha)
				fi_hora = $("#frmedit #fi_hora").val( data.hora)
				//estado = $("#frmedit #estado").val( data.estado)

				opcion = $("#frmedit #opcion").val("modificar")

				console.log(data);


			});
		}

	$("#frmedit").on('submit', function (e) 
 	 {
  	    e.preventDefault()
    	  $.ajax({
        	  type: "POST",                 
			  //url: "controladores/actualizar.php",  se cambio para que en la actualización se guardara un nuevo registro.  
			  url: "controladores/registro_agenda.php",                
          	data: $("#frmedit").serialize(),
          	beforeSend: function(){
          	},
          	success: function(data)            
           		{
            		if(data == 1)
            		{
            			Swal.fire('Datos guardados')
            			var table = $("#dt_medicos").DataTable()
            			      	

            			table.ajax.reload()
            			//console.log(data)
            			//location.reload()
            			//window.opener.document.location="./tabla_est.php";
            			
            		}else
            		{
						//console.log(data)
						if (data == 999){
							Swal("El medico ya fue asignado en este dia")
						}else{
							Swal("Error en MySQL, Error numero" + data)
							//console.log(data)	
						}
            	
            		}
            	}
          	});          
  	});


		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				
				const swalWithBootstrapButtons = swal.mixin({
					confirmButtonClass: 'btn btn-success',
					cancelButtonClass: 'btn btn-danger',
					buttonStyling: false,
				})

				swalWithBootstrapButtons({
					title: 'Estas segur@',
					text: 'No podras revertir esta accion!',
					type: 'warning',
					showCancelButton: true,
					cancelButtonText: 'No, Cancelar!',
					confirmButtonText: 'Si, Eliminarlo!',
					reverseButtons: true
				}).then((result) => {
					if(result.value) {
						$.post("./controladores/eliminar_agenda.php", {'id_medico' : data.id_medico} , function(data,status)
						{
							swalWithBootstrapButtons(
								'Eliminado!',
								'La informacion ha sido eliminada',
								'succes'
								)
							console.log(data)
							var table = $('#dt_medicos').DataTable();
							table.ajax.reload();
						});
					}
					else if (
						result.dismiss == swal.DismissReason.cancel
						){
						swalWithBootstrapButtons(
							'Cancelado',
							'Los archivos estan seguros :)',
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
