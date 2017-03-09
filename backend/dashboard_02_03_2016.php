<?php 
require_once("header.php");
require_once("session_check.php");

//FETCH DATA FROM DATABASE
$fetch_record = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `ml_administrator` WHERE `admin_id` = '".$_SESSION['LOGIN_ID']."'"));
$no_of_visitors = $fetch_record['no_of_visitors'];
?>

<?php require_once("left_panel.php");?>
<div class="content">
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12" style="text-align: center; margin-top: 20px;">
                    <div>Welcome to administrator panel... </div>
                    <div>Please use navigation menu to access administrative departments.</div>
                    <div style="height:30px">&nbsp;</div>
                    <div><h3>Total No. of  Visitors - <?php echo $no_of_visitors;?></h3></div>
                </div>
            </div>
        </div>
</div>

<?php require_once("footer.php"); ?>