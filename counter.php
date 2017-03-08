<?php
require_once("config.php");
global $conn; 

$my_ip = $_SERVER['REMOTE_ADDR'];
$today = date('Y-m-d');

//CHECK ALREADY VISIT OR NOT IN A PARTICULAR DATE IN SAME IP ADDRESS
$sql_already_visit = "SELECT * FROM `ml_statistics` WHERE `visitor_ip` = '".$my_ip."' AND `visit_date` = '".$today."'";
$exe_already_visit = mysqli_query($conn, $sql_already_visit) or die(mysqli_error());
$num_already_visit = mysqli_num_rows($exe_already_visit);
if($num_already_visit == 0) //FIRST TIME VISIT IN A PARTICULAR DATE
{
	$visit_month = date('F');
	$visit_year = date('Y');
	$sql_insert_visit = "INSERT INTO `ml_statistics` SET `visitor_ip` = '".$my_ip."',`visit_date` = '".$today."',`visit_month` = '".$visit_month."',`visit_year` = '".$visit_year."'";
	$exe_insert_visit = mysqli_query($conn, $sql_insert_visit) or die(mysqli_error());
}
?>