    
	$(document).ready(function() {
			listar2();
		});
        var listar2 = function(){
			var table = $("#dt_doctor").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar3.php"
				},
				"columns":[
					{ "data": "nombre" },
					{ "data": "a_paterno" },
                    { "data": "a_materno" },
                    { "data": "rfc" },
                    {"defaultContent": "<button type='button' class='agregar2 btn btn-primary'>.<i class='fa fa-pencil-square-o'></i></button>"}
				],
				"language": idioma_espanol
			});

			datos_editar("#dt_doctor tbody", table);
			//obtener_id_eliminar("#dt_cliente tbody", table);
		}

        
         var datos_editar = function(tbody, table){
			$(tbody).on("click", "button.agregar2", function(){
                
                if ($('#doctor').val() === ''){
                   var data = table.row( $(this).parents("tr") ).data();
				        $("#doctor").val( data.nombre + " " + data.a_paterno + " " + data.a_materno );
                        $("#idmedico").val(data.id_medico);
                }else
                if($('#doctor').val()){
                    alert ("Ya no se pueden agregar estudios")
                }
        

				

			});
            
		}

        