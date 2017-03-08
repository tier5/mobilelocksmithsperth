<?php 
require_once("header.php");
require_once("session_check.php");

//FETCH DATA FROM DATABASE
$fetch_record = mysql_fetch_array(mysql_query("SELECT * FROM `ml_testimonials` WHERE `testimonial_id` = '".$_GET['testimonial_id']."'"));
?>
<?php require_once("left_panel.php");?>
<div class="content">
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">
                	<form action="" method="post" enctype="multipart/form-data" onsubmit="return frm_validation();">
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <h1>Review Details</h1>
                    </div>
                    <div class="block-fluid">
                    	<div class="row-form clearfix">
                            <div class="span3">Sender Name</div>
                            <div class="span9"><?php echo stripslashes($fetch_record['sender_name']);?></div>
                        </div>
                    	<div class="row-form clearfix">
                            <div class="span3">Sender Photo</div>
                            <div class="span9">
                            <?php if($fetch_record['sender_type'] == "General") { ?>
                            <?php if($fetch_record['sender_image']!="") { ?>
                                <a href="../uploads/testimonial/<?php echo stripslashes($fetch_record['sender_image']);?>" rel="group" class="fancybox" style="margin: 26px;"><img src="../uploads/testimonial/thumb/<?php echo stripslashes($fetch_record['sender_image']);?>" width="100" height="100" border="0" alt="" /></a>
                            <?php } else { ?>
                                <img src="../img/no_image.png" border="0" width="100" height="100" alt="" />
                            <?php } ?>
							<?php } else { ?>
                            <img src="<?php echo stripslashes($fetch_record['sender_image']);?>" border="0" alt="" width="100" height="100" />
                            <?php } ?>
                            </div>
                        </div>
                    	<div class="row-form clearfix">
                            <div class="span3">Sender Email</div>
                            <div class="span9"><?php echo stripslashes($fetch_record['sender_email']);?></div>
                        </div>
                    	<div class="row-form clearfix">
                            <div class="span3">Sender City</div>
                            <div class="span9"><?php echo stripslashes($fetch_record['sender_city']);?></div>
                        </div>
                    	<div class="row-form clearfix">
                            <div class="span3">Sender Review</div>
                            <div class="span9"><?php echo nl2br(stripslashes($fetch_record['sender_comments']));?></div>
                        </div>
                    	<div class="row-form clearfix">
                            <div class="span3">Post Date</div>
                            <div class="span9"><?php echo date('F d, Y',strtotime($fetch_record['post_date']));?></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">&nbsp;</div>
                            <div class="span9"><button class="btn" type="button" name="back" onclick="window.location.href='testimonial_list.php'">Back To Reviews List</button></div>
                        </div>  
                   	</div>
                    </form>
                </div>
            </div>
        </div>
</div>   

<?php require_once("footer.php"); ?>