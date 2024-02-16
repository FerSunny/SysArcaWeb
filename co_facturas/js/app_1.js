 $(document).ready(function() {
    $.fn.dataTable.ext.errMode = 'none';
    var t = $('#dt_contador').DataTable({
        processing: true,
        serverSide: false,
        displayLength: 25,
        select: false,
        paging: false,
        "pagingType": "false",
        "searching": false,
        "lengthChange": "false",
        "language": {
            "info": "Mostrando _START_ a _END_ de _TOTAL_ productos",
            "infoEmpty": "No existen productos",
            "emptyTable": "No existen productos",
            "search": "Buscar:",
            "lengthMenu": "Mostrar _MENU_ productos",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
    add_estudio(t)

})



//Obtenemos la informacion y la cargamos a la tabla
function add_estudio(t)
{
  $('#buscar_sucursal').on("click", function()
  {

  	$("#buscar_sucursal").attr("disabled","true")
  	Total()

  	var tipo = $("#tipo").val()
  	var f_inicio = $("#f_inicio").val()
  	var f_final = $("#f_final").val()
  	var grupo = $("#grupo").val()
  	var cantidad = $("#cantidad").val()

  	var dataTable = $('#dt_contador').DataTable();
    var filas = dataTable
    .rows()
    .data();
 
    console.log(filas)
    
    if(filas.length > 0)
    {
    	dataTable.clear().draw();
    	$.post("ajax/listar.php", {"tipo": tipo,"f_inicio": f_inicio,"f_final": f_final,"grupo": grupo, "cantidad" : cantidad} ,function(mensaje){
		  		var data =$('#dt_contador').DataTable().row( $(this).parents('tr') ).data();
		    	var row = $(this).parents('tr');
				mensaje = jQuery.parseJSON(mensaje)
				console.log(mensaje)
			
				for(var i = 0;i<mensaje[0].length;i++)
				{
					var id = mensaje[0][i].id_sucursal
					var sucursal = mensaje[0][i].desc_sucursal
					var porcentaje = mensaje[1][i].porcentaje
					var t_porcentaje = mensaje[2][i].t_porcentaje
					var folios = mensaje[3][i].folios
					var bancos =  parseFloat(mensaje[4][i].total_b)
					var folios_e = mensaje[5][i].folios_e
					var efectivo = parseFloat(mensaje[6][i].total_e)
					var suma = efectivo + bancos
					var resta = parseFloat(mensaje[2][i].t_porcentaje-mensaje[4][i].total_b)
					console.log(resta)
						t.row.add([
							id,
					    sucursal,
					    porcentaje,
					    t_porcentaje,
					    folios,
					    bancos,
					    folios_e,
					    efectivo,
					    resta,
					    ]).draw( true );
				}
				

			})
    }else
    {
    		$.post("ajax/listar.php", {"tipo": tipo,"f_inicio": f_inicio,"f_final": f_final,"grupo": grupo, "cantidad":cantidad} ,function(mensaje){
		  		var data =$('#dt_contador').DataTable().row( $(this).parents('tr') ).data();
		    	var row = $(this).parents('tr');
				mensaje = jQuery.parseJSON(mensaje)
				console.log(mensaje)
			
				for(var i = 0;i<mensaje[0].length;i++)
				{
					var id = mensaje[0][i].id_sucursal
					var sucursal = mensaje[0][i].desc_sucursal
					var porcentaje = mensaje[1][i].porcentaje
					var t_porcentaje = mensaje[2][i].t_porcentaje
					var folios = mensaje[3][i].folios
					var bancos =  parseFloat(mensaje[4][i].total_b)
					var folios_e = mensaje[5][i].folios_e
					var efectivo = parseFloat(mensaje[6][i].total_e)
					var suma = efectivo + bancos
					var resta = parseFloat(mensaje[2][i].t_porcentaje-mensaje[4][i].total_b)
					console.log(resta)
					
						t.row.add([
							id,
					    sucursal,
					    porcentaje,
					    t_porcentaje,
					    folios,
					    bancos,
					    folios_e,
					    efectivo,
					    resta,
					    ]).draw( true );
					
				}
				

			})
    }
  
  })

}


//calculamos Totales Efectivo y Bancos
function Total()
{
	var v1 = $("#tipo").val();
	var v2 = $("#f_inicio").val();
	var v3 = $("#f_final").val();
	var v4 = $("#grupo").val();
	var v5 = $("#cantidad").val();

	var parametros = {}

//limpiar los input despues de click

		$("#total_efectivo").val("")
		$("#total_banco").val("")
		$("#total_t").val("")
	

	$.post("ajax/total_efectivo.php", {"v1" : v1, "v2" : v2, "v3" : v3, "v4" : v4, "v5" : v5}, function(mensaje){
			
		data = jQuery.parseJSON(mensaje)
		console.log(data[0].total)
		$(".label-wi label").attr("class","active")
		$("#total_efectivo").val("$"+data[0].total)

	})

	$.post("ajax/total_banco.php", {"v1" : v1, "v2" : v2, "v3" : v3, "v4" : v4, "v5" : v5}, function(mensaje){
			

		data = jQuery.parseJSON(mensaje)
		console.log(data[0].total)
		$(".label-wi label").attr("class","active")
		$("#total_banco").val("$"+data[0].total)

	})

	$.post("ajax/total.php", {"v1" : v1, "v2" : v2, "v3" : v3, "v4" : v4, "v5" : v5}, function(mensaje){
			

		data = jQuery.parseJSON(mensaje)
		console.log(data[0].total)
		$(".label-wi label").attr("class","active")
		$("#total_t").val("$"+data[0].total)

	})
}


$("#btn-bancos").click(function()
{
	$("#mdl-banco").modal("show")
	$('#mdl-banco .terminar').html('<div class="loading"><img src="img/loader.gif" alt="loading" /><br/>Un momento, guardando folios...</div>');
	var tipo = $("#tipo").val();
	var f_inicio = $("#f_inicio").val();
	var f_final = $("#f_final").val();
	var grupo = $("#grupo").val();
	var cantidad = $("#cantidad").val();
	var dataTable = $('#dt_contador').DataTable();
	var filas = dataTable
	.rows()
	.data();
	var jsonDatos = [];

	for (i=0; i<filas.length; i++)
	{
		var temp = {
	        sucursal: filas[i][0],
	        f_inicio : f_inicio,
	        f_final : f_final,
	    }

	    jsonDatos.push(temp);
	}
	
 	

 	console.log(jsonDatos)

 	$.ajax({
      type: "POST",
      url: "ajax/guardar_bancos.php",
      data: { datos: JSON.stringify(jsonDatos)},
      success: function(data) {
          //Cargamos finalmente el contenido deseado
          $('#mdl-banco .terminar').fadeIn(1).html(data);
      }
  });


})


function listar_bancos()
{
	var f_inicio = $("#f_inicio").val()
  var f_final = $("#f_final").val()
  $("#mdl-banco").modal("hide")
	$("#modal-bancos").modal("show")
	$("#modal-bancos").css("overflow-y","auto")

	table = $('#dt_bancos').dataTable(
	        {
	        		 "language":{
				       "lengthMenu":"Mostrar _MENU_ registros por página.",
				       "zeroRecords": "Lo sentimos. No se encontraron registros.",
				             "info": "Mostrando página _PAGE_ de _PAGES_",
				             "infoEmpty": "No hay registros aún.",
				             "infoFiltered": "(filtrados de un total de _MAX_ registros)",
				             "search" : "Búsqueda",
				             "LoadingRecords": "Cargando ...",
				             "Processing": "Procesando...",
				             "SearchPlaceholder": "Comience a teclear...",
				             "paginate": {
				     "previous": "Anterior",
				     "next": "Siguiente",
				     }
				      },
	            "aProcessing" : true, //Activamos el procesamiento de datatables
	            "aServerSide" : true, //Paginacion y filtrado realizados por el servidor
	            dom: 'Bfrtip',
	           "ajax":
	                  {
	                    url : "listar.php?val=2&inicio="+f_inicio+"&final="+f_final,
	                    type : "get",
                    dataType : "json",
                    error: function(e)
                    {

                    }
                  },
            "bDestroy" : true,
            "iDisplayLength": 10, //Paginacion
            "order": [[0, "asc"]] //Ordernar (columna, orden)
        }
    ).DataTable();
}



$("#btn-folios").click(function()
{
	$("#buscar_sucursal").removeAttr("disabled","disabled")
	var f_inicio = $("#f_inicio").val()
	var f_final = $("#f_final").val()
	var dataTable = $('#dt_contador').DataTable();
	var filas = dataTable
	.rows()
	.data();
	var jsonDatos = [];
	var count = filas.length*1000;

	for (var i = 0; i < filas.length; i++)
  {
      var temp = {
	        id_sucursal: filas[i][0],
	        resta : filas[i][8],
	        f_inicio : f_inicio,
	        f_final : f_final
	    }
 		 jsonDatos.push(temp);
  }

  console.log(jsonDatos)

  $("#modal-loading").modal("show")
 	$('#modal-loading .loading-fac').html('<div class="loading"><img src="img/loader.gif" alt="loading" /><br/>Un momento, por favor estamos buscando los folios...</div>');
  $.ajax({
      type: "POST",
      url: "ajax/folios.php",
      data: { datos: JSON.stringify(jsonDatos)},
      success: function(data) {
          //Cargamos finalmente el contenido deseado
          $('#modal-loading .loading-fac').fadeIn(1).html(data);
      }
  });
  return false;

})


function continuar()
{
	 $("#modal-loading").modal("hide")
	 listar("si")
}

function listar($res,$sucursal="")
{
	var f_inicio = $("#f_inicio").val()
  var f_final = $("#f_final").val()

	$("#modal-folios").modal("show")
	$("#modal-folios").css("overflow-y","auto")

	table = $('#dt_efectivo').dataTable(
	        {
	        		 "language":{
				       "lengthMenu":"Mostrar _MENU_ registros por página.",
				       "zeroRecords": "Lo sentimos. No se encontraron registros.",
				             "info": "Mostrando página _PAGE_ de _PAGES_",
				             "infoEmpty": "No hay registros aún.",
				             "infoFiltered": "(filtrados de un total de _MAX_ registros)",
				             "search" : "Búsqueda",
				             "LoadingRecords": "Cargando ...",
				             "Processing": "Procesando...",
				             "SearchPlaceholder": "Comience a teclear...",
				             "paginate": {
				     "previous": "Anterior",
				     "next": "Siguiente",
				     }
				      },
	            "aProcessing" : true, //Activamos el procesamiento de datatables
	            "aServerSide" : true, //Paginacion y filtrado realizados por el servidor
	            dom: 'Bfrtip',
	           "ajax":
	                  {
	                    url : "listar.php?val=1&inicio="+f_inicio+"&final="+f_final,
	                    type : "get",
                    dataType : "json",
                    error: function(e)
                    {

                    }
                  },
            "bDestroy" : true,
            "iDisplayLength": 10, //Paginacion
            "order": [[0, "desc"]] //Ordernar (columna, orden)
        }
    ).DataTable();



		totales()

}

function Cancelar(num)
{
	$.post("ajax/cancelar.php?tabla="+num,function(data)
	{
	 	if(data == 1)
	 	{
	 		Swal("Se han eliminado los datos")
	 		$("#modal-folios").modal("hide")
	 	}else
	 	if(data == 2)
	 	{
	 		Swal("Se han eliminado los datos")
	 		$("#modal-bancos").modal("hide")
	 	}else
	 	{
	 		Swal(data)
	 	}
	 
	})
}



function totales()
{
	var dataTable = $('#dt_contador').DataTable();
		var filas = dataTable
		.rows()
		.data();

		var total = 0;
		for (var i = 0; i < filas.length; i++)
	  {
		   total += filas[i][8]
	  }
	  $("#modal-folios .lbl-1 label").attr("class","active")
	  $("#efec_total").val(total)

}


$("#btn-econtrado").click(function()
{
	var dataTable_e = $('#dt_folios').DataTable();
		var filas_e = dataTable_e
		.rows()
		.data();
		console.log(filas_e)
		var total_e = 0;
		for (var i = 0; i < filas_e.length; i++)
	  {
		   total_e += parseFloat(filas_e[i][3])
	  }
	  $("#modal-folios .lbl-2 label").attr("class","active")
	  $("#efec_bus").val(total_e)
})


function eliminar(id)
{

	Swal.fire({
	  title: 'Desea eliminar la informacion?',
	  text: "No podra volver a recuperarla!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Si, Eliminar!',
	  cancelButtonText: 'Cancelar!'
	}).then((result) => {
	  if (result.value) {
	    $.ajax({
		      type: "POST",
		      url: "ajax/eliminar.php",
		      data: { id : id},
		      success: function(data) {
		          Swal(data)
		          $("#dt_folios").DataTable().ajax.reload()
		      }
		  });
	  }else
	  {

	  }
	})
	
}



function folio(num)
{
	if(num == 1)
	{
		$('#mdl-ingresar .terminar').html('<button class="btn btn-success" onclick="guardar(1)">Continuar</button>');
		$("#mdl-ingresar").modal("show")
	}else
	if(num == 2)
	{
		$('#mdl-ingresar .terminar').html('<button class="btn btn-success" onclick="guardar(2)">Continuar</button>');
		$("#mdl-ingresar").modal("show")
	}else
	{
		Swal("Error")
	}
}
$("#btn-folio").click(function()
{

	
})


function guardar(num)
{
	if(num == 1){var tabla = "#dt_efectivo"}else{var tabla = "#dt_bancos"}
	var folio = $("#folio-factura").val()
	var dataTable_e = $(tabla).DataTable();
	var filas_e = dataTable_e
		.rows()
		.data();
	

	if(filas_e.length == 0)
	{
		Swal("La tabla esta vacia")
	}else
	{
		$('#mdl-ingresar .terminar').html('<div class="loading"><img src="img/loader.gif" alt="loading" /><br/>Guardando Folios...</div>');
		$.ajax({
		      type: "POST",
		      url: "ajax/guardar.php?val="+num,
		      data: { folio : folio},
		      success: function(data) {
		          $('#mdl-ingresar .terminar').fadeIn(1).html(data);
		      }
		  });
	}
}

function finish(num){
	if(num == 1)
	{
		$("#mdl-ingresar").modal("hide")
		$("#modal-folios").modal("hide")
		Swal.fire({
		  title: 'La infomación se ha completado?',
		  text: "Clic en Terminar!",
		  type: 'warning',
		  showCancelButton: false,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Terminar'
		}).then((result) => {
		  if (result.value) {
		  	$.post("ajax/cancelar.php?tabla="+3,function(data)
			{
			 	if(data == 1)
			 	{
			 		location.reload();
			 	}else
			 	{
			 		Swal(data)
			 	}
			})
		  }
		})

		
	}else
	if(num == 2)
	{
		$("#mdl-ingresar").modal("hide")
		$("#modal-bancos").modal("hide")
	}else
	{

	}
}

function Limpiar(num)
{
	Cancelar(num)
	setTimeout(location.reload(),3000);
}




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
    "sLoadingRecords": "Cargando...",
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
/*
$.post("ajax/buscar_resta.php", { "resta": resta, "id" : id } , function(recibir)
					{
})
var bancos =  parseFloat(mensaje[4][i].total_b)
					var efectivo = parseFloat(mensaje[6][i].total_e)
					var suma = efectivo + bancos
					var resta = parseFloat(mensaje[2][i].t_porcentaje-mensaje[4][i].total_b)
					
					console.log(mensaje[0][i].total_b)
					t.row.add([
				    	mensaje[0][i].desc_sucursal,
				    	mensaje[1][i].porcentaje,
				      	mensaje[2][i].t_porcentaje,
				      	mensaje[3][i].folios,
				     	bancos,
				     	mensaje[5][i].folios_e,
				     	efectivo,
				     	resta
				    ]).draw( false );
*/









