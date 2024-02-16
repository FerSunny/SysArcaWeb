$(document).ready(function(){

buscar('no');

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




function buscar(busqueda, folio='')
 {
  tabla = $('#dt_resultados').dataTable(
        {
            "aProcessing" : true, //Activamos el procesamiento de datatables
            "aServerSide" : true, //Paginacion y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control tabla
            "ajax":
                  {
                    url : 'listar.php?busqueda='+busqueda+"&folio="+folio,
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
}

});

function pdf(factura,estudio,plantilla)
{
  console.log("Numero de factura: " + factura)
  console.log("Numero de estudio: " + estudio)
  console.log("Numero de estudio: " + plantilla)
  if(plantilla == 1)
        {
            if(estudio == 235)
            {
                window.open('./reports/print_plantilla_1_curva.php?numero_factura='+factura+'&studio='+estudio, '_blank');

            }else
            if(estudio == 236)
            {
                window.open('./reports/print_plantilla_1_curva.php?numero_factura='+factura+'&studio='+estudio, '_blank');

            }else
            if(estudio == 270)
            {
                window.open('./reports/print_plantilla_1_270.php?numero_factura='+factura+'&studio='+estudio, '_blank');
            }
            else
            {
                window.open('./reports/print_plantilla_1.php?numero_factura='+factura+'&studio='+estudio, '_blank');

            }
        }else
        if(plantilla == 2)
        {
            window.open('./reports/print_plantilla_2.php?numero_factura='+factura+'&studio='+estudio, '_blank');

        }else
        if(plantilla == 3)
        {
            window.open('./reports/print_plantilla_3.php?numero_factura='+factura+'&studio='+estudio, '_blank');
        }else
        {
            alert("no existe esa plantilla")
        }
}


function validar(factura,estudio,plantilla)
{
  console.log("Numero de factura: " + factura)
  console.log("Numero de estudio: " + estudio)
  console.log("Numero de estudio: " + plantilla)

    if(plantilla == 1)
    {
      console.log("Es plantilla 1")
        $.post("./validar/validar_plantilla_1.php", {'factura' : factura, 'estudio' : estudio} ,function(data, status){
            if(data == 1)
            {
               console.log("SE valido")
                var table = $("#dt_resultados").DataTable()
                table.ajax.reload()
                Swal.fire({
                          position: 'top-end',
                          type: 'success',
                          title: 'Validando datos, espere porfavor',
                          showConfirmButton: false,
                          timer: 1000
                        })
                 console.log("se recargo la pagina")
                //window.opener.document.location="../ag_orden_dia_p1_nvo/tabla_agenda.php";
            }else
            {
                Swal.fire('Error MySQL Codigo: ' + data)
            }
        });
    }else
    if(plantilla == 2)
    {
        $.post("./validar/validar_plantilla_2.php", {'factura' : factura, 'estudio' : estudio} ,function(data, status){
            if(data == 1)
            {
                var table = $("#dt_resultados").DataTable()
                table.ajax.reload()
                Swal.fire({
                          position: 'top-end',
                          type: 'success',
                          title: 'Validando datos, espere porfavor',
                          showConfirmButton: false,
                          timer: 1000
                })
                //window.opener.document.location="../ag_orden_dia_p1_nvo/tabla_agenda.php";
            }else
            {
                Swal.fire('Error MySQL Codigo: ' + data)
            }
        });
    }else
    if(plantilla == 3)
    {
        $.post("./validar/validar_plantilla_3.php", {'factura' : factura, 'estudio' : estudio} ,function(data, status){
            if(data == 1)
            {
                var table = $("#dt_resultados").DataTable()
                table.ajax.reload()
                Swal.fire({
                          position: 'top-end',
                          type: 'success',
                          title: 'Validando datos, espere porfavor',
                          showConfirmButton: false,
                          timer: 1000
                })
                //window.opener.document.location="../ag_orden_dia_p1_nvo/tabla_agenda.php";
            }else
            {
                Swal.fire('Error MySQL Codigo: ' + data)
            }
        });
    }else
    {
        alert("no existe esa plantilla")
    }

}



function modificar(factura,estudio,plantilla,cliente)
{
  console.log("Numero de factura: " + factura)
  console.log("Numero de estudio: " + estudio)
  console.log("Numero de estudio: " + plantilla)
  console.log("Numero de estudio: " + cliente)

    if(plantilla == 1)
    {
        if(estudio == 235)
        {
            window.open('./plantilla_1_3h/frm_update.php?cliente='+data.fk_id_cliente+'&factura='+factura+'&estudio='+estudio, '_blank');

        }else
        if(estudio == 236)
        {
            window.open('./plantilla_1_5h/frm_update.php?cliente='+cliente+'&factura='+factura+'&estudio='+estudio, '_blank');

        }else
        {
            window.open('./plantilla_1/frm_update.php?cliente='+cliente+'&factura='+factura+'&estudio='+estudio, '_blank');
        }
    }else
    if(plantilla == 2)
    {
        window.open('./plantilla_2/frm_update.php?cliente='+cliente+'&factura='+factura+'&estudio='+estudio, '_blank');
    }else
    if(plantilla == 3)
    {
        window.open('./plantilla_3/frm_update.php?cliente='+cliente+'&factura='+factura+'&estudio='+estudio, '_blank');
    }else
    {
        alert("La plantilla no existe")
    }

}


