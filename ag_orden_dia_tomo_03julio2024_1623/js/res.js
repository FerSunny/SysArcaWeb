preConfirm: function() {
    return new Promise(function(resolve, reject) {
        setTimeout(function() {
          $.ajax({
            url:"./services/delete_row.php",
             type: 'POST',
             data:{datas:JSON.stringify({"id_factura":data.id_factura,"id_studio":data.fk_id_estudio})},
             dataType: "json",
            success: function(datas){
              $('#dt_agenda').DataTable().ajax.reload();
              resolve();
            },
               error:function(xhr, status, error){
                 console.log(xhr.responseText);
                swal(
                  'Oops...',
                  'Error del servidor',
                  xhr.responseText
                )
               }
          }) //fin del ajax
        }, 300)
    })
},


swal({
  title: '<i>Se elimino el registro correctamente</i>',
  type: 'success',
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    '<a  class="fa fa-thumbs-up"></a> Ok!',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  });
