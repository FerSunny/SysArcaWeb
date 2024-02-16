		$(document).ready(function() {
			listar();
		});
		var listar = function(){
			var table = $("#dt_cliente").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
                    { "data": "id_estudio" },
					{ "data": "desc_estudio" },
					{ "data": "costo" },
                    {"defaultContent": "<button type='button' class='agregar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"}
				],
				"language": idioma_espanol
			});

			obtener_data_editar("#dt_cliente tbody", table);
            //detalle("#dt_cliente tbody", table);
           
		} 
        
       /*var detalle= function(tbody, table){
			$(tbody).on("click", "button.agregar", function(){
                alert("HOLA");
				var data = table.row( $(this).parents("tr") ).data();
				 //$("#editdetalle #idusuario").val( data.id_estudio );
                 $("#e1").val(data.desc_estudio);
				 $("#c1").val(data.costo);
				console.log(data);
			});*/

		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.agregar", function(){
                var importe1=0;
                var importe2=0;
                var importe3=0;
                var importe4=0;
                var importe5=0;
                var suma=0;
                var num=1;
                if ($('#txtestudio').val() === '' && $('#txtcosto').val()){
                    var data = table.row( $(this).parents("tr") ).data();
				        $("#txtestudio ").val( data.desc_estudio );
						$("#txtcosto").val( data.costo );
                        $("#f1").val(num);
                        $("#c1").val(data.id_estudio);
                }else
                if($('#txtestudio1').val() === '' && $('#txtcosto1').val())
                {
                           var data = table.row( $(this).parents("tr") ).data();
				        $("#txtestudio1 ").val( data.desc_estudio );
						$("#txtcosto1").val( data.costo );            
						console.log(data);
                        $("#f2").val(num);
                        $("#c2").val(data.id_estudio);
                }else
                  if($('#txtestudio2').val() === '' && $('#txtcosto2').val())
                {
                           var data = table.row( $(this).parents("tr") ).data();
				        $("#txtestudio2 ").val( data.desc_estudio );
						$("#txtcosto2").val( data.costo );
                        $("#f3").val(num);
						console.log(data);
                        $("#c3").val(data.id_estudio);
                }else
                 if($('#txtestudio3').val() === '' && $('#txtcosto3').val())
                {
                           var data = table.row( $(this).parents("tr") ).data();
				        $("#txtestudio3 ").val( data.desc_estudio );
						$("#txtcosto3").val( data.costo );
                        $("#f4").val(num);
						console.log(data);
                        $("#c4").val(data.id_estudio);
                }else
                 if($('#txtestudio4').val() === '' && $('#txtcosto4').val())
                {
                           var data = table.row( $(this).parents("tr") ).data();
				        $("#txtestudio4 ").val( data.desc_estudio );
						$("#txtcosto4").val( data.costo );
                        $("#f5").val(num);
						console.log(data);
                        $("#c5").val(data.id_estudio);
                }else
               
                if($('#txtestudio1').val() && $('#txtcosto1').val()){
                    alert ("Ya no se pueden agregar estudios")
                }
        
                $(".txtcosto").each(
		          function(index, value) {
			         importe1 = eval($(this).val());
		          }
                    ); 
                
                    $(".txtcosto1").each(
                        function(index, value) {
                            importe2 =eval($(this).val());
                          
                        }
                    );
                
                    $(".txtcosto2").each(
                        function(index, value) {
                            importe3 =eval($(this).val());
                        }
                    );
                    $(".txtcosto3").each(
                        function(index, value) {
                            importe4 =eval($(this).val());
                        }
                    );
                    $(".txtcosto4").each(
                        function(index, value) {
                            importe5 =eval($(this).val());
                        }
                    );
                
                     $(".cuenta").each(
                        function(index, value) {
                            cuenta =eval($(this).val());
                        }
                    );
                
                    $("#importe").val(importe1 + importe2 + importe3 + importe4 + importe5);
                    $("#ttotal").val(importe1 + importe2 + importe3 + importe4 + importe5);
                    $("#resta").val((importe1 + importe2 + importe3 + importe4 + importe5)-cuenta)

				

			});
            
		}
        
    
        

		/*var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_estudio = $("#frmEliminarUsuario #idusuario").val( data.id_estudio );
				 id_estudio =$("#frmEliminarUsuario #usuario").val(data.id_estudio);
				 desc_estudio=$("#frmEliminarUsuario #desc").val(data.desc_estudio);
				opcion = $("#frmEliminarUsuario #opcion").val("eliminar");
				console.log(data);
			});
		}*/

		var idioma_espanol = {
		    "sProcessing":     "Procesando...",
               "sLengthMenu": 'Mostrar <select>'+
		    	'<option value="3">3</option>'+
		        '</select> registros',
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