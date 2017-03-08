<?php require_once("header.php");
include_once("config.php");
global $conn;
?>
<!-- page template part start -->
<section>
    <div class="body_content">
        <div class="container">
            <div class="row">
                <div class="services_section clearfix">
                    <div class="in_service_header">LOCAL <span>PROFESSIONAL</span></div>
                    <!--left panel area start-->
					<?php
                    $fetch_left_content = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `ml_contents` WHERE `content_id` = '2'"));
                    $left_content = stripslashes($fetch_left_content['content']);
                    $left_content_image = stripslashes($fetch_left_content['content_image']);
                    ?>
          			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad-left">
          				<div class="professional_container1">
          					<div class="professional_container2">
          						<div class="professional_container_img_area"><img src="<?php echo SITE_URL; ?>uploads/content/<?php echo $left_content_image;?>" alt=""></div>
           						<div class="professional_container_text_area"><?php echo $left_content;?></div>
           					</div>
           				</div>
          			</div>
          			<!--left panel area end-->
                    
                    <!--right panel area start-->
					<?php
                    $fetch_right_content = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `ml_contents` WHERE `content_id` = '3'"));
                    $right_content = stripslashes($fetch_right_content['content']);
                    $right_content_image = stripslashes($fetch_right_content['content_image']);
                    ?>
          			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            			<div class="professional_container3">
          					<div class="professional_container2">
          						<div class="professional_container_img_area"><img src="<?php echo SITE_URL; ?>uploads/content/<?php echo $right_content_image;?>" alt=""></div>
           						<div class="professional_container_text_area"><?php echo $right_content;?></div>
           					</div>
           				</div>
          			</div>
          			<!--right panel area end-->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page template part end -->

<?php require_once("footer.php");?>