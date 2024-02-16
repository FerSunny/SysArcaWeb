    
	$(document).ready(function() {
			listar1();
		});
        var listar1 = function(){
			var table = $("#dt_paciente").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar2.php"
				},
				"columns":[
					{ "data": "nombre" },
					{ "data": "a_paterno" },
                    { "data": "a_materno" },
                    {"defaultContent": "<button type='button' class='agregar1 btn btn-primary'>.<i class='fa fa-pencil-square-o'></i></button>"}
				],
				"language": idioma_espanol
			});

			data_editar("#dt_paciente tbody", table);
			//obtener_id_eliminar("#dt_cliente tbody", table);
		}


            var data_editar = function(tbody, table){
			$(tbody).on("click", "button.agregar1", function(){
                
                if ($('#nombre').val() === ''){
                   var data = table.row( $(this).parents("tr") ).data();
				        $("#nombre").val( data.nombre +" " + data.a_paterno + " " + data.a_materno );
                        $("#edad").val( data.edad );
                        $("#sexo").val( data.sexo );
                        $("#telefono").val( data.telefono_fijo );
                        $("#idpaciente").val(data.id_cliente);
                }else
                if($('#nombre').val()){
                    alert ("Ya no se pueden agregar estudios")
                }
        

				

			});
            
		}
        
    