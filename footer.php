	<!--footer area start-->
    <footer>
    	<div class="footer_content">
    		<div class="container">
    			<div class="footer_main_area">
   					<div class="row">
                    	<!--quick links area start-->
    					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
   							<div class="footer_main_container">
   								<div class="footer_header">Quick Links</div>
   								<div class="footer_link_area">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 footer_link_area_main">
                                            <div class="footer_link_area2">
                                                <ul>
                                                    <li><a href="<?php echo SITE_URL;?>">Home</a></li>
                                                    <li><a href="<?php echo SITE_URL;?>local-professional/">Local Professional</a></li>
                                                    <li><a href="<?php echo SITE_URL;?>services/">Services</a></li>
                                                </ul>
                                            </div> 
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 footer_link_area_main">
                                            <div class="footer_link_area2">
                                                <ul>
                                                    <li><a href="<?php echo SITE_URL;?>gallery/">Product Gallery</a></li>
                                                    <li><a href="<?php echo SITE_URL;?>reviews/">Client Reviews</a></li>
                                                    <li><a href="<?php echo SITE_URL;?>contact-us/">Contact Us</a></li>
                                                </ul>
                                            </div> 
                                        </div>
                                    </div>
   								</div>
    						</div>
    					</div>
               	 		<!--quick links area end-->
                
                		<!--social icons area start-->
       					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
       						<div class="footer_header2">
       							<ul>
       								<li><img src="<?php echo SITE_URL;?>img/footer_text_header_bg.png" alt=""></li>
       								<li>Follow Us On</li>
       							</ul>
       						</div>
    						<div class="social_area">
    							<ul>
    								<li class="social_area_ajs"><a href="<?php echo $facebook_link;?>" target="_blank"><img src="<?php echo SITE_URL;?>img/social_img1.png" alt=""></a></li>
                                    <li><a href="<?php echo $gplus_link;?>" target="_blank"><img src="<?php echo SITE_URL;?>img/social_img2.png" alt=""></a></li>
                                    <li><a href="<?php echo $youtube_link;?>" target="_blank"><img src="<?php echo SITE_URL;?>img/social_img3.png" alt=""></a></li>
    							</ul>
    						</div>
    					</div>
                        <!--social icons area end-->
                        
                        <!--contact area start-->
       					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
       						<div class="footer_header">Contact Us</div>
    						<div class="footer_contact_area">
    							<div class="footer_contact_header"><?php echo $company_name;?></div>
    							<div class="footer_contact_area">
									<?php echo $contact_address;?><br>
                                    <strong>Mobile : </strong><a href="tel:<?php echo str_replace(' ', '',$contact_no);?>"><?php echo $contact_no;?></a><br>
                                    <strong>Email : </strong><a href="mailto:<?php echo $contact_email;?>"><?php echo $contact_email;?></a><br>
                                    <strong>ABN : </strong><?php echo $abn_no;?>
    							</div>
    						</div>
    					</div>
    					<!--contact area end-->
    				</div>
    			</div>
    		</div>
    	</div>
    
    	<!--copyright area start-->
    	<div class="footer_bottom">
      		<div class="container">
        		<div class="row">
          			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 footer_data_2">
            			<p>&copy; 2016 Mobile Locksmiths Perth. All Rights Reserved. Site by <a href="http://a2zonlinesolution.com.au/" target="_blank">A2Z Online Solution</a>.</p>
          			</div>
          			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 footer_data_3">
         				<p>JACK <a href="mailto:jack@a2zonlinesolution.com.au">(jack@a2zonlinesolution.com.au).</a></p>
          			</div>
        		</div>
      		</div>
    	</div>
        <!--copyright area end-->
  	</footer>
  	<!--footer area end-->
  	<span id="top-link-block" class="hidden"> <a href="#top" class="well well-sm"  onclick="$('html,body').animate({scrollTop:0},'slow');return false;"> <i class="glyphicon glyphicon-chevron-up"></i> </a> </span>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
wow = new WOW(
{
	boxClass:     'wow',
	animateClass: 'animated',
	offset:       100
}
);
wow.init();
});
swfobject.registerObject("FlashID");
swfobject.registerObject("FlashID");
</script>
</body>
</html>