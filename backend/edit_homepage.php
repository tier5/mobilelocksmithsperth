<?php 
require_once("header.php");
require_once("session_check.php");
require_once("../FCKeditor/fckeditor.php");

//CODE FOR UPDATE CONTENT
if(isset($_POST['edit']))
{
	//UPLOAD IMAGE
	if($_FILES['content_image']['name']!="")
	{	
		unlink("../uploads/content/".$_POST['hid_content_image']);
		
		$photopath = pathinfo($_FILES['content_image']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['content_image']['tmp_name'];
		$content_image = time().".".$extension;
		$destination = "../uploads/content/".$content_image;
		move_uploaded_file($source,$destination);
	}
	else
	{
		$content_image = $_POST['hid_content_image'];
	}
	
	$sql_update = "UPDATE `ml_contents` SET `content` = '".addslashes($_POST['page_content'])."',`content_image` = '".$content_image."'  WHERE `content_id` = '1'";
	$exe_update = mysql_query($sql_update) or die(mysql_error());
	
	$_SESSION['save_succ_msg'] = 'Content updated successfully.';
	header("location: edit_homepage.php");
	exit;
}

//FETCH DATA FROM DATABASE
$fetch_record = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `ml_contents` WHERE `content_id` = '1'"));
$page_content = stripslashes($fetch_record['content']);
$content_image = stripslashes($fetch_record['content_image']);
?>

<script language="javascript" type="text/javascript">
function frm_validation()
{
	var EditorInstance = FCKeditorAPI.GetInstance('page_content'); 
	if(EditorInstance.EditorDocument.body.innerText.length<=0)
	{
		alert("Please enter content");
		EditorInstance.EditorDocument.body.focus();
		return false;
	}
}
</script>

<?php require_once("left_panel.php");?>
<div class="content">
        <div class="workplace">
        	<?php if(isset($_SESSION['save_succ_msg'])) { ?>
            <div class="alert alert-success">                
            <b><?php echo $_SESSION['save_succ_msg'];?></b>
            </div> 
			<?php
            unset($_SESSION['save_succ_msg']);
            }
            ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <h1>Homepage Content</h1>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return frm_validation();">
					<input type="hidden" name="hid_content_image" id="hid_content_image" value="<?php echo $content_image;?>" />
                    <div class="block-fluid">
                        <div class="row-form clearfix">
                            <div class="span3">Content <font color="#FF0000">*</font></div>
                            <div class="span9">
                            <?php 
							$oFCKeditor = new FCKeditor('page_content');
							$oFCKeditor->Height=400;
							$oFCKeditor->Width=700;
							$oFCKeditor->BasePath = '../FCKeditor/';
							$oFCKeditor->Value= $page_content;
							$oFCKeditor->Create(); 
						   ?>
                           </div>                            
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Photo <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="file" name="content_image" id="content_image" />
                            <br /><a href="../uploads/content/<?php echo $content_image;?>" rel="group" class="fancybox" style="margin: 26px;"><img src="../uploads/content/<?php echo $content_image;?>" width="150" height="150" border="0" alt="" /></a>
                            </div>                            
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">&nbsp;</div>
                            <div class="span9">
                            <button class="btn" type="submit" name="edit">Save</button>
                            </div>
                       </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div>   

<?php require_once("footer.php"); ?>