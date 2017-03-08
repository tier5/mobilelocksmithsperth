<?php require_once("header.php");?>

<!-- page template part start -->
<section>
    <div class="body_content">
        <div class="container">
            <div class="row">
                <div class="services_section clearfix">
                    <div class="in_service_header">Services</div>
          			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ser_no_pad">
                    <?php
					$sql_services = "SELECT * FROM `ml_services` WHERE `service_status` = 'Active' ORDER BY `service_id` DESC";
					$exe_services = mysql_query($sql_services) or die(mysql_error());
					$num_services = mysql_num_rows($exe_services);
					if($num_services>0)
					{
						while($arr_services = mysql_fetch_array($exe_services))
						{
							?>
          					<div class="ser_container">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ser_no_pad">
                                        <div class="ser_img"><img src="<?php echo SITE_URL;?>uploads/service/thumb/<?php echo $arr_services['service_image'];?>" alt=""></div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ser_no_pad2">
                                        <div class="ser_text_container">
                                            <div class="ser_text_header1" style="background-image:url(<?php echo SITE_URL;?>uploads/service/icon/<?php echo $arr_services['service_icon'];?>); background-repeat:no-repeat"><?php echo stripslashes($arr_services['service_title']);?></div>
                                            <div class="ser_text_area"><?php echo nl2br(stripslashes($arr_services['service_content']));?></div>
                                        </div>
                                    </div>
                                </div>
          					</div>
                            <?php
						}
					}
					?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page template part end -->

<?php require_once("footer.php");?>