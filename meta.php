<?php
$sql_meta = "SELECT * FROM `ml_meta` WHERE `page_link` = '".$current_page."'";
$exe_meta = mysql_query($sql_meta) or die(mysql_error());
$num_meta = mysql_num_rows($exe_meta);
if($num_meta>0)
{
	$fetch_meta = mysql_fetch_array($exe_meta);
	
	if($fetch_meta['meta_title']!="")
	{
		$meta_title = stripslashes($fetch_meta['meta_title']);
	}
	else
	{
		$meta_title = 'Welcome to Mobile Locksmiths Perth'; //DEFAULT META TITLE
	}
	
	if($fetch_meta['meta_description']!="")
	{
		$meta_description = stripslashes($fetch_meta['meta_description']);
	}
	else
	{
		$meta_description = 'Welcome to Mobile Locksmiths Perth'; //DEFAULT META DESCRIPTION
	}
	
	
	if($fetch_meta['meta_keywords']!="")
	{
		$meta_keywords = stripslashes($fetch_meta['meta_keywords']); 
	}
	else
	{
		$meta_keywords = 'Welcome to Mobile Locksmiths Perth'; //DEFAULT META KEYWORDS
	}
}
?>