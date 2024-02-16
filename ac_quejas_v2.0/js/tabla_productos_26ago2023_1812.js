

		$(document).on("ready", function(){

    //$('select').select2();
    		listClientes();
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

					{"data" : "desc_corta"},

					{"data" : "iniciales"},

					{"data" : "desc_origen"},

					{"data" : "medico"},

					{"data" : "paciente"},

					{"data" : "fecha_queja"},

					//{"data" : "desc_estatus"},
					{
	                    render: function( data, type, row, meta )

	                    {
	                        var valid = row['fk_id_estatus']

	                        if(valid == '1')
	                        {
	                            return "<p class='btn btn-danger'>"+row['desc_estatus']+"</p>"
	                         }else{
	                         	return "<p class='btn btn-success'>"+row['desc_estatus']+"</p>"
	                         }



	                    },
					},
// boton de imagenes					
					{
						render:function(data,type,row){
							var registrado;
					
							return "<form-group style='text-align:center;'>"+
							"<a id='printer'  href='../ac_quejas_v2.0/tabla_imagenes.php?id_queja="+row['id_queja']+"&fk_id_origen="+row['fk_id_origen']+"' target=“_blank” class='btn btn-blue-grey btn-md' role='button'><span  class='fa fa-image' style='color: white;'></span></a>"+
							"</form-group>";											
											
						}

					},
	                {
	                    render: function(data,type,row)
	                    {
	                        var valid = row['fk_id_estatus']

	                        if(valid == '1')
	                        {
	                            return "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"
	                        }else
	                        {
	                            return "<button disabled type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i> </button>"
	                        }

	                    }
	                },

	                {
	                    render: function(data,type,row)
	                    {
	                        var valid = row['fk_id_estatus']

	                        if(valid == '1')
	                        {
	                            return "<button type='button' class='eliminar btn btn-warning btn-md'><i class='fas fa-trash-alt'></i></button>"
	                        }else
	                        {
	                            return "<button disabled type='button' class='eliminar btn btn-danger btn-md'><i class='fas fa-trash-alt'></i></button>"
	                        }

	                    }
	                },


					{"defaultContent": "<button type='button' class='ver btn btn-info btn-md'><i class='fas fa-edit'></i></button>"},

					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md'><i class='fas fa-trash-alt'></i></button>"}

				],

				"language": idioma_espanol

			});

			agregar("#dt_productos tbody", table)

			editar("#dt_productos tbody", table)

			eliminar("#dt_productos tbody", table)

			ver("#dt_productos tbody", table)

				

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

				$("#frmedit  #q_o_s").val(data.fk_id_inconformidad)

				$("#frmedit  #fecha_queja").val(data.fecha_queja)

				$("#frmedit  #origen").val(data.fk_id_origen)

				$("#frmedit  #tipo").val(data.fk_id_tipo_queja)

				$("#frmedit  #medico_id").val(data.medico)

				$("#frmedit  #cliente_id").val(data.paciente)

				$("#frmedit  #empleado").val(data.fk_id_empleado)

				$("#frmedit  #orden_id").val(data.fk_id_folio)

				$("#frmedit  #sucursal").val(data.fk_id_sucursal)

				$("#frmedit  #inconformidad").val(data.descripcion)

			 	$("#frmedit  #observaciones").val(data.observaciones)

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

var ver = function(tbody, table) {

		$(tbody).on("click", "button.ver", function() 

		{

				var data = table.row($(this).parents("tr")).data();

				$("#form_ver").modal("show")





				$("#frmver  label").attr('class','active')

				$("#frmver  #dc").val(data.id_queja)

				$("#frmver  #pro").val(data.id_queja)

				$("#frmver  #codigo").val(data.id_queja)

				$("#frmver  #inconformidad").val(data.descripcion)

				$("#frmver  #fecha_queja").val(data.fecha_queja)

				$("#frmver  #fecha_asignacion").val(data.fecha_asignacion)
				$("#frmver  #fecha_solucion").val(data.fecha_solucion)

				$("#frmver  #problema").val(data.problema)

				$("#frmver  #causas").val(data.causas)

				$("#frmver  #solucion").val(data.solucion)

				$("#frmver  #acciones").val(data.acciones)

				$("#frmver  #estatus").val(data.fk_id_estatus)

				$("#frmver  #sucursal").val(data.fk_id_sucursal_asigna)

				$("#frmver  #servicio").val(data.fk_id_servicio)

			 	$("#frmver  #observaciones").val(data.observaciones)

		});

}

// Función autocompletar paciente

function autocompletar_p() {
	var minimo_letras = 0; // minimo letras visibles en el autocompletar
	var palabra = $('#cliente_id').val();
	//Contamos el valor del input mediante una condicional
	//console.log('entro a buscar:'+palabra)
	if (palabra.length >= minimo_letras) {
		$.ajax({
			url: 'mostrar_p.php',
			type: 'POST',
			data: {palabra:palabra},
			success:function(data){
				$('#lista_id').show();
				$('#lista_id').html(data);
			}
		});
	} else {
		//ocultamos la lista
		$('#lista_id').hide();
	}
}

// Funcion Mostrar valores pacientes
function set_item(opciones) {
	// Cambiar el valor del formulario input
	$('#cliente_id').val(opciones);
	// ocultar lista de proposiciones
	$('#lista_id').hide();
}


// Función autocompletar medicoss

function autocompletar_m() {
	var minimo_letras = 0; // minimo letras visibles en el autocompletar
	var palabra = $('#medico_id').val();
	//Contamos el valor del input mediante una condicional
	//console.log('entro a buscar:'+palabra)
	if (palabra.length >= minimo_letras) {
		$.ajax({
			url: 'mostrar_m.php',
			type: 'POST',
			data: {palabra:palabra},
			success:function(data){
				$('#lista_id_m').show();
				$('#lista_id_m').html(data);
			}
		});
	} else {
		//ocultamos la lista
		$('#lista_id_m').hide();
	}
}

// Funcion Mostrar valores pacientes
function set_item_m(opciones) {
	// Cambiar el valor del formulario input
	$('#medico_id').val(opciones);
	// ocultar lista de proposiciones
	$('#lista_id_m').hide();
}

// Función autocompletar ordenes

function autocompletar_o() {
	var minimo_letras = 0; // minimo letras visibles en el autocompletar
	var palabra = $('#orden_id').val();
	//Contamos el valor del input mediante una condicional
	//console.log('entro a buscar:'+palabra)
	if (palabra.length >= minimo_letras) {
		$.ajax({
			url: 'mostrar_o.php',
			type: 'POST',
			data: {palabra:palabra},
			success:function(data){
				$('#lista_id_o').show();
				$('#lista_id_o').html(data);
			}
		});
	} else {
		//ocultamos la lista
		$('#lista_id_o').hide();
	}
}

// Funcion Mostrar valores pacientes
function set_item_o(opciones) {
	// Cambiar el valor del formulario input
	$('#orden_id').val(opciones);
	// ocultar lista de proposiciones
	$('#lista_id_o').hide();
}



function listClientes() {

    var data_result;

    $(".js-data-example-ajax").select2({
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





