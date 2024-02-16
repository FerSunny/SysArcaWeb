
    $(document).on("ready", function(){
      listar();
    $.fn.dataTable.ext.errMode = 'none';
    });

// listar datos en la tabla de perfiles
    var listar = function(){
        $("#cuadro1").slideDown("slow");
      var table = $("#dt_proveedores").DataTable({
        "destroy":true,
        "sRowSelect": "multi",
        "ajax":{
          "method":"POST",
          "url": "listar.php"
        },
        "columns":[
          {"data" : "id_proveedor"},
          {"data" : "razon_social"},
          {"data" : "nombre_respon"},
          {"data" : "celular"},
          {"data" : "telefono"},
          {"data" : "correo"},
          {"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"},
          {"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md'><i class='fas fa-trash-alt'></i></button>"}
        ],
        "language": idioma_espanol
      });
      agregar("#dt_proveedores tbody", table)
      editar("#dt_proveedores tbody", table)
      eliminar("#dt_proveedores tbody", table)
        
}
var agregar= function(tbody, table) {
    $(tbody).on("click", "button.agregar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#form_provee  #dc").val(data.fk_id_cliente)
        $("#form_provee  #prov").val(data.id_proveedor)
        $("#form_provee").modal("show")

    });
}

/* Agregamos una nueva clasificacion  para q no se recargue la pagina */
$("#form_provee").on('submit', function (e) 
  {
      e.preventDefault()
      $.ajax({
          type: "POST",                 
          url: "controladores/agregar.php",                    
          data: $("#form_provee").serialize(),
          beforeSend: function(){
          },
          success: function(data)            
            {
              if(data==1)
              {
                var table = $('#dt_proveedores').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                document.getElementById("form_provee").reset();
                swal('datos agregados correctamente')
                console.log(data)
              }else
              if (data == 1062)
              {
                swal('El proveedor ya existe')
              }
              else
              {
                swal('Error en MySQL, Error numero:  '+ data)
                console.log(data)
              }
            }
          });          
  });



var editar = function(tbody, table) {
    $(tbody).on("click", "button.editar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#form_editar").modal("show")
        $("#frmedit  label").attr("class","active")
        $("#frmedit  #dc").val(data.fk_id_cliente)
        $("#frmedit  #prov").val(data.id_proveedor)
        $("#frmedit  #provee").val(data.razon_social)
        $("#frmedit  #respon").val(data.nombre_respon)
        $("#frmedit  #n_cel").val(data.celular)
        $("#frmedit  #edo").val(data.fk_id_estado)
        $.post("../select/select_estado.php?val=1", {'id_estado' : data.fk_id_estado, 'id_municipio' : data.fk_id_municipio}  , function(res,status)
        {
          console.log(res)
          $("#frmedit #muni").html(res);
          $("#frmedit #muni option[value='"+data.fk_id_municipio+"']").attr("selected",true);
          //$('#frm_edit #fi_municipio').append(data);  
        });
                
        $.post("../select/select_estado.php?val=2", {'id_estado' : data.fk_id_estado, 'id_municipio' : data.fk_id_municipio}  , function(res,status)
        {
          console.log(res)
          $("#frmedit #loca").html(res);
          $("#frmedit #loca option[value='"+data.fk_id_localidad+"']").attr("selected",true);
            //$('#frm_edit #fi_municipio').append(data);  
        });
        $("#frmedit  #tel").val(data.telefono)
        $("#frmedit  #cp").val(data.codigo_postal)
        $("#frmedit  #col").val(data.colonia)
        $("#frmedit  #calle").val(data.calle)
        $("#frmedit  #email").val(data.correo)
        $("#frmedit  #web").val(data.sitio_web)


       
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
                var table = $('#dt_proveedores').DataTable(); // accede de nuevo a la DataTable.
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
           $.post("./controladores/eliminar.php", {'id_proveedor' : data.id_proveedor}  , function(data,status)
          {
            swalWithBootstrapButtons(
            'Eliminado!',
            'La información ha sido eliminada',
            'success'
          )
            console.log(data)
            var table = $('#dt_proveedores').DataTable(); // accede de nuevo a la DataTable.
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


// tomar el evento de municipios
    $("#form_provee select[name=edo]").change(function()
    {
        select = $('#form_provee select[name=edo]').val();
        //alert(select)
        //Si form es 1 viene del form para agregar
        var parametros = 
        {
          "id_estado" : select
        }
        $.ajax({
          type: "POST",                 
          url: "../select/select_estado.php?val=1",
          data:parametros ,
          beforeSend: function(){
          },
          success: function(data)            
            {
              $("#form_provee #muni").html(data);
              //$('select').selectpicker('refresh');
              //$("#res").load(" #resultado");
              console.log(data)
            }
        });
    });

// tomar el evento de localidades
    $("#form_provee select[name=muni]").change(function()
    {
        select1 = $('#form_provee select[name=muni]').val();
        select2 = $('#form_provee select[name=edo]').val();
        //alert(select)
        //Si form es 1 viene del form para agregar
        var parametros = 
        {
          "id_municipio" : select1,
          "id_estado" : select2

        }
        $.ajax({
          type: "POST",                 
          url: "../select/select_estado.php?val=2",
          data:parametros ,
          beforeSend: function(){
          },
          success: function(data)            
            {
              $("#form_provee #loca").html(data);
              //$('select').selectpicker('refresh');
              //$("#res").load(" #resultado");
              console.log(data)
            }
        });
    });

    // tomar el evento de consultorio
    $("#frmedit select[name=edo]").change(function()
    {
        select = $('#frmedit select[name=edo]').val();
        //alert(select)
        //Si form es 1 viene del form para agregar
        var parametros = 
        {
          "id_estado" : select
        }
        $.ajax({
          type: "POST",                 
          url: "../select/select_estado.php?val=1",
          data:parametros ,
          beforeSend: function(){
          },
          success: function(data)            
            {
              $("#frmedit #muni").html(data);
              //$('select').selectpicker('refresh');
              //$("#res").load(" #resultado");
              console.log(data)
            }
        });
    });


        $("#frmedit select[name=muni]").change(function()
         {
        select1 = $('#frmedit select[name=muni]').val();
        select2 = $('#frmedit select[name=edo]').val();
        //alert(select)
        //Si form es 1 viene del form para agregar
        var parametros = 
        {
          "id_municipio" : select1,"id_estado" : select2

        }
        $.ajax({
          type: "POST",                 
          url: "../select/select_estado.php?val=2",
          data:parametros ,
          beforeSend: function(){
          },
          success: function(data)            
            {
              $("#frmedit #loca").html(data);
              //$('select').selectpicker('refresh');
              //$("#res").load(" #resultado");
              console.log(data)
            }
        });
    });



