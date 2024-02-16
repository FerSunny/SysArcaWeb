	$(document).ready(function() {
			listar2();
		});
        var listar2 = function(){
			var table = $("#dt_detalle").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar4.php"
				},
				"columns":[
					{ "data": "id_solicitud" },
					{ "data": "cliente" },
                    { "data": "paterno" },
                    { "data": "materno" },
                    { "data": "fecha_entrega" },
                    {"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#tabla1'>.<i class='fa fa-pencil-square-o'></i></button>"},
					{"defaultContent":"<button type='button' class='editar1 btn btn-success' data-toggle='modal' data-target='#modalEditar1' >.<i class='fa fa-pencil'></i></button>"},
                    {"defaultContent":"<button type='button' class='editar2 btn btn-success' data-toggle='modal' data-target='#modalEditar2' >.<i class='fa fa-pencil'></i></button>"},
                    {"defaultContent":"<button type='button' class='pdf btn btn-defautl' data-toggle='modal' data-target='#pdf' >.<i class='fa fa-file-pdf-o'></i></button>"}
                    
				],
				"language": idioma_espanol
			});

			datos_editar("#dt_detalle tbody", table);
            datos_editar1("#dt_detalle tbody", table);
            datos_editar2("#dt_detalle tbody", table);
            crear_pdf("#dt_detalle tbody", table);
		}
        var crear_pdf = function(tbody, table){
			$(tbody).on("click", "button.pdf", function(){
            var data = table.row( $(this).parents("tr") ).data();
                
            var doc = new jsPDF();
                var nombre= data.cliente + " " + data.paterno + " " + data.materno;
                var fechae= data.fecha_entrega;
                doc.setFontSize(40);
                doc.text(35, 25, 'Cabecera');
                doc.setFontSize(12);
                doc.text(35,40,'Nombre: ' + nombre);
                doc.text(35,45,'Fecha de Entrega: ' + fechae);
                doc.output('dataurlnewwindow');

            /*$("#frmedit #idsol").val( data.id_solicitud);
            $("#frmedit #sucursal").val( data.id_sucursal);
            $("#frmedit #id").val( data.id_solicitud);
            $("#frmedit #nombre").val( data.cliente + " " + data.paterno + " " + data.materno);
            $("#frmedit #medico").val( data.id_medico);
            $("#frmedit #fe").val( data.fecha_entrega);
            $("#frmedit #he").val( data.hora_entrega);
            $("#frmedit #obs").val( data.observaciones);
            $("#frmedit #diag").val( data.diagnostico);
            $("#frmedit #est").val( data.cantidad_estudios);
            $("#frmedit #estado").val( data.estado);
            $("#frmedit #origen").val( data.origen);
            $("#frmedit #edad").val( data.edad);
            $("#frmedit #sexo").val( data.fk_id_ssexo);*/
			});
		} 

       	var datos_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
            var data = table.row( $(this).parents("tr") ).data();
            $("#frmedit #idsol").val( data.id_solicitud);
            $("#frmedit #sucursal").val( data.id_sucursal);
            $("#frmedit #id").val( data.id_solicitud);
            $("#frmedit #nombre").val( data.cliente + " " + data.paterno + " " + data.materno);
            $("#frmedit #medico").val( data.id_medico);
            $("#frmedit #fe").val( data.fecha_entrega);
            $("#frmedit #he").val( data.hora_entrega);
            $("#frmedit #obs").val( data.observaciones);
            $("#frmedit #diag").val( data.diagnostico);
            $("#frmedit #est").val( data.cantidad_estudios);
            $("#frmedit #estado").val( data.estado);
            $("#frmedit #origen").val( data.origen);
            $("#frmedit #edad").val( data.edad);
            $("#frmedit #sexo").val( data.fk_id_ssexo);
			});
		}  
        
        
        var datos_editar1 = function(tbody, table){
			$(tbody).on("click", "button.editar1", function(){
            var data = table.row( $(this).parents("tr") ).data();
            var desc=$("#frmEdit1 #iddetalle").val( data.id_solicitud);
            $("#frmEdit1 #desc").val( data.porc_descuento);
            $("#frmEdit1 #comision").val( data.afecta_comision);
            $("#frmEdit1 #importe").val( data.imp_subtotal);
             $("#frmEdit1 #cuenta").val( data.a_cuenta);
            $("#frmEdit1 #total").val( data.imp_total);
            $("#frmEdit1 #resta").val( data.resta);
			});
            
		}  
        var datos_editar2 = function(tbody, table){
			$(tbody).on("click", "button.editar2", function(){
            var data = table.row( $(this).parents("tr") ).data();
            $("#frmEdit2 #idsolicitud").val( data.fk_id_solicitud);
            $("#frmEdit2 #txtestudio").val( data.fk_id_estudio);
            $("#frmEdit2 #txtcosto").val( data.precio);
            //$("#frmEdit1 #txtestudio").val( data.afecta_comision);
            //$("#frmEdit1 #txtcosto").val( data.imp_subtotal);
            //$("#frmEdit1 #txtestudio").val( data.a_cuenta);
            //$("#frmEdit1 #txtcosto").val( data.imp_total);
            //$("#frmEdit1 #txtestudio").val( data.resta);
            //$("#frmEdit1 #txtcosto").val( data.imp_total);
			});
		}  
                        
                        
                        
    
        	var idioma_espanol = {
		    "sProcessing":     "Procesando...",
               "sLengthMenu": 'Mostrar <select>'+
		    	'<option value="3">3</option>'+
		        '</select> registros',
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}