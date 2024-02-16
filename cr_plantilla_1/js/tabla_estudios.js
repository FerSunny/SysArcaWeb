
		$(document).on("ready", function(){
			listar();
			//guardar();
			//eliminar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

// listar datos en la tabla de perfiles
		var listar = function(){
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_plantilla_1").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar_estudios.php"
				},
				"columns":[
					{"data" : "id_estudio"},
					{"data" : "desc_estudio"},
					{"data" : "numconceptos"},
					
					//{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'><i class='fas fa-edit'></i></button>"},
					{
						render:function(data,type,row){

							return "<form-group style='text-align:center;'>"+
							//"<a id='printer'  href='../ww_precios_estudios/tabla_conceptos.php?numero_factura="+row['id_factura']+"&studio="+row['fk_id_estudio']+"' class='btn btn-success btn-md' role='button'><span class='fas fa-edit' style='color: white;'></span></a>"+
							"<a id='printer'  href='../cr_plantilla_1/tabla_plantilla_1.php?studio="+row['id_estudio']+"' class='btn btn-success btn-md' role='button'><span class='fas fa-edit' style='color: white;'></span></a>"+
							"</form-group>";
						},

					},					
					
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger'><i class='fas fa-trash-alt'></i></button>"},
					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger'><i class='fas fa-print'></i></button>"}
					{

						render:function(data,type,row){

							return "<form-group style='text-align:center;'>"+

							"<a id='printer' target='_blank' href='./reports/print_result_p1.php?numero_factura="+row['id_factura']+"&studio="+row['id_estudio']+"' class='btn btn-warning btn-md' role='button'><span  class='fa fa-print'></span></a>"+

							"</form-group>";

							},

					},				
				
				
				
				],
				"language": idioma_espanol
			});


			obtener_data_editar("#dt_plantilla_1 tbody", table);
			obtener_id_eliminar("#dt_plantilla_1 tbody", table);
		}

	$("#plantilla_add").on('submit', function (e) 
  	{
      e.preventDefault()
      	$.ajax({
         	type: "POST",                 
          	url: "controladores/registro_estudio.php",                    
          	data: $("#plantilla_add").serialize(),
          	beforeSend: function(){
          	},
          	success: function(data)            
            {
              if(data==1)
              {
                var table = $('#dt_plantilla_1').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                document.getElementById("plantilla_add").reset();
               	Swal.fire("Agregados correctamente")
                console.log(data)
              }
              else
              {
				if(data==1062){
					Swal.fire('Estudio ya tiene plantilla')
				}
				else{
					Swal.fire('Error en MySQL, Error numero:  '+ data)
					console.log(data)					
				}
              }
            }
          });          
  	});


// editamos perfiles
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#plantilla_edit #idvalor").val( data.id_valor );
				$("#plantilla_edit #fi_orden").val( data.orden);
				$("#plantilla_edit #fi_estudio").val( data.fk_id_estudio);
				$("#plantilla_edit #fi_tipo").val( data.tipo);
				$("#plantilla_edit #fi_interface").val( data.codigo_int);			
				$("#plantilla_edit #fi_concepto").val( data.concepto);
				$("#plantilla_edit #fi_valor_refe").val( data.valor_refe);
				$("#plantilla_edit #fi_unidad_medida").val( data.unidad_medida);
				$("#plantilla_edit #fi_posini").val( data.posini);
				$("#plantilla_edit #fi_tamfue").val( data.tamfue);
				$("#plantilla_edit #fi_tipfue").val( data.tipfue);
				$("#plantilla_edit #fi_estado").val( data.estado);
				
				console.log(data);


			});
		}


	$("#plantilla_edit").on('submit', function (e) 
  	{
      e.preventDefault()
      	$.ajax({
         	type: "POST",                 
          	url: "controladores/actualizar.php",                    
          	data: $("#plantilla_edit").serialize(),
          	beforeSend: function(){
          	},
          	success: function(data)            
            {
              if(data==1)
              {
                var table = $('#dt_plantilla_1').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
               swal("Editado correctamente")
                console.log(data)
              }
              else
              {
                swal('Error en MySQL, Error numero:  '+ data)
                console.log(data)
              }
            }
          });          
  	});

// eliminndo usuarios


		var obtener_id_eliminar= function(tbody, table) {
	    $(tbody).on("click", "button.eliminar", function() {
	      var data = table.row($(this).parents("tr")).data();

	      const swalWithBootstrapButtons = swal.mixin({
	        confirmButtonClass: 'btn btn-success',
	        cancelButtonClass: 'btn btn-danger',
	        buttonsStyling: false,
	      })

	      swalWithBootstrapButtons({
	        title: 'Estas segur@?',
	        text: "No podras revertir esta accion!",
	        type: 'warning',
	        showCancelButton: true,
	        cancelButtonText: 'No, Cancelar!',
	        confirmButtonText: 'Si, Eliminarlo!',
	        reverseButtons: true
	      }).then((result) => {
	        if (result.value) {
	           $.post("controladores/eliminar_estudio.php", {'idvalor' : data.id_estudio}  , function(data,status)
	          {
	          	if(data == 1)
	          	{
	          		swalWithBootstrapButtons(
			            'Eliminado!',
			            'La informacion ha sido eliminada',
			            'success'
			         )
			         var table = $('#dt_plantilla_1').DataTable(); // accede de nuevo a la DataTable.
	                table.ajax.reload(); // linea 106 del error de la consola
	          	}else
	          	{
	          		swal('Error en MySQL, Error numero:  '+ data)
               	 	console.log(data)
	          	}
	          });
	          
	        } else if (
	          // Read more about handling dismissals
	          result.dismiss === swal.DismissReason.cancel
	        ) {
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
