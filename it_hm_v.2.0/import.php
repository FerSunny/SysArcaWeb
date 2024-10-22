<?php
include_once("db_connect.php");
if(isset($_POST['import_data'])){
$lineas=1;
// validate to check uploaded file is a valid csv file
$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)){
	if(is_uploaded_file($_FILES['file']['tmp_name'])){

		$csv_file = fopen($_FILES['file']['tmp_name'], 'r');
		//fgetcsv($csv_file);
		// get data records from csv file
		while(($emp_record = fgetcsv($csv_file)) !== FALSE){
			if($lineas <= 2){
				$lineas += 1;
				continue;
			}
			// Check if employee already exists with same email
			$sql_query = "SELECT nickname, Instrument_id, date_v, time_v, adapter, position_v, sample_no FROM hm_recepcion_nx_550 WHERE sample_no = '".$emp_record[6]."'";
			$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
			// if employee already exist then update details otherwise insert new record
			if(mysqli_num_rows($resultset)) {
				$sql_update = "UPDATE hm_recepcion_nx_550 set nickname='".$emp_record[0]."', 
															Instrument_id='".$emp_record[1]."', 
															date_v='".$emp_record[2]."',
															time_v='".$emp_record[3]."',
															adapter='".$emp_record[4]."',
															position_v='".$emp_record[5]."',
															reception_date='".$emp_record[6]."',
															wbctotales='".$emp_record[92]."',
															rbctotales='".$emp_record[94]."',
															hgb='".$emp_record[96]."',
															hct='".$emp_record[98]."',
															mcv='".$emp_record[100]."',
															mchpg='".$emp_record[102]."',
															mchcgdl='".$emp_record[104]."',
															plt='".$emp_record[106]."',
															rdwsd='".$emp_record[108]."',
															rdwcv='".$emp_record[110]."',
															mpv='".$emp_record[114]."',
															neutabs='".$emp_record[124]."',
															lymphabs='".$emp_record[126]."',
															monoabs='".$emp_record[128]."',
															eoabs='".$emp_record[130]."',
															basoabs='".$emp_record[132]."',
															neutporc='".$emp_record[134]."',
															lymphporc='".$emp_record[136]."',
															monoporc='".$emp_record[138]."',
															eoporc='".$emp_record[140]."',
															basoporc='".$emp_record[142]."',
															igabs='".$emp_record[144]."',
															igporc='".$emp_record[146]."' WHERE sample_no = '".$emp_record[6]."'";
				mysqli_query($conn, $sql_update) or die("database error:". mysqli_error($conn));
			} else{
				$mysql_insert = "INSERT INTO hm_recepcion_nx_550 (  nickname,
																	instrument_id,
																	date_v,
																	time_v,
																	adapter,
																	position_v,
																	sample_no,
																	
																	reception_date,

																	wbctotales,
																	rbctotales,
																	hgb,
																	hct,
																	mcv,
																	mchpg,
																	mchcgdl,
																	plt,
																	rdwsd,
																	rdwcv,
																	mpv,
																	neutabs,
																	lymphabs,
																	monoabs,
																	eoabs,
																	basoabs,
																	neutporc,
																	lymphporc,
																	monoporc,
																	eoporc,
																	basoporc,
																	igabs,
																	igporc)
															VALUES(	'".$emp_record[0]."',
																	'".$emp_record[1]."',
																	'".$emp_record[2]."', 
																	'".$emp_record[3]."', 
																	'".$emp_record[4]."', 
																	'".$emp_record[5]."',
																	'".$emp_record[6]."', 

																	'".$emp_record[7]."', 

																	'".$emp_record[92]."', 
																	'".$emp_record[94]."', 
																	'".$emp_record[96]."', 
																	'".$emp_record[98]."', 
																	'".$emp_record[100]."', 
																	'".$emp_record[102]."', 
																	'".$emp_record[104]."',  
																	'".$emp_record[106]."', 
																	'".$emp_record[108]."', 
																	'".$emp_record[110]."', 
																	'".$emp_record[114]."', 
																	'".$emp_record[124]."',
																	'".$emp_record[126]."',
																	'".$emp_record[128]."',
																	'".$emp_record[130]."',
																	'".$emp_record[132]."',
																	'".$emp_record[134]."',
																	'".$emp_record[136]."',
																	'".$emp_record[138]."',
																	'".$emp_record[140]."',
																	'".$emp_record[142]."',
																	'".$emp_record[144]."',
																	'".$emp_record[146]."')";
				mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));
			}
		}
		fclose($csv_file);
		$import_status = '?import_status=success';
} else {
$import_status = '?import_status=error';
}
} else {
$import_status = '?import_status=invalid_file';
}
}
header("Location: index.php".$import_status);
?>