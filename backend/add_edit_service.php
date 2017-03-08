<?php 
require_once("header.php");
require_once("session_check.php");
require_once('class.upload.php');

//CODE FOR ADD SERVICE
if(isset($_POST['add']))
{
	//UPLOAD SERVICE IMAGE
	if($_FILES['service_image']['name']!="")
	{	
		$photopath = pathinfo($_FILES['service_image']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['service_image']['tmp_name'];
		$service_image = time().".".$extension;
		$service_image_insert = time().$extension.".".$extension;
		chmod("../uploads/service/",0777);
		
		$foo = new Upload($_FILES['service_image']);
		if ($foo->uploaded) 
		{
			 // save uploaded image with a new name
			  $foo->file_new_name_body = $service_image;
			  $foo->Process("../uploads/service/");
			  if ($foo->processed) 
			  {
			  } 
			  else 
			  {
				$msg = $foo->error;
				$valid = 0;
			  }
	
			 // save uploaded image with a new name,
			 // resized to small //
			 $foo->file_new_name_body			= $service_image;
			 $foo->image_resize			   	 	= true;
			 $foo->image_ratio_fill		    	= false;
			 $foo->image_ratio_crop  	    	= false;
			 $foo->image_y						= "193";
			 $foo->image_x						= "396";
			 $foo->image_background_color 		= '#FFFFFF';
			 $foo->Process("../uploads/service/thumb/");
			 $foo->processed;
		}
	}
	else
	{
		$service_image_insert = '';
	}
	
	//UPLOAD SERVICE ICON
	if($_FILES['service_icon']['name']!="")
	{	
		$photopath = pathinfo($_FILES['service_icon']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['service_icon']['tmp_name'];
		$service_icon = time().".".$extension;
		$destination = "../uploads/service/icon/".$service_icon;
		move_uploaded_file($source,$destination);
	}
	else
	{
		$service_icon = '';
	}	
	
	$sql_update = "INSERT INTO `ml_services` SET `service_title` = '".addslashes($_POST['service_title'])."',`service_content` = '".addslashes($_POST['service_content'])."',`service_image` = '".$service_image_insert."',`service_icon` = '".$service_icon."',`service_status` = 'Active',`homepage_display` = 'No'";
	$exe_update = mysql_query($sql_update) or die(mysql_error());
	
	$_SESSION['add_succ_msg'] = 'Service added successfully.';
	header("location: service_list.php");
	exit;
}

//CODE FOR UPDATE SERVICE
if(isset($_POST['edit']))
{
	//UPLOAD SERVICE IMAGE
	if($_FILES['service_image']['name']!="")
	{	
		unlink("../uploads/service/thumb/".$_POST['hid_service_image']);
		unlink("../uploads/service/".$_POST['hid_service_image']);
		
		$photopath = pathinfo($_FILES['service_image']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['service_image']['tmp_name'];
		$service_image = time().".".$extension;
		$service_image_insert = time().$extension.".".$extension;
		chmod("../uploads/service/",0777);
		
		$foo = new Upload($_FILES['service_image']);
		if ($foo->uploaded) 
		{
			 // save uploaded image with a new name
			  $foo->file_new_name_body = $service_image;
			  $foo->Process("../uploads/service/");
			  if ($foo->processed) 
			  {
			  } 
			  else 
			  {
				$msg = $foo->error;
				$valid = 0;
			  }
	
			 // save uploaded image with a new name,
			 // resized to small //
			 $foo->file_new_name_body			= $service_image;
			 $foo->image_resize			   	 	= true;
			 $foo->image_ratio_fill		    	= false;
			 $foo->image_ratio_crop  	    	= false;
			 $foo->image_y						= "193";
			 $foo->image_x						= "396";
			 $foo->image_background_color 		= '#FFFFFF';
			 $foo->Process("../uploads/service/thumb/");
			 $foo->processed;
		}
	}
	else
	{
		$service_image_insert = $_POST['hid_service_image'];
	}
	
	//UPLOAD SERVICE ICON
	if($_FILES['service_icon']['name']!="")
	{	
		unlink("../uploads/service/icon/".$_POST['hid_service_icon']);
	
		$photopath = pathinfo($_FILES['service_icon']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['service_icon']['tmp_name'];
		$service_icon = time().".".$extension;
		$destination = "../uploads/service/icon/".$service_icon;
		move_uploaded_file($source,$destination);
	}
	else
	{
		$service_icon = $_POST['hid_service_icon'];
	}	
	
	$sql_update = "UPDATE `ml_services` SET `service_title` = '".addslashes($_POST['service_title'])."',`service_content` = '".addslashes($_POST['service_content'])."',`service_image` = '".$service_image_insert."',`service_icon` = '".$service_icon."' WHERE `service_id` = '".$_REQUEST['service_id']."'";
	$exe_update = mysql_query($sql_update) or die(mysql_error());
	
	$_SESSION['edit_succ_msg'] = 'Service updated successfully.';
	header("location: service_list.php");
	exit;
}

//FETCH DATA FROM DATABASE
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") 
{
	$fetch_record = mysql_fetch_array(mysql_query("SELECT * FROM `ml_services` WHERE `service_id` = '".$_REQUEST['service_id']."'"));
	$service_title = stripslashes($fetch_record['service_title']);
	$service_content = stripslashes($fetch_record['service_content']);
	$service_icon = stripslashes($fetch_record['service_icon']);
	$service_image = stripslashes($fetch_record['service_image']);
}
?>

<script language="javascript" type="text/javascript">
function frm_validation()
{
	if(document.getElementById('service_title').value == '')
	{
		alert("Please enter title");
		document.getElementById('service_title').focus();
		return false;
	}
	
	if(document.getElementById('service_content').value == '')
	{
		alert("Please enter content");
		document.getElementById('service_content').focus();
		return false;
	}
	
	if(document.getElementById('service_image').value == '' && document.getElementById('hid_service_image').value == '')
	{
		alert("Please upload photo");
		return false;
	}
}
</script>

<?php require_once("left_panel.php");?>
<div class="content">
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") { ?>
                        <h1>Update Service</h1>
                        <?php } else { ?>
                        <h1>Add Service</h1>
                        <?php } ?>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return frm_validation();">
                    <input type="hidden" name="service_id" id="service_id" value="<?php echo $fetch_record['service_id'];?>" />
                    <input type="hidden" name="hid_service_icon" id="hid_service_icon" value="<?php echo $service_icon;?>" />
                    <input type="hidden" name="hid_service_image" id="hid_service_image" value="<?php echo $service_image;?>" />
                    <div class="block-fluid">
                        <div class="row-form clearfix">
                            <div class="span3">Title <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="service_title" id="service_title" value="<?php echo $service_title;?>" />
                            </div>                            
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Content <font color="#FF0000">*</font></div>
                            <div class="span9"><textarea name="service_content" id="service_content" style="height:200px;"><?php echo $service_content;?></textarea>
                           </div>                            
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Photo <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="file" name="service_image" id="service_image" />
                            <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") { ?>
                            <br /><a href="../uploads/service/<?php echo $service_image;?>" rel="group" class="fancybox" style="margin: 26px;"><img src="../uploads/service/thumb/<?php echo $service_image;?>" width="200" height="70" border="0" alt="" /></a>
                            <?php } ?>
                            </div>                            
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Icon </div>
                            <div class="span9"><input type="file" name="service_icon" id="service_icon" />
                            <br /><font color="#FF0000">[Image size should be 34x34]</font>
                            <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") { ?>
                            <?php if($service_icon!="") { ?>
                            <br /><img src="../uploads/service/icon/<?php echo $service_icon;?>" border="0" alt="" />
                            <?php } ?>
                            <?php } ?>
                            </div>                            
                        </div>
                        <div class="row-form clearfix">
                                <div class="span3">&nbsp;</div>
                                <div class="span9">
                                <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") { ?>
                                <button class="btn" type="submit" name="edit">Save</button>
                                <?php } else { ?>
                                <button class="btn" type="submit" name="add">Save</button>
                                <?php } ?>
                                <button class="btn" type="button" name="back" onclick="window.location.href='service_list.php'">Back To Services List</button>
                                </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div> 

<?php require_once("footer.php"); ?>