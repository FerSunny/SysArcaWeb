$(document).ready(function(){
	listar();
});


		function listar(){
			var table=$('#dt_agenda').DataTable({
				processing: true,
				serverSide: false,
				lengthMenu: [10, 25, 50],
				select: true,
				"ajax":{
					"url":"listar.php",
					"type": "POST",
				},
				"columns":[
					{"data" : "fk_id_cliente"},
					{"data" : "nombre"},
					{"data" : "a_paterno"},
					{"data" : "a_materno"},
					{"data" : "numnotas"},
					{"data" : "primerestudio"},
					{"data" : "ultimoestudio"},
                    //{"data" : "num_imp"},
// Boton para registrar el resultado
					{
						render:function(data,type,row){
							var saldo;
							saldo=row['resta'];
							saldo = '0.00'; // solo para que se puedan registrar sin pago.
							registrado=row['Registrado'];
							perfil = row['perfil'];		
							switch(perfil)
							{ 
								case '11': // recepcionista no tiene acceso a registrar
									return "<form-group style='text-align:center;'>"+
									"<a id='printer' target='_blank'  class='btn btn-success btn-md' role='button'><i class='fas fa-minus-circle'></i></a>"+
									"</form-group>";
									break;									
								default:
									switch(saldo)
										{
										 	case '0.00':
										 		switch(registrado)
												 {
												 	case 'No':
														return "<form-group style='text-align:center;'>"+
														"<a id='printer'  href='../ag_orden_dia_ekg/tabla_plantillas.php?numero_factura="+row['id_factura']+"&studio="+row['fk_id_estudio']+"' class='btn btn-success btn-md' role='button'><span class='fas fa-stethoscope' style='color: white;'></span></a>"+
														"</form-group>";
														break;
													default:
														return "<form-group style='text-align:center;'>"+
														"<a id='printer' target='_blank'  class='btn btn-success btn-md' role='button'><i class='fas fa-thumbs-up'></i></a>"+
														"</form-group>";
												}

											default:
												return "<form-group style='text-align:center;'>"+
												"<a id='printer' target='_blank'  class='btn btn-info btn-md' role='button'><i class='fas fa-hand-holding-usd'></i></a>"+
												"</form-group>";

											
										}							
							}	



							},

					}
				],
				"language": idioma_espanol
			});

	//		mostrar("#dt_agenda tbody", table)
            editar("#dt_agenda tbody", table)

}




		var editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#resultado_usg").modal("show")
				var fac = data.fk_id_factura
			$.post('controladores/buscar_estudio.php',{'val':data.id_factura,'val2': data.fk_id_estudio}, function(data, status){
				
				var datos = jQuery.parseJSON(data);

				console.log(datos) 
				$("#frm-edit label").attr("class","active")
       			$("#frm-edit #id_factura").val(datos.fk_id_factura)

				$("#frm-edit #desc_estudio").val(datos.desc_estudio)
				$("#frm-edit #nombre_plantilla").val(datos.nombre_plantilla)
				$("#frm-edit #titulo_desc").val(datos.titulo_desc)
				$("#frm-edit #descripcion").val(datos.descripcion)
				$("#frm-edit #firma").val(datos.firma)
				})

			});
		}




$("#frm-edit").on('submit', function (e) 
    {
      e.preventDefault()

        $.ajax({
            type: "POST",                 
            url: "controladores/editar_resultado.php",                    
            data: $("#frm-edit").serialize(),
            beforeSend: function(){
            },
            success: function(data)            
            {
              if(data==1)
              {
                var table = $('#dt_agenda').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                Swal.fire("Agregados correctamente")
                console.log(data)
              }
              else
              {
                Swal.fire('Error en MySQL, Error numero:  '+ data)
                console.log(data)
              }
            }
          });          
    });


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