<?php require_once("header.php");?>

<!-- page template part start -->
<section>
    <div class="body_content">
        <div class="container">
            <div class="row">
                <div class="services_section clearfix">
                    <div class="in_service_header">Welcome To <span>Mobile Locksmiths Perth</div>
          			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ser_no_pad">
                    <?php
					$sql_text = "SELECT * FROM `ml_contents` WHERE `content_id` = '1'";
					$exe_text = mysql_query($sql_text) or die(mysql_error());
					$arr_text = mysql_fetch_array($exe_text);
					?>
                        <div class="ser_container">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ser_no_pad">
                                    <div class="ser_img"><img src="<?php echo SITE_URL;?>uploads/content/<?php echo $arr_text['content_image'];?>" alt=""></div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ser_no_pad2">
                                    <div class="ser_text_container">
                                        <div class="ser_text_area"><?php echo stripslashes($arr_text['content']);?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page template part end -->

<?php require_once("footer.php");?>