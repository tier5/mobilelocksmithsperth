<?php
session_start(); 
if($_REQUEST['mode']=='Option')
	{
		//echo $_SESSION['4_letters_code'];exit;
		if(($_POST['4_letters_code'] == $_SESSION['4_letters_code']) && (!empty($_SESSION['4_letters_code'])))
	{
		//echo "hiiv";exit;
		///////////////   mail section ////////////////////////////////////////////////////////////////////////////
		//$to = $site['admin_email'];
		$to = 'sam@a2zonlinesolution.org';
		$subject="Contact Information";
		$from_mail=$_REQUEST['email'];
$message='<table width="100%" border="0" cellspacing="2" cellpadding="2">
				<tr>
					<td width="30%">Name :</td>
					<td width="70%">'.$_REQUEST['name'].'</td>
				</tr>
				<tr>
					<td>Email :</td>
					<td>'.$_REQUEST['email'].'</td>
				</tr>
				<tr>
					<td>Company :</td>
					<td>'.$_REQUEST['company'].'</td>
				</tr>
				<tr>
					<td valign="top">Message :</td>
					<td>'.$_REQUEST['message'].'</td>
				</tr>
				<tr>
					<td>IP Address :</td>
					<td>'.$_SERVER['REMOTE_ADDR'].'</td>
				</tr>
				</table>';
//echo $message;exit;
// To send HTML mail, the Content-type header must be set
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers  .= "From: $from_mail\r\n";
	$headers .= "To: $to\r\n";
	//$headers .= "Cc: karmicksol4@gmail.com\r\n";
//echo $message;exit;
			

		//////////////////////  end //////////////////////////////////////////////////////////////////
		
		
		//echo $sql_contact;exit;
		
		
			@mail($to,$subject,$message,$headers);    		

			$_SESSION['contact_succ_msg'] = 'Thank you. Your information has been successfully mailed to administrator.';
			
		
			}
		 else
		 {
			 //echo "notttt";exit;
		    $_SESSION['contact_wrong_msg'] = 'Invalid security code. Please try again!';
			
		 }
			header("Location: index.php");
			//header("Location: contact.php");
			exit;
	}


?>
<!DOCTYPE html>
<html lang="en-US">

<!-- Mirrored from a2zonlinesolution.ca/contact/ by HTTrack Website Copier/3.x [XR&CO'2010], Tue, 01 Dec 2015 13:30:42 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<title>Contact | A2Z Online Solution</title>
<meta name="DC.title" content="A2Z Online Solution" />
<meta name="geo.region" content="AU-WA" />
<meta name="geo.placename" content="Perth" />
<meta name="geo.position" content="-31.97968;115.800092" />
<meta name="ICBM" content="-31.97968, 115.800092" />

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="../xmlrpc.php" />






<script src="../../code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<!-- All in One SEO Pack 2.2.6.1 by Michael Torbert of Semper Fi Web Design[163,206] -->
<link rel="author" href="https://plus.google.com/u/0/b/114504234044371129973/" />

<link rel="canonical" href="index.html" />
			<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-61511152-1', 'auto');
			ga('require', 'linkid', 'linkid.html');
			ga('send', 'pageview');
			</script>
		<script type="text/javascript">
		function recordOutboundLink(link, category, action) {
					ga('send', 'event', category, action);
					if ( link.target == '_blank' ) return true;
			setTimeout('document.location = "' + link.href + '"', 100);
			return false;
		}
			/* use regular Javascript for this */
			function getAttr(ele, attr) {
				var result = (ele.getAttribute && ele.getAttribute(attr)) || null;
				if( !result ) {
					var attrs = ele.attributes;
					var length = attrs.length;
					for(var i = 0; i < length; i++)
					if(attr[i].nodeName === attr) result = attr[i].nodeValue;
				}
				return result;
			}
			
			function aiosp_addLoadEvent(func) {
			  var oldonload = window.onload;
			  if (typeof window.onload != 'function') {
			    window.onload = func;
			  } else {
			    window.onload = function() {
			      if (oldonload) {
			        oldonload();
			      }
			      func();
			    }
			  }
			}
			
			function aiosp_addEvent(element, evnt, funct){
			  if (element.attachEvent)
			   return element.attachEvent('on'+evnt, funct);
			  else
			   return element.addEventListener(evnt, funct, false);
			}

			aiosp_addLoadEvent(function () {
				var links = document.getElementsByTagName('a');
				for (var x=0; x < links.length; x++) {
					if (typeof links[x] == 'undefined') continue;
					aiosp_addEvent( links[x], 'onclick', function () {
						var mydomain = new RegExp(document.domain, 'i');
						href = getAttr(this, 'href');
						if (href && href.toLowerCase().indexOf('http') === 0 && !mydomain.test(href)) {
							recordOutboundLink(this, 'Outbound Links', href);
						}
					});
				}
			});
		</script>
<!-- /all in one seo pack -->
<link rel="alternate" type="application/rss+xml" title="A2Z Online Solution &raquo; Feed" href="../feed/index.html" />
<link rel="alternate" type="application/rss+xml" title="A2Z Online Solution &raquo; Comments Feed" href="../comments/feed/index.html" />
<link rel="alternate" type="application/rss+xml" title="A2Z Online Solution &raquo; Contact Comments Feed" href="feed/index.html" />
<link rel='stylesheet' id='jqueryui-css'  href='../wp-content/themes/nomos/css/jqueryui/custom5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='flexslider-css'  href='../wp-content/themes/nomos/js/flexslider/flexslider5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='slider-style-css'  href='../wp-content/themes/nomos/css/slider-style5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='screen-css'  href='../wp-content/themes/nomos/css/screen5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='fancybox-css'  href='../wp-content/themes/nomos/js/fancybox/jquery.fancybox5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='fancybox_thumb-css'  href='../wp-content/themes/nomos/js/fancybox/jquery.fancybox-thumbs5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='mediaelementplayer-css'  href='../wp-content/themes/nomos/js/mediaelement/mediaelementplayer5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='tipsy-css'  href='../wp-content/themes/nomos/css/tipsy5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='custom_css-css'  href='../wp-content/themes/nomos/templates/custom-css5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='grid-css'  href='../wp-content/themes/nomos/css/grid0235.css?ver=4.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='rs-settings-css'  href='../wp-content/plugins/revslider/rs-plugin/css/settings0235.css?ver=4.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='rs-captions-css'  href='../wp-content/plugins/revslider/rs-plugin/css/captions0235.css?ver=4.1.1' type='text/css' media='all' />
<script type='text/javascript' src='../wp-includes/js/jquery/jquery90f9.js?ver=1.11.1'></script>
<script type='text/javascript' src='../wp-includes/js/jquery/jquery-migrate.min1576.js?ver=1.2.1'></script>
<script type='text/javascript' src='../wp-content/plugins/revslider/rs-plugin/js/jquery.themepunch.plugins.min0235.js?ver=4.1.1'></script>
<script type='text/javascript' src='../wp-content/plugins/revslider/rs-plugin/js/jquery.themepunch.revolution.min0235.js?ver=4.1.1'></script>
<script type='text/javascript' src='../wp-content/plugins/flexslider-hg/js/jquery.flexslider-min0235.js?ver=4.1.1'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="../xmlrpc0db0.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="../wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 4.1.1" />
<link rel='shortlink' href='../indexcdf3.html?p=6429' />



</head>


<body class="page page-id-6429 page-template page-template-contact page-template-contact-php">

		<input type="hidden" id="slider_timer" name="slider_timer" value="10"/>
	
	<input type="hidden" id="pp_blogurl" name="pp_blogurl" value="http://a2zonlinesolution.ca"/>
	
	<input type="hidden" id="pp_stylesheet_directory" name="pp_stylesheet_directory" value="http://a2zonlinesolution.ca/wp-content/themes/nomos"/>
		<input type="hidden" id="pp_footer_style" name="pp_footer_style" value="4"/>
		<input type="hidden" id="pp_lightbox_padding" name="pp_lightbox_padding" value="10"/>
		<input type="hidden" id="pp_lightbox_opacity" name="pp_lightbox_opacity" value="0.7"/>
		<input type="hidden" id="pp_lightbox_open_effect" name="pp_lightbox_open_effect" value="fade"/>
		<input type="hidden" id="pp_lightbox_open_speed" name="pp_lightbox_open_speed" value="150"/>
		<input type="hidden" id="pp_lightbox_autoplay" name="pp_lightbox_autoplay" value="true"/>
		<input type="hidden" id="pp_lightbox_play_speed" name="pp_lightbox_play_speed" value="4000"/>
	
		<!-- Begin top bar -->
	<div id="top_bar">
	    
	    <div id="top_bar_inner">
	    
	    <div class="top_bar_wrapper">
	    		    	<div class="top_social">
	
	    		<!--<ul class="social_wrapper">
	    	    		    	    		    	    		    	    		    	    		    	    	<li><a title="Google+" href="https://plus.google.com/+A2zonlinesolutionOrgWeb" target="_blank"><img src="http://a2zonlinesolution.ca/wp-content/themes/nomos/images/social_dark/google.png" alt="a2z_5"/></a></li>
	    	    		    	    		    	    		    	    		    	    		    	    	<li><a title="Twitter" href="https://twitter.com/A2ZOnline_Sol" target="_blank"><img src="http://a2zonlinesolution.ca/wp-content/themes/nomos/images/social_dark/twitter.png" alt=""/></a></li>
	    	    		    	    		    	    	<li><a title="Facebook" href="http://facebook.com/pages/A2Z-Online-Solution/806998569398108" target="_blank"><img src="http://a2zonlinesolution.ca/wp-content/themes/nomos/images/social_dark/facebook.png" alt=""/></a></li>
	    	    		    	    		            	<li><a title="Pinterest" href="http://pinterest.com/A2ZOnlineSol" target="_blank"><img src="http://a2zonlinesolution.ca/wp-content/themes/nomos/images/social_dark/pinterest.png" alt=""/></a></li>
	            		            		    	    </ul>-->
	    	
	    	</div>
	    		    	
	    </div>
	    	
	    	    <div class="top_contact_info">
	        <ul>
	        		        		<li><img src="../wp-content/themes/nomos/images/grey_phone_icon.png" alt="" class="middle">+1(888) 688 2154</li>
	        		        		        		<li><img src="../wp-content/themes/nomos/images/grey_email_icon.png" alt="" class="middle">support@a2zonlinesolution.ca</li>
	        		        </ul>
	    </div>
	    	    
	    	    
	    	    
	    </div>
	    
	</div>
	<!-- End top bar -->
		
	<!-- Begin template wrapper -->
	<div id="wrapper">
			
		<div class="header_bg">	
		
			<!-- Begin header -->
			<div id="header_wrapper">
				
				<!-- Begin main nav -->
				<div id="menu_wrapper">
				
				    <div class="logo">
				    	<!-- Begin logo -->
				    
				    					    	
				    	<a id="custom_logo" href="../index.html"><img src="http://a2zonlinesolution.org/wp-content/uploads/2015/03/bps_logo.png" alt=""/></a>
				    	
				    	<!-- End logo -->
				    	
				    </div>
				    
				    <img id="mobile_menu" src="../wp-content/themes/nomos/images/mobile_menu.png" alt=""/>
				    
				    <div id="menu_border_wrapper">
				
				    	<div class="menu-main-menu-container"><ul id="main_menu" class="nav"><li id="menu-item-6843" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-6843"><a href="../index.html">Home</a></li>
<li id="menu-item-6940" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6940"><a href="../about/index.html">About</a></li>
<li id="menu-item-6941" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-6941"><a href="#">Our Services</a>
<ul class="sub-menu">
	<li id="menu-item-6957" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6957"><a href="../basic-website/index.html">Basic Website</a></li>
	<li id="menu-item-7116" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7116"><a href="../business-websites/index.html">Business Websites</a></li>
	<li id="menu-item-6958" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6958"><a href="../advanced-website/index.html">Advanced Website</a></li>
	<li id="menu-item-6959" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6959"><a href="../ecommerce-website/index.html">Ecommerce Website</a></li>
	<li id="menu-item-7046" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7046"><a href="../local-listing/index.html">Google Local Listing</a></li>
	<li id="menu-item-6960" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6960"><a href="../app-development/index.html">App Development</a></li>
	<li id="menu-item-6961" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6961"><a href="../global-seo/index.html">Global SEO</a></li>
	<li id="menu-item-6962" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6962"><a href="../local-seo/index.html">Local SEO</a></li>
	<li id="menu-item-6963" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6963"><a href="../print-media/index.html">Print Media</a></li>
	<li id="menu-item-6964" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6964"><a href="../hosting/index.html">Hosting</a></li>
	<li id="menu-item-7150" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7150"><a href="../computer-maintenance-support/index.html">Computer Maintenance &#038; Support</a></li>
</ul>
</li>
<li id="menu-item-6965" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-6429 current_page_item menu-item-6965"><a href="index.php">Contact</a></li>
</ul></div>				    
				    </div>
				
				</div>
				<!-- End main nav -->
				
		</div>
		<hr class="content_divider mainmenu"/>
		
				
</div>


<div class="page_caption">
	<div class="caption_inner">
		<div class="caption_header">
			<h1 ><span>Contact</span></h1>
						    <div class="page_description">For Any queries, kindly call us or fill up the form below and we will get back to you in 24 hours:</div>
					</div>
	</div>
	
	<hr class="hr_page_caption"/>
</div>
<br class="clear"/>

<!-- Begin content -->
<div id="content_wrapper">

    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    	<div class="standard_wrapper">
    	
    					
				    		<div class="contact_style1_info">
	    			<h2>
	    				    			</h2>
	    				    		</div>
	    		<hr/><br class="clear"/>
	    			

			<div class="sidebar_wrapper">
			    
			    <div class="sidebar">
			    	
			    	<div class="content">
			    	
			    		<ul class="sidebar_widget">
			    		<li id="text-4" class="widget widget_text"><h2 class="widgettitle"><span>Our Contact Centers</span></h2>
			<div class="textwidget"><b>USA/Canada</b><br>
Calgary, Alberta <br>
Phone: +1(888) 688 2154 <br>
Email: support@a2zonlinesolution.ca <br></div>
		</li>
			    		</ul>
			    		
			    	</div>
			    
			    </div>
			    <br class="clear"/>
					
			    <div class="sidebar_bottom"></div>
			
			</div>
				
			<div class="sidebar_content">
			<script language="javascript" type="text/javascript">
function refreshCaptcha()
{
	//alert('hiii');
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
						
				
				    					    
			    			    <form id="contact_form" class="style1" method="post" action="" enctype="multipart/form-data" >
                                <?php if(isset($_SESSION['contact_wrong_msg'])) { ?>
            <div style="color:#f60;font-size:16px;"><?php echo $_SESSION['contact_wrong_msg'];?></div>
             <?php
            unset($_SESSION['contact_wrong_msg']);
            }
            ?>
            <?php if(isset($_SESSION['contact_succ_msg'])) { ?>
            <div style="color:#090;font-size:16px;"><?php echo $_SESSION['contact_succ_msg'];?></div>
             <?php
            unset($_SESSION['contact_succ_msg']);
            }
            ?>

              <input type="hidden" name="mode" value="Option" />
			    				    <input id="name" name="name" type="text" title="Name*" placeholder="Name *" style="width:28%" required/>	
			    				    					
			        				<input id="email" name="email" type="text" title="Email*" placeholder="Email *" style="width:28%" required/>			
			    				    					
			        				<input id="company" name="company" type="text" title="Company Name" placeholder="Company Name" style="width:28%"/>			
			    				    					
			        				<textarea id="message" name="message" rows="7" cols="10" title="Message" placeholder="Message *" style="width:94%" required></textarea>				
			    				    	<input type="text" id="4_letters_code" name="4_letters_code" placeholder="Security Code *" style=" height:28px;" value="" required>
                                        <img src="<?php echo $site_url;?>captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg'><a href='javascript: refreshCaptcha();'><img src="re.png" style=" margin-left:10px;width:25px; height:25px; "></a>
			    				    		
			    		<br class="clear"/>
			    		
					
								
			        <br class="clear"/><br/>
			    	<input type="submit" value="Send Message"/><br/>
			    </form>
			    <div id="reponse_msg"></div>
			    <br/><br/><br/>
			    
			</div>
			
			<!--<script>
			jQuery(document).ready(function(){ 
							    
				// refresh captcha
 				$j('img#captcha-refresh').click(function() {  
 						
 						change_captcha();
 				});
 				
 				function change_captcha()
 				{
 					document.getElementById('captcha').src="../wp-content/themes/nomos/get_captcha4051.png?rnd=" + Math.random();
 				}
 				
 							
				$j.validator.setDefaults({
					submitHandler: function() { 
												$j.ajax({
			  		    	type: 'GET',
			  		    	url: 'http://a2zonlinesolution.ca/wp-content/themes/nomos/get_captcha.php?check=true',
			  		    	data: $j('#contact_form').serialize(),
			  		    	success: function(msg){
			  		    		if(msg == 'true')
			  		    		{
			  		    			var actionUrl = $j('#contact_form').attr('action');
					    
					    			$j.ajax({
			  		    				type: 'GET',
			  		    				url: actionUrl,
			  		    				data: $j('#contact_form').serialize(),
			  		    				success: function(msg){
			  		    					$j('#contact_form').hide();
			  		    					$j('#reponse_msg').html('<br/>'+msg);
			  		    				}
					    			});
			  		    		}
			  		    		else
			  		    		{
			  		    			alert(msg);
			  		    		}
			  		    	}
					    });
					    					    
					    return false;
					}
				});
					    
					
				$j('#contact_form').validate({
					rules: {
					    your_name: "required",
					    email: {
					    	required: true,
					    	email: true
					    },
					    message: "required"
					},
					messages: {
					    your_name: "Please enter your name",
					    email: "Please enter a valid email address",
					    message: "Please enter some message"
					}
				});
			});
			</script>-->
				
			
			</div>
			<!-- End main content -->
			
							
			<br class="clear"/>

			</div>
		</div>
		<!-- End content -->

			
	</div>
	
			
		<div id="client_wrapper">
			<div class="ppb_title headingbg center clients"><h5>Technologies We Use</h5></div>
		
								<a title="Photoshop" href="#" target="_blank" class="tipsy">
						<img src="../wp-content/uploads/2015/04/logo1.png" alt="Evernote"/>
					</a>
								<a title="Short Description about this client" href="#" target="_blank" class="tipsy">
						<img src="../wp-content/uploads/2013/03/logo2.png" alt="Rdio"/>
					</a>
								<a title="Short Description about this client" href="#" target="_blank" class="tipsy">
						<img src="../wp-content/uploads/2013/03/logo3.png" alt="Square"/>
					</a>
								<a title="Short Description about this client" href="#" target="_blank" class="tipsy">
						<img src="../wp-content/uploads/2013/03/logo4.png" alt="Designmodo"/>
					</a>
								<a title="Adobe Photoshop" href="#" target="_blank" class="tipsy">
						<img src="../wp-content/uploads/2013/03/logo5.png" alt="Photoshop"/>
					</a>
								<a title="" href="#" target="_blank" class="tipsy">
						<img src="../wp-content/uploads/2015/04/logo6.png" alt="php"/>
					</a>
						</div>
		
		</div>
				
		<!-- Begin footer -->
		<div id="footer">
			
						<ul class="sidebar_widget four">
				<li id="text-2" class="widget widget_text"><h2 class="widgettitle"><span>Reach Us @</span></h2>
			<div class="textwidget"><strong>Support: </strong><br>support@a2zonlinesolution.ca<br>
<strong>Grievances: </strong><br>sam@a2zonlinesolution.ca</div>
		</li>
<li id="nav_menu-2" class="widget widget_nav_menu"><h2 class="widgettitle"><span>Quick Links </span></h2>
<div class="menu-footer-link-container"><ul id="menu-footer-link" class="menu"><li id="menu-item-7019" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-7019"><a href="../index.html">Home</a></li>
<li id="menu-item-7020" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7020"><a href="../about/index.html">About</a></li>
<li id="menu-item-7021" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7021"><a href="../terms-and-conditions/index.html">Terms and Conditions</a></li>
<li id="menu-item-7024" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7024"><a href="../privacy-policy/index.html">Privacy Policy</a></li>
<li id="menu-item-7027" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7027"><a href="../refund-policy/index.html">Refund Policy</a></li>
<li id="menu-item-7028" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7028"><a href="index.php">Contact</a></li>
</ul></div></li>
<li id="text-3" class="widget widget_text"><h2 class="widgettitle"><span>Payment Partner </span></h2>
			<div class="textwidget"><a href="http://a2zonlinesolution.ca/password/index.php"><img src="../wp-includes/images/media/visa.png"/></a>
<!--<a href="/make-payment/"><img src="http://a2zonlinesolution.ca/wp-includes/images/media/paypal.png"/></a>-->
</div>
		</li>
        <li id="text-3" class="widget widget_text">
         <span id="ss_img_wrapper_115-55_image_en"><a href="http://www.alphassl.com/ssl-certificates/wildcard-ssl.html" target="_blank" title="SSL Certificates"><img alt="Wildcard SSL Certificates" border=0 id="ss_img" src="//seal.alphassl.com/SiteSeal/images/alpha_noscript_115-55_en.gif" title="SSL Certificate"></a></span><script type="text/javascript" src="//seal.alphassl.com/SiteSeal/alpha_image_115-55_en.js"></script>
        </li>
			</ul>
			
			<br class="clear"/>
						
		</div>
		<!-- End footer -->
		<div>
		<div>
		<div id="copyright" >
			<div class="copyright_wrapper">
				<div class="left_wrapper">
				Copyright  2015 A2Z Online Solutions  				</div>
				
								<div class="right_wrapper">
					<!--<ul class="social_wrapper">
				    					    	<li><a title="Twitter" href="http://twitter.com/A2ZOnline_Sol"><img src="http://a2zonlinesolution.ca/wp-content/themes/nomos/images/social_white/twitter.png" alt=""/></a></li>
				    					    					    	<li><a title="Facebook" href="http://facebook.com/pages/A2Z-Online-Solution/806998569398108"><img src="http://a2zonlinesolution.ca/wp-content/themes/nomos/images/social_white/facebook.png" alt=""/></a></li>
				    					    					    					    					    					    					    	<li><a title="Google+" href="https://plus.google.com/+A2zonlinesolutionOrgWeb"><img src="http://a2zonlinesolution.ca/wp-content/themes/nomos/images/social_white/google.png" alt=""/></a></li>
				    					    					    					    					    				        	<li><a title="Pinterest" href="http://pinterest.com/A2ZOnlineSol" target="_blank"><img src="http://a2zonlinesolution.ca/wp-content/themes/nomos/images/social_white/pinterest.png" alt=""/></a></li>
			        				        					    </ul>-->				
				</div>
								<br class="clear"/>
			</div>
			</div>
		
		</div>
	
	</div>
		
	<div id="toTop">
		<img src="../wp-content/themes/nomos/images/arrow_up_24x24.png" alt=""/>
	</div>


<script language="javascript" type="text/javascript">
/*$( document ).ready(function() {
    ('.divider').hide();
});
*/</script>


<script type='text/javascript' src='../wp-content/themes/nomos/js/custom5152.js?ver=1.0'></script>

</body>

<!-- Mirrored from a2zonlinesolution.ca/contact/ by HTTrack Website Copier/3.x [XR&CO'2010], Tue, 01 Dec 2015 13:30:44 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
</html>		
						
