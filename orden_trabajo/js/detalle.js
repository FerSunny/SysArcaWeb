    
	$(document).ready(function() {
			listar5();
		});
        var listar5 = function(){
			var table = $("#dt_estudios").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar5.php"
				},
				"columns":[
					{ "data": "fk_id_solicitud" },
                    { "data": "fk_id_estudio" },
                     { "data": "desc_estudio" },
                    { "data": "precio" },
                    {"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar3'>.<i class='fa fa-pencil-square-o'></i></button>"}
                    
				],
				"language": idioma_espanol
			});

			detalle_editar1("#dt_estudios", table);
			//obtener_id_eliminar("#dt_cliente tbody", table);
		}

        
         var detalle_editar1 = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_muestra = $("#frmedit #idusuario").val( data.id_muestra ),
						desc_estudio = $("#editdetalle #txtestudio").val( data.desc_estudio),
                    precio = $("#editdetalle #txtcosto").val( data.precio);
						console.log(data);

			});
		}

        