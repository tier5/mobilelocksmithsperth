<?php 
require_once("header.php");
require_once("session_check.php");

//CODE FOR CHANGE STATUS TO INACTIVE
if(isset($_GET['action']) && $_GET['action'] == "No")
{
	$sql_update = "UPDATE `ml_services` SET `homepage_display` = 'No' WHERE `service_id` = '".$_GET['service_id']."'";
	$exe_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
	
	$_SESSION['change_succ_msg'] = 'Service status changed successfully.';
	header("location: service_list.php");
	exit;
}

//CODE FOR CHANGE STATUS TO ACTIVE
if(isset($_GET['action']) && $_GET['action'] == "Yes")
{
	$sql_update = "UPDATE `ml_services` SET `homepage_display` = 'Yes' WHERE `service_id` = '".$_GET['service_id']."'";
	$exe_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
	
	$_SESSION['change_succ_msg'] = 'Service status changed successfully.';
	header("location: service_list.php");
	exit;
}

//CODE FOR DELETE SERVICE
if(isset($_GET['action']) && $_GET['action'] == "delete")
{
	$sql_service_image = "SELECT * FROM `ml_services` WHERE `service_id` = '".$_GET['service_id']."'";
	$exe_service_image = mysqli_query($conn, $sql_service_image) or die(mysqli_error());
	while($arr_service_image = mysql_fetch_array($exe_service_image))
	{
		if($arr_service_image['service_image']!="")
		{
			unlink("../uploads/service/thumb/".$arr_service_image['service_image']);
			unlink("../uploads/service/icon/".$arr_service_image['service_icon']);
			unlink("../uploads/service/".$arr_service_image['service_image']);
		}
	}
	mysqli_query($conn, "DELETE FROM `ml_services` WHERE `service_id` = '".$_GET['service_id']."'") or die(mysqli_error());
	
	$_SESSION['del_succ_msg'] = 'Service deleted successfully.';
	header("location: service_list.php");
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
                        <div class="isw-grid"></div>
                        <h1>Services List</h1>                               
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable">
                            <thead>
                                <tr>
                                    <th width="10%">Serial No.</th>
                                    <th width="20%">Title</th>
                                    <th width="45%">Content</th>                                    
                                    <th width="15%">Display on Home Page</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$service_counter = 1;
							$sql_record = "SELECT * FROM `ml_services` ORDER BY `service_id` DESC";
                            $exe_record = mysqli_query($conn, $sql_record) or die();
                            $num_record = mysqli_num_rows($conn, $exe_record);
                            if($num_record>0)
                            {
                                while($fetch_record = mysqli_fetch_array($exe_record))
                                {
									$service_title = stripslashes($fetch_record['service_title']);
									$service_content = substr(stripslashes($fetch_record['service_content']),0,350)."...";
									$homepage_display = stripslashes($fetch_record['homepage_display']);
                                ?>
                                <tr>
                                    <td><?php echo $service_counter;?></td>
                                    <td><?php echo $service_title;?></td>
                                    <td><?php echo $service_content;?></td>
                                    <td><?php if($homepage_display == 'Yes') { ?><a href="service_list.php?service_id=<?php echo $fetch_record['service_id']?>&action=No" title="Click to change status" onclick="return confirm('Are you sure you want to change status?');">Yes</a><?php } else { ?><a href="service_list.php?service_id=<?php echo $fetch_record['service_id']?>&action=Yes" title="Click to change status" onclick="return confirm('Are you sure you want to change status?');">No</a><?php } ?></td>
                                    <td><a href="add_edit_service.php?service_id=<?php echo $fetch_record['service_id']?>&action=edit" title="Edit" style="float:left; display:block; margin:0 5px 0 0;"><ul class="the-icons clearfix"><i class="isb-edit"></i></ul></a><a href="service_list.php?service_id=<?php echo $fetch_record['service_id']?>&action=delete" title="Delete" onclick="return confirm('Are you sure you want to delete this service?');" style="float:left; display:block; margin:0 5px 0 0;"><ul class="the-icons clearfix"><i class="isb-delete"></i></ul></a></td>
                                </tr>
								<?php
								$service_counter++;
                                }
                            }
                            else
                            {
                            ?>
                            <tr><td colspan="5" align="center"><font color="#FF0000">No service found</font></td></tr>
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