<?php 
require_once("header.php");
require_once("session_check.php");
require_once('class.upload.php');
global $conn;
//CODE FOR ADD BANNER
if(isset($_POST['add']))
{
	//UPLOAD IMAGE
	if($_FILES['banner_image']['name']!="")
	{	
		$photopath = pathinfo($_FILES['banner_image']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['banner_image']['tmp_name'];
		$banner_image = time().".".$extension;
		$destination = "../uploads/banner/".$banner_image;
		move_uploaded_file($source,$destination);
	}
	
	$sql_insert = "INSERT INTO `ml_banners` SET `banner_image` = '".$banner_image."',`banner_status` = 'Active'";
	$exe_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
	
	$_SESSION['add_succ_msg'] = 'Banner addded successfully.';
	header("location: banner_list.php");
	exit;
}

//CODE FOR UPDATE BANNER
if(isset($_POST['edit']))
{
	//UPLOAD IMAGE
	if($_FILES['banner_image']['name']!="")
	{	
		unlink("../uploads/banner/".$_POST['hid_banner_image']);
		
		$photopath = pathinfo($_FILES['banner_image']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['banner_image']['tmp_name'];
		$banner_image = time().".".$extension;
		$destination = "../uploads/banner/".$banner_image;
		move_uploaded_file($source,$destination);
	}
	else
	{
		$banner_image = $_POST['hid_banner_image'];
	}
	
	$sql_update = "UPDATE `ml_banners` SET `banner_image` = '".$banner_image."' WHERE `banner_id` = '".$_REQUEST['banner_id']."'";
	$exe_update = mysqli_query($conn,$sql_update) or die(mysqli_error());
	
	$_SESSION['edit_succ_msg'] = 'Banner updated successfully.';
	header("location: banner_list.php");
	exit;
}

//FETCH DATA FROM DATABASE
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") 
{
	$fetch_record = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `ml_banners` WHERE `banner_id` = '".$_REQUEST['banner_id']."'"));
	$banner_image = stripslashes($fetch_record['banner_image']);
}
?>

<script language="javascript" type="text/javascript">
function frm_validation()
{
	if(document.getElementById('banner_image').value == '' && document.getElementById('hid_banner_image').value == '')
	{
		alert("Please upload banner image");
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
                        <h1>Update Banner</h1>
                        <?php } else { ?>
                        <h1>Add Banner</h1>
                        <?php } ?>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return frm_validation();">
                    <input type="hidden" name="banner_id" id="banner_id" value="<?php echo $fetch_record['banner_id'];?>" />
					<input type="hidden" name="hid_banner_image" id="hid_banner_image" value="<?php echo $banner_image;?>" />
                    <div class="block-fluid">
                        <div class="row-form clearfix">
                            <div class="span3">Banner Image <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="file" name="banner_image" id="banner_image" /><br /><font color="#FF0000">[Image size should be 1400x494]</font>
                            <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") { ?>
                            <br /><a class="fancybox" rel="group" href="../uploads/banner/<?php echo $banner_image;?>"><img src="../uploads/banner/<?php echo $banner_image;?>" width="300" height="100" border="0" alt="" /></a>
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
                            <button class="btn" type="button" name="back" onclick="window.location.href='banner_list.php'">Back To Banners List</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div> 

<?php require_once("footer.php"); ?>