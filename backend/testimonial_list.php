<?php 
require_once("header.php");
require_once("session_check.php");

//CODE FOR CHANGE STATUS TO INACTIVE
if(isset($_GET['action']) && $_GET['action'] == "inactive")
{
	$sql_update = "UPDATE `ml_testimonials` SET `testimonial_status` = 'Inactive' WHERE `testimonial_id` = '".$_GET['testimonial_id']."'";
	$exe_update = mysql_query($sql_update) or die(mysql_error());
	
	$_SESSION['change_succ_msg'] = 'Review de-activated successfully.';
	header("location: testimonial_list.php");
	exit;
}

//CODE FOR CHANGE STATUS TO ACTIVE
if(isset($_GET['action']) && $_GET['action'] == "active")
{
	$sql_update = "UPDATE `ml_testimonials` SET `testimonial_status` = 'Active' WHERE `testimonial_id` = '".$_GET['testimonial_id']."'";
	$exe_update = mysql_query($sql_update) or die(mysql_error());
	
	$_SESSION['change_succ_msg'] = 'Review activated successfully.';
	header("location: testimonial_list.php");
	exit;
}

//CODE FOR DELETE TESTIMONIAL
if(isset($_GET['action']) && $_GET['action'] == "delete")
{
	$sql_testimonial_image = "SELECT * FROM `ml_testimonials` WHERE `testimonial_id` = '".$_GET['testimonial_id']."'";
	$exe_testimonial_image = mysql_query($sql_testimonial_image) or die(mysql_error());
	while($arr_testimonial_image = mysql_fetch_array($exe_testimonial_image))
	{
		if($arr_testimonial_image['sender_type'] == "General")
		{
			if($arr_testimonial_image['sender_image']!="")
			{
				unlink("../uploads/testimonial/".$arr_testimonial_image['sender_image']);
				unlink("../uploads/testimonial/thumb/".$arr_testimonial_image['sender_image']);
			}
		}
	}
	mysql_query("DELETE FROM `ml_testimonials` WHERE `testimonial_id` = '".$_GET['testimonial_id']."'") or die(mysql_error());
	
	$_SESSION['del_succ_msg'] = 'Review deleted successfully.';
	header("location: testimonial_list.php");
	exit;
}
?>

<?php require_once("left_panel.php");?>
<div class="content">
        <div class="workplace">
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
                        <h1>Reviews List</h1>                               
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable">
                            <thead>
                                <tr>
                                    <th width="10%">Serial No.</th>
                                    <th width="45%">Review</th>
                                    <th width="20%">Posted By</th>                                    
                                    <th width="10%">Status</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$testimonial_counter = 1;
							$sql_record = "SELECT * FROM `ml_testimonials` ORDER BY `testimonial_id` DESC";
                            $exe_record = mysql_query($sql_record) or die();
                            $num_record = mysql_num_rows($exe_record);
                            if($num_record>0)
                            {
                                while($fetch_record = mysql_fetch_array($exe_record))
                                {
									$testimonial = stripslashes($fetch_record['sender_comments']);
									$posted_by = stripslashes($fetch_record['sender_name']);
									$photo = stripslashes($fetch_record['sender_image']);
									$testimonial_status = $fetch_record['testimonial_status'];
                                ?>
                                <tr>
                                    <td><?php echo $testimonial_counter;?></td>
                                    <td><?php echo $testimonial;?></td>
                                    <td><?php echo $posted_by;?><br />
                                    <?php if($fetch_record['sender_type'] == "General") { ?>
                                    <?php if($photo!="") { ?>
                                        <a href="../uploads/testimonial/<?php echo $photo;?>" rel="group" class="fancybox" style="margin: 26px;"><img src="../uploads/testimonial/thumb/<?php echo $photo;?>" width="100" height="100" border="0" alt="" /></a>
                                    <?php } else { ?>
                                        <img src="../img/no_image.png" border="0" alt="" width="100" height="100" />
                                    <?php } ?>
                                    <?php } else { ?>
                                    <img src="<?php echo $photo;?>" border="0" alt="" width="100" height="100" />
                                    <?php } ?>
                                    </td>
                                    <td><?php if($testimonial_status == 'Active') { ?><a href="testimonial_list.php?testimonial_id=<?php echo $fetch_record['testimonial_id']?>&action=inactive" title="Click to inactive" onclick="return confirm('Are you sure you want to inactive this review?');"><ul class="the-icons clearfix"><li><i class="isb-unlock"></i></li></ul></a><?php } else { ?><a href="testimonial_list.php?testimonial_id=<?php echo $fetch_record['testimonial_id']?>&action=active" title="Click to active" onclick="return confirm('Are you sure you want to active this review?');"><ul class="the-icons clearfix"><li><i class="isb-lock"></i></li></ul></a><?php } ?></td>
                                    <td><a href="testimonial_details.php?testimonial_id=<?php echo $fetch_record['testimonial_id']?>" title="Edit" style="float:left; display:block; margin:0 5px 0 0;">View Details</a><a href="testimonial_list.php?testimonial_id=<?php echo $fetch_record['testimonial_id']?>&action=delete" title="Delete" onclick="return confirm('Are you sure you want to delete this review?');" style="float:left; display:block; margin:0 5px 0 0;"><ul class="the-icons clearfix"><i class="isb-delete"></i></ul></a></td>
                                </tr>
								<?php
								$testimonial_counter++;
                                }
                            }
                            else
                            {
                            ?>
                            <tr><td colspan="5" align="center"><font color="#FF0000">No testimonial found</font></td></tr>
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