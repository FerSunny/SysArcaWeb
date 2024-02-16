$(document).on("ready", function() {
	$.fn.dataTable.ext.errMode = 'none';
	listar();
	busquedaPersonalizada();

});

$("#btn_listar").on("click", function() {
	listar();
});

// Inicio Nueva rutina para calculo de la edad
// rutina para leer la fecha en ALTAS
function CalcularEdad()
{
   // var fecha=document.getElementById("user_date").value;
    var fecha = $("#form_clientes #fecha_nac").val();
    //var fecha= curp2date(rfc);

console.log(fecha)
    //var fecha ='1965-06-19'

    if(validate_fecha(fecha)==true)
    {
        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
 
        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();
 
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes )
        {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }
        if (edad > 1900)
        {
            edad -= 1900;
        }
 
        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
            meses=ahora_mes-mes;
        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;
 
        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia)
        {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
        $("#form_clientes #anios").val(edad)
 		$("#form_clientes #fi_meses").val(meses)
 		$("#form_clientes #dias").val(dias)
        //document.getElementById("result").innerHTML="Tienes "+edad+" años, "+meses+" meses y "+dias+" días";
    }else{
    	alert('Error en el formato de la fecha');	
        //document.getElementById("result").innerHTML="La fecha "+fecha+" es incorrecta";
    }
}
// validar que la fecha tenga el formato correcto
function validate_fecha(fecha)
{
    var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");
 
    if(fecha.search(patron)==0)
    {
        var values=fecha.split("-");
        if(isValidDate(values[2],values[1],values[0]))
        {
            return true;
        }
    }
    return false;
}

function isValidDate(day,month,year)
{
    var dteDate;
     month=month-1;
    dteDate=new Date(year,month,day);
     return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
}


// Inicio Nueva rutina para calculo de la antiguedad
// rutina para leer la fecha en ALTAS
function CalcularAntiguedad()
{
   // var fecha=document.getElementById("user_date").value;
    var fecha = $("#form_clientes #fecha_ing").val();
    //var fecha= curp2date(rfc);

console.log(fecha)
    //var fecha ='1965-06-19'

    if(validate_fecha(fecha)==true)
    {
        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
 
        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();
 
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes )
        {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }
        if (edad > 1900)
        {
            edad -= 1900;
        }
 
        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
            meses=ahora_mes-mes;
        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;
 
        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia)
        {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
        $("#form_clientes #anios_ant").val(edad)
 		$("#form_clientes #fi_meses_ant").val(meses)
 		$("#form_clientes #dias_ant").val(dias)
        //document.getElementById("result").innerHTML="Tienes "+edad+" años, "+meses+" meses y "+dias+" días";
    }else{
    	alert('Error en el formato de la fecha');	
        //document.getElementById("result").innerHTML="La fecha "+fecha+" es incorrecta";
    }
}




// fin Nueva rutina para calculo de la edad
// inicia rutinas reutilizadas

// rutina para extraer la fecha del RFC
function curp2date(curp) {
	var m = curp.match( /^\w{4}(\w{2})(\w{2})(\w{2})/ );
	//miFecha = new Date(año,mes,dia)
	
	var anyo = parseInt(m[1],10)+1900;

	if( anyo < 1950 ) anyo += 100;
	var mes = parseInt(m[2], 10)-1;
	var dia = parseInt(m[3], 10);
	return (new Date( anyo, mes, dia ));
}
// rutina para leer la fecha en MODIFICACIONES
function CalcularEdadMo()
{
   // var fecha=document.getElementById("user_date").value;
    var fecha = $("#frmedit #fecha_nac").val();
    //var fecha= curp2date(rfc);

console.log(fecha)
    //var fecha ='1965-06-19'

    if(validate_fecha(fecha)==true)
    {
        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
 
        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();
 
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes )
        {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }
        if (edad > 1900)
        {
            edad -= 1900;
        }
 
        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
            meses=ahora_mes-mes;
        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;
 
        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia)
        {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
        $("#frmedit #anios").val(edad)
 		$("#frmedit #meses").val(meses)
 		$("#frmedit #dias").val(dias)
        //document.getElementById("result").innerHTML="Tienes "+edad+" años, "+meses+" meses y "+dias+" días";
    }else{
    	alert('Error en el formato de la fecha');	
        //document.getElementById("result").innerHTML="La fecha "+fecha+" es incorrecta";
    }
}

// fin de rutinas re utilizadaas

/*
// CALCULOS DE LA EDAD EN BASE AL RFC
function curp2date(curp) {
	var m = curp.match( /^\w{4}(\w{2})(\w{2})(\w{2})/ );
	//miFecha = new Date(año,mes,dia)
	
	var anyo = parseInt(m[1],10)+1900;

	if( anyo < 1950 ) anyo += 100;
	var mes = parseInt(m[2], 10)-1;
	var dia = parseInt(m[3], 10);
	return (new Date( anyo, mes, dia ));
}

Date.prototype.toString = function() {
	var anyo = this.getFullYear();
	var mes = this.getMonth()+1;
	if( mes<=9 ) mes = "0"+mes;
	var dia = this.getDate();
	if( dia<=9 ) dia = "0"+dia;
	return dia+"/"+mes+"/"+anyo;
}
//var miCurp = "BUHI930418HDFSRR04";
//document.write( curp2date(miCurp) );
function calculateAge(birthday) {
    var birthday_arr = birthday.split("/");
    var birthday_date = new Date(birthday_arr[2], birthday_arr[1] - 1, birthday_arr[0]);
    var ageDifMs = Date.now() - birthday_date.getTime();
    var ageDate = new Date(ageDifMs);
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}

function calcular_d(cumple,hoy){
	console.log(cumple)
	console.log(hoy)
	var  fechafin = new Date(hoy)
	var fechaini = new Date(cumple)
	var diasdif= fechafin.getTime()-fechaini.getTime();
	var contdias = Math.round(diasdif/(1000*60*60*24));
	return contdias;
}

function Calcular()
{
var miCurp = $("#form_clientes #rfc").val()
var fecha= curp2date(miCurp);
var fecha_s = fecha.toString()
var age = calculateAge(fecha_s);
$("#form_clientes #anios").val(age)


//Cumple años
var fecha_c = fecha_s.split("/");
//var dia = fecha_c[2]
var dia_c = fecha_c[0];
var mes_c = fecha_c[1]
var year_c = new Date();
var ano_c = year_c.getFullYear();
var mi_cumple = ano_c+"-"+mes_c+"-"+dia_c
var fecha_hoy = new Date()
var dias = calcular_d(mi_cumple.toString(),fecha_hoy)
console.log(dias)
//* Meses
var meses = parseInt(dias/30)
$("#form_clientes #fi_meses").val(meses)

// Obtener dias resta
var dias_r = meses*30
var dias_s = dias-dias_r;
$("#form_clientes #dias").val(dias_s)

}
*/
// FIN DE RUTINAS PARA CALCULAR LA EDAD ECON EL RFC

// listar datos en la tabla de medicos
var listar = function() {
		$("#cuadro1").slideDown("slow");
		var table = $("#dt_clientes").DataTable({
			"destroy": true,
			"sRowSelect": "multi",
			"ajax": {
				"method": "POST",
				"url": "listar.php"
			},
			"columns": [
				{ "data": "id_cliente" },
				{ "data": "nombre" },
				{ "data": "a_paterno" },
				{ "data": "a_materno" },
				{ "data": "edad" },
				{ "data": "desc_sexo" },
				{ "data": "desc_estado_civil" },
				{ "data": "telefono_fijo"},
				{ "data": "telefono_movil" },
				{
						render:function(data,type,row){
							var perfil;
							var perfil=row['perfil']

							if(perfil==1)
							{
								return "<button type='button' class='editar btn btn-warning btn-sm' data-toggle='modal' data-target='#modalEditar'><i class='fas fa-edit'></i></button>"
							}

					},
				},
				//{ "defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>" },
				{
						render:function(data,type,row){
							var perfil;
							var perfil=row['perfil']

							if(perfil==1)
							{
								return "<button type='button' class='eliminar btn btn-danger btn-sm' data-toggle='modal' data-target='#modalEliminar' ><i class='fas fa-trash-alt'></i></button>"
							}
							else
							{
								return ""
							}

					},
				},
				//{ "defaultContent": "<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>" }
			],
			"language": idioma_espanol
		});
		agregar("#dt_clientes tbody" , table);
		editar("#dt_clientes tbody", table);
	  eliminar("#dt_clientes tbody", table);
}



var agregar= function(tbody, table) {
		$(tbody).on("click", "button.agregar", function()
		{
				var data = table.row($(this).parents("tr")).data();
				$("#form_clientes  #pro").val(data.id_cliente)
				$("#form_clientes").modal("show")

		});
}


/* Agregamos una nueva clasificacion  para q no se recargue la pagina */
$("#form_clientes").on('submit', function (e)
	{
			e.preventDefault()
			$.ajax({
					type: "POST",
					url: "controladores/agregar.php",
					data: $("#form_clientes").serialize(),
					beforeSend: function(){
					},
					success: function(data)
						{

								var table = $('#dt_clientes').DataTable(); // accede de nuevo a la DataTable.
								table.ajax.reload();// Recarga el  DataTable
								document.getElementById("form_clientes").reset();
								swal('Empleado Agregado')
								console.log(data)

						}
					});
	});
	// editamos clientes
    var editar = function(tbody, table) {
		$(tbody).on("click", "button.editar", function()
		{
		var data = table.row($(this).parents("tr")).data();
		$("#form_editar").modal("show")
		$("#frmedit  label").attr('class','active')
		$("#frmedit #idcliente").val(data.id_cliente);
		$("#frmedit #id_cliente").val(data.id_cliente);
		$("#frmedit #rfc").val(data.rfc);
		$("#frmedit #nombre").val(data.nombre);
		$("#frmedit #a_paterno").val(data.a_paterno);
		$("#frmedit #a_materno").val(data.a_materno);
		$("#frmedit #anios").val(data.anios);
		$("#frmedit #meses").val(data.meses);
		$("#frmedit #dias").val(data.dias);
		$("#frmedit #sexo option[value='"+data.fk_id_sexo+"']").attr("selected",true);
		$("#frmedit #estado_civil option[value='"+data.fk_id_estado_civil+"']").attr("selected",true);
		$("#frmedit #ocupacion option[value='"+data.fk_id_ocupacion+"']").attr("selected",true);
		$("#frmedit #t_fijo").val(data.telefono_fijo);
		$("#frmedit #movil").val(data.telefono_movil);
		$("#frmedit #mail").val(data.mail);
		$("#frmedit #edo").val(data.fk_id_estado)
		$.post("../select/select_estado.php?val=1", {'id_estado' : data.fk_id_estado, 'id_municipio' : data.fk_id_municipio}  , function(res,status)
		{
			console.log(res)
			$("#frmedit #muni").html(res);
			$("#frmedit #muni option[value='"+data.fk_id_municipio+"']").attr("selected",true);
			$('select').selectpicker('refresh');
			//$('#frm_edit #fi_municipio').append(data);
		});

		$.post("../select/select_estado.php?val=2", {'id_estado' : data.fk_id_estado, 'id_municipio' : data.fk_id_municipio}  , function(res,status)
		{
			//console.log(res)
			$("#frmedit #loca").html(res);
			$("#frmedit #loca option[value='"+data.fk_id_localidad+"']").attr("selected",true);
			$('select').selectpicker('refresh');
				//$('#frm_edit #fi_municipio').append(data);
		});
		$("#frmedit #colonia").val(data.colonia);
		$("#frmedit #cp").val(data.cp);
		$("#frmedit #calle").val(data.calle);
		$("#frmedit #numero").val(data.numero_exterior);
		$("#frmedit #f_alta").val(data.fecha_registro);
		//$("#frmedit #fi_factualiza").val( data.fecha_actuaizacion);
		$("#frmedit #estado").val(data.activo);
		$("#frmedit #fecha_nac").val(data.fecha_nac)
		$("#frmedit #box_publicidad").val(data.publicidad)

		//Obetemo el valor de campo publicidad
/*
		if(data.publicidad == 1)
		{
			//Si es 1
			$("#frmedit input[name=box_publicidad][value='1'").prop("checked",true);
		}else
		{
			//Si es 0
			$("#frmedit input[name=box_publicidad][value='1'").prop("checked",false);
		}
		$('select').selectpicker('refresh');
		console.log(data);
*/

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

								var table = $('#dt_clientes').DataTable(); // accede de nuevo a la DataTable.
								table.ajax.reload(); // Recarga el  DataTable
								swal(data)
								console.log(data)

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
					 //$.post("../../config/eliminar.php", {'id_cliente' : data.id_cliente}  , function(data,status)
					 $.post("controladores/eliminar.php", {'id_cliente' : data.id_cliente}  , function(data,status)
					{
						swalWithBootstrapButtons(
						'Eliminado!',
						'La información ha sido eliminada',
						'success'
					)
						console.log(data)
						var table = $('#dt_clientes').DataTable(); // accede de nuevo a la DataTable.
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
 *Funcion que al ejecutar el boton de busqueda crea un JSON con los parametros a buscar
 *
 */
var busquedaPersonalizada = function() {
	$("#btnFilter").click(function() {
		search("dt_clientes", "clientes");

	});

}


// tomar el evento de municipios
		$("#myModals select[name=edo]").change(function()
		{

				select = $('#myModals select[name=edo]').val();
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
							$("#myModals #muni").html(data);
							$('select').selectpicker('refresh');
							//$("#res").load(" #resultado");
							console.log(data)
						}
				});
		});

// tomar el evento de localidades
		$("#myModals select[name=muni]").change(function()
		{
				select1 = $('#myModals select[name=muni]').val();
				select2 = $('#myModals select[name=edo]').val();
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
							$("#myModals #loca").html(data);
							$('select').selectpicker('refresh');
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
							$('select').selectpicker('refresh');
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
							$('select').selectpicker('refresh');
							//$("#res").load(" #resultado");
							console.log(data)
						}
				});
		});
