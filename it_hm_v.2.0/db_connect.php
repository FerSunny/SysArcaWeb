<?php
/* Database connection start */
$servername = "localhost";
$username = "labora41_root";
$password = "ArcaRoot_2017";
$dbname = "labora41_bd_arca";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
printf("Connect failed: %sn", mysqli_connect_error());
exit();
}
?>