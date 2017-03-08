<?php require_once("header.php");?>

<?php
if(isset($_POST['send']))
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
					<td width="70%">'.stripslashes($_POST['c_name']).'</td>
				</tr>
				<tr>
					<td>Email : </td>
					<td>'.stripslashes($_POST['c_email']).'</td>
				</tr>
				<tr>
					<td>Contact No : </td>
					<td>'.stripslashes($_POST['c_phone']).'</td>
				</tr>
				<tr>
					<td valign="top">Comments : </td>
					<td>'.nl2br(stripslashes($_POST['c_comments'])).'</td>
				</tr>
				</table>';
	$headers = "From: ".$_POST['c_name']."<".stripslashes($_POST['c_email']).">" . "\r\n" .
	"Reply-To: ".stripslashes($_POST['c_email'])."" . "\r\n" .
	"X-Mailer: PHP/" . phpversion();
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($contact_email,$subject,$message,$headers);
	
	$_SESSION['msg_succ'] = 'Thank you. Your information has been successfully mailed to administrator.';
	header("location: ".SITE_URL."contact-us/");
	exit;
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
   	if(document.getElementById('c_name').value == "")
    {
		alert("Please enter name");
		document.getElementById('c_name').focus();
		return false;
    }
	
   	if(document.getElementById('c_email').value == "")
    {
		alert("Please enter email");
		document.getElementById('c_email').focus();
		return false;
    }
   
	if(echeck(document.getElementById('c_email').value)==false){
		document.getElementById('c_email').focus();
		return false;
	}
	
   	if(document.getElementById('c_phone').value == "")
    {
		alert("Please enter contact no.");
		document.getElementById('c_phone').focus();
		return false;
    }
	
    if(document.getElementById('c_comments').value == "")
    {
		alert("Please enter comments");
		document.getElementById('c_comments').focus();
		return false;
    }
	
	return true;
}
</script>

<!--content area start-->
<section class="body_content">
	<div class="container">
		<div class="row">
			<div class="contact_section clearfix wow fadeInDown" data-wow-duration="2s">
           		<div class="title_box col-lg-12">
            		<h1 class="">Contact Us</h1>
          		</div>
				<!--enquiry form area start-->
            	<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
              		<div class="contact_form"> 
						<span class="change_color_1 change_font">Inquiry Now</span>
						<?php if(isset($_SESSION['msg_succ'])) { ?>
							<div style="color:#006600; margin-bottom:10px; font-size:15px; text-align:center;"><?php echo $_SESSION['msg_succ'];?></div>
						<?php
						unset($_SESSION['msg_succ']);
						}
						?>
                		<form action="" method="post" role="form" class="form-horizontal" onSubmit="return validenq();">
                  		<div class="form-group">
                    		<label class="col-sm-4" for="inputName">Your Name <font color="#FF0000">*</font></label>
                    		<div class="col-sm-8">
                      			<input type="text" class="form-control" name="c_name" id="c_name">
                    		</div>
                  		</div>
                  		<div class="form-group">
                    		<label class="col-sm-4" for="inputEmail">Your Email <font color="#FF0000">*</font></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="c_email" id="c_email">
							</div>
                  		</div>
                  		<div class="form-group">
                    		<label class="col-sm-4" for="inputMobile">Contact Number <font color="#FF0000">*</font></label>
                    		<div class="col-sm-8">
                      			<input type="text" class="form-control" name="c_phone" id="c_phone">
                    		</div>
                  		</div>
                  		<div class="form-group">
                    		<label class="col-sm-4" for="TextArea">Comments <font color="#FF0000">*</font></label>
                    		<div class="col-sm-8">
                      			<textarea class="form-control" name="c_comments" id="c_comments"></textarea>
                    		</div>
                  		</div>
                  		<div class="form-group">
                    		<div class="col-sm-12">
                     			<button type="submit" class="btn btn-default custom_btn hvr-sweep-to-right">Submit</button>
                    		</div>
                  		</div>
						<input type="hidden" name="send" value="1" />
                		</form>
              		</div>
            	</div>
				<!--enquiry form area end-->
            
            	<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
              		<div class="address_section">
						<!--contact area start -->
						<span class="change_color_1 change_font contact_details"><?php echo $company_name;?></span>
						<div class="contact_data">
							<address><?php echo $contact_address;?></address>
							<span class="ph_ico"><a href="tel:<?php echo str_replace(' ','',$mobile_no1);?>"><?php echo $mobile_no1;?></a> / <a href="tel:<?php echo str_replace(' ','',$mobile_no2);?>"><?php echo $mobile_no2;?></a></span> 
							<span class="mail_ico"><a href="mailto:<?php echo $contact_email;?>"><?php echo $contact_email;?></a></span> 
						</div>
						<!--contact area end -->
						
						<!--map area start-->
                		<div class="map_section">
                			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13006.407827682036!2d149.08008237932663!3d-35.415115646566996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b163547e7425eaf%3A0x500ea6ea7695a00!2sMonash+ACT+2904%2C+Australia!5e0!3m2!1sen!2sin!4v1450163506697"  frameborder="0" style="border:0; height:202px; width:100%;" allowfullscreen></iframe>
                		</div>
						<!--map area end-->
              		</div>
            	</div>
			</div>
		</div>
	</div>
</section>
<!--content area end-->

<?php require_once("footer.php");?>