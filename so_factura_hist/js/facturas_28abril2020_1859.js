$(document).ready(function(){
	buscar('no')

});

$( "#buscar_folio" ).keyup(function() {
  var buscar_folio = $('#buscar_folio').val();
  if(buscar_folio == '')
  {
    buscar('no');
  }else
  {
    buscar('si', buscar_folio);
  }

});
//./ajax/buscar_facturas.php?busqueda='+busqueda+"&folio="+folio
	var buscar = function(busqueda, folio='')
	 {
	 	console.log(busqueda)

	  table = $('#data_facturas').dataTable(
			{
            "aProcessing" : true, //Activamos el procesamiento de datatables
            "aServerSide" : true, //Paginacion y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control tabla
            "ajax":
                  {
                    url : './ajax/buscar_facturas.php?busqueda='+busqueda+"&folio="+folio,
                    type : "get",
                    dataType : "json",
                    error: function(e)
                    {

                    }
                  },
            "bDestroy" : true,
            "iDisplayLength": 5, //Paginacion
            "order": [[0, "desc"]] //Ordernar (columna, orden)
        }
    ).DataTable();
	  	update("#data_facturas tbody", table)
	}

	function update(estado_factura,id_factura,numero_factura,tel,mail,se_modifica)
	{
		console.log(estado_factura)
		console.log(id_factura)
		console.log(numero_factura)
		console.log(se_modifica)

		if(estado_factura>=2 && estado_factura<=4)
		{
			if(numero_factura == 1)
			{
				console.log("Pedir contraseñasss")
				swal({
				  title: 'Ingrese la contraseña de autorización',
				  input: 'password',
				  showCancelButton: true,
				  confirmButtonText: 'Verificar',
				  showLoaderOnConfirm: true,
				  preConfirm: function (pass) {
				    return new Promise(function (resolve, reject) {
				      setTimeout(function() {
							$.ajax({
								url:"./ajax/validate_password.php",
								type: 'POST',
								data:{'password':pass},
								async:false,
								dataType: "JSON",
								success: function(data){
									console.log(data);
									resolve()
									updateFactura(id_factura,numero_factura,tel,mail);
								},error:function(xhr, status, error){
								console.log(xhr.responseText);
								swal({
									title: '!Contraseña Inválida',
									html: $('<div>')
									.addClass('some-class')
									.text('Intente de nuevo o póngase en contacto con el administrador.'),
									animation: false,
									customClass: 'animated tada'
								});
							}
						}); //FIN AJAX

				      }, 2000)
				    })
				  },
				  allowOutsideClick: false
				}).then(function (email) {

				})
			}else{
								swal({
									title: 'Nota cerrada!!!',
									html: $('<div>')
									.addClass('some-class')
									.text('Le recuerdo que solo puede modificar notas del mes actual'),
									animation: false,
									customClass: 'animated tada'
								});
			}
		}else {
			console.log("No pedir")
		}
	}


function updateFactura(id_factura,numero_factura,tel,mail){
			console.log("prrrrr");
			var obj={
				id_factura:id_factura,numero_factura,
				numero_factura:id_factura,numero_factura
			};



			$.ajax({
				url:'./editar_factura.php',
				data:{datas:JSON.stringify(obj)},
				type: 'POST',
				success:function(data){
					$('.container').empty();
					$(".container").append(data);

					//load javascript
					var s = document.createElement("script");
						s.type = "text/javascript";
						s.src = "js/nueva_factura.js";
						$("head").append(s);

						var nombre_cliente=$('#nombre_cliente').val();
						$('#tel1').val(tel);
						$('#mail').val(mail);

						//load javascript
						var s = document.createElement("script");
							s.type = "text/javascript";
							s.src = "js/jquery.validate.min.js";
							$("head").append(s);

						calculateTotalPrice();

				},
				error:function(xhr, status, error){
					console.log("click");
					console.log(xhr.responseText);
				}
			});
		}
