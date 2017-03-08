<?php
/*
Template Name: Payment Submits
*/

$dbh2 = mysql_connect('localhost', 'a2zbackupdb', 'a2zonline@123', true); 

mysql_select_db('admin_backup', $dbh2);

get_template_part("lib/fallback.home.lib");

/**
*	Get Current page object
**/
global $post;
$page = get_page($post->ID);

/**
*	Get current page id
**/
if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Get page Sidebar
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);
if(empty($page_sidebar))
{
	$page_sidebar = 'Page Sidebar';
}

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

if(!isset($hide_header) OR !$hide_header)
{
?>	
</div>

<?php
	if(has_post_thumbnail($current_page_id, 'full'))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        $pp_page_bg = $image_thumb[0];
?>
<style>
.page_caption { background: #f9f9f9 url('<?php echo $pp_page_bg; ?>') center center no-repeat; background-size: cover; }
</style>
<?php
	}
?>

<?php 
if(!is_front_page())
{
?>
<!--<div class="page_caption">
	<div class="caption_inner">
		<div class="caption_header">
			<h1 <?php if(!empty($pp_page_bg)) { ?>class="withbg"<?php } ?>><span><?php the_title(); ?></span></h1>
			<?php
			$page_description = get_post_meta($current_page_id, 'page_description', true);
			
			if(!empty($page_description))
			{
			?>
			    <div class="page_description<?php if(!empty($pp_page_bg)) { ?> withbg<?php } ?>"><?php echo $page_description; ?></div>
			<?php
			}
			?>
		</div>
	</div>
	
	<hr class="hr_page_caption"/>
</div>-->
<br class="clear"/>

<!-- Begin content -->
<div id="content_wrapper">

    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    	<div class="standard_wrapper">
<?php
}

} //End is not front page
?>
<?php 
function set_html_content_type() {
	return 'text/html';
}
?>
	<?php if($_POST['payment_method']=='Paypal'){?>
		<?php 
		$msg.='<strong>Name:</strong>'.$_POST['user_name'].'<br>';
		$msg.='<strong>Product Name:</strong>'.$_POST['product_name'].'<br>';
                $msg.='<strong>Description:</strong>'.$_POST['description'].'<br>';
                $msg.='<strong>Address :</strong>'.$_POST['address1'].' '.$_POST['address2'].'<br>';
		$msg.='<strong>Email:</strong>'.$_POST['email'].'<br>';
                $msg.='<strong>Contact Number:</strong>'.$_POST['phone'].'<br>';
                $msg.='<strong>Total Project Value:</strong>'.$_POST['tpv'].'<br>';
		$msg.='<strong>Amount Payable Now:</strong>'.$_POST['amount'].'<br>';
		$msg.='<strong>Currency:</strong>'.$_POST['currency'].'<br>';
		//$_SESSION['payment_msg'] = $msg;
		update_option( 'payment_success_msg', $msg );
                update_option( 'payment_success_email', $_POST['email'] );
		add_filter( 'wp_mail_content_type', 'set_html_content_type' );
		//wp_mail('payments@a2zonlinesolution.org', 'Confirmation Mail from A2Z Online Solution ', $msg);
                //wp_mail( $_POST['email'] , 'Payment Information', $msg);
		?>
		<form id = "paypal_checkout" action = "https://www.paypal.com/cgi-bin/webscr" method = "post">
			<input name = "cmd" value = "_cart" type = "hidden">
			<input name = "upload" value = "1" type = "hidden">
			<input name = "no_note" value = "<?php echo $_POST['description'];?>" type = "hidden">
			<input name = "bn" value = "PP-BuyNowBF" type = "hidden">
			<input name = "tax" value = "0" type = "hidden">
			<input name = "rm" value = "2" type = "hidden">
		 
			<input name = "business" value = "payments@a2zonlinesolution.org" type = "hidden">
			<input name = "handling_cart" value = "0" type = "hidden">
			<input name = "currency_code" value = "<?php echo $_POST['currency'];?>" type = "hidden">
			
			<input name = "return" value = "<?php echo get_permalink( 6973 ); ?>" type = "hidden">
			
			<input name = "cancel_return" value = "<?php echo get_permalink( 7040); ?>" type = "hidden">
			<input name = "custom" value = "<?php echo $_POST['tpv'];?>" type = "hidden">
			<input name = "email" value = "<?php echo $_POST['email'];?>" type = "hidden">
			<input name = "night_phone_b" value = "<?php echo $_POST['phone'];?>" type = "hidden">
			<input name = "zip" value = "<?php echo $_POST['pincode'];?>" type = "hidden">
			<input name = "address1" value = "<?php echo $_POST['address1'];?>" type = "hidden">
			<input name = "address2" value = "<?php echo $_POST['address2'];?>" type = "hidden">
			<div id = "item_1" class = "itemwrap">
				<input name = "item_name_1" value = "<?php echo $_POST['product_name'];?>" type = "hidden">
				<input name = "quantity_1" value = "1" type = "hidden">
				<input name = "amount_1" value = "<?php echo $_POST['amount'];?>" type = "hidden">
				<input name = "shipping_1" value = "0" type = "hidden">
			</div>
				 
			<input id = "ppcheckoutbtn" value = "Checkout" class = "button" type = "submit">
		</form>
		<?php } ?>

		<?php if($_POST['payment_method']=='Visa'){?>
		<?php 
		$msg.='<strong>Name:</strong>'.$_POST['user_name'].'<br>';
		$msg.='<strong>Product Name:</strong>'.$_POST['product_name'].'<br>';
        $msg.='<strong>Description:</strong>'.$_POST['description'].'<br>';
        $msg.='<strong>Address :</strong>'.$_POST['address1'].' '.$_POST['address2'].'<br>';
		$msg.='<strong>Email:</strong>'.$_POST['email'].'<br>';
        $msg.='<strong>Contact Number:</strong>'.$_POST['phone'].'<br>';
        $msg.='<strong>Total Project Value:</strong>'.$_POST['tpv'].'<br>';
		$msg.='<strong>Amount Payable Now:</strong>'.$_POST['amount'].'<br>';
		
		$invoice_start = 'WIN';
		$invoice_number = '35740';
				
		$sql_already = "select * from `wp_windowspremium_buyer_info` order by id desc limit 0,1";
		$exe_already = mysql_query($sql_already) or die(mysql_error());
		$num_already = mysql_num_rows($exe_already);
		if($num_already>0)
		{
			$fetch_already = mysql_fetch_array($exe_already);
			$new_invoice_number = $fetch_already['invoice_number']+1;
			$invoice_id = $invoice_start.$new_invoice_number;
		}
		else
		{
			$invoice_start = 'WIN';
			$new_invoice_number = $invoice_number;
			$invoice_id = $invoice_start.$invoice_number;
		}
		
		mysql_query("insert into `wp_windowspremium_buyer_info` set name = '".$_POST['user_name']."',product_name = '".$_POST['product_name']."',description = '".$_POST['description']."',project_value = '".$_POST['tpv']."',payable_amount = '".$_POST['amount']."',currency = '".$_POST['currency']."',address1 = '".$_POST['address1']."',address2='".$_POST['address2']."',zip = '".$_POST['pincode']."',email = '".$_POST['email']."',phone = '".$_POST['phone']."',ip_address = '".$_SERVER['REMOTE_ADDR']."',post_date = '".date('Y-m-d H:i:s',time())."',`comes_from` = 'windowspremiumservices',invoice_number = '".$new_invoice_number."',invoice_id = '".$invoice_id."'", $dbh2); 

                update_option( 'payment_success_msg', $msg );
                update_option( 'payment_success_email', $_POST['email'] );

		add_filter( 'wp_mail_content_type', 'set_html_content_type' );
		//wp_mail('payments@a2zonlinesolution.org', 'Confirmation Mail from A2Z Online Solution ', $msg);
                //wp_mail( $_POST['email'] , 'Payment Information', $msg);
		?>
		<form id="ShoppingForm" action="https://paypage.ipay.com/" method="POST" name="ShoppingForm">
		<input type="hidden" id="BILLING_ID" name="BILLING_ID" value="0GLD17B4LYGTJPK0009">
		<input type="hidden" id="AMOUNT" name="AMOUNT" value="<?php echo $_POST['amount'];?>">
		<input type="hidden" id="CURRENCY_CODE" name="CURRENCY_CODE" value="<?php echo $_POST['currency'];?>">
		<input id="ADDRESS" type="hidden" name="ADDRESS" value="<?php echo $_POST['address1'].' '.$_POST['address2'];?>">
		<input id="POSTAL_CODE" type="hidden" name="POSTAL_CODE" value="<?php echo $_POST['pincode'];?>">
		<input id="EMAIL_ADDRESS" type="hidden" name="EMAIL_ADDRESS" value="<?php echo $_POST['email'];?>">
		<input id="SHIP_PHONE" type="hidden" name="SHIP_PHONE" value="<?php echo $_POST['phone'];?>">
		<input id="Submit1" type="submit" id = "ppcheckoutbtn" value = "Checkout" class = "button" name="Submit1">
		</form>
		<?php } ?>
		
			<br class="clear"/>
					
			
				
		</div>
	</div>
	<!-- End main content -->
	<br class="clear"/>
				
</div>
			
<?php 
if(!isset($hide_header) OR !$hide_header OR is_null($hide_header))
{
?>			

<?php get_footer(); ?>

<?php
}
?>