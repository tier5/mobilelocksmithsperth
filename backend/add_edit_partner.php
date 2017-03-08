<?php 
require_once("header.php");
require_once("session_check.php");
require_once('class.upload.php');

//CODE FOR ADD PHOTO
if(isset($_POST['add']))
{
	//UPLOAD IMAGE
	if($_FILES['partner_image']['name']!="")
	{	
		$photopath = pathinfo($_FILES['partner_image']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['partner_image']['tmp_name'];
		$partner_image = time().".".$extension;
		$destination = "../uploads/partner/".$partner_image;
		
		move_uploaded_file($source,$destination);
	}
	
	$sql_insert = "INSERT INTO `ml_partners` SET `partner_image` = '".$partner_image."',`partner_link` = '".addslashes($_POST['partner_link'])."',`partner_status` = 'Active'";
	$exe_insert = mysql_query($sql_insert) or die(mysql_error());
	
	$_SESSION['add_succ_msg'] = 'Partner addded successfully.';
	header("location: partner_list.php");
	exit;
}

//CODE FOR UPDATE PHOTO
if(isset($_POST['edit']))
{
	//UPLOAD IMAGE
	if($_FILES['partner_image']['name']!="")
	{	
		unlink("../uploads/partner/".$_POST['hid_partner_image']);
		
		$photopath = pathinfo($_FILES['partner_image']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['partner_image']['tmp_name'];
		$partner_image = time().".".$extension;
		$destination = "../uploads/partner/".$partner_image;
		
		move_uploaded_file($source,$destination);
	}
	else
	{
		$partner_image_insert = $_POST['hid_partner_image'];
	}
	
	$sql_update = "UPDATE `ml_partners` SET `partner_image` = '".$partner_image."',`partner_link` = '".addslashes($_POST['partner_link'])."' WHERE `partner_id` = '".$_REQUEST['partner_id']."'";
	$exe_update = mysql_query($sql_update) or die(mysql_error());
	
	$_SESSION['edit_succ_msg'] = 'Partner updated successfully.';
	header("location: partner_list.php");
	exit;
}

//FETCH DATA FROM DATABASE
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") 
{
	$fetch_record = mysql_fetch_array(mysql_query("SELECT * FROM `ml_partners` WHERE `partner_id` = '".$_REQUEST['partner_id']."'"));
	$partner_image = stripslashes($fetch_record['partner_image']);
	$partner_link = stripslashes($fetch_record['partner_link']);
}
?>

<script language="javascript" type="text/javascript">
function frm_validation()
{
	if(document.getElementById('partner_image').value == '' && document.getElementById('hid_partner_image').value == '')
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
                        <div class="isw-picture"></div>
                        <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") { ?>
                        <h1>Update Partner</h1>
                        <?php } else { ?>
                        <h1>Add Partner</h1>
                        <?php } ?>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return frm_validation();">
                    <input type="hidden" name="photo_id" id="photo_id" value="<?php echo $fetch_record['partner_id'];?>" />
					<input type="hidden" name="hid_partner_image" id="hid_partner_image" value="<?php echo $fetch_record['partner_image'];?>" />
                    <div class="block-fluid">
                        <div class="row-form clearfix">
                            <div class="span3">Photo <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="file" name="partner_image" id="partner_image" />
                            <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") { ?>
                            <br /><img src="../uploads/partner/<?php echo $partner_image;?>" border="0" alt="" />
                            <?php } ?>
                            </div>                            
                         </div>
                        <div class="row-form clearfix">
                            <div class="span3">Photo Link</div>
                            <div class="span9"><input type="text" name="partner_link" id="partner_link" value="<?php echo $partner_link;?>" />
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
                            <button class="btn" type="button" name="back" onclick="window.location.href='partner_list.php'">Back To Partners List</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div> 

<?php require_once("footer.php"); ?>