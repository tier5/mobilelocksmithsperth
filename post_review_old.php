<?php
if(isset($_POST['review_send']))
{
	//UPLOAD IMAGE
	if($_FILES['sender_image']['name']!="")
	{	
		$photopath = pathinfo($_FILES['sender_image']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['sender_image']['tmp_name'];
		$sender_image = time().".".$extension;
		$sender_image_insert = time().$extension.".".$extension;
		chmod("uploads/testimonial/",0777);
		
		$foo = new Upload($_FILES['sender_image']);
		if ($foo->uploaded) 
		{
			 // save uploaded image with a new name
			  $foo->file_new_name_body = $sender_image;
			  $foo->Process("uploads/testimonial/");
			  if ($foo->processed) 
			  {
			  } 
			  else 
			  {
				$msg = $foo->error;
				$valid = 0;
			  }
	
			 // save uploaded image with a new name,
			 // resized to small //
			 $foo->file_new_name_body			= $sender_image;
			 $foo->image_resize			   	 	= true;
			 $foo->image_ratio_fill		    	= false;
			 $foo->image_ratio_crop  	    	= false;
			 $foo->image_y						= "163";
			 $foo->image_x						= "171";
			 $foo->image_background_color 		= '#FFFFFF';
			 $foo->Process("uploads/testimonial/thumb/");
			 $foo->processed;
		}
	}
	else
	{
		$sender_image_insert = '';
	}

	$sql_insert = "INSERT INTO `ml_testimonials` SET `sender_name` = '".addslashes($_POST['name'])."',`sender_email` = '".addslashes($_POST['email'])."',`sender_city` = '".addslashes($_POST['city'])."',`sender_comments` = '".addslashes($_POST['comments'])."',`sender_image` = '".$sender_image_insert."',`testimonial_status` = 'Inactive',`post_date` = '".date('Y-m-d H:i:s')."'";
	//echo $sql_insert;exit;
	$exe_insert = mysql_query($sql_insert) or die(mysql_error());
	
	$_SESSION['msg_succr'] = 'Your comment will display after admin approval.';
	header("location: ".$_SERVER['REQUEST_URI']);
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

function validrev()
{
   	if(document.getElementById('name').value == "")
    {
		alert("Please enter name");
		document.getElementById('name').focus();
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
	
	if(document.getElementById('city').value == "")
	{
		alert("Please enter suburb");
		document.getElementById('city').focus();
		return false;
	}
	
    if(document.getElementById('comments').value == "")
    {
		alert("Please enter comment");
		document.getElementById('comments').focus();
		return false;
    }
	
	return true;
}
</script>

<form action="" method="post" enctype="multipart/form-data" onSubmit="return validrev();">
<input type="hidden" name="review_send" id="review_send" value="1">
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="review_reply_container">
        <div class="review_reply_header">Leave A Reply</div>
		<?php if(isset($_SESSION['msg_succr'])) { ?>
            <div style="color:#006600; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin-bottom:5px; text-align:center;"><?php echo $_SESSION['msg_succr'];?></div>
        <?php
        unset($_SESSION['msg_succr']);
        }
        ?>
        
        <div class="contact_field">
            <div class="contact_text">Your Name <font color="#FF0000">*</font></div>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="contact_field">
            <div class="contact_text">Your Email <font color="#FF0000">*</font></div>
            <input type="text" class="form-control" id="email" name="email">
        </div>

        <div class="contact_field">
            <div class="contact_text">Your Suburb <font color="#FF0000">*</font></div>
            <input type="text" class="form-control" id="city" name="city">
        </div>
        
        <div class="contact_field">
            <div class="contact_text">Your Photo</div>
            <input type="file" class="" id="sender_image" name="sender_image">
        </div>

        <div class="contact_field">
            <div class="contact_text">Your Comment <font color="#FF0000">*</font></div>
            <textarea name="comments" id="comments" cols="" rows="" class="form-control" style="width:100%; height:150px; resize:none;"></textarea>
        </div>

        <div class="contact_field2">
            <input type="image" src="<?php echo SITE_URL;?>img/submit_btn.jpg">
        </div>

		</div>
        <div>&nbsp;</div>
        <div style="text-align:right;">
            <img src="<?php echo SITE_URL;?>img/fblogin.png" alt="" border="0">
        </div>

</div>
</form>