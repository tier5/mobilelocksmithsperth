<?php require_once("header.php");?>

<?php
if(isset($_POST['send']))
{
	if($_POST['4_letters_code'] == $_SESSION['4_letters_code'])
	{
		//SEND EMAIL TO ADMINISTRATOR
		$subject = 'A New Inquiry Posted';	
		$message = '<table border="0" width="100%" cellspacing="2" cellpadding="2" align="center">
					<tr>
						<td colspan="2">A new inquiry has been posted. Details are below,</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="30%">Name : </td>
						<td width="70%">'.stripslashes($_POST['name']).'</td>
					</tr>
					<tr>
						<td>Phone Number : </td>
						<td>'.stripslashes($_POST['phone']).'</td>
					</tr>
					<tr>
						<td>Email Address : </td>
						<td>'.stripslashes($_POST['email']).'</td>
					</tr>
					<tr>
						<td valign="top">Comment :</td>
						<td>'.nl2br(stripslashes($_POST['comments'])).'</td>
					</tr>
					</table>';
					
		$headers = "From: ".$company_name."<".stripslashes($_POST['email']).">" . "\r\n" .
		"Reply-To: ".stripslashes($_POST['email'])."" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		mail($contact_email,$subject,$message,$headers);
		
		$_SESSION['msg_succ'] = 'Thank you. Your information has been successfully mailed to administrator.';
		header("location: ".SITE_URL."contact-us/");
		exit;
	}
	else
	{
		$_SESSION['msg_fail'] = 'Invalid security code. Please try again!';
		header("location: ".SITE_URL."contact-us/");
		exit;
	}
}
?>

<script language="javascript" type="text/javascript">
function echeck(str) 
{
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		    alert("Invalid email address");
		   return false;
		}


		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		    alert("Invalid email address");
		   return false;
		}


		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Invalid email address");
		    return false;
		}


		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Invalid email address");
		    return false;
		 }


		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Invalid email address");
		    return false;
		 }


		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Invalid email address");
		    return false;
		 }
		

		 if (str.indexOf(" ")!=-1){
		    alert("Invalid email address");
		    return false;
		 }
 		 return true;					
}

function validenq()
{
   	if(document.getElementById('name').value == "")
    {
		alert("Please enter name");
		document.getElementById('name').focus();
		return false;
    }
	
	if(document.getElementById('phone').value == "")
	{
		alert("Please enter phone number");
		document.getElementById('phone').focus();
		return false;
	}
	
   	if(document.getElementById('email').value == "")
    {
		alert("Please enter email");
		document.getElementById('email').focus();
		return false;
    }
   
	if(echeck(document.getElementById('email').value)==false){
		document.getElementById('email').focus();
		return false;
	}
	
    if(document.getElementById('comments').value == "")
    {
		alert("Please enter comment");
		document.getElementById('comments').focus();
		return false;
    }
	
    if(document.getElementById('4_letters_code').value == "")
    {
		alert("Please enter security code");
		document.getElementById('4_letters_code').focus();
		return false;
    }
	
	return true;
}
</script>

<script language="javascript" type="text/javascript">
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>

<!-- page template part start -->
<section>
	<div class="body_content">
    	<div class="container">
      		<div class="row">
        		<div class="services_section clearfix">
                	<!--enquiry area start-->
                    <form action="" method="post" enctype="multipart/form-data" onSubmit="return validenq();">
                    <input type="hidden" name="send" id="send" value="1">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad-left">
              			<div class="in_service_header">
            				Contact <span>Us</span>
            			</div>
              			<div class="cont_container1">
              				<div class="professional_container2">
              					<div class="contact_text2">Just send us an inquiry</div>
								<?php if(isset($_SESSION['msg_succ'])) { ?>
                                    <div style="color:#006600; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin-bottom:5px; text-align:center;"><?php echo $_SESSION['msg_succ'];?></div>
                                <?php
                                unset($_SESSION['msg_succ']);
                                }
                                ?>
                                
                                <?php if(isset($_SESSION['msg_fail'])) { ?>
                                    <div style="color:#FF0000; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin-bottom:5px; text-align:center;"><?php echo $_SESSION['msg_fail'];?></div>
                                <?php
                                unset($_SESSION['msg_fail']);
                                }
                                ?>
              					<div class="contact_field">
              						<div class="contact_text">Your Name <font color="#FF0000">*</font></div>
                          			<input type="text" class="form-control" id="name" name="name">
                        		</div>
              					<div class="contact_field">
              						<div class="contact_text">Your Phone <font color="#FF0000">*</font></div>
                       				<input type="text" class="form-control" id="phone" name="phone">
                      			</div>
              					<div class="contact_field">
              						<div class="contact_text">Your Email <font color="#FF0000">*</font></div>
                          			<input type="text" class="form-control" id="email" name="email">
                        		</div>
              					<div class="contact_field">
              						<div class="contact_text">Your Comment <font color="#FF0000">*</font></div>
                          			<textarea id="comments" name="comments" cols="" rows="" class="form-control" style="width:100%; height:150px; resize:none;"></textarea>
                        		</div>
              					<div class="contact_field">
              						<div class="contact_text">Type this text</div>
                       					<div class="captcha_container">
                       						<div class="row">
                       							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 no-pad-left">
                       								<div class="captcha_area"><img src="<?php echo SITE_URL;?>captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg'></div>
                       							</div>
                                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 no-pad-left">
                       								<div style="text-align:center;"><a href='javascript: refreshCaptcha();' style="text-decoration:none"><img src="<?php echo SITE_URL;?>image/refresh.png" border="0" alt=""></a></div>
                       							</div>
                        						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 no-pad-left">
                       								<input type="text" class="form-control" id="4_letters_code" name="4_letters_code" style="margin-bottom:10px;">
                       							</div>
                        						<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 no-pad-left">
                        						<input type="image" src="<?php echo SITE_URL;?>img/submit_btn.jpg">
                       						</div>
                       					</div>
                       				</div>
                        		</div>
               				</div>
               			</div>
              		</div>
                    </form>
                    <!--enquiry area end-->
                    
              		<!--contact information area start-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="in_service_header">
                            <?php echo $owner_name_black;?> <span><?php echo $owner_name_red;?></span>
                        </div>
                        <div class="professional_container3">
                            <div class="professional_container2">
                                <div class="cont_address_area">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 no-pad-left">
                                            <div class="mobile_no">Mobile : <br> <a href="tel:<?php echo str_replace(' ', '',$contact_no);?>"><?php echo $contact_no;?></a></div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 no-pad-left">
                                            <div class="mobile_no">Email : <br><a href="mailto:<?php echo $contact_email;?>"><?php echo $contact_email;?></a></div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 no-pad-left">
                                            <div class="mobile_no">Address : <br> <span><?php echo $contact_address;?></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cont_img_area"><img src="<?php echo SITE_URL;?>uploads/content/<?php echo $owner_image;?>" alt="" class="cont_img_border"></div>
                            </div>
                        </div>
                        <div class="cont_text_area">
                            <div class="cont_text_header">Note from the owner</div>
                            <div class="cont_text_main_area">
                                <?php echo $owner_note;?>
                            </div>
                        </div>
                    </div>
                    <!--contact information area end-->
				</div>
            </div>
        </div>
    </div>
</section>
<!-- page template part end -->

<?php require_once("footer.php");?>