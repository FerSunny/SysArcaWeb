		$(document).ready(function(){
			listar();
			//register();
			//editRegister();
			//deleteRow();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

// listar datos en la tabla de perfiles
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
					{"data" : "id_factura"},
					{"data" : "fecha_factura"},
					{"data" : "sucursal"},
					{"data" : "paciente"},
					{"data" : "estudio"},
					{"data" : "Registrado"},

// mail medico
					{
						render:function(data,type,row)
						{
							var email_medico = row['email_medico']
							var resta = row['resta']
							var perfil=row['perfil']

							if(perfil == 1 || perfil == 42 || perfil == 40)
							{
								if(email_medico == 1)
								{
									if(resta == 0)
									{
										//console.log('aqui')
										return "<button type='button' id='e_medico' class='btn btn-primary btn-md'><i class='fas fa-paper-plane'></i></button>"
									}else
									{
										return "<button type='button' class='btn btn-info'><i class='fas fa-hand-holding-usd'></i></button>"
									}
								}else
								{
									return ""
								}
							}else
							{
								return "<button id='out' class='btn btn-secondary btn-md' role='button'><i class='fas fa-hand-paper'></i></button>"
							}
							
						}
					},


					{
						render:function(data,type,row)
						{
								var saldo = row['resta']
								var perfil = row['perfil']
								if(perfil == 1){
									return "<a  id='register'   class='btn btn-success btn-sm'><span  <i class='fas fa-stethoscope' style='color: white;'></i></span></a>"
								}else{
									if(saldo == '0.00'){
										return "<a  id='register'   class='btn btn-success btn-sm'><span  <i class='fas fa-stethoscope' style='color: white;'></i></span></a>"
									}else{
										return "<a id='printer' target='_blank'  class='btn btn-info btn-md' role='button'><i class='fas fa-hand-holding-usd'></i></a>"
									}
								}
						}
					},
					//boton para editar
					{
						render:function(data,type,row)
						{
								var saldo = row['resta']
								var perfil = row['perfil']
								if(perfil == 1){
									return "<a  id='edit' style='color:white;'  class='btn btn-warning btn-sm'><span  <i class='fas fa-pencil-alt' style='color: white;'> </i></span></a>"
								}else{
									if(saldo == '0.00')
									{
										return "<a  id='edit' style='color:white;'  class='btn btn-warning btn-sm'><span  <i class='fas fa-pencil-alt' style='color: white;'> </i></span></a>"
									}else{
										return "<a id='printer' target='_blank'  class='btn btn-info btn-md' role='button'><i class='fas fa-hand-holding-usd'></i></a>"
									}
								}
						},
				 },


				 ],
				 "language": {
					"info":"Mostrando _START_ a _END_ de _TOTAL_ registros",
					"infoEmpty":      "No existen registros",
					"emptyTable":     "No existen registros",
					"search":         "Buscar:",
					"lengthMenu":     "Mostrar _MENU_ registros",
					"paginate": {
						"next":       "Siguiente",
						"previous":   "Anterior"
					},
				},
				columnDefs: [
				{
					 orderable: false,
					 targets: [2]
				}],
				order: [[2, 'asc']]
			});
				 email_medico("#dt_agenda tbody", table);
				 //email_paciente("#dt_agenda tbody", table);

		}


		var email_medico = function(tbody, table){
			$(tbody).on("click", "button#e_medico", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var plantilla = data.num_plantilla
				var fac = data.id_factura
				var est = data.fk_id_estudio
				var enviar = 1
				var e_medico = data.email_medico
				var e_paciente = data.email_paciente
				var registro = data.Registrado

				
				if(registro == 'Si')
				{
					console.log(plantilla)
					if(plantilla == 7)
					{
						
					    		$.post("./reports/print_result_mail_7.php",{'numero_factura': fac, 'studio' : est },function(data, status){
							    $.post("./services/send_mail_medico.php",{'numero_factura': fac, 'studio' : est, 'enviar' : enviar},function(data, status){
								    console.log('Se envio email: ' + data)
								    if(data == 1)
								    {
								    	Swal.fire('Mensaje enviado')
								    }else
								    {
								    	Swal.fire('Error al enviar ensaje: ' + data)
								    }
								  });
							  });


					}else
					if(plantilla == 'P2')
					{
						$.post("./services/validar_p2.php",{'factura': fac, 'estudio' : est },function(data, status){
					    console.log('Validado: ' + data)

					    data = jQuery.parseJSON(data);
					    val = data.val
					    if(val == 1)
					    {
					    	swal({
									type: 'info',
									title: 'El estudio no ha sido validado',
								})
					    }
					    else
					    if(val == 2)
					    {
					    	$.post("./reports/result_email_p2.php",{'numero_factura': fac, 'studio' : est },function(data, status){
							    $.post("./services/send_mail_medico.php",{'numero_factura': fac, 'studio' : est, 'enviar' : enviar},function(data, status){
								    console.log('Se envio email: ' + data)
								    if(data == 1)
								    {
								    	Swal.fire('Mensaje enviado')
								    }else
								    {
								    	Swal.fire('Error al enviar ensaje: ' + data)
								    }
								  });
							  });
					    }else
					    {
					    	Swal.fire('Ocurrio un error')
					    }
					  });
					}else
					if(plantilla == 'P3')
					{
						$.post("./services/validar_p3.php",{'factura': fac, 'estudio' : est },function(data, status){
					    console.log('Validado: ' + data)

					    data = jQuery.parseJSON(data);
					    val = data.val
					    if(val == 1)
					    {
					    	swal({
									type: 'info',
									title: 'El estudio no ha sido validado',
								})
					    }
					    else
					    if(val == 2)
					    {
					    	$.post("./reports/result_email_p3.php",{'numero_factura': fac, 'studio' : est },function(data, status){
							    $.post("./services/send_mail_medico.php",{'numero_factura': fac, 'studio' : est, 'enviar' : enviar},function(data, status){
								    console.log('Se envio email: ' + data)
								    if(data == 1)
								    {
								    	Swal.fire('Mensaje enviado')
								    }else
								    {
								    	Swal.fire('Error al enviar ensaje: ' + data)
								    }
								  });
							  });
					    }else
					    {
					    	Swal.fire('Ocurrio un error')
					    }
					  });
					}else
					{
						Swal.fire('Ocurrio un error')
					}

				}else
				{
					swal({
								type: 'info',
								title: 'Es necesario registrar primero',
					})
				}
  
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
