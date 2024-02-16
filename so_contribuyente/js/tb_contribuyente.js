
    $(document).on("ready", function(){
      listar();
    $.fn.dataTable.ext.errMode = 'none';
    });

// listar datos en la tabla de perfiles
    var listar = function(){
                $("#cuadro1").slideDown("slow");
      var table = $("#dt_contribuyente").DataTable({
        "destroy":true,
        "sRowSelect": "multi",
        "ajax":{
          "method":"POST",
          "url": "listar.php"
        },
        "columns":[
          {"data" : "id_factura"},
          {"data" : "numero_factura"},
          {"data" : "nombre"},
          {"data" : "rfc"},
          {"data" : "desc_tipo_pago"},
          {"defaultContent": "<button type='button' class='ver btn btn-info btn-md'><i class='fas fa-eye'></button>"},
          {"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"}
        ],
        "language": idioma_espanol
      });

            agregar("#dt_contribuyente tbody", table)
            editar("#dt_contribuyente tbody", table)
            ver("#dt_contribuyente tbody", table)
        
}
var agregar= function(tbody, table) {
    $(tbody).on("click", "button.agregar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#form_contribuyente  #dc").val(data.fk_id_cliente)
        $("#form_contribuyente  #pro").val(data.id_uso)
        $("#form_contribuyente").modal("show")

    });
}


/* Agregamos una nueva clasificacion  para q no se recargue la pagina */
$("#form_contribuyente").on('submit', function (e) 
  {
      e.preventDefault()
      $.ajax({
          type: "POST",                 
          url: "controladores/agregar.php",                    
          data: $("#form_contribuyente").serialize(),
          beforeSend: function(){
          },
          success: function(data)            
            {             
              if(data==1)
              {
                var table = $('#dt_contribuyente').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                document.getElementById("form_contribuyente").reset();
                swal('Datos agregados correctamente')
                console.log(data)
              }

             
              else
              {
                swal('Error en MySQL, Error numero:  '+ data)
                console.log(data)
              }

              if(data==1062)
              {
                var table = $('#dt_contribuyente').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                document.getElementById("form_contribuyente").reset();
                swal('La clave de Uso ya existe en la base de datos')
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
        $("#contribuyente").modal("show")

        $("#frm-edit label").attr("class","active")
        $("#frm-edit #id_facturacion").val(data.id_facturacion)
        $("#frm-edit #id_factura").val(data.id_factura)
        $("#frm-edit #numero_factura").val(data.numero_factura)
        $("#frm-edit #nombre").val(data.nombre)
        $("#frm-edit #rfc").val(data.rfc)
        $("#frm-edit #domicilio").val(data.domicilio)
        $("#frm-edit #email").val(data.email)
        $("#frm-edit #desc_uso").val(data.fk_id_uso)
        $("#frm-edit #desc_tipo_pago").val(data.fk_id_tipo_pago)
   
       
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
                var table = $('#dt_contribuyente').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                swal('Datos agregados correctamente')
                console.log(data)
              }

             
              else
              {
                swal('Error en MySQL, Error numero:  '+ data)
                console.log(data)
              }

              if(data==1062)
              {
                var table = $('#dt_contribuyente').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                document.getElementById("form_contribuyente").reset();
                swal('La clave de Uso ya existe en la base de datos')
                console.log(data)
              }

            }
          });          
    });

var ver = function(tbody, table) {
    $(tbody).on("click", "button.ver", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#ver_datos").modal("show")

        $("#frm-ver label").attr("class","active")
        $("#frm-ver #id_factura").val(data.id_factura)
        $("#frm-ver #numero_factura").val(data.numero_factura)
        $("#frm-ver #nombre").val(data.nombre)
        $("#frm-ver #rfc").val(data.rfc)
        $("#frm-ver #domicilio").val(data.domicilio)
        $("#frm-ver #email").val(data.email)
        $("#frm-ver #desc_uso").val(data.fk_id_uso)
        $("#frm-ver #desc_tipo_pago").val(data.fk_id_tipo_pago)   
       
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


