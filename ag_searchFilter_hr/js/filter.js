$(document).on("ready", function() {
    btnClear();
});

/*
 *Funcion que limpia todos los parametros,los parametros deben tener la clase .parameter
 */
var btnClear = function() {
    
    $('#btnClear').click(function() {
        $("input.parameter:text").val("");
        $("#btnClear").trigger("blur");
    });
}


/*Funcion que realiza la busqueda de información especifica dependiendo de los parametros
la tabla y el tipo de consulta
*
*@param tabla - nombre del ID de la tabla
*@param tipoConsulta - Sirve para saber que query va a ejecutar
* del query
*/
var search = function(tabla, tipoConsulta) {
    var JSONdata = {
        tipoConsulta: tipoConsulta,
        parametros: getValueParameters()
    };
    $.ajax({
        url: "../ag_searchFilter_hr/filtro.php",
        type: 'POST',
        data: { datas: JSON.stringify(JSONdata) },
        async: false,
        dataType: "JSON",
        success: function(data) {
            $("#" + tabla).DataTable().clear().draw();
            $("#" + tabla).DataTable().rows.add(data.data).draw();
            $("#btnFilter").trigger("blur");
        },
        error: function(xhr, status, error) {
            //console.log("error", xhr.responseText); //descomentar para ver el error
            $("#" + tabla).DataTable().ajax.reload();
            $("#btnFilter").trigger("blur");
        }
    }); //FIN AJAX

}

/*
 * Funcion que busca todos los inputs con la clase parameter y obtiene su valor creando un JSON
 */
var getValueParameters = function() {
    var arrayParametros = [];
    $('.parameter').each(function() {
        arrayParametros.push(this.id);
    });
    JSONparameters = {};
    for (var i = 0; i < arrayParametros.length; i++) {
        JSONparameters[arrayParametros[i]] = $('#' + arrayParametros[i]).val();
    }

    return JSONparameters;
}