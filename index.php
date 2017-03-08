<?php require_once("header.php");
require_once("config.php");
global $conn; 

?>
<!-- page template part start -->
<section>
	<!--services area start-->
    <div class="body_content">
        <div class="container">
            <div class="row">
                <div class="services_section clearfix">
                    <div class="in_service_header">Our <span>Services</span></div>
    				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 no-pad-left">
    					<div class="service_block">
    						<div class="img_block"><img src="uploads/content/<?php echo $service_image;?>" alt=""> </div>
    					</div>
    				</div>
          			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            			<div class="service_block">
						<?php
						$service_counter = 1;
                        $sql_services = "SELECT * FROM `ml_services` WHERE `service_status` = 'Active' AND `homepage_display` = 'Yes'";
                        $exe_services = mysqli_query($conn, $sql_services) or die(mysqli_error());
                        $num_services = mysqli_num_rows($exe_services);
                        if($num_services>0)
                        {
                            while($arr_services = mysqli_fetch_array($exe_services))
                            {
                                ?>
             					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
             						<div class="in_service_area">
             							<div class="in_ser_icon_area1"><img src="uploads/service/icon/<?php echo $arr_services['service_icon'];?>" alt=""></div>
             							<div class="in_ser_header"><a href="services/"><?php echo stripslashes($arr_services['service_title']);?></a></div>
             							<div class="in_ser_text_area"><?php echo substr(stripslashes($arr_services['service_content']),0,220);?>...</div>
             						</div>
             					</div>
                                <?php
								if($service_counter%2 == 0)
								{
									echo '</div><div class="service_block">';
								}
								$service_counter++;
							}
						}
						?>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <!--services area end-->
    
    <!--welcome text area start-->
	<?php
    $fetch_home_content = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `ml_contents` WHERE `content_id` = '1'"));
    $home_content = stripslashes($fetch_home_content['content']);
    $home_content_image = stripslashes($fetch_home_content['content_image']);
    ?>
    <div class="welcome_container">
        <div class="container">
			<div class="welcome_main_area">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="welcome_img"><img src="uploads/content/<?php echo $home_content_image;?>" width="385" height="225" alt=""></div>
                    </div>
     				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
 						<div class="welcome_main_text_area">
 							<div class="welcome_text_header">Welcome To <span>Mobile Locksmiths Perth</span></div>
								<div class="welcome_text_container"><?php echo $home_content;?></div>
 								<div class="welcome_read_more_btn"><a href="homepage-text/"><img src="img/read_more_btn.png" width="103" height="31" alt=""></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--welcome text area end-->
    
    <!--review area start-->
    <div class="testimonial_content">
        <div class="container">
            <div class="testimonial_main_area">
                <div class="testimonial_text_header">client <span>reviews</span></div>
                <div class="testimonial_slide_container">
    				<div class="row">
        				<div id="carousel-example-generic" class="carousel slide testimonial_section" data-ride="carousel"> <!-- Indicators --> 
          					<!-- Wrapper for slides -->
          					<div class="carousel-inner">
							<?php
							$testimonial_counter = 1;
                            $sql_testimonials = "SELECT * FROM `ml_testimonials` WHERE `testimonial_status` = 'Active' ORDER BY `testimonial_id` DESC";
                            $exe_testimonials = mysqli_query($conn,$sql_testimonials) or die(mysqli_error());
                            $num_testimonials = mysqli_num_rows($exe_testimonials);
                            if($num_testimonials>0)
                            {
                                while($arr_testimonials = mysqli_fetch_array($exe_testimonials))
                                {
									if($testimonial_counter == 1)
									{
										$testimonial_active_class = 'item active';
									}
									else
									{
										$testimonial_active_class = 'item';
									}
                                    ?>
                                    <div class="<?php echo $testimonial_active_class;?>">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="adjust1">
                                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                                                        <div class="author_img">
                                                        <?php if($arr_testimonials['sender_type'] =="General") { ?>
                                                        <?php if($arr_testimonials['sender_image']!="") { ?>
                                                            <img class="img-responsive" src="uploads/testimonial/thumb/<?php echo $arr_testimonials['sender_image'];?>" alt="">
                                                            <?php } else { ?>
                                                            <img class="img-responsive" src="img/no_image.png" alt="">
															<?php } ?>
                                                            <?php } else { ?>
                                                            <img src="<?php echo $arr_testimonials['sender_image'];?>" border="0" alt="" />
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                                        <div class="testimo_txt all_txt">
                                                            <p><?php echo nl2br(stripslashes($arr_testimonials['sender_comments']));?></p>
                                                        </div>
                                                        <span class="auther_name">-- <?php echo stripslashes($arr_testimonials['sender_name']);?>, <?php echo stripslashes($arr_testimonials['sender_city']);?></span> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
									$testimonial_counter++;
								}
							}
							?>
          					</div>
          					<!-- Controls --> 
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a> 
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
            			</div>
        			</div>
    			</div>
    
                <div class="review_area">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="review_area"><a href="reviews/"><img src="img/read_more_btn.png" width="103" height="31" alt=""></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--review area end-->
</section>
<!-- page template part end -->

<?php require_once("footer.php");?>