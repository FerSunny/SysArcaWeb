

		$(document).on("ready", function(){

			listar();

			$("#frmedit  #codigo").focus();

		$.fn.dataTable.ext.errMode = 'none';

		});



// listar datos en la tabla de perfiles

		var listar = function(){

				$("#cuadro1").slideDown("slow");

			var table = $("#dt_productos").DataTable({

				"destroy":true,

				"sRowSelect": "multi",

				"ajax":{

					"method":"POST",

					"url": "listar.php"

				},

				"columns":[

					{"data" : "id_queja"},

					{"data" : "desc_servicio"},

					{"data" : "fecha_queja"},

					{"data" : "desc_q_i"},

					{"data" : "desc_origen"},

					{"data" : "desc_tipo"},

					{"data" : "paciente"},
					{"data" : "medico"},
					{"data" : "fk_id_folio"},
					{"data" : "descripcion"},
					{"data" : "observaciones"},
					//{"data" : "desc_estatus"},
					{
	                    render: function( data, type, row, meta )
	                    {
	                    var fk_id_estatus;
	                    fk_id_estatus = row['fk_id_estatus']

							switch(fk_id_estatus) {
							  case '2':
							    return "<p class='btn btn-info'>"+row['desc_estatus']+"</p>"
							    break;
							  case '1':
							    return "<p class='btn btn-danger'>"+row['desc_estatus']+"</p>"
							    break;
							  default:
							    return "<p class='btn btn-danger'>"+row['desc_estatus']+"</p>"
							}
	                            //alert('El producto: ' + row['desc_producto'] + ' Esta por agotarse')

	                            //return "<p class='btn btn-info'>"+row['desc_estatus']+"</p>"



	                    }
					},
// boton de imagenes					
					{
						render:function(data,type,row){
							var registrado;
					
							return "<form-group style='text-align:center;'>"+
							"<a id='printer'  href='../ac_quejas/tabla_imagenes.php?id_queja="+row['id_queja']+"&fk_id_origen="+row['fk_id_origen']+"' target=“_blank” class='btn btn-blue-grey btn-md' role='button'><span  class='fa fa-image' style='color: white;'></span></a>"+
							"</form-group>";											
											
						}

					},

					{"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"}

					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md'><i class='fas fa-trash-alt'></i></button>"}

				],

				"language": idioma_espanol

			});

			agregar("#dt_productos tbody", table)

			editar("#dt_productos tbody", table)

			eliminar("#dt_productos tbody", table)

				

}

var agregar= function(tbody, table) {

		$(tbody).on("click", "button.agregar", function() 

		{

				var data = table.row($(this).parents("tr")).data();

				$("#form_productos  #dc").val(data.id_queja)

				$("#form_productos  #pro").val(data.id_queja)

				$("#form_productos").modal("show")



		});

}



/* Agregamos una nueva clasificacion  para q no se recargue la pagina */

$("#form_productos").on('submit', function (e) 

	{

			e.preventDefault()

			$.ajax({

					type: "POST",                 

					url: "controladores/agregar.php",                    

					data: $("#form_productos").serialize(),

					beforeSend: function(){

					},

					success: function(data)            

						{

							if(data==1)

							{

								var table = $('#dt_productos').DataTable(); // accede de nuevo a la DataTable.

								table.ajax.reload(); // Recarga el  DataTable

								document.getElementById("form_productos").reset();

								swal('datos agregados correctamente')

								console.log(data)

							}else

							if(data == 1062)

							{

								swal('El codigo del producto ya existe')

							}

							else

							{

								swal('Error en MySQL, Error numero:  '+ data)

								console.log(data)

							}

						}

					});          

	});



function focus_btn()

{

	$("input#codigo.form-control").focus();

}



var editar = function(tbody, table) {

		$(tbody).on("click", "button.editar", function() 

		{

				var data = table.row($(this).parents("tr")).data();

				$("#form_editar").modal("show")





				$("#frmedit  label").attr('class','active')

				$("#frmedit  #dc").val(data.id_queja)

				$("#frmedit  #pro").val(data.id_queja)

				$("#frmedit  #codigo").val(data.id_queja)

				$("#frmedit  #si_no").val(data.fk_id_procede)

				$("#frmedit  #fecha_asignacion").val(data.fecha_asignacion)

				$("#frmedit  #sucursal").val(data.fk_id_sucursal_asigna)

				$("#frmedit  #servicio").val(data.fk_id_servicio)


				$("#frmedit  #inconformidad").val(data.descripcion)

			 	$("#frmedit  #observaciones").val(data.observaciones)

				 $("#frmedit  #procede").val(data.motivo_no_procede)

			 	$("#frmedit  #noprocede").val(data.motivo_no_procede)
			 	$("#frmedit  #estatus").val(data.fk_id_estatus)
			 	$("#frmedit  #identifica").val(data.fk_id_identifica)
			 	$("#frmedit  #fecha_queja").val(data.fecha_queja)
			 	$("#frmedit  #usuario").val(data.usuario)
			 	$("#frmedit  #problema").val(data.problema)
			 	$("#frmedit  #causas").val(data.causas)
			 	$("#frmedit  #solucion").val(data.solucion)
			 	$("#frmedit  #acciones").val(data.acciones)

		});

}



$("#frmedit").on('submit', function (e) 

	{

			e.preventDefault()

			$.ajax({

					type: "POST",                 

					url: "controladores/editar.php",                    

					data: $("#frmedit").serialize(),

					beforeSend: function(){

					},

					success: function(data)            

						{

							if( data== 1 )

							{

								var table = $('#dt_productos').DataTable(); // accede de nuevo a la DataTable.

								table.ajax.reload(); // Recarga el  DataTable

								swal('datos agregados correctamente')

								console.log(data)

							}

							else

							{

								swal('Error en MySQL, Error numero:  '+data)

								console.log(data)

							}

						}

					});          

	});





/* Obtenemos los datos de un paciente */

var eliminar= function(tbody, table) {

		$(tbody).on("click", "button.eliminar", function() {

			var data = table.row($(this).parents("tr")).data();



			const swalWithBootstrapButtons = swal.mixin({

				confirmButtonClass: 'btn btn-success',

				cancelButtonClass: 'btn btn-danger',

				buttonsStyling: false,

			})



			swalWithBootstrapButtons({

				title: 'Estas segur@?',

				text: "No podras revertir esta acción",

				type: 'warning',

				showCancelButton: true,

				cancelButtonText: 'No, Cancelar!',

				confirmButtonText: 'Si, Eliminarlo!',

				reverseButtons: true

			}).then((result) => {

				if (result.value) {

					 $.post("./controladores/eliminar.php", {'id_queja' : data.id_queja}  , function(data,status)

					{

						swalWithBootstrapButtons(

						'Eliminado!',

						'La información ha sido eliminada',

						'success'

					)

						console.log(data)

						var table = $('#dt_productos').DataTable(); // accede de nuevo a la DataTable.

								table.ajax.reload(); // linea 106 del error de la consola



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





function calcular(val)

{

	if(val == 1)

	{

			var costo = parseFloat($("#costo").val())

			var utilidad = parseFloat($("#utilidad").val())

			var porciento = utilidad / 100

			var porcentaje = costo * porciento

			var total = costo + porcentaje

			$("#form_productos #lbl_total").attr('class','active')

			if(porciento == 0)

			{

				$("#c_total").val(costo)

			}else

			{

				$("#c_total").val(total)

			} 

	}else

	if(val == 2)

	{

			var costo = parseFloat($("#frmedit #costo").val())

			var utilidad = parseFloat($("#frmedit #utilidad").val())

			var porciento = utilidad / 100

			var porcentaje = costo * porciento

			var total = costo + porcentaje

			$("#frmedit #lbl_total").attr('class','active')

			if(porciento == 0)

			{

				$("#frmedit #c_total").val(costo)

			}else

			{

				$("#frmedit #c_total").val(total)

			} 

	}

	



}

function listmedicos() {

    var data_result;

    $(".js-data-example-ajax-m").select2({
        ajax: {
            type: "GET",
            url: "./ajax/autocomplete/medicos.php",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                console.log("Imprimiendo valores medico")
                console.log(data)
                data_result = data;
                console.log("arreglo recibido medico", data);
                params.page = params.page || 1;

                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.value,
                            id: item.id_medico
                        }
                    }),
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1
        // templateResult: formatRepo, // omitted for brevity, see the source of this page
        // templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    }).on('change', function(e) {
        var str = $("#s2id_search_code .select2-choice span").text();
        var idselect = $('#fi_medico').val();

     /*
        for (var i = 0; i < data_result.length; i++) {
            if (data_result[i].id_cliente == idselect) {
                $('#tel1').val(data_result[i].telefono_fijo);
                $('#mail').val(data_result[i].mail);
                break;
            }
        }
    */
    }).on('select', function(e) {
        console.log("select");
    });
}


		/* Idioma para el DataTable */

var idioma_espanol = {

		"sProcessing": "Procesando...",

		"sLengthMenu": "Mostrar _MENU_ registros",

		"sZeroRecords": "No se encontraron resultados",

		"sEmptyTable": "Ningún dato disponible en esta tabla",

		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",

		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",

		"sInfoPostFix": "",

		"sSearch": "Buscar:",

		"sUrl": "",

		"sInfoThousands": ",",

		"oPaginate": {

				"sFirst": "Primero",

				"sLast": "Último",

				"sNext": "Siguiente",

				"sPrevious": "Anterior"

		},

		"oAria": {

				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",

				"sSortDescending": ": Activar para ordenar la columna de manera descendente"

		}

}





