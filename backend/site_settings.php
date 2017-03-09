<?php 
require_once("header.php");
require_once("session_check.php");

//CODE FOR UPDATE SETTINGS
if(isset($_POST['save']))
{
	//UPLOAD OWNER IMAGE
	if($_FILES['owner_image']['name']!="")
	{	
		unlink("../uploads/content/".$_POST['hid_owner_image']);
	
		$photopath = pathinfo($_FILES['owner_image']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['owner_image']['tmp_name'];
		$owner_image = time().".".$extension;
		$destination = "../uploads/content/".$owner_image;
		move_uploaded_file($source,$destination);
	}
	else
	{
		$owner_image = $_POST['hid_owner_image'];
	}
	
	//UPLOAD SERVICE IMAGE
	if($_FILES['service_image']['name']!="")
	{	
		unlink("../uploads/content/".$_POST['hid_service_image']);
	
		$photopath = pathinfo($_FILES['service_image']['name']);
		$extension = $photopath['extension'];
		$source = $_FILES['service_image']['tmp_name'];
		$service_image = time().".".$extension;
		$destination = "../uploads/content/".$service_image;
		move_uploaded_file($source,$destination);
	}
	else
	{
		$service_image = $_POST['hid_service_image'];
	}	
	
	$sql_update = "UPDATE `ml_administrator` SET `admin_username` = '".addslashes($_POST['admin_username'])."',`company_name` = '".addslashes($_POST['company_name'])."',`contact_address` = '".addslashes($_POST['contact_address'])."',`contact_email` = '".addslashes($_POST['contact_email'])."',`contact_no` = '".addslashes($_POST['contact_no'])."',`abn_no` = '".addslashes($_POST['abn_no'])."',`owner_name_black` = '".addslashes($_POST['owner_name_black'])."',`owner_name_red` = '".addslashes($_POST['owner_name_red'])."',`owner_note` = '".addslashes($_POST['owner_note'])."',`owner_image` = '".$owner_image."',`banner_caption_tagline` = '".addslashes($_POST['banner_caption_tagline'])."',`gallery_text` = '".addslashes($_POST['gallery_text'])."',`facebook_link` = '".addslashes($_POST['facebook_link'])."',`gplus_link` = '".addslashes($_POST['gplus_link'])."',`youtube_link` = '".addslashes($_POST['youtube_link'])."',`service_image` = '".$service_image."' WHERE `admin_id` = '".$_SESSION['LOGIN_ID']."'";
	$exe_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
	
	$_SESSION['save_succ_msg'] = 'Site settings updated successfully.';
	header("location: site_settings.php");
	exit;
}

//FETCH DATA FROM DATABASE
$fetch_record = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `ml_administrator` WHERE `admin_id` = '".$_SESSION['LOGIN_ID']."'"));
$admin_username = stripslashes($fetch_record['admin_username']);
$company_name = stripslashes($fetch_record['company_name']);
$contact_address = stripslashes($fetch_record['contact_address']);
$contact_email = stripslashes($fetch_record['contact_email']);
$contact_no = stripslashes($fetch_record['contact_no']);
$abn_no = stripslashes($fetch_record['abn_no']);

$owner_name_black = stripslashes($fetch_record['owner_name_black']);
$owner_name_red = stripslashes($fetch_record['owner_name_red']);
$owner_image = stripslashes($fetch_record['owner_image']);
$owner_note = stripslashes($fetch_record['owner_note']);

$banner_caption_tagline = stripslashes($fetch_record['banner_caption_tagline']);
$gallery_text = stripslashes($fetch_record['gallery_text']);

$facebook_link = stripslashes($fetch_record['facebook_link']);
$gplus_link = stripslashes($fetch_record['gplus_link']);
$youtube_link = stripslashes($fetch_record['youtube_link']);

$service_image = stripslashes($fetch_record['service_image']);
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
		   alert("Invalid Email Address")
		   return false;
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Invalid Email Address")
		   return false;
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Invalid Email Address")
		    return false;
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Invalid Email Address")
		    return false;
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Invalid Email Address")
		    return false;
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Invalid Email Address")
		    return false;
		 }

		 if (str.indexOf(" ")!=-1){
		    alert("Invalid Email Address")
		    return false;
		 }
 		 return true;					
}

function frm_validation()
{
	if(document.getElementById('admin_username').value == '')
	{
		alert("Please enter admin username");
		document.getElementById('admin_username').focus();
		return false;
	}
	
	if(document.getElementById('company_name').value == '')
	{
		alert("Please enter company name");
		document.getElementById('company_name').focus();
		return false;
	}
	
	if(document.getElementById('contact_address').value == '')
	{
		alert("Please enter company address");
		document.getElementById('contact_address').focus();
		return false;
	}
	
	if(document.getElementById('contact_email').value == '')
	{
		alert("Please enter contact email");
		document.getElementById('contact_email').focus();
		return false;
	}
	
    if(echeck(document.getElementById('contact_email').value)==false)
    {
	    document.getElementById('contact_email').focus();
		return false;
    }
	
	if(document.getElementById('contact_no').value == '')
	{
		alert("Please enter contact no.");
		document.getElementById('contact_no').focus();
		return false;
	}
	
	if(document.getElementById('abn_no').value == '')
	{
		alert("Please enter abn no.");
		document.getElementById('abn_no').focus();
		return false;
	}
	
	if(document.getElementById('owner_name_black').value == '')
	{
		alert("Please enter owner name in black font");
		document.getElementById('owner_name_black').focus();
		return false;
	}
	
	if(document.getElementById('owner_name_red').value == '')
	{
		alert("Please enter owner name in red font");
		document.getElementById('owner_name_red').focus();
		return false;
	}
	
	if(document.getElementById('owner_note').value == '')
	{
		alert("Please enter owner note");
		document.getElementById('owner_note').focus();
		return false;
	}
	
	if(document.getElementById('banner_caption_tagline').value == '')
	{
		alert("Please enter banner caption tagline");
		document.getElementById('banner_caption_tagline').focus();
		return false;
	}
	
	if(document.getElementById('gallery_text').value == '')
	{
		alert("Please enter gallery text");
		document.getElementById('gallery_text').focus();
		return false;
	}

	if(document.getElementById('facebook_link').value == '')
	{
		alert("Please enter facebook link");
		document.getElementById('facebook_link').focus();
		return false;
	}
	
	if(document.getElementById('gplus_link').value == '')
	{
		alert("Please enter google plus link");
		document.getElementById('gplus_link').focus();
		return false;
	}
	
	if(document.getElementById('youtube_link').value == '')
	{
		alert("Please enter youtube link");
		document.getElementById('youtube_link').focus();
		return false;
	}
}
</script>

<?php require_once("left_panel.php");?>
<div class="content">
        <div class="workplace">
        	<?php if(isset($_SESSION['save_succ_msg'])) { ?>
            <div class="alert alert-success">                
            <b><?php echo $_SESSION['save_succ_msg'];?></b>
            </div> 
			<?php
            unset($_SESSION['save_succ_msg']);
            }
            ?>
            <div class="row-fluid">
                <div class="span12">
                	<form action="" method="post" enctype="multipart/form-data" onsubmit="return frm_validation();">
                    <input type="hidden" name="hid_owner_image" id="hid_owner_image" value="<?php echo $owner_image;?>" />
                    <input type="hidden" name="hid_service_image" id="hid_service_image" value="<?php echo $service_image;?>" />
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <h1>Site Settings</h1>
                    </div>
                    <div class="block-fluid">
                    	<div class="row-form clearfix">
                            <div class="span3">Admin Username <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="admin_username" id="admin_username" value="<?php echo $admin_username;?>" /></div>
                        </div>
                    	<div class="row-form clearfix">
                            <div class="span3">Company Name <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="company_name" id="company_name" value="<?php echo $company_name;?>" /></div>
                        </div>
                    	<div class="row-form clearfix">
                            <div class="span3">Contact Address <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="contact_address" id="contact_address" value="<?php echo $contact_address;?>" /></div>
                        </div>
                    	<div class="row-form clearfix">
                            <div class="span3">Contact Email <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="contact_email" id="contact_email" value="<?php echo $contact_email;?>" /></div>
                        </div>
                    	<div class="row-form clearfix">
                            <div class="span3">Contact No. <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="contact_no" id="contact_no" value="<?php echo $contact_no;?>" /></div>
                        </div>
                    	<div class="row-form clearfix">
                            <div class="span3">ABN No. <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="abn_no" id="abn_no" value="<?php echo $abn_no;?>" /></div>
                        </div>
                   	</div>
                    <div>&nbsp;</div>
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <h1>Company Owner Details</h1>
                    </div>
                    <div class="block-fluid">                        
                        <div class="row-form clearfix">
                            <div class="span3">Owner Name in Black Font <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="owner_name_black" id="owner_name_black" value="<?php echo $owner_name_black;?>" /></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Owner Name in Red Font <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="owner_name_red" id="owner_name_red" value="<?php echo $owner_name_red;?>" /></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Owner Photo <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="file" name="owner_image" id="owner_image" /><br />
                               <img src="../uploads/content/<?php echo $owner_image;?>" border="0" alt="" />                       
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Owner Note <font color="#FF0000">*</font></div>
                            <div class="span9"><textarea name="owner_note" id="owner_note"><?php echo $owner_note;?></textarea></div>                            
                        </div>
                    </div>
                    <div>&nbsp;</div>
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <h1>Banner Caption Tagline</h1>
                    </div>
                    <div class="block-fluid">                        
                        <div class="row-form clearfix">
                            <div class="span3">Text <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="banner_caption_tagline" id="banner_caption_tagline" value="<?php echo $banner_caption_tagline;?>" /></div>
                        </div>
                    </div>
                    <div>&nbsp;</div>
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <h1>Gallery Text</h1>
                    </div>
                    <div class="block-fluid">                        
                        <div class="row-form clearfix">
                            <div class="span3">Text <font color="#FF0000">*</font></div>
                            <div class="span9"><textarea name="gallery_text" id="gallery_text"><?php echo $gallery_text;?></textarea></div>
                        </div>
                    </div>
                    <div>&nbsp;</div>
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <h1>Service Photo For Homepage</h1>
                    </div>
                    <div class="block-fluid">                        
                        <div class="row-form clearfix">
                            <div class="span3">Photo <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="file" name="service_image" id="service_image" /><br />
                               <img src="../uploads/content/<?php echo $service_image;?>" border="0" alt="" /></div>  
                        </div>
                    </div>
                    <div>&nbsp;</div>
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <h1>Social Media Settings</h1>
                    </div>
                    <div class="block-fluid">                        
                        <div class="row-form clearfix">
                            <div class="span3">Facebook Link <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="facebook_link" id="facebook_link" value="<?php echo $facebook_link;?>" /></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Google Plus Link <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="gplus_link" id="gplus_link" value="<?php echo $gplus_link;?>" /></div>                            
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Youtube Link <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="text" name="youtube_link" id="youtube_link" value="<?php echo $youtube_link;?>" /></div>                            
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">&nbsp;</div>
                            <div class="span9"><button class="btn" type="submit" name="save">Save</button></div>
                        </div>  
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div>   

<?php require_once("footer.php"); ?>