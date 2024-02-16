<?php
include("../controladores/conex.php");
//Variable de búsqueda
$consultaBusqueda = $_POST['valorBusqueda'];
//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("&lt;", "&gt;", "&quot;", "&#x27;", "&#x2F;", "&#060;", "&#062;", "&#039;", "&#047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);
//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";

//Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda)) {

	//Selecciona todo de la tabla mmv001 
	//donde el nombre sea igual a $consultaBusqueda, 
	//o el apellido sea igual a $consultaBusqueda, 
	//o $consultaBusqueda sea igual a nombre + (espacio) + apellido
	$consulta = mysqli_query($conexion, "SELECT * FROM km_estudios
	WHERE id_estudio='$consultaBusqueda'");

	//Obtiene la cantidad de filas que hay en la consulta
	$filas = mysqli_num_rows($consulta);

	//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
	if ($filas === 0) {
		$mensaje = "<p>No hay ningún usuario con ese nombre y/o apellido</p>";
	} else {
		//Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
		echo '<label>ID de Busqueda <strong>: '.$consultaBusqueda.'</strong></label>';

		//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
		while($resultados = mysqli_fetch_array($consulta)) {
			$idestudio = $resultados['id_estudio'];
			$estudio = $resultados['desc_estudio'];
            $costo =$resultados['costo'];

			//Output
			$mensaje .= '
			<form id="modal2">
            <p>
            <table class="table">
                <tr>
                    <th><label for="">Estudio</label></th>
                    <th><label for="">Costo</label></th>
                </tr>
                <tr>
                    <th><input type="text" name="estudio" id="estudio" class="form-control estudio" value="' . $estudio . '" placeholder="" maxlength="30" autocomplete="off"disabled/></th>
                    <th><input type="text" name="costo" id="costo" class="form-control costo" value="' . $costo . '" placeholder="" maxlength="30" autocomplete="off" disabled/></th>
                </tr>
            </table>
			</p>
            </form>';

		};//Fin while $resultados

	}; //Fin else $filas

};//Fin isset $consultaBusqueda

//Devolvemos el mensaje que tomará jQuery
echo $mensaje;

?>
