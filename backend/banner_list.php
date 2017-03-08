<?php 
require_once("header.php");
require_once("session_check.php");

//CODE FOR CHANGE STATUS TO INACTIVE
if(isset($_GET['action']) && $_GET['action'] == "inactive")
{
	$sql_update = "UPDATE `ml_banners` SET `banner_status` = 'Inactive' WHERE `banner_id` = '".$_GET['banner_id']."'";
	$exe_update = mysql_query($sql_update) or die(mysql_error());
	
	$_SESSION['change_succ_msg'] = 'Banner de-activated successfully.';
	header("location: banner_list.php");
	exit;
}

//CODE FOR CHANGE STATUS TO ACTIVE
if(isset($_GET['action']) && $_GET['action'] == "active")
{
	$sql_update = "UPDATE `ml_banners` SET `banner_status` = 'Active' WHERE `banner_id` = '".$_GET['banner_id']."'";
	$exe_update = mysql_query($sql_update) or die(mysql_error());
	
	$_SESSION['change_succ_msg'] = 'Banner activated successfully.';
	header("location: banner_list.php");
	exit;
}

//CODE FOR DELETE BANNER
if(isset($_GET['action']) && $_GET['action'] == "delete")
{
	$sql_banner_image = "SELECT * FROM `ml_banners` WHERE `banner_id` = '".$_GET['banner_id']."'";
	$exe_banner_image = mysql_query($sql_banner_image) or die(mysql_error());
	while($arr_banner_image = mysql_fetch_array($exe_banner_image))
	{
		if($arr_banner_image['banner_image']!="")
		{
			unlink("../uploads/banner/".$arr_banner_image['banner_image']);
		}
	}
	mysql_query("DELETE FROM `ml_banners` WHERE `banner_id` = '".$_GET['banner_id']."'") or die(mysql_error());
	
	$_SESSION['del_succ_msg'] = 'Banner deleted successfully.';
	header("location: banner_list.php");
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
                        <h1>Banners List</h1>                               
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable">
                            <thead>
                                <tr>
                                    <th width="10%">Serial No.</th>
                                    <th width="45%">Banner Image</th> 
                                    <th width="20%">Status</th>
                                    <th width="20%">Action</th>
                                    <th width="5%">&nbsp;</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$banner_counter = 1;
							$sql_record = "SELECT * FROM `ml_banners` ORDER BY `banner_id` DESC";
                            $exe_record = mysql_query($sql_record) or die();
                            $num_record = mysql_num_rows($exe_record);
                            if($num_record>0)
                            {
                                while($fetch_record = mysql_fetch_array($exe_record))
                                {
									$banner_image = $fetch_record['banner_image'];
									$banner_status = $fetch_record['banner_status'];
                                	?>
                                    <tr>
                                        <td><?php echo $banner_counter;?></td>
                                        <td><a href="../uploads/banner/<?php echo $banner_image;?>" rel="group" class="fancybox" style="margin: 26px;"><img src="../uploads/banner/<?php echo $banner_image;?>" width="300" height="100" border="0" alt="" /></a></td>
                                        <td><?php if($banner_status == 'Active') { ?><a href="banner_list.php?banner_id=<?php echo $fetch_record['banner_id']?>&set_id=<?php echo $_REQUEST['set_id'];?>&action=inactive" title="Click to inactive" onclick="return confirm('Are you sure you want to inactive this banner?');"><ul class="the-icons clearfix"><li><i class="isb-unlock"></i></li></ul></a><?php } else { ?><a href="banner_list.php?banner_id=<?php echo $fetch_record['banner_id']?>&set_id=<?php echo $_REQUEST['set_id'];?>&action=active" title="Click to active" onclick="return confirm('Are you sure you want to active this banner?');"><ul class="the-icons clearfix"><li><i class="isb-lock"></i></li></ul></a><?php } ?></td>
                                        <td><a href="add_edit_banner.php?banner_id=<?php echo $fetch_record['banner_id']?>&action=edit" title="Edit" style="float:left; display:block; margin:0 5px 0 0;"><ul class="the-icons clearfix"><i class="isb-edit"></i></ul></a><a href="banner_list.php?banner_id=<?php echo $fetch_record['banner_id']?>&action=delete" title="Delete" onclick="return confirm('Are you sure you want to delete this banner?');" style="float:left; display:block; margin:0 5px 0 0;"><ul class="the-icons clearfix"><i class="isb-delete"></i></ul></a></td>
                                        <td>&nbsp;</td>
                                    </tr>
								<?php
								$banner_counter++;
                                }
                            }
                            else
                            {
                            ?>
                            <tr><td colspan="5" align="center"><font color="#FF0000">No banner found</font></td></tr>
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