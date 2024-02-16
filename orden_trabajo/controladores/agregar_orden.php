<?php
session_start();
include("../../controladores/conex.php");
date_default_timezone_set('America/Mexico_City');
include("../../pdf/fpdf.php");

$fecha=date("y/m/d");
$hora=date("H:i:s");
$feho=date("y/m/d H:i:s");

$empresa ="1";
/*Datos del Paciente*/
$d1 = $_POST['unidad'];
$d2 = $_POST['folio'];
$d3 = $_POST['fecha'];
$d4 = $_POST['fechaentrega'];
$d5 = $_POST['hora'];
$d6 = $_POST['idpaciente'];;
$d10 = $_POST['idmedico'];
$d11 = $_POST['obs'];
$d12 = $_POST['atendio'];
$d13 = $_POST['diagnostico'];
/*Lista Estudios */
$d14 = $_POST['txtestudio'];
$d15 = $_POST['txtcosto'];
$d16 = $_POST['txtestudio1'];
$d17 = $_POST['txtcosto1'];
$d18 = $_POST['txtestudio2'];
$d19 = $_POST['txtcosto2'];
$d20 = $_POST['txtestudio3'];
$d21 = $_POST['txtcosto3'];
$d22 = $_POST['txtestudio4'];
$d23 = $_POST['txtcosto4'];
/*Pago*/
$d24 = $_POST['descuento'];
$d25 = $_POST['importe'];
$d26 = $_POST['ttotal'];
$d27 = $_POST['cuenta'];
$d28 = $_POST['resta'];
$d29 = $_POST['comision'];
$d30 = $_POST['est'];
$c1=$_POST['c1'];
$c2=$_POST['c2'];
$c3=$_POST['c3'];
$c4=$_POST['c4'];
$c5=$_POST['c5'];
$num1=$_POST['f1'];
$num2=$_POST['f2'];
$num3=$_POST['f3'];
$num4=$_POST['f4'];
$num5=$_POST['f5'];

$suma=$num1 + $num2 + $num3 + $num4 + $num5;

/*echo $d1. "<br> " . $d2. "<br> " . $d6. "<br> " . $d10. "<br> " . $d4. "<br> " . $d5. "<br> " . $d4. "<br> "
    . $d5. " <br>" . $fecha. "<br> " . $hora . "<br> " .$d11 . "<br> " .$d13 . " <br>" ."0"."<br> " .$d25. "<br> ".$d24."<br> "."0"."<br> ".$d26."<br> " .$d27."<br> ".$d28."<br> " . $d29 . "<br> ". " <br>" ."NO"."<br> ".$feho." <br>" . "No" . "<br> " . $feho . " <br>" ."A". "<br> " . "L";*/
//echo " Espacio ";
//echo $d14. " " . $d15. " " . $d16. " " . $d17. " " . $d18. " " . $d19. " " . $d20. " " . $d21. " " . $d22;
//echo " Espacio ";
//echo $d23. " " . $d24. " " . $d25. " " . $d26. " " . $d27;



$query = " INSERT INTO so_cabezal
(fk_id_empresa,fk_id_cliente,fk_id_medico,fecha_recepcion,hora_recepcion,fecha_aplicacion,hora_aplicacion,fecha_entrega ,hora_entrega ,observaciones,diagnostico,cantidad_estudios,imp_subtotal,porc_descuento,porc_incremento,imp_total,a_cuenta,resta,afecta_comision,impresa,fecha_hora_impresa,entregada,fecha_hora_entrega,estado,origen) 
VALUES('$d1','$d6','$d10','$d4','$d5','$d4','$d5','$d4','$d5','$d11','$d13','$suma','$d25','$d24',0,'$d26','$d27','$d28','$d29','No','$feho','No','$feho','$d30','L')";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			header("location: ../notas.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
      die('Error de Conexión: ' . mysqli_connect_errno());
		}

if($suma==1){
    $query2= "INSERT INTO so_detalle(fk_id_empresa,fk_id_solicitud,renglon,cantidad,fk_id_estudio,precio) VALUES('$d1','$d2',1,1,'$c1','$d15')";
   
    $resultado = mysqli_query($conexion, $query2);
        if ($resultado) {
			//echo "perfil almacenado. <br />";
			header("location: ../notas.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
      die('Error de Conexión: ' . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: ' . mysqli_connect_errno());

       }
}else
    if($suma==2){
        $query2= "INSERT INTO so_detalle(fk_id_empresa,fk_id_solicitud,renglon,cantidad,fk_id_estudio,precio) VALUES('$d1','$d2',1,1,'$c1','$d15'),('$d1','$d2',2,1,'$c2','$d17')";
         $resultado = mysqli_query($conexion, $query2);
        if ($resultado) {
			//echo "perfil almacenado. <br />";
			header("location: ../notas.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
      die('Error de Conexión: ' . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: ' . mysqli_connect_errno());

       }
    }else
    if($suma==3){
        $query2= "INSERT INTO so_detalle(fk_id_empresa,fk_id_solicitud,renglon,cantidad,fk_id_estudio,precio) VALUES('$d1','$d2',1,1,'$c1','$d15'),('$d1','$d2',2,1,'$c2','$d17'),('$d1','$d2',3,1,'$c3','$d19')";
         $resultado = mysqli_query($conexion, $query2);
        if ($resultado) {
			//echo "perfil almacenado. <br />";
			header("location: ../notas.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
      die('Error de Conexión: ' . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: ' . mysqli_connect_errno());

       }
    }else
    if($suma==4){
        $query2= "INSERT INTO so_detalle(fk_id_empresa,fk_id_solicitud,renglon,cantidad,fk_id_estudio,precio) VALUES('$d1','$d2',1,1,'$c1','$d15'),('$d1','$d2',2,1,'$c2','$d17'),('$d1','$d2',3,1,'$c3','$d19'),('$d1','$d2',4,1,'$c4','$d21')";
         $resultado = mysqli_query($conexion, $query2);
        if ($resultado) {
			//echo "perfil almacenado. <br />";
			header("location: ../notas.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
      die('Error de Conexión: ' . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: ' . mysqli_connect_errno());

       }
    }else
    if($suma==5){
        $query2= "INSERT INTO so_detalle(fk_id_empresa,fk_id_solicitud,renglon,cantidad,fk_id_estudio,precio) VALUES('$d1','$d2',1,1,'$c1','$d15'),('$d1','$d2',2,1,'$c2','$d17'),('$d1','$d2',3,1,'$c3','$d19'),('$d1','$d2',4,1,'$c4','$d21'),('$d1','$d2',5,1,'$c5','$d23')";
         $resultado = mysqli_query($conexion, $query2);
        if ($resultado) {
			//echo "perfil almacenado. <br />";
			header("location: ../notas.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
      die('Error de Conexión: ' . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: ' . mysqli_connect_errno());

       }
    }
   else    
    if($suma==0){
 
    }

?>