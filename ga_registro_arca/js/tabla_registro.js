
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
			var table = $("#dt_registro").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "id_registro"},
					{"data" : "desc_sucursal"},
					{"data" : "desc_clasifica"},
					{"data" : "desc_tipo_gasto"},
					{"data" : "desc_gasto"},
					{"data" : "desc_estado"},
					{"data" : "nota"},
					{"data" : "num_comprobante"},
					{"data" : "importe"},
					{"data" : "fecha_mov"},
					
					//{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"},

					{
						render:function(data,type,row){
							var estado;
							estado=row['estado'];
							perfil=row['perfil'];
							if(estado=='E')
							{
								return "<form-group style='text-align:center;'>"+
								"<button  id='edit'  type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>";
							}else 
							if(estado=='A' && perfil == 1)
							{
								return "<form-group style='text-align:center;'>"+
								"<button  id='edit'  type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>";
					
							}
							else{
								return "<form-group style='text-align:center;'>"+
								"<button  id='out'  type='button' class='btn btn-info btn-md'><span  class='fa fa-ban'></span></button>"+
								"</form-group>";
							}		

							},
					},
					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}

					{
						render:function(data,type,row){
							var estado;
							estado=row['estado'];
							if(estado=='E'){
								return "<form-group style='text-align:center;'>"+
								"<button  type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>";
							}else{
								return "<form-group style='text-align:center;'>"+
								"<button  id='out'  type='button' class='btn btn-info btn-md'><span  class='fa fa-ban'></span></button>"+
								"</form-group>";
							}		

							},
					}

				],
				"language": idioma_espanol
			});


			obtener_data_editar("#dt_registro tbody", table);
			obtener_id_eliminar("#dt_registro tbody", table);
		}
// editamos medicos
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#frmedit #idregistro").val( data.id_registro );
				$("#frmedit #fi_gasto").val( data.fk_id_gasto);
				$("#frmedit #fi_importe").val( data.importe);
				$("#frmedit #fi_nota").val( data.nota);
				$("#frmedit #fi_fmov").val( data.fecha_mov);
				$("#frmedit #estado").val( data.estado);	
				$("#frmedit #beneficia").val( data.fk_id_beneficiario);
				$("#frmedit #fi_compro").val( data.num_comprobante);			
				console.log(data);
			});
		}

// eliminndo mwdicos
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_registro = $("#frmEliminarregistro #idregistro").val( data.id_registro);
				registro =$("#frmEliminarregistro #registro").val(data.id_registro);
				 nombre =$("#frmEliminarregistro #nombre").val(data.desc_gasto);
				opcion = $("#frmEliminarregistro #opcion").val("eliminar");
				console.log(data);
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
