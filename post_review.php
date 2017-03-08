<?php
//POST TESTIMONIAL
if(isset($_POST['review_send']))
{
	//print_r($_POST);
	//exit;
	if($_POST['response_id'] == "")
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
	}
	else
	{
		$sender_image_insert = 'http://graph.facebook.com/'.$_POST['response_id'].'/picture?type=large';
	}
	
	if($_POST['response_id'] == "")
	{
		$sql_insert = "INSERT INTO `ml_testimonials` SET `sender_name` = '".addslashes($_POST['name'])."',`sender_email` = '".addslashes($_POST['email'])."',`sender_city` = '".addslashes($_POST['city'])."',`sender_comments` = '".addslashes($_POST['comments'])."',`sender_image` = '".$sender_image_insert."',`testimonial_status` = 'Inactive',`post_date` = '".date('Y-m-d H:i:s')."',`sender_type` = 'General'";
	}
	else
	{
		$sql_insert = "INSERT INTO `ml_testimonials` SET `sender_name` = '".addslashes($_POST['name'])."',`sender_email` = '".addslashes($_POST['email'])."',`sender_city` = '".addslashes($_POST['city'])."',`sender_comments` = '".addslashes($_POST['comments'])."',`sender_image` = '".$sender_image_insert."',`testimonial_status` = 'Inactive',`post_date` = '".date('Y-m-d H:i:s')."',`sender_type` = 'Facebook'";
	}
	$exe_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
	
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
<input type="hidden" name="response_id" id="response_id" value="" />
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
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $fbname;?>">
        </div>

        <div class="contact_field">
            <div class="contact_text">Your Email <font color="#FF0000">*</font></div>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo $fbemail;?>">
        </div>

        <div class="contact_field">
            <div class="contact_text">Your Suburb <font color="#FF0000">*</font></div>
            <input type="text" class="form-control" id="city" name="city">
        </div>
        
        <div class="contact_field">
            <div class="contact_text">Your Photo</div>
                <input type="file" class="" id="sender_image" name="sender_image">
            	<span id="fb_image" style="display:none;"><img src="" id="profileImage" /></span>
        </div>

        <div class="contact_field">
            <div class="contact_text">Your Comment <font color="#FF0000">*</font></div>
            <textarea name="comments" id="comments" cols="" rows="" class="form-control" style="width:100%; height:150px; resize:none;"></textarea>
        </div>

        <div class="contact_field2">
            <input type="image" src="<?php echo SITE_URL;?>img/submit_btn.jpg">
        </div>
        <div>&nbsp;</div>
        <div class="contact_field2">
            Leave a comment via Facebook&nbsp;&nbsp;<fb:login-button scope="public_profile,email,user_friends" onlogin="checkLoginState();"></fb:login-button>
        </div>
    </div>
</div>
</form>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      //document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      //document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1669952783274041',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=name,email', function(response) {
		console.log(response);
      console.log('Successful login for: ' + response.name);
		$('#name').val(response.name);
		$('#email').val(response.email);
		$('#response_id').val(response.id);
		document.getElementById("profileImage").setAttribute("src", "http://graph.facebook.com/" + response.id + "/picture?type=large");
		$('#fb_image').show();
		$('#sender_image').hide();
    });
  }
</script>