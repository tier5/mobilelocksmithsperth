<?php
//DATABSE CONNECTION AND DATABASE SELECTION
/*$conn = mysql_connect("localhost","root","tier5"); //CODE FOR DATABASE CONNECTION
if(!$conn)
{
	die("Could not connect to database");
}
$db = mysql_select_db("lockrepair",$conn); //CODE FOR DATABASE SELECTION
if(!$db)
{
	die("Could not select any database");
}*/

$conn=mysqli_connect("localhost", "root" , "tier5" , "lockrepair");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_errno();
  } else {
  	return $conn;
  }


//PAGINATION RECORDS PER PAGE
$testimonial_records_per_page = 5;
?>