
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
					"url": "listar_hojas.php"
				},
				"columns":[
					{"data" : "id_hoja"},
					{"data" : "fecha_visita"},
					{"data" : "desc_visita"},
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
				var id_medico = $("#frm_add #id_medico").val(data.id_medico)
					fk_id_zona = $("#frm_add #fi_zona").val(data.fk_id_zona)
					nombre = $("#frm_add #fi_nombre").val(data.nombre)
					a_paterno = $("#frm_add #fi_apaterno").val(data.a_paterno)
					a_materno = $("#frm_add #fi_amaterno").val(data.a_materno)
					rfc = $("#frm_add #fi_rfc").val(data.rfc)
					sexo = $("#frm_add #fi_sexo").val(data.fk_id_sexo)
					especialidad = $("#frm_add #fi_especialidad").val(data.fk_id_especialidad)
					estado = $("#frm_add #fi_estado").val(data.fk_id_estado)

					$.post("./controladores/buscar.php?val=1", {'id_estado' : data.fk_id_estado, 'id_municipio' : data.fk_id_municipio}  , function(res,status)
      					{
      						console.log(res)
      						$("#frm_add #fi_Municipio").html(res);
      						$("#frm_add #fi_Municipio option[value='"+data.fk_id_municipio+"']").attr("selected",true);
      						$('#frm_add #fi_municipio').append(data);	
          				});
 						 
 						
					  	$.post("./controladores/buscar.php?val=2", {'id_estado' : data.fk_id_estado, 'id_municipio' : data.fk_id_municipio}  , function(res,status)
      					{
      						console.log(res)
      						$("#frm_add #fi_Localidad").html(res);
      						$("#frm_add #fi_Localidad option[value='"+data.fk_id_localidad+"']").attr("selected",true);
      						$('#frm_add #fi_municipio').append(data);	
          				});

					//municipio = $("#frm_add #fi_Municipio").val(data.fk_id_municipio)
					//localidad = $("#frm_add #fi_Localidad").val(data.fk_id_localidad)
					colonia = $("#frm_add #fi_colonia").val(data.colonia)
					cp = $("#frm_add #fi_cp").val(data.cp)
					calle = $("#frm_add #fi_calle").val(data.calle)
					numero = $("#frm_add #fi_numero").val(data.numero_exterior)
					referencia = $("#frm_add #fi_referencia").val(data.referencia)
					telefono_fijo = $("#frm_add #fi_tfijo").val(data.telefono_fijo)
					telefono_movil = $("#frm_add #fi_movil").val(data.telefono_movil)
					e_mail = $("#frm_add #fi_mail").val(data.e_mail)
					horario = $("#frm_add #fi_horario").val(data.horario)
					cbanco = $("#frm_add #fi_cbanco").val(data.cuenta_banco)
					//adscrito = $("#frm_add #fn_ads").val(data.adscrito)
					fecha_registro = $("#frm_add #fi_falta").val(data.fecha_registro)
					fecha_actuaizacion = $("#frm_add #fi_factualiza").val(data.fecha_actuaizacion)
					estado = $("#frm_add #estado_reg").val(data.estado)
					sucursal = $("#frm_add #fi_sucursal").val(data.fk_id_sucursal)
					latitud = $("#frm_add #fi_lat").val(data.latitud)
					longitud = $("#frm_add #fi_lon").val(data.longitud)
					altitud = $("#frm_add #fi_alt").val(data.altitud)
					tipo_consul = $("#frm_add #fi_tipo_consul").val(data.tipo_consul)
					observaciones = $("#frm_add #fi_observaciones").val(data.observaciones)
					//medico = $("#frm_add #fi_med").val(data.medico)
					otro_lab = $("#frm_add #fi_otro_lab").val(data.otro_lab)
					visitador = $("#frm_add #fi_visitador").val(data.fk_id_usuario)

					activado = $("#frm_add #fi_acti").val(data.activado)
					pass = $("#frm_add #fi_pass").val(data.pass)
					token = $("#frm_add #fi_tok").val(data.token)
					usuario = $("#frm_add #fi_usu").val(data.usuario)

					console.log(data);
			});
		}	 

	$("#frm_add").on('submit', function(e)
	{
		e.preventDefault()
		$.ajax({
			type: "POST",
			url: "controladores/registro_hojas.php",
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
						Swal("Error en MySQL, Error numero" + data)
						console.log(data)
					}
			}
		});
	});
// editamos medicos
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_hoja= $("#frmedit #id_hoja").val( data.id_hoja )
				//$("#frmedit #fi_id_medico").val( data.id_medico);
				fi_edovisita = $("#frmedit #fi_edovisita").val( data.fk_id_estado_visita)
				fi_participa = $("#frmedit #fi_participa").val( data.participaciones)
				fi_publicidad = $("#frmedit #fi_publicidad").val( data.publicidad)
				
				fi_ordenes_i = $("#frmedit #fi_ordenes_i").val( data.ordenes_fi)
				fi_ordenes_f = $("#frmedit #fi_ordenes_f").val( data.ordenes_ff)

				fi_quejas = $("#frmedit #fi_quejas").val( data.quejas)
				fi_sugiere = $("#frmedit #fi_sugiere").val( data.sugerencias)
				fi_observaciones = $("#frmedit #fi_observaciones").val( data.observaciones)
				fi_mail = $("#frmedit #fi_mail").val( data.mail_resultados)
				fi_ce = $("#frmedit #fi_ce").val( data.consulta_externa)
				fi_falta = $("#frmedit #fi_falta").val( data.fecha_visita)
				fi_halta = $("#frmedit #fi_halta").val( data.hora_visita)
				estado_reg = $("#frmedit #estado_reg").val( data.estado)

				opcion = $("#frmedit #opcion").val("modificar")

				console.log(data);


			});
		}

	$("#frmedit").on('submit', function (e) 
 	 {
  	    e.preventDefault()
    	  $.ajax({
        	  type: "POST",                 
          	url: "controladores/actualizar.php",                    
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
            			console.log(data)
            			//location.reload()
            			//window.opener.document.location="./tabla_est.php";
            			
            		}else
            		{
            			Swal.fire("Error MySQL #" + data)
            	
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
						$.post("./controladores/eliminar_hoja.php", {'id_hoja' : data.id_hoja} , function(data,status)
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
