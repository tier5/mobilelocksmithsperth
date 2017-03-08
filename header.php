<?php
ob_start();
session_start();
error_reporting(0);

$current_page = basename($_SERVER['PHP_SELF']);
$current_page_full_url = basename($_SERVER['REQUEST_URI']);

require_once("config.php");
global $conn;
require_once("meta.php");
require_once("class.upload.php");
require_once("counter.php");

//FETCH SITE SETTINGS
$fetch_settings = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `ml_administrator` WHERE `admin_id` = '1'"));
$company_name = stripslashes($fetch_settings['company_name']);
$contact_address = stripslashes($fetch_settings['contact_address']);
$contact_email = stripslashes($fetch_settings['contact_email']);
$contact_no = stripslashes($fetch_settings['contact_no']);
$abn_no = stripslashes($fetch_settings['abn_no']);

$owner_name_black = stripslashes($fetch_settings['owner_name_black']);
$owner_name_red = stripslashes($fetch_settings['owner_name_red']);
$owner_image = stripslashes($fetch_settings['owner_image']);
$owner_note = stripslashes($fetch_settings['owner_note']);

$banner_caption_tagline = stripslashes($fetch_settings['banner_caption_tagline']);
$gallery_text = stripslashes($fetch_settings['gallery_text']);

$facebook_link = stripslashes($fetch_settings['facebook_link']);
$gplus_link = stripslashes($fetch_settings['gplus_link']);
$youtube_link = stripslashes($fetch_settings['youtube_link']);

$service_image = stripslashes($fetch_settings['service_image']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $meta_title;?></title>
    <meta  name="description" content="<?php echo $meta_description;?>" />
    <meta name="keywords" content="<?php echo $meta_keywords;?>" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/responsive_style.css">
    <link rel="stylesheet" href="css/animate.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/custom.js"></script>
    <script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
    
    <script language="javascript" type="text/javascript">
    function closeDiv()
	{
		$('#bcaption').hide();
	}
    function closeDiv2()
	{
		$('#bbottom').hide();
	}
    </script>
</head>
<body>
<div class="wrapper"> 
 	<header class="masthead">
    	<div class="header_top">
        	<div class="header_top2">
          	<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="891" height="36">
            <param name="movie" value="swf/light_on_off.swf">
            <param name="quality" value="high">
            <param name="wmode" value="opaque">
            <param name="swfversion" value="9.0.45.0">
            <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
            <param name="expressinstall" value="Scripts/expressInstall.swf">
            <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
            <!--[if !IE]>-->
            <object type="application/x-shockwave-flash" data="swf/light_on_off.swf" width="891" height="36">
              <!--<![endif]-->
              <param name="quality" value="high">
              <param name="wmode" value="opaque">
              <param name="swfversion" value="9.0.45.0">
              <param name="expressinstall" value="Scripts/expressInstall.swf">
              <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
              <div>
                <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
              </div>
              <!--[if !IE]>-->
            </object>
            <!--<![endif]-->
          	</object>
        	</div>
      	</div>  
        <div class="header_bottom">
        	<div class="container">
            	<div class="col-lg-5 col-md-5 col-sm-4 col-xs-12 logo_section">
                	<a href=""><img src="img/logo.png"></a> 
                </div>
                <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 text-right main_menu ">
                	<div id="nav" class="nav_section">
          				<div class="navbar navbar-default navbar-static menu_section">
            				<nav class="navbar navbar_content nav_list"> 
              					<!-- Brand and toggle get grouped for better mobile display -->
              					<div class="navbar-header">
              						<div class="res_logo wow fadeInDown"> <a href=""><img src="img/small_logo.png"></a> </div>
                					<button id="res-nav-btn" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              					</div>
             					<!-- Collect the nav links, forms, and other content for toggling -->
              					<div class="collapse navbar-collapse all_menu" id="bs-example-navbar-collapse-1">
				  					<ul class="nav navbar-nav menu_list navbar-right">
                    					<li class="one_line_nav <?php if($current_page == 'index.php') { ?>active<?php } ?>"><a href="">Home</a></li>
                    					<li <?php if($current_page == 'local.php') { ?>class="active"<?php } ?>><a href="local-professional/">LOCAL<br>PROFESSIONAL</a></li>
                   	 					<li class="one_line_nav <?php if($current_page == 'services.php') { ?>active<?php } ?>"><a href="services/">Services</a></li>
                    					<li <?php if($current_page == 'gallery.php') { ?>class="active"<?php } ?>><a href="gallery/">Product<br>Gallery</a></li>
                    					<li <?php if($current_page == 'reviews.php') { ?>class="active"<?php } ?>><a href="reviews/">Client<br>Reviews</a></li>
                    					<li class="one_line_nav <?php if($current_page == 'contact_us.php') { ?>active<?php } ?>"><a href="contact-us/">Contact Us</a></li>
                  					</ul>
              					</div>
              					<!-- /.navbar-collapse --> 
            				</nav>
                            <!-- /.navbar --> 
          				</div>
        			</div>
                </div>
  			</div>
        </div>
    </header> 

  	<!--banner area start-->
  	<div class="banner_section">
       	<div id="banner_slide" class="carousel slide slider_section">
              <ol class="carousel-indicators slide_dot">
			  <?php
			  $banner_counter = 0;
			  $sql_banner_counter = "SELECT * FROM `ml_banners` WHERE `banner_status` = 'Active'";
			  $exe_banner_counter = mysqli_query($conn, $sql_banner_counter) or die(mysqli_error());
			  $num_banner_counter = mysqli_num_rows($exe_banner_counter);
			  if($num_banner_counter>0)
			  {
				  while($arr_banner_counter = mysqli_fetch_array($conn, $exe_banner_counter))
				  {
					  if($banner_counter == 0)
					  {
						  $banner_active_class = 'class="active"';
					  }
					  else
					  {
						  $banner_active_class = '';
					  }
			  	  	?>
              			<li data-target="#banner_slide" data-slide-to="<?php echo $banner_counter;?>" <?php echo $banner_active_class;?>></li>
              		<?php
					$banner_counter++;
				  }
			  }
			  ?>
            </ol>
            <div class="carousel-inner slider_img">
			  <?php
			  $banner_image_counter = 1;
			  $sql_banner_image = "SELECT * FROM `ml_banners` WHERE `banner_status` = 'Active'";
			  $exe_banner_image = mysqli_query($conn, $sql_banner_image) or die(mysqli_error());
			  $num_banner_image = mysqli_num_rows($exe_banner_image);
			  if($num_banner_image>0)
			  {
				  while($arr_banner_image = mysqli_fetch_array($exe_banner_image))
				  {
					  if($banner_image_counter == 1)
					  {
						  $banner_image_active_class = 'active item';
					  }
					  else
					  {
						  $banner_image_active_class = 'item';
					  }
			  	  	?>
              		<div class="<?php echo $banner_image_active_class;?>"><img src="uploads/banner/<?php echo $arr_banner_image['banner_image'];?>" alt="" border="0"></div>
              		<?php
					$banner_image_counter++;
				  }
			  }
			  ?>
            </div>
            <a class="carousel-control left" href="#banner_slide" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="carousel-control right" href="#banner_slide" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a> </div>
  
  		<!--caption area start for desktop-->
    	<?php /*?><div class="banner_caption" id="bcaption">
   	  		<div class="banner_caption_header"><?php echo strtoupper($company_name);?></div>
           	<div class="banner_caption_call"> 
            	<a href="tel:<?php echo str_replace(' ', '',$contact_no);?>"><?php echo $contact_no;?></a>
           	</div>
			<div class="banner_caption_tag"><?php echo strtoupper($banner_caption_tagline);?><div class="close-butt"><a href="javascript:void(0);" onClick="closeDiv();"><img src="<?php echo SITE_URL;?>img/close.png" alt="" border="0"></a></div></div>
      	</div><?php */?> 
      	<!--caption area end for desktop-->  
        
        <!--caption area start for mobile-->
        <div class="banner_bottom" id="bbottom">
            <div class="container">
                <ul>
                    <li class="banner_bottom_text"><?php echo strtoupper($company_name);?></li>
                    <li class="banner_bottom_text"><a href="tel:<?php echo str_replace(' ', '',$contact_no);?>"><?php echo $contact_no;?></a><a href="javascript:void(0);" onClick="closeDiv2();"><img src="img/close.png" alt="" border="0"></a></li>
                </ul>
             </div>
        </div>
        <!--caption area end for mobile-->  
	</div>
    <!--banner area end-->