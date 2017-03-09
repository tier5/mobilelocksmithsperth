<?php 
require_once("header.php");
require_once("session_check.php");
?>

<?php require_once("left_panel.php");?>
<div class="content">
        <div class="workplace">
            <?php if(isset($_SESSION['edit_succ_msg'])) { ?>
                <div class="alert alert-success">                
                <b><?php echo $_SESSION['edit_succ_msg'];?></b>
                </div> 
            <?php
            unset($_SESSION['edit_succ_msg']);
            }
            ?>
			<div class="row-fluid">
                <div class="span12">                    
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Pages List</h1>                               
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable">
                            <thead>
                                <tr>
                                    <th width="10%">Serial No.</th>
                                    <th width="20%">Page Name</th>
                                    <th width="25%">Meta Title</th>
                                    <th width="35%">Meta Keywords</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$seo_counter = 1;
							$sql_record = "SELECT * FROM `ml_meta` ORDER BY `meta_id` DESC";
                            $exe_record = mysqli_query($conn, $sql_record) or die();
                            $num_record = mysqli_num_rows($exe_record);
                            if($num_record>0)
                            {
                                while($fetch_record = mysqli_fetch_array($exe_record))
                                {
									$page_name = $fetch_record['page_name'];
									$meta_title = stripslashes($fetch_record['meta_title']);
									$meta_keywords = nl2br(stripslashes($fetch_record['meta_keywords']));
                                ?>
                                <tr>
                                    <td><?php echo $seo_counter;?></td>
                                    <td><?php echo $page_name;?></td>
                                    <td><?php echo $meta_title;?></td>
                                    <td><?php echo $meta_keywords;?></td>
                                    <td><a href="edit_seo_settings.php?meta_id=<?php echo $fetch_record['meta_id']?>" title="Edit"><ul class="the-icons clearfix"><i class="isb-edit"></i></ul></a></td>
                                </tr>
								<?php
								$seo_counter++;
                                }
                            }
                            else
                            {
                            ?>
                            <tr><td colspan="5" align="center"><font color="#FF0000">No page found</font></td></tr>
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