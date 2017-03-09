<?php 
require_once("header.php");
require_once("session_check.php");

$total_visitors = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `ml_statistics`"));
?>

<?php require_once("left_panel.php");?>
<div class="content">
        <div class="workplace">
			<div class="row-fluid">
                <div class="span12">                    
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <h1>Site Statistics</h1>                               
                    </div>
                    <div class="block-fluid">
                    	<div class="row-form clearfix">
                            <div class="span3">Total no. of visitors</div>
                            <div class="span9"><?php echo $total_visitors;?></div>
                        </div>
                  	</div>
                    <br />
                    <div class="block-fluid table-sorting clearfix">
					<?php
                    $sql_year = "SELECT * FROM `ml_statistics` GROUP BY `visit_year`";
                    $exe_year = mysqli_query($conn, $sql_year) or die(mysqli_error());
                    $num_year = mysqli_num_rows($exe_year);
                    if($num_year>0)
                    {
                        while($fetch_year = mysqli_fetch_array($exe_year))
                        {
                        ?>
                        <div class="head clearfix">
                            <h1><?php echo $fetch_year['visit_year'];?></h1>                               
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="">
                            <thead>
                                <tr>
                                    <th width="50%">Month</th>
                                    <th width="50%">No. of Visitors</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
                            $sql_month = "SELECT * FROM `ml_statistics` WHERE `visit_year` = '".$fetch_year['visit_year']."' GROUP BY `visit_month`";
                            $exe_month = mysqli_query($conn, $sql_month) or die(mysqli_error());
                            $num_month = mysqli_num_rows($exe_month);
                            if($num_month>0)
                            {
                                while($fetch_month = mysqli_fetch_array($exe_month))
                                {
									$total_visitors_current_month = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ml_statistics WHERE `visit_month` = '".$fetch_month['visit_month']."' AND `visit_year` = '".$fetch_year['visit_year']."'"));
                                ?>
                                <tr>
                                    <td><?php echo $fetch_month['visit_month'];?></td>
                                    <td><?php echo $total_visitors_current_month;?></td>
                                </tr>
								<?php
                                }
                            }
                            else
                            {
                            ?>
                            <tr><td colspan="5" align="center"><font color="#FF0000">No record found</font></td></tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
						}
					}
					?>
                    </div>
                </div>                                
            </div>
         </div>
</div>

<?php require_once("footer.php"); ?>