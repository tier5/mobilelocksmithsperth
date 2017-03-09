<?php 
require_once("header.php");
require_once("session_check.php");

//CODE FOR CHANGE STATUS TO INACTIVE
if(isset($_GET['action']) && $_GET['action'] == "inactive")
{
	$sql_update = "UPDATE `ml_partners` SET `partner_status` = 'Inactive' WHERE `partner_id` = '".$_GET['partner_id']."'";
	$exe_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
	
	$_SESSION['change_succ_msg'] = 'Partner de-activated successfully.';
	header("location: partner_list.php");
	exit;
}

//CODE FOR CHANGE STATUS TO ACTIVE
if(isset($_GET['action']) && $_GET['action'] == "active")
{
	$sql_update = "UPDATE `ml_partners` SET `partner_status` = 'Active' WHERE `partner_id` = '".$_GET['partner_id']."'";
	$exe_update = mysqli_query($sql_update) or die(mysqli_error());
	
	$_SESSION['change_succ_msg'] = 'Partner activated successfully.';
	header("location: partner_list.php");
	exit;
}

//CODE FOR DELETE PHOTO
if(isset($_GET['action']) && $_GET['action'] == "delete")
{
	$sql_partner_image = "SELECT * FROM `ml_partners` WHERE `partner_id` = '".$_GET['partner_id']."'";
	$exe_partner_image = mysqli_query($conn, $sql_partner_image) or die(mysqli_error());
	while($arr_partner_image = mysqli_fetch_array($exe_partner_image))
	{
		if($arr_partner_image['partner_image']!="")
		{
			unlink("../uploads/partner/".$arr_partner_image['partner_image']);
		}
	}
	mysqli_query($conn, "DELETE FROM `ml_partners` WHERE `partner_id` = '".$_GET['partner_id']."'") or die(mysqli_error());
	
	$_SESSION['del_succ_msg'] = 'Partner deleted successfully.';
	header("location: partner_list.php");
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
                        <h1>Partners List</h1>                               
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable">
                            <thead>
                                <tr>
                                    <th width="10%">Serial No.</th>
                                    <th width="30%">Photo</th>
                                    <th width="40%">Link</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$partner_counter = 1;
							$sql_record = "SELECT * FROM `ml_partners` ORDER BY `partner_id` DESC";
                            $exe_record = mysqli_query($conn, $sql_record) or die();
                            $num_record = mysqli_num_rows($exe_record);
                            if($num_record>0)
                            {
                                while($fetch_record = mysqli_fetch_array($exe_record))
                                {
									$partner_image = stripslashes($fetch_record['partner_image']);
									$partner_link = stripslashes($fetch_record['partner_link']);
									$partner_status = $fetch_record['partner_status'];
                                ?>
                                <tr>
                                    <td><?php echo $partner_counter;?></td>
                                    <td><img src="../uploads/partner/<?php echo $partner_image;?>" border="0" alt="" /></td>
                                    <td><?php echo $partner_link;?></td>
                                    <td><?php if($partner_status == 'Active') { ?><a href="partner_list.php?partner_id=<?php echo $fetch_record['partner_id']?>&action=inactive" title="Click to inactive" onclick="return confirm('Are you sure you want to inactive this partner?');"><ul class="the-icons clearfix"><li><i class="isb-unlock"></i></li></ul></a><?php } else { ?><a href="partner_list.php?partner_id=<?php echo $fetch_record['partner_id']?>&action=active" title="Click to active" onclick="return confirm('Are you sure you want to active this partner?');"><ul class="the-icons clearfix"><li><i class="isb-lock"></i></li></ul></a><?php } ?></td>
                                    <td><a href="add_edit_partner.php?partner_id=<?php echo $fetch_record['partner_id']?>&action=edit" title="Edit" style="float:left; display:block; margin:0 5px 0 0;"><ul class="the-icons clearfix"><i class="isb-edit"></i></ul></a><a href="partner_list.php?partner_id=<?php echo $fetch_record['partner_id']?>&action=delete" title="Delete" onclick="return confirm('Are you sure you want to delete this partner?');" style="float:left; display:block; margin:0 5px 0 0;"><ul class="the-icons clearfix"><i class="isb-delete"></i></ul></a></td>
                                </tr>
								<?php
								$partner_counter++;
                                }
                            }
                            else
                            {
                            ?>
                            <tr><td colspan="5" align="center"><font color="#FF0000">No partner found</font></td></tr>
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