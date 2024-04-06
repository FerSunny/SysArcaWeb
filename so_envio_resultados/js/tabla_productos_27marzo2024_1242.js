
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
          {"data" : "id_factura"},
          {"data" : "fecha_factura"},
          {"data" : "nombre"},
          {"data" : "desc_estudio"},
          //{"data" : "entregada"},
					{
						render: function( data, type, row, meta )
						{
							if(row['entregada'] == '1')
							{
								return '<span class="badge badge-danger">Sin resultado en sistema</span>'
							}else
							if(row['entregada'] == '2')
							{
								return '<span class="badge badge-warning">Pendiente de entregar</span>'
							}else
							if(row['entregada'] == '3')
							{
								return '<span class="badge badge-primary">Pendiente de Validar</span>'
							}else
									{
                    return "<p class='btn btn-success'>"+row['entregada']+"</p>"
							}

						}
					},
          {"data" : "iniciales"},
          //{"data" : "resta"},
					{
						render: function( data, type, row, meta )
						{
							if(row['resta'] == '0.00')
							{
								return "<p class='btn btn-success'>"+row['resta']+"</p>"
							}else
							{
                return "<p class='btn btn-danger'>"+row['resta']+"</p>"
							}

						}
					},
          // envio por email
          {
            render: function(data,type,row)
            {
                var entregar = row['entregada']

                if(entregar == '2')
                {
                    return "<button type='button'  class='email btn btn-primary btn-sm'><i class='fa fa-envelope'></i></button>"
                }else
                {
                    return "<button disabled type='button'  class='email btn btn-primary btn-sm'><i class='fa fa-envelope'></i></button>"
                }

            }
          },
          // envio por whatsapp
          {
            render: function(data,type,row)
            {
                var entregar = row['entregada']

                if(entregar == '2')
                {
                    return "<button type='button'  class='whatsapp btn btn-warning btn-sm'><i class='fa fa-phone'></i></button>"
                }else
                {
                    return "<button disabled type='button'  class='whatsapp btn btn-warning btn-sm'><i class='fa fa-phone'></i></button>"
                }

            }
          },
         // {"defaultContent": "<button type='button'  class='email btn btn-primary btn-sm'><i class='fa fa-envelope'></i></button>"},
         // {"defaultContent": "<button type='button' disabled class='editar btn btn-warning btn-sm'><i class='fa fa-phone' ></i></button>"},
          {"defaultContent":"<button type='button' disabled class='eliminar btn btn-danger btn-sm'><i class='fa fa-link'></i></button>"}
        ],
        "language": idioma_espanol
      });
      email("#dt_productos tbody", table)
      whatsapp("#dt_productos tbody", table)
      editar("#dt_productos tbody", table)
      eliminar("#dt_productos tbody", table)
        
}

/* enviar resultados por email */
var email = function(tbody, table) {
  $(tbody).on("click", "button.email", function() 
  {
      var data = table.row($(this).parents("tr")).data();
      var factura = data.id_factura
      var estudio = data.fk_id_estudio
      var plantilla_id = data.fk_id_plantilla
      var id_cliente = data.fk_id_cliente
      var tipo_salida = 1

      switch(plantilla_id) {
// envio plantilla 2
        case '1':
          $.post("../reports/pdf_plantilla_1.php", {'factura' : factura, 'estudio' : estudio, 'tipo_salida' : tipo_salida} ,function(data, status){
            if(data == 1)
            {
              $.post("./controladores/email.php", {'factura' : factura, 'estudio' : estudio, 'plantilla' : plantilla_id, 'id_cliente' : id_cliente} ,function(data, status){
                if(data == 1)
                {
                    Swal.fire({
                              position: 'top-end',
                              type: 'success',
                              title: 'Email enviado.. ',
                              showConfirmButton: false,
                            })
                }else
                {
                    Swal.fire('No se envio el email, error: '+data+' Envie este mensseja a su area de sistemas')
                }
            });
            }else{
              swal('No se genero el PDF (p1) para ser enviado, notifique a su area de sistemas: soporte.producto@medisyslabs.onmicrosoft.com-->'+data)
            }
          }
          );
          break;
// envio plantilla 2
        case '2':
          $.post("../reports/pdf_plantilla_2.php", {'factura' : factura, 'estudio' : estudio, 'tipo_salida' : tipo_salida} ,function(data, status){
            if(data == 1)
            {
              $.post("./controladores/email.php", {'factura' : factura, 'estudio' : estudio, 'plantilla' : plantilla_id, 'id_cliente' : id_cliente} ,function(data, status){
                if(data == 1)
                {
                    Swal.fire({
                              position: 'top-end',
                              type: 'success',
                              title: 'Email enviado.. ',
                              showConfirmButton: false,
                            })
                }else
                {
                    Swal.fire('No se envio el email, error: '+data+' Envie este mensseja a su area de sistemas')
                }
            });
            }else{
              swal('No se genero el PDF (p2) para ser enviado, notifique a su area de sistemas: soporte.producto@medisyslabs.onmicrosoft.com->'+data)
            }
          }
          );
          break;
        // envio plantilla 3
        case '3':
          $.post("../reports/pdf_plantilla_3.php", {'factura' : factura, 'estudio' : estudio, 'tipo_salida' : tipo_salida} ,function(data, status){
            if(data == 1)
            {
              $.post("./controladores/email.php", {'factura' : factura, 'estudio' : estudio, 'plantilla' : plantilla_id, 'id_cliente' : id_cliente} ,function(data, status){
                if(data == 1)
                {
                    Swal.fire({
                              position: 'top-end',
                              type: 'success',
                              title: 'Email enviado.. ',
                              showConfirmButton: false,
                            })
                }else
                {
                    Swal.fire('No se envio el email, error: '+data+' Envie este mensseja a su area de sistemas')
                }
            });
            }else{
              swal('No se genero el PDF (p3) para ser enviado, notifique a su area de sistemas: soporte.producto@medisyslabs.onmicrosoft.com->'+data)
            }
          }
          );
          break;          
        default:
          swal('Sin plantilla'+plantilla_id)
         // stop
      }
  });
}

/* enviar resultados por whatsapp */
var whatsapp = function(tbody, table) {
  $(tbody).on("click", "button.whatsapp", function() 
  {
      var data = table.row($(this).parents("tr")).data();
      var factura = data.id_factura
      var estudio = data.fk_id_estudio
      var plantilla_id = data.fk_id_plantilla
      var id_cliente = data.fk_id_cliente
      var tipo_salida = 1
//console.log('Plantilla:'+pllantilla_id)
      switch(plantilla_id) {
        case '1':
          //console.log('factura:'+factura+' estudio:'+estudio+' tipo salida:'+tipo_salida)
          //console.log('tipo_salida '+tipo_salida)
          $.post("../reports/pdf_plantilla_1.php", {'factura' : factura, 'estudio' : estudio, 'tipo_salida' : tipo_salida} ,function(data, status){
            if(data == 1)
            {
              //console.log('previo al envio')
              $.post("./controladores/whatsapp.php", {'factura' : factura, 'estudio' : estudio, 'plantilla' : plantilla_id, 'id_cliente' : id_cliente} ,function(data, status){
                //console.log('envio el mail, estado: '+data)
                if(data == 1)
                {
                    Swal.fire({
                              position: 'top-end',
                              type: 'success',
                              title: 'Mensaje envia corretamente',
                              showConfirmButton: false,
                            })
                    //window.opener.document.location="../ag_orden_dia_p1_nvo/tabla_agenda.php";
                }else
                {
                    Swal.fire('No se envio el whatsapp, error: '+data)
                }
            });
            }else{
              swal('No se genero el PDF para ser enviado, notifique a su area de sistemas: soporte.producto@medisyslabs.onmicrosoft.com-->'+data)
            }
          }
          );
          break;
        case '2':
            //console.log('factura:'+factura+' estudio:'+estudio+' tipo salida:'+tipo_salida)
            //console.log('tipo_salida '+tipo_salida)
            $.post("../reports/pdf_plantilla_2.php", {'factura' : factura, 'estudio' : estudio, 'tipo_salida' : tipo_salida} ,function(data, status){
              if(data == 1)
              {
                //console.log('previo al envio')
                $.post("./controladores/whatsapp.php", {'factura' : factura, 'estudio' : estudio, 'plantilla' : plantilla_id, 'id_cliente' : id_cliente} ,function(data, status){
                  //console.log('envio el mail, estado: '+data)
                  if(data == 1)
                  {
                      Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: 'Mensaje envia corretamente',
                                showConfirmButton: false,
                              })
                      //window.opener.document.location="../ag_orden_dia_p1_nvo/tabla_agenda.php";
                  }else
                  {
                      Swal.fire('No se envio el whatsapp, error: '+data)
                  }
              });
              }else{
                swal('No se genero el PDF para ser enviado, notifique a su area de sistemas: soporte.producto@medisyslabs.onmicrosoft.com-->'+data)
              }
            }
          );
          break;
        case '3':
            //console.log('factura:'+factura+' estudio:'+estudio+' tipo salida:'+tipo_salida)
            //console.log('tipo_salida '+tipo_salida)
            $.post("../reports/pdf_plantilla_3.php", {'factura' : factura, 'estudio' : estudio, 'tipo_salida' : tipo_salida} ,function(data, status){
              if(data == 1)
              {
                //console.log('previo al envio')
                $.post("./controladores/whatsapp.php", {'factura' : factura, 'estudio' : estudio, 'plantilla' : plantilla_id, 'id_cliente' : id_cliente} ,function(data, status){
                  //console.log('envio el mail, estado: '+data)
                  if(data == 1)
                  {
                      Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: 'Mensaje envia corretamente',
                                showConfirmButton: false,
                              })
                      //window.opener.document.location="../ag_orden_dia_p1_nvo/tabla_agenda.php";
                  }else
                  {
                      Swal.fire('No se envio el whatsapp, error: '+data)
                  }
              });
              }else{
                swal('No se genero el PDF para ser enviado, notifique a su area de sistemas: soporte.producto@medisyslabs.onmicrosoft.com-->'+data)
              }
            }
          );
          break;
        default:
          swal('Sin plantilla'+plantilla_id)
         // stop
      }
  });
}


/* 
var codigo= function(tbody, table) {
  $(tbody).on("click", "button.codigo", function() 
  {
    var data = table.row($(this).parents("tr")).data();
    window.open("./reports/barras.php?cod="+data.cod_producto,'_blank')
  
  });
}
*/

var agregar= function(tbody, table) {
    $(tbody).on("click", "button.agregar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#form_productos  #dc").val(data.fk_id_cliente)
        $("#form_productos  #pro").val(data.id_producto)
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
        $("#frmedit  #dc").val(data.fk_id_cliente)
        $("#frmedit  #pro").val(data.id_producto)
        $("#frmedit  #codigo").val(data.cod_producto)
        $("#frmedit  #producto").val(data.producto)
        $("#frmedit  #desc_p").val(data.desc_producto)
        $("#frmedit  #uni").val(data.fk_unidad_medida)
        $("#frmedit  #lote").val(data.lote)
        $("#frmedit  #num_p").val(data.numero_p)
        $("#frmedit  #costo").val(data.costo_producto)
        $("#frmedit  #utilidad").val(data.utilidad)
        $("#frmedit  #c_total").val(data.costo_total)
        $("#frmedit  #depto").val(data.departamento)
        $("#frmedit  #proveedor").val(data.fk_id_proveedor)
        $("#frmedit  #cat").val(data.fk_id_categoria)
        $("#frmedit  #caducidad").val(data.caducidad)
        $("#frmedit  #fecha_actualizacion").val(data.fecha_actualizacion)
        $("#frmedit  #con").val(data.fk_id_tipo_consumo)
       
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
           $.post("./controladores/eliminar.php", {'id_producto' : data.id_producto}  , function(data,status)
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

/*
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
*/
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


