<?php 
require_once("header.php");
require_once("session_check.php");

//CODE FOR CHANGE PASSWORD
if(isset($_POST['cp']))
{
	$sql_check = "SELECT * FROM `ml_administrator` WHERE `admin_password` = '".md5($_POST['old_password'])."' AND `admin_id` = '".$_SESSION['LOGIN_ID']."'";
	$exe_check = mysqli_query($conn, $sql_check) or die(mysqli_error());
	$num_check = mysqli_num_rows($exe_check);
	if($num_check>0)
	{
		$sql_update = "UPDATE `ml_administrator` SET `admin_password` = '".md5($_POST['confirm_password'])."',`admin_original_password` = '".$_POST['confirm_password']."' WHERE `admin_id` = '".$_SESSION['LOGIN_ID']."'";
		$exe_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
		
		$_SESSION['cp_succ_msg'] = 'Password changed successfully.';
		header("location: change_password.php");
		exit;
	}
	else
	{
		$_SESSION['cp_fail_msg'] = 'Old password not found in database.';
		header("location: change_password.php");
		exit;
	}
}
?>

<script language="javascript" type="text/javascript">
function frm_validation()
{
	if(document.getElementById('old_password').value == '')
	{
		alert("Please enter old password");
		document.getElementById('old_password').focus();
		return false;
	}
	
	if(document.getElementById('new_password').value == '')
	{
		alert("Please enter new password");
		document.getElementById('new_password').focus();
		return false;
	}
	
	if(document.getElementById('confirm_password').value == '')
	{
		alert("Please enter confirm password");
		document.getElementById('confirm_password').focus();
		return false;
	}
	
	if(document.getElementById('confirm_password').value != document.getElementById('new_password').value)
	{
		alert("New password and confirm password both should be same");
		document.getElementById('confirm_password').focus();
		return false;
	}
}
</script>

<?php require_once("left_panel.php");?>
<div class="content">
        <div class="workplace">
        	<?php if(isset($_SESSION['cp_succ_msg'])) { ?>
            <div class="alert alert-success">                
            <b><?php echo $_SESSION['cp_succ_msg'];?></b>
            </div> 
			<?php
            unset($_SESSION['cp_succ_msg']);
            }
            ?>
            
            <?php if(isset($_SESSION['cp_fail_msg'])) { ?>
                <div class="alert alert-error">                
                <b><?php echo $_SESSION['cp_fail_msg'];?></b>
                </div> 
            <?php
            unset($_SESSION['cp_fail_msg']);
            }
            ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-archive"></div>
                        <h1>Change Password</h1>
                    </div>
                    <form action="" method="post" onsubmit="return frm_validation();">
                    <div class="block-fluid">                        
                        <div class="row-form clearfix">
                            <div class="span3">Old Password <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="password" name="old_password" id="old_password" /></div>
                        </div> 
                        <div class="row-form clearfix">
                            <div class="span3">New Password <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="password" name="new_password" id="new_password" /></div>
                        </div>                         
                        <div class="row-form clearfix">
                            <div class="span3">Confirm Password <font color="#FF0000">*</font></div>
                            <div class="span9"><input type="password" name="confirm_password" id="confirm_password" /></div>                            
                        </div> 
                        <div class="row-form clearfix">
                            <div class="span3">&nbsp;</div>
                            <div class="span9"><button class="btn" type="submit" name="cp">Save</button></div>
                        </div>                                                  
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div>   

<?php require_once("footer.php"); ?>