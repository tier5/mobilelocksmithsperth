<?php
require_once("header_home.php");

//CODE FOR LOGIN
if(isset($_POST['login']))
{
	$sql_check = "SELECT * FROM `ml_administrator` WHERE `admin_username` = '".$_POST['username']."' AND `admin_password` = '".md5($_POST['password'])."'";
	$exe_check = mysqli_query($conn, $sql_check) or die(mysqli_error());
	$num_check = mysqli_num_rows($exe_check); 
	if($num_check>0)
	{
		$arr_check = mysqli_fetch_array($exe_check);
		$_SESSION['LOGIN_ID'] = $arr_check['admin_id'];
		header("location: dashboard.php");
	}
	else
	{
		$_SESSION['login_fail_msg'] = 'Incorrect login credentials. Please try again!';
		header("location: index.php");
		exit;
	}
}
?>

<div class="loginBox">        
    <div class="loginHead">
        <img src="img/logo.png" alt="" title=""/>
    </div>
    <form class="form-horizontal" action="" method="POST">  
		<?php if(isset($_SESSION['login_fail_msg'])) { ?>
            <div class="alert alert-error">                
            <b><?php echo $_SESSION['login_fail_msg'];?></b>
            </div> 
        <?php
        unset($_SESSION['login_fail_msg']);
        }
        ?>
        <div class="control-group">
            <label for="inputEmail">Username</label>                
            <input type="text" id="inputEmail" name="username"/>
        </div>
        <div class="control-group">
            <label for="inputPassword">Password</label>                
            <input type="password" id="inputPassword" name="password"/>                
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-block" name="login">Login</button>
        </div>
    </form>        
</div>   

<?php require_once("footer.php"); ?>