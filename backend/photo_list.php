<?php 
require_once("header.php");
require_once("session_check.php");

//CODE FOR CHANGE STATUS TO INACTIVE
if(isset($_GET['action']) && $_GET['action'] == "inactive")
{
	$sql_update = "UPDATE `ml_gallery` SET `gallery_status` = 'Inactive' WHERE `gallery_id` = '".$_GET['gallery_id']."'";
	$exe_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
	
	$_SESSION['change_succ_msg'] = 'Photo de-activated successfully.';
	header("location: photo_list.php");
	exit;
}

//CODE FOR CHANGE STATUS TO ACTIVE
if(isset($_GET['action']) && $_GET['action'] == "active")
{
	$sql_update = "UPDATE `ml_gallery` SET `gallery_status` = 'Active' WHERE `gallery_id` = '".$_GET['gallery_id']."'";
	$exe_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
	
	$_SESSION['change_succ_msg'] = 'Photo activated successfully.';
	header("location: photo_list.php");
	exit;
}

//CODE FOR DELETE PHOTO
if(isset($_GET['action']) && $_GET['action'] == "delete")
{
	$sql_gallery_image = "SELECT * FROM `ml_gallery` WHERE `gallery_id` = '".$_GET['gallery_id']."'";
	$exe_gallery_image = mysqli_query($conn, $sql_gallery_image) or die(mysqli_error());
	while($arr_gallery_image = mysqli_fetch_array($exe_gallery_image))
	{
		if($arr_gallery_image['gallery_image']!="")
		{
			unlink("../uploads/gallery/thumb/".$arr_gallery_image['gallery_image']);
			unlink("../uploads/gallery/".$arr_gallery_image['gallery_image']);
			unlink("../uploads/gallery/pdf/".$arr_gallery_image['gallery_pdf']);
		}
	}
	mysqli_query($conn,"DELETE FROM `ml_gallery` WHERE `gallery_id` = '".$_GET['gallery_id']."'") or die(mysqli_error());
	
	$_SESSION['del_succ_msg'] = 'Photo deleted successfully.';
	header("location: photo_list.php");
	exit;
}
?>

<?php require_once("left_panel.php");?>
<div class="content">
        <div class="workplace">
        	<?php if(isset($_SESSION['add_succ_msg'])) { ?>
                <div class="alert alert-success">                
                <b><?php echo $_SESSION['add_succ_msg'];?></b>
                </div> 
            <?php
            unset($_SESSION['add_succ_msg']);
            }
            ?>
            
            <?php if(isset($_SESSION['edit_succ_msg'])) { ?>
                <div class="alert alert-success">                
                <b><?php echo $_SESSION['edit_succ_msg'];?></b>
                </div> 
            <?php
            unset($_SESSION['edit_succ_msg']);
            }
            ?>
            
            <?php if(isset($_SESSION['del_succ_msg'])) { ?>
                <div class="alert alert-success">                
                <b><?php echo $_SESSION['del_succ_msg'];?></b>
                </div> 
            <?php
            unset($_SESSION['del_succ_msg']);
            }
            ?>
            
            <?php if(isset($_SESSION['change_succ_msg'])) { ?>
                <div class="alert alert-success">                
                <b><?php echo $_SESSION['change_succ_msg'];?></b>
                </div> 
            <?php
            unset($_SESSION['change_succ_msg']);
            }
            ?>
			<div class="row-fluid">
                <div class="span12">                    
                    <div class="head clearfix">
                        <div class="isw-picture"></div>
                        <h1>Photos List</h1>                               
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable">
                            <thead>
                                <tr>
                                    <th width="10%">Serial No.</th>
                                    <th width="20%">Title</th>
                                    <th width="40%">Photo</th>                                    
                                    <th width="15%">Status</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$photo_counter = 1;
							$sql_record = "SELECT * FROM `ml_gallery` ORDER BY `gallery_id` DESC";
                            $exe_record = mysqli_query($conn, $sql_record) or die();
                            $num_record = mysqli_num_rows($exe_record);
                            if($num_record>0)
                            {
                                while($fetch_record = mysqli_fetch_array($exe_record))
                                {
									$gallery_name = stripslashes($fetch_record['gallery_name']);
									$gallery_image = stripslashes($fetch_record['gallery_image']);
									$gallery_status = $fetch_record['gallery_status'];
                                ?>
                                <tr>
                                    <td><?php echo $photo_counter;?></td>
                                    <td><?php echo $gallery_name;?></td>
                                    <td><a href="../uploads/gallery/<?php echo $gallery_image;?>" rel="group" class="fancybox" style="margin: 26px;"><img src="../uploads/gallery/thumb/<?php echo $gallery_image;?>" width="200" height="150" border="0" alt="" /></a></td>
                                    <td><?php if($gallery_status == 'Active') { ?><a href="photo_list.php?gallery_id=<?php echo $fetch_record['gallery_id']?>&action=inactive" title="Click to inactive" onclick="return confirm('Are you sure you want to inactive this photo?');"><ul class="the-icons clearfix"><li><i class="isb-unlock"></i></li></ul></a><?php } else { ?><a href="photo_list.php?gallery_id=<?php echo $fetch_record['gallery_id']?>&action=active" title="Click to active" onclick="return confirm('Are you sure you want to active this photo?');"><ul class="the-icons clearfix"><li><i class="isb-lock"></i></li></ul></a><?php } ?></td>
                                    <td><a href="add_edit_photo.php?gallery_id=<?php echo $fetch_record['gallery_id']?>&action=edit" title="Edit" style="float:left; display:block; margin:0 5px 0 0;"><ul class="the-icons clearfix"><i class="isb-edit"></i></ul></a><a href="photo_list.php?gallery_id=<?php echo $fetch_record['gallery_id']?>&action=delete" title="Delete" onclick="return confirm('Are you sure you want to delete this portfolio?');" style="float:left; display:block; margin:0 5px 0 0;"><ul class="the-icons clearfix"><i class="isb-delete"></i></ul></a></td>
                                </tr>
								<?php
								$photo_counter++;
                                }
                            }
                            else
                            {
                            ?>
                            <tr><td colspan="5" align="center"><font color="#FF0000">No photo found</font></td></tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>                                
            </div>
         </div>
</div>

<?php require_once("footer.php"); ?>