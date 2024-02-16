
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
					{"data" : "desc_sucursal"},
					{"data" : "id_factura"},
					{"data" : "fechafactura"},
					{"data" : "nombrecliente"},
					{"data" : "imp_total"},
					{"data" : "a_cuenta"},
					{"data" : "resta"},
					{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"}
				],
				"language": idioma_espanol
			});


			obtener_data_editar("#dt_medicos tbody", table);
			obtener_id_eliminar("#dt_medicos tbody", table);
		}
// editamos medicos
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#frmedit #idfactura").val( data.id_factura );
				$("#frmedit #fi_id_factura").val( data.id_factura);
				$("#frmedit #fi_nombre").val( data.nombrecliente);
				$("#frmedit #fi_imp_total").val( data.imp_total);
				$("#frmedit #fi_a_cuenta").val( data.a_cuenta);
				$("#frmedit #fi_resta").val( data.resta);
				$("#frmedit #fi_tipo_pago").val( data.tipo_pago);
				
				console.log(data);


			});
		}
/*
// eliminndo mwdicos
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_ocupacion = $("#frmEliminarmedico #idmedico").val( data.id_medico);
				medico =$("#frmEliminarmedico #medico").val(data.id_medico);
				 nombre =$("#frmEliminarmedico #nombre").val(data.nombre);
				opcion = $("#frmEliminarmedico #opcion").val("eliminar");
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
