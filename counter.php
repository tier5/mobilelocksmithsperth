<?php
$my_ip = $_SERVER['REMOTE_ADDR'];
$today = date('Y-m-d');

//CHECK ALREADY VISIT OR NOT IN A PARTICULAR DATE IN SAME IP ADDRESS
$sql_already_visit = "SELECT * FROM `ml_statistics` WHERE `visitor_ip` = '".$my_ip."' AND `visit_date` = '".$today."'";
$exe_already_visit = mysql_query($sql_already_visit) or die(mysql_error());
$num_already_visit = mysql_num_rows($exe_already_visit);
if($num_already_visit == 0) //FIRST TIME VISIT IN A PARTICULAR DATE
{
	$visit_month = date('F');
	$visit_year = date('Y');
	$sql_insert_visit = "INSERT INTO `ml_statistics` SET `visitor_ip` = '".$my_ip."',`visit_date` = '".$today."',`visit_month` = '".$visit_month."',`visit_year` = '".$visit_year."'";
	$exe_insert_visit = mysql_query($sql_insert_visit) or die(mysql_error());
}
?>