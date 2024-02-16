		$(document).on("ready", function(){
			listar();
    $.fn.dataTable.ext.errMode = 'none';
		});

// listar datos en la tabla de perfiles
		var listar = function(){
                $("#cuadro1").slideDown("slow");
			var table = $("#dt_unidades").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "cod_producto"},
					{"data" : "desc_producto"},
					{"data" : "razon_social"},
					{
                        render: function( data, type, row, meta )
                        {
                            if(row['existencias'] >= 21)
                            {
                                //alert('El producto: ' + row['desc_producto'] + ' Esta por agotarse')
                                return "<p class='btn btn-success'>"+row['existencias']+"</p>"
                            }else
                            if(row['existencias'] > 5 || row['existencias'] <= 20)
                            {
                                return "<p class='btn btn-warning'>"+row['existencias']+"</p>"
                            }else
                            if(row['existencias'] < 6)
                            {
                                return "<p class='btn btn-danger'>"+row['existencias']+"</p>"
                            }else
                            {
                                return
                            }
                        },
                    },
                    {"data" : "min"},
                    {"data" : "max"},
                    {"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"},
                    
				],
				"language": idioma_espanol
			});

            agregar("#dt_unidades tbody", table)
            editar("#dt_unidades tbody", table)
           
      //agregar("#dt_productos tbody", table)
        
}
var agregar= function(tbody, table) {
    $(tbody).on("click", "button.agregar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#form_unidades  #dc").val(data.fk_id_cliente)
        $("#form_unidades  #pro").val(data.id_producto)
        $("#form_unidades").modal("show")

    });
}

/* Agregamos una nueva clasificacion  para q no se recargue la pagina */
$("#form_unidades").on('submit', function (e) 
  {
      e.preventDefault()
      $.ajax({
          type: "POST",                 
          url: "controladores/agregar.php",                    
          data: $("#form_unidades").serialize(),
          beforeSend: function(){
          },
          success: function(data)            
            {
              if(data==1)
              {
                var table = $('#dt_unidades').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                document.getElementById("form_unidades").reset();
                swal('datos agregados correctamente')
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

function focus_btn()
{
  $("input#codigo.form-control").focus();
}






var editar = function(tbody, table) {
    $(tbody).on("click", "button.editar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#unidades").modal("show")
        $("#frm-edit label").attr("class","active")
        $("#frm-edit #id_unidades").val(data.id_unidades)
        $("#frm-edit #producto").val(data.id_producto)
        $("#frm-edit #existencias").val(data.existencias)
        $("#frm-edit #proveedor").val(data.fk_id_proveedor)
        $("#frm-edit #min").val(data.min)
        $("#frm-edit #max").val(data.max)
    });
}


$("#frm-edit").on('submit', function (e) 
    {
      e.preventDefault()
        $.ajax({
            type: "POST",                 
            url: "controladores/editar.php",                    
            data: $("#frm-edit").serialize(),
            beforeSend: function(){
            },
            success: function(data)            
            {
              if(data==1)
              {
                var table = $('#dt_unidades').DataTable(); // accede de nuevo a la DataTable.
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


