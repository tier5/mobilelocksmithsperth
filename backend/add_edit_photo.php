<?php 
require_once("header.php");
require_once("session_check.php");
require_once('class.upload.php');

//CODE FOR ADD PHOTO
if(isset($_POST['add']))
{
	//UPLOAD IMAGE
	if($_FILES['gallery_image']['name']!="")
	{	
		$photopath = pathinfo($_FILES['gallery_image']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['gallery_image']['tmp_name'];
		$gallery_image = time().".".$extension;
		$gallery_image_insert = time().$extension.".".$extension;
		chmod("../uploads/gallery/",0777);
		
		$foo = new Upload($_FILES['gallery_image']);
		if ($foo->uploaded) 
		{
			 // save uploaded image with a new name
			  $foo->file_new_name_body = $gallery_image;
			  $foo->Process("../uploads/gallery/");
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
			 $foo->file_new_name_body			= $gallery_image;
			 $foo->image_resize			   	 	= true;
			 $foo->image_ratio_fill		    	= false;
			 $foo->image_ratio_crop  	    	= false;
			 $foo->image_y						= "229";
			 $foo->image_x						= "281";
			 $foo->image_background_color 		= '#FFFFFF';
			 $foo->Process("../uploads/gallery/thumb/");
			 $foo->processed;
		}
	}
	
	//UPLOAD PDF
	if($_FILES['gallery_pdf']['name']!="")
	{	
		$photopath2 = pathinfo($_FILES['gallery_pdf']['name']);
		$extension2 = $photopath2['extension'];
		$source2 = $_FILES['gallery_pdf']['tmp_name'];
		$gallery_pdf = md5(time()).".".$extension2;
		$destination2 = "../uploads/gallery/pdf/".$gallery_pdf;
		
		move_uploaded_file($source2,$destination2);
	}
	
	$sql_insert = "INSERT INTO `ml_gallery` SET `gallery_name` = '".addslashes($_POST['gallery_name'])."',`gallery_pdf` = '".$gallery_pdf."',`gallery_image` = '".$gallery_image_insert."',`gallery_status` = 'Active'";
	$exe_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
	
	$_SESSION['add_succ_msg'] = 'Photo addded successfully.';
	header("location: photo_list.php");
	exit;
}

//CODE FOR UPDATE PHOTO
if(isset($_POST['edit']))
{
	//UPLOAD IMAGE
	if($_FILES['gallery_image']['name']!="")
	{	
		unlink("../uploads/gallery/thumb/".$_POST['hid_gallery_image']);
		unlink("../uploads/gallery/".$_POST['hid_gallery_image']);
		
		$photopath = pathinfo($_FILES['gallery_image']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['gallery_image']['tmp_name'];
		$gallery_image = time().".".$extension;
		$gallery_image_insert = time().$extension.".".$extension;
		chmod("../uploads/gallery/",0777);
		
		$foo = new Upload($_FILES['gallery_image']);
		if ($foo->uploaded) 
		{
			 // save uploaded image with a new name
			  $foo->file_new_name_body = $gallery_image;
			  $foo->Process("../uploads/gallery/");
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
			 $foo->file_new_name_body			= $gallery_image;
			 $foo->image_resize			   	 	= true;
			 $foo->image_ratio_fill		    	= false;
			 $foo->image_ratio_crop  	    	= false;
			 $foo->image_y						= "229";
			 $foo->image_x						= "281";
			 $foo->image_background_color 		= '#FFFFFF';
			 $foo->Process("../uploads/gallery/thumb/");
			 $foo->processed;
		}
	}
	else
	{
		$gallery_image_insert = $_POST['hid_gallery_image'];
	}
	
	//UPLOAD PDF
	if($_FILES['gallery_pdf']['name']!="")
	{	
		unlink("../uploads/gallery/pdf/".$_POST['hid_gallery_pdf']);
		
		$photopath2 = pathinfo($_FILES['gallery_pdf']['name']);
		$extension2 = $photopath2['extension'];
		$source2 = $_FILES['gallery_pdf']['tmp_name'];
		$gallery_pdf = md5(time()).".".$extension2;
		$destination2 = "../uploads/gallery/pdf/".$gallery_pdf;
		
		move_uploaded_file($source2,$destination2);
	}
	else
	{
		$gallery_pdf = $_POST['hid_gallery_pdf'];
	}
	
	$sql_update = "UPDATE `ml_gallery` SET `gallery_name` = '".addslashes($_POST['gallery_name'])."',`gallery_pdf` = '".$gallery_pdf."',`gallery_image` = '".$gallery_image_insert."' WHERE `gallery_id` = '".$_REQUEST['gallery_id']."'";
	$exe_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
	
	$_SESSION['edit_succ_msg'] = 'Photo updated successfully.';
	header("location: photo_list.php");
	exit;
}

//FETCH DATA FROM DATABASE
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") 
{
	$fetch_record = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `ml_gallery` WHERE `gallery_id` = '".$_REQUEST['gallery_id']."'"));
	$gallery_name = stripslashes($fetch_record['gallery_name']);
	$gallery_pdf = stripslashes($fetch_record['gallery_pdf']);
	$gallery_image = stripslashes($fetch_record['gallery_image']);
}
?>

<script language="javascript" type="text/javascript">
function frm_validation()
{
	if(document.getElementById('gallery_name').value == '')
	{
		alert("Please enter title");
		document.getElementById('gallery_name').focus();
		return false;
	}
	
	if(document.getElementById('gallery_image').value == '' && document.getElementById('hid_gallery_image').value == '')
	{
		alert("Please upload photo");
		return false;
	}
	
	if(document.getElementById('gallery_pdf').value == '' && document.getElementById('hid_gallery_pdf').value == '')
	{
		alert("Please upload PDF");
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
                        <div class="isw-picture"></div>
                        <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") { ?>
                        <h1>Update Photo</h1>
                        <?php } else { ?>
                        <h1>Add Photo</h1>
                        <?php } ?>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return frm_validation();">
                    <input type="hidden" name="gallery_id" id="gallery_id" value="<?php echo $fetch_record['gallery_id'];?>" />
					<input type="hidden" name="hid_gallery_image" id="hid_gallery_image" value="<?php echo $fetch_record['gallery_image'];?>" />
                    <input type="hidden" name="hid_gallery_pdf" id="hid_gallery_pdf" value="<?php echo $fetch_record['gallery_pdf'];?>" />
                    <div class="block-fluid">
                        <div class="row-form clearfix">
                            <div class="span3">Title <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="gallery_name" id="gallery_name" value="<?php echo $gallery_name;?>" />
                            </div>                            
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Photo <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="file" name="gallery_image" id="gallery_image" />
                            <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") { ?>
                            <br /><a class="fancybox" rel="group" href="../uploads/gallery/<?php echo $gallery_image;?>"><img src="../uploads/gallery/thumb/<?php echo $gallery_image;?>" width="200" height="100" border="0" alt="" /></a>
                            <?php } ?>
                            </div>                            
                         </div>
                        <div class="row-form clearfix">
                            <div class="span3">PDF <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="file" name="gallery_pdf" id="gallery_pdf" />
                            <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") { ?>
                            <br /><a href="download.php?file=../uploads/gallery/pdf/<?php echo $gallery_pdf;?>">Click to download</a>
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
                            <button class="btn" type="button" name="back" onclick="window.location.href='photo_list.php'">Back To Photos List</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div> 

<?php require_once("footer.php"); ?>