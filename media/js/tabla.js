
			$(document).on("ready", function(){
				listar();
			});
					var listar = function(){
							var table = $("#dt_cliente").DataTable({
									"ajax":{
											"method":"POST",
											"url":"listar.php"
									},
									"columns":[
											{"data":"id_usr"},
											{"data":"fk_sucursal"},
											{"data":"pass"},
											{"data":"estado"},
											{"data":"nombre"},
											{"data":"a_paterno"},
											{"data":"a_materno"},
											{"data":"telefono_movil"},
											{"data":"mail"}
									]
							});


					}
