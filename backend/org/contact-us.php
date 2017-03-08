<?php
/**
 * Template Name: Contact template
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/custom-style.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive-style.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.bxslider.css" />
        <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr.js"></script>
        
        <?php wp_head();?>
    </head>
    
  	<body>
  	<div class="wrapper">
  	<?php get_header();?>
        <div class="content-section">
       		<div class="container">
               <div class="container-2">
			    <?php
				if (have_posts()) : while (have_posts()) : the_post();
				?>
               		<div class="inner-content">
                		<div class=" bottom-content about-page-content">
               				<div class="bottom-contact-content-left"><h2><?php the_title();?></h2>
                   				<div class="contact-section-data">
									<div class="contact-frm-section"><?php the_content();?></div>
                        		</div>
                    			<div class="map-section">
                    			<div class="loaction-1 location-section">
									<div class="address-section">
                            		<h5> APPLECROSS </h5>
                                    <p> <?php echo get_field("address");?></p> </div><div class="map-holder">							
									<iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo urlencode(get_field("map_address_1")); ?>&output=embed"></iframe>							
                        			</div>
                       			</div>
                    			<div class="loaction-2 location-section">
									<div class="address-section">
                            		<h5> MYAREE </h5>
									<p> <?php echo get_field("address_2");?></p>
                            		</div>
                           			<div class="map-holder">
                        			<iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo urlencode(get_field("map_address_2")); ?>&output=embed"></iframe>
                        			</div>
                    			</div>
               				</div>
        					</div>    
        				</div>
        			</div>
				<?php endwhile; 
				endif;
				wp_reset_query();
				?>
        		</div>
         	</div>
         <?php get_footer();?>           
  		</div>
  	</div>
	</body>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.bxslider.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/hamburger-menu.js"></script>
<script>
//responsive nav
$(document).ready(function(){	
  $("#menu_responsive").click(function(){
    $(".menu-section").slideToggle();
  });
});
</script>

<script>
$(document).ready(function(){
  $('.bxslider').bxSlider({
  auto: true,
  autoControls: true,
  minSlides: 6,
  maxSlides: 6,
  slideWidth: 300,
  slideMargin: 10
});
});
</script>
</html>
