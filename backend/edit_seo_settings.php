<?php 
require_once("header.php");
require_once("session_check.php");

//CODE FOR UPDATE SETTINGS
if(isset($_POST['edit']))
{
	$sql_update = "UPDATE `ml_meta` SET `meta_title` = '".addslashes($_POST['meta_title'])."',`meta_keywords` = '".addslashes($_POST['meta_keywords'])."',`meta_description` = '".addslashes($_POST['meta_description'])."' WHERE `meta_id` = '".$_POST['meta_id']."'";
	$exe_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
	
	$_SESSION['edit_succ_msg'] = 'SEO settings updated successfully.';
	header("location: seo_settings.php");
	exit;
}

//FETCH DATA FROM DATABASE
$fetch_record = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `ml_meta` WHERE `meta_id` = '".$_REQUEST['meta_id']."'"));
$page_name = $fetch_record['page_name'];
$meta_title = stripslashes($fetch_record['meta_title']);
$meta_keywords = nl2br(stripslashes($fetch_record['meta_keywords']));
$meta_description = nl2br(stripslashes($fetch_record['meta_description']));
?>

<?php require_once("left_panel.php");?>
<div class="content">
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <h1>Update SEO Settings</h1>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return frm_validation();">
                    <input type="hidden" name="meta_id" id="meta_id" value="<?php echo $fetch_record['meta_id'];?>" />
                    <div class="block-fluid">
                    <div class="row-form clearfix">
                            <div class="span3">Page Name</div>
                            <div class="span9"><?php echo $page_name;?>
                            </div>                            
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Meta Title</div>
                            <div class="span9"><input type="text" name="meta_title" id="meta_title" value="<?php echo $meta_title;?>" />
                            </div>                            
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Meta Keywords</div>
                            <div class="span9"><textarea name="meta_keywords" id="meta_keywords"><?php echo $meta_keywords;?></textarea>
                            </div>                            
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Meta Description</div>
                            <div class="span9"><textarea name="meta_description" id="meta_description"><?php echo $meta_description;?></textarea>
                            </div>                            
                        </div>
                         <div class="row-form clearfix">
                            <div class="span3">&nbsp;</div>
                            <div class="span9">
                            <button class="btn" type="submit" name="edit">Save</button>
                            <button class="btn" type="button" name="back" onclick="window.location.href='seo_settings.php'">Back To Pages List</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div>   

<?php require_once("footer.php"); ?>