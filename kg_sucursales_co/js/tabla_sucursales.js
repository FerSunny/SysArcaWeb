		$(document).on("ready", function(){
			listar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

// listar datos en la tabla de comisiones
		var listar = function(){
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_sucursales").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "id_sucursal"},
					{"data" : "desc_sucursal"},
					{"data" : "nombre"},
					{"data" : "telefono"},
					{"data" : "telefono_2"},
					{"data" : "tel_movil"},
					{"data" : "hor_hab_ape"},
					{"data" : "hor_hab_cie"},
					{"data" : "hor_sab_ape"},
					{"data" : "hor_sab_cie"},
					{"data" : "hor_dom_ape"},
					{"data" : "hor_dom_cie"},
					{"data" : "domingo"},
					{"data" : "lunes"},
					{"data" : "martes"},
					{"data" : "miercoles"},
					{"data" : "jueves"},
					{"data" : "viernes"},
					{"data" : "sabado"},
					{"data" : "desc_descuento"},
					{"data" : "skype"},
					{"data" : "mail"},
					{"data" : "nombre_pais"},
					{"data" : "desc_estado"},
					{"data" : "desc_municipio"},
					{"data" : "desc_localidad"},
					{"data" : "cp"},
					{"data" : "colonia"},
					{"data" : "calle"},
					{"data" : "numero"},
					{"data" : "estado"},
					{"data" : "desc_corta"},
					{"data" : "desc_grupo"},
					//{"data" : "dias_labora"},

					{"defaultContent": "<button type='button' class='editar btn btn-warning btn-sm' data-toggle='modal' data-target='#modalEditar'><i class='fas fa-edit'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-sm' data-toggle='modal' data-target='#modalEliminar' ><i class='fas fa-trash-alt'></i></button>"}
				],
				"language": idioma_espanol
			});
			obtener_data_editar("#dt_sucursales tbody", table);
			obtener_id_eliminar("#dt_sucursales tbody", table);
		}


$("#frm_add").on('submit', function (e)
  {
      e.preventDefault()
      $.ajax({
          type: "POST",
          url: "controladores/registro_sucursales.php",
          data: $("#frm_add").serialize(),
          beforeSend: function(){
          },
          success: function(data)
            {
            	if(data == 1)
            	{
            		var table=$('#dt_sucursales').DataTable()//Accede de nuevo a la tabla
               		table.ajax.reload();//Recarga el DataTable
               		document.getElementById("frm_add").reset();
               		//referencia al obj del doc, al ID,uso del form, borra todos
            		Swal('Datos guardados correctamente')
            		console.log(data)
            	}
            	else
            	{
            		Swal("Error en MySQL, Error numero " + data)
            		console.log(data)

            	}
            }
          });
  });



// editamos estado civil
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
					$("#frm_edit label").attr("class","active")
					$("#frm_edit #id_sucursal").val( data.id_sucursal)
					$("#frm_edit #fi_desc").val( data.desc_sucursal)
					$("#frm_edit #fi_usuario").val( data.fk_id_usr)
					$("#frm_edit #fi_telefono").val( data.telefono)
					$("#frm_edit #fi_tel").val( data.telefono_2)
					$("#frm_edit #fi_celular").val( data.tel_movil)
					$("#frm_edit #fi_ha").val( data.hor_hab_ape)
					$("#frm_edit #fi_hc").val( data.hor_hab_cie)
					$("#frm_edit #fi_sa").val( data.hor_sab_ape)
					$("#frm_edit #fi_sc").val( data.hor_sab_cie)
					$("#frm_edit #fi_da").val( data.hor_dom_ape)
					$("#frm_edit #fi_dc").val( data.hor_dom_cie)
					$("#frm_edit #fi_descuento").val( data.fk_id_descuento)
					$("#frm_edit #fi_skype").val( data.skype)
					$("#frm_edit #fi_mail").val( data.mail)
					$("#frm_edit #fi_fk_pais").val( data.fk_pais)
					$("#frm_edit #fi_est").val( data.fk_estado)
					$.post("./controladores/buscar.php?val=1", {'id_estado' : data.fk_estado, 'id_municipio' : data.fk_municipio}  , function(res,status)
					{
						console.log(res)
						$("#frm_edit #fi_municipio").html(res);
						$("#frm_edit #fi_municipio option[value='"+data.fk_municipio+"']").attr("selected",true);
						//$('#frm_edit #fi_municipio').append(data);
    			});
			  	$.post("./controladores/buscar.php?val=2", {'id_estado' : data.fk_estado, 'id_municipio' : data.fk_municipio}  , function(res,status)
  				{
  						console.log(res)
  						$("#frm_edit #fi_localidad").html(res);
  						$("#frm_edit #fi_localidad option[value='"+data.fk_localidad+"']").attr("selected",true);
  						//$('#frm_edit #fi_municipio').append(data);
      		});
					$("#frm_edit #fi_cp").val( data.cp)
					$("#frm_edit #fi_colonia").val( data.colonia)
					$("#frm_edit #fi_calle").val( data.calle)
					$("#frm_edit #fi_numero").val( data.numero)
					$("#frm_edit #fi_estado").val( data.estado)
					$("#frm_edit #fi_corta").val( data.desc_corta)
					$("#frm_edit #fi_labora").val( data.dias_labora)
					$("#frm_edit #fn_lu").val( data.lunes)
					$("#frm_edit #fn_ma").val( data.martes)
					$("#frm_edit #fn_mi").val( data.miercoles)
					$("#frm_edit #fn_ju").val( data.jueves)
					$("#frm_edit #fn_vi").val( data.viernes)
					$("#frm_edit #fn_sab").val( data.sabado)
					$("#frm_edit #fn_do").val( data.domingo)
					$("#frm_edit #fn_grupo").val( data.fk_id_grupo)
					$("#frm_edit #opcion").val("modificar");
						console.log(data);

			});
		}


$("#frm_edit").on('submit', function (e)
 	 {
  	    e.preventDefault()
    	  $.ajax({
        	  type: "POST",
          	url: "controladores/actualizar.php",
          	data: $("#frm_edit").serialize(),
          	beforeSend: function(){
          	},
          	success: function(data)
           		{
            		if(data == 1)
            		{
            			Swal.fire('Datos guardados')
            			var table = $("#dt_sucursales").DataTable()


            			table.ajax.reload()
            			console.log(data)
            			//location.reload()
            			//window.opener.document.location="./tabla_est.php";

            		}else
            		{
            			Swal.fire("Error MySQL #" + data)

            		}
            	}
          	});
  	});


// eliminndo la comision
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();

				const swalWithBootstrapButtons = swal.mixin({
					confirmButtonClass: 'btn btn-success',
					cancelButtonClass: 'btn btn-danger',
					buttonStyling: false,
				})

				swalWithBootstrapButtons({
					title: 'Estas segur@',
					text: 'No podras revertir esta accion!',
					type: 'warning',
					showCancelButton: true,
					cancelButtonText: 'No, Cancelar!',
					confirmButtonText: 'Si, Eliminarlo!',
					reverseButtons: true
				}).then((result) => {
					if(result.value) {
						$.post("./controladores/eliminar_sucursales.php", {'id_sucursal' : data.id_sucursal} , function(data,status)
						{
							swalWithBootstrapButtons(
								'Eliminado!',
								'La informacion ha sido eliminada',
								'succes'
								)
							console.log(data)
							var table = $('#dt_sucursales').DataTable();
							table.ajax.reload();
						});
					}
					else if (
						result.dismiss == swal.DismissReason.cancel
						){
						swalWithBootstrapButtons(
							'Cancelado',
							'Los archivos estan seguros :)',
							'error'
						)
					}
				})
			});
		}




    /* Idioma para el DataTable */
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
