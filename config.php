<?php
//DATABSE CONNECTION AND DATABASE SELECTION
$conn = mysql_connect("localhost","repair","9_p1iQ0h"); //CODE FOR DATABASE CONNECTION
if(!$conn)
{
	die("Could not connect to database");
}
$db = mysql_select_db("lockrepair",$conn); //CODE FOR DATABASE SELECTION
if(!$db)
{
	die("Could not select any database");
}

//DEFINE SITE URL
define('SITE_URL','http://www.lockrepairsperth.com.au/');

//PAGINATION RECORDS PER PAGE
$testimonial_records_per_page = 5;
?>