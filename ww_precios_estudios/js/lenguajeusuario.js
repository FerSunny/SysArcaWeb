
		$(document).on("ready", function(){
			listar();
			//guardar();
			//eliminar();
		});
/*
		$("#btn_listar").on("click", function(){
			listar();
		});
*/
/*
		var guardar = function(){
			$("#form").on("click", function(e){
				e.preventDefault();
				var frm = $(this).serialize();
				console.log(frm)
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: frm
				}).done( function( info ){
					console.log(info);
					var json_Info = JSON.parse( info );
					console.log(json_info);
					mostrar_mensaje( json_info );
					limpiar_datos();
					listar();
				});
			});
		}
*/

/*
		var mostrar_mensaje = function( informacion ){
			var texto = "", color = "";
			if( informacion.respuesta == "BIEN" ){
					texto = "<strong>Bien!</strong> Se han guardado los cambios correctamente.";
					color = "#379911";
			}else if( informacion.respuesta == "ERROR"){
					texto = "<strong>Error</strong>, no se ejecutó la consulta.";
					color = "#C9302C";
			}else if( informacion.respuesta == "EXISTE" ){
					texto = "<strong>Información!</strong> el usuario ya existe.";
					color = "#5b94c5";
			}else if( informacion.respuesta == "VACIO" ){
					texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
					color = "#ddb11d";
			}else if( informacion.respuesta == "OPCION_VACIA" ){
					texto = "<strong>Advertencia!</strong> la opción no existe o esta vacia, recargar la página.";
					color = "#ddb11d";
			}

			$(".mensaje").html( texto ).css({"color": color });
			$(".mensaje").fadeOut(5000, function(){
					$(this).html("");
					$(this).fadeIn(3000);
			});
		}

		var limpiar_datos = function(){
			$("#opcion").val("registrar");
			$("#idusuario").val("");
			$("#nombre").val("").focus();
			$("#apellidos").val("");
			$("#dni").val("");
		}
*/
		var listar = function(){
				$("#cuadro2").slideUp("slow");
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_cliente").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{ "data": "id_estudio" },
					//{ "data": "iniciales" },
					{ "data": "desc_estudio" },
					//{ "data": "urgente" },
					{ "data": "tiempo_entrega" },
					{ "data": "costo" },
					{ "data": "precio" },
					{ "data": "desc_comision" },
					{ "data": "desc_descuento" },
					{ "data": "desc_promocion" },
					{ "data": "desc_indicaciones"},

					{
						render:function(data,type,row){
							var tipoestudio = row['tipoestudio']

							switch(tipoestudio){
								case 'nr':
									return "<form-group style='text-align:center;'>"+
									"<a id='printer' target='_blank' href='../ww_precios_estudios/tabla_conceptos.php?studio="+row['id_estudio']+"&plantilla="+row['fk_id_plantilla']+"' class='btn btn-success btn-md'  role='button'><span class='far fa-bell' style='color:white;'></span></a>"+
									"</form-group>";
									break;
								case 'pe':
									return "<form-group style='text-align:center;'>"+
									"<a id='printer'  href='../ww_precios_estudios/tabla_perfiles.php?studio="+row['id_estudio']+"&plantilla="+row['fk_id_plantilla']+"' class='btn btn-success btn-md'  role='button'><span class='fas fa-stethoscope' style='color: white;'></span></a>"+
									"</form-group>";
									break;
								case 'pq':
									return "<form-group style='text-align:center;'>"+
									"<a id='printer'  href='../ww_precios_estudios/tabla_paquetes.php?studio="+row['id_estudio']+"&plantilla="+row['fk_id_plantilla']+"' class='btn btn-success btn-md'  role='button'><span class='fas fa-compass' style='color: white;'></span></a>"+
									"</form-group>";
									break;
								default:
									console.log('otro')
									return "<button type='button' class='btn btn-info'><i class='fas fa-exclamation-triangle'></i></button>"

							}
						},

					},


					//{ "data": "desc_muestra"},
					//{ "data": "estatus"},
					//{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"},
					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
				],
				"language": idioma_espanol
			});

			obtener_data_editar("#dt_cliente tbody", table);
			obtener_id_eliminar("#dt_cliente tbody", table);
		}
/*
		var agregar_nuevo_usuario = function(){
			limpiar_datos();
			$("#cuadro2").slideDown("slow");
			$("#cuadro1").slideUp("slow");
		}

		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_estudio = $("#frmedit #idusuario ").val( data.id_estudio ),
						id_estudio = $("#frmedit #edit1").val( data.id_estudio ),
						iniciales = $("#frmedit #edit2").val( data.iniciales),
						desc_estudio=$("#frmedit #edit3").val(data.desc_estudio),
						fk_id_tipo_estudio = $("#frmedit #edit4").val( data.fk_id_tipo_estudio ),
						urgente = $("#frmedit #edit5").val( data.urgente ),
						tiempo_entrega= $("#frmedit #edit6").val( data.tiempo_entrega),
						fk_id_comision= $("#frmedit #edit7").val( data.fk_id_comision ),
						observaciones = $("#frmedit #edit8").val( data.observaciones ),
						per_perfil = $("#frmedit #edit9").val( data.per_perfil),
						costo = $("#frmedit #edit10").val( data.costo ),
						fk_id_descuento = $("#frmedit #edit11").val( data.fk_id_descuento),
						fk_id_promosion = $("#frmedit #edit12").val( data.fk_id_promosion),
						fk_id_indicaciones = $("#frmedit #edit13").val( data.fk_id_indicaciones),
						fk_id_muestra = $("#frmedit #edit14").val( data.fk_id_muestra),
						fk_id_muestra_1 = $("#frmedit #edit14_1").val( data.fk_id_muestra_1),
						fk_id_muestra_2 = $("#frmedit #edit14_2").val( data.fk_id_muestra_2),
						fk_id_muestra_3 = $("#frmedit #edit14_3").val( data.fk_id_muestra_3),
						fk_id_muestra_4 = $("#frmedit #edit14_4").val( data.fk_id_muestra_4),
						estatus=$("#frmedit #edit15").val(data.estatus),
						opcion = $("#frmedit #opcion").val("modificar");
						console.log(data);

			});
		}

		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_estudio = $("#frmEliminarUsuario #idusuario").val( data.id_estudio );
				 id_estudio =$("#frmEliminarUsuario #usuario").val(data.id_estudio);
				 desc_estudio=$("#frmEliminarUsuario #desc").val(data.desc_estudio);
				opcion = $("#frmEliminarUsuario #opcion").val("eliminar");
				console.log(data);
			});
		}
*/
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
