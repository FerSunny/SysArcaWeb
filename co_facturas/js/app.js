$(document).ready(function(){
	//buscar(0)
});


$("input[name=f_inicio]").change(function(){
    var fecha = $('input[name=f_inicio]').val()
    $("#f_final").removeAttr("disabled")
    $("#f_final").attr("min",fecha )

});

$('#buscar_facturas').click(function(){
  var tipo = $("#tipo").val()
  var f_inicio = $("#f_inicio").val()
  var f_final = $("#f_final").val()
  var grupo = $("#grupo").val()
  if(tipo != '' && grupo !='')
  {
   	$('#dt_contador').DataTable().destroy();
  	buscar(tipo,f_inicio,f_final,grupo)
  }
  else
  {
   alert("Por favor seleccione la fecha");
  }
 });

function listar() {



   if(grupo == 0)
   {
   		console.log("Seleccione grupo")
   		//buscar(0)
   }else{
   	$('#dt_contador').DataTable().destroy();

   }



}


$("#imprimir_pdf").click(function(event) {
  var tipo = $("#tipo").val()
  var f_inicio = $("#f_inicio").val()
  var f_final = $("#f_final").val()
  var grupo = $("#grupo").val()

  switch (tipo){
    case '1':
          window.open('./reportes/pdf_ingresos.php?tipo='+tipo+'&fi='+f_inicio+'&ff='+f_final+'&grupo='+grupo, '_blank');
      break;
    case '2':
          window.open('./reportes/pdf_egresos.php?tipo='+tipo+'&fi='+f_inicio+'&ff='+f_final+'&grupo='+grupo, '_blank');
      break;
    case '3':
          window.open('./reportes/pdf_facturas.php?tipo='+tipo+'&fi='+f_inicio+'&ff='+f_final+'&grupo='+grupo, '_blank');
      break;
    default:
          alert("No existe")
      break;
  }


});


var buscar = function(tipo,f_inicio = '',f_final = '',grupo = '')
	 {
	 	console.log("Buscando")
	  table = $('#dt_contador').dataTable(
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
	                    url : 'listar.php?tipo='+tipo+'&f_inicio='+f_inicio+'&f_final='+f_final+'&grupo='+grupo,
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


	function ingresos(tipo,tp)
	{
		var f_inicio = $("#f_inicio").val()
   	var f_final = $("#f_final").val()
   	var grupo = $("#grupo").val()
		console.log(f_inicio)
		window.open('detalles_ingresos.php?tipo='+4+'&tp='+tp+'&fi='+f_inicio+'&ff='+f_final+'&grupo='+grupo, '_blank');
	}

  function imprimir_ingresos(tipo,tp,f_inicio,f_final,grupo)
  {
    window.open('reportes/pdf_detalles_ingresos.php?&tp='+tp+'&fi='+f_inicio+'&ff='+f_final+'&grupo='+grupo, '_blank');
  }

  function egresos(tipo,tp)
  {
    var f_inicio = $("#f_inicio").val()
    var f_final = $("#f_final").val()
    var grupo = $("#grupo").val()
    console.log(f_inicio)
    window.open('detalles_egresos.php?tipo='+5+'&tp='+tp+'&fi='+f_inicio+'&ff='+f_final, '_blank');
  }

  function imprimir_egresos(tipo,tp,f_inicio,f_final)
  {
    window.open('reportes/pdf_detalles_egresos.php?&tp='+tp+'&fi='+f_inicio+'&ff='+f_final+'&grupo='+grupo, '_blank');
  }

  function facturas(tipo,tp)
  {
    var f_inicio = $("#f_inicio").val()
    var f_final = $("#f_final").val()
    var grupo = $("#grupo").val()
    console.log(f_inicio)
    window.open('detalles_facturas.php?tipo='+6+'&tp='+tp+'&fi='+f_inicio+'&ff='+f_final+'&grupo='+grupo, '_blank');
  }

  function imprimir_facturas(tipo,tp,f_inicio,f_final,grupo)
  {
    window.open('reportes/pdf_detalles_facturas.php?&tp='+tp+'&fi='+f_inicio+'&ff='+f_final+'&grupo='+grupo, '_blank');
  }

/*
  function crear_grafica()
  {
      var tipo = 1//$("#tipo").val()
      var f_inicio = '2019-01-01'// $("#f_inicio").val()
      var f_final = '2019-01-31' //$("#f_final").val()
      var grupo = 'A'//$("#grupo").val()

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        $.post("ajax/buscar_datos.php", {'tipo':tipo,'f_inicio':f_inicio,'f_final':f_final,'grupo':grupo}, function(data)
        {

          var datos = jQuery.parseJSON(data);
          //console.log(datos[0].cuenta)
          for(var key in datos)
          {
            console.log(datos[key].tipo)
            console.log(datos[key].folios)
          }
          var data = google.visualization.arrayToDataTable([
            ['Tipo Pago', 'Total'],
            ['Efectivo',    datos[key].cuenta]
          ]);

          var options = {
            title: 'My Daily Activities'
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart.draw(data, options);
        })

      }
  }
*/
