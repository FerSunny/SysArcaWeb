		$(document).on("ready", function(){

			listar();

			//guardar();

			//eliminar();

		});



		$("#btn_listar").on("click", function(){

			listar();

		});



// listar datos en la tabla de comisiones

		var listar = function(){

				$("#cuadro1").slideDown("slow");

			var table = $("#dt_colpo").DataTable({

				"destroy":true,

				"sRowSelect": "multi",

				"ajax":{

					"method":"POST",

					"url": "listar_medicos.php"

				},

				"columns":[

					

					{"data" : "id_medico"},

					{"data" : "iniciales"},

					{"data" : "nombre"},

					{"data" : "a_paterno"},

					{"data" : "a_materno"},

					{"data" : "fecha_registro"},

					{"data" : "primer_nota"},

					{"data" : "ultima_nota"},

					{"data" : "promedio"},

					{

						render:function(data,type,row){				

						return "<form-group style='text-align:center;'>"+

						"<a id='printer' href='../vm_visita_su/tabla_hojas.php?numero_factura="+row['id_medico']+"'  class='btn btn-info' role='button'><span  class='fa fa-file-text-o'></span></a>"+

						"</form-group>";

						}

					}



				],

				"language": idioma_espanol

			});



			obtener_data_editar("#dt_colpo tbody", table);

			obtener_id_eliminar("#dt_colpo tbody", table);

			obtener_data_registrar("#dt_colpo tbody", table);

		}



// registrar

		var obtener_data_registrar = function(tbody, table){

			$(tbody).on("click", "button.registrar", function(){

				var data = table.row( $(this).parents("tr") ).data();



				var id_factura = $("#AltasEstudio #fi_id_factura").val( data.id_factura)

					   fk_id_estudio = $("#AltasEstudio #fi_fk_id_estudio").val( data.fk_id_estudio)

						//estado = $("#frmedit #edit2").val( data.estado),

						//opcion = $("#frmedit #opcion").val("modificar");

						console.log(data);

						//alert(data.id_factura);



					



			});

		}







// modificar

		var obtener_data_editar = function(tbody, table){

			$(tbody).on("click", "button.editar", function(){

				var data = table.row( $(this).parents("tr") ).data();

				var fi_id_factura = $("#frmedit #fi_id_factura").val( data.id_factura),

						fi_fk_id_estudio = $("#frmedit #fi_fk_id_estudio").val( data.fk_id_estudio),

					    fi_titulo_desc   = $("#frmedit #fi_titulo_desc").val( data.titulo_desc),

						fi_descripcion   = $("#frmedit #fi_descripcion").val( data.descripcion),

						fi_t_allazgos   = $("#frmedit #fi_t_allazgos").val( data.t_otros_allazgos),

						fi_d_allazgos   = $("#frmedit #fi_d_allazgos").val( data.d_otros_allazgos),



						fi_t_diagnostico   = $("#frmedit #fi_t_diagnostico").val( data.t_diagnostico),

						fi_d_diagnostico   = $("#frmedit #fi_d_diagnostico").val( data.d_diagnostico),



						fi_t_comenta   = $("#frmedit #fi_t_comenta").val( data.t_comentarios),

						fi_d_comenta   = $("#frmedit #fi_d_comenta").val( data.d_comentarios),







						opcion           = $("#frmedit #opcion").val("modificar");

						console.log(data);



			});

		}



// eliminndo la comision

		var obtener_id_eliminar = function(tbody, table){

			$(tbody).on("click", "button.eliminar", function(){

				var data = table.row( $(this).parents("tr") ).data();

				var fi_id_factura =   $("#frmEliminarzona #fi_id_factura").val( data.id_factura),

				 fi_fk_id_estudio =   $("#frmEliminarzona #fi_fk_id_estudio").val(data.fk_id_estudio),

				 fi_titulo_desc =     $("#frmEliminarzona #fi_titulo_desc").val(data.titulo_desc),

				opcion =              $("#frmEliminarzona #opcion").val("eliminar");

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

