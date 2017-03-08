<?php require_once("header.php");?>

<!-- page template part start -->
<section>
    <div class="body_content">
        <div class="container">
            <div class="in_service_header">Product <span>Gallery</span></div>
        	<div class="gall_text_container">
        		<?php echo $gallery_text;?>
        	</div>
      		<div class="product_container">
     			<div class="row">
				<?php
				$gallery_counter = 1;
                $sql_gallery = "SELECT * FROM `ml_gallery` WHERE `gallery_status` = 'Active'";
                $exe_gallery = mysqli_query($conn, $sql_gallery) or die(mysqli_error());
                $num_gallery = mysqli_num_rows($exe_gallery);
                if($num_gallery>0)
                {
                    while($arr_gallery = mysqli_fetch_array($exe_gallery))
                    {
                        ?>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 no-pad-left">
                            <div class="gall_container">
                                <div class="gall_container2"><img src="<?php echo SITE_URL;?>uploads/gallery/thumb/<?php echo stripslashes($arr_gallery['gallery_image']);?>" alt="" /></div>
                                <div class="gall_img_name">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="82%" align="left" valign="middle" class="gall_img_name2"><?php echo stripslashes($arr_gallery['gallery_name']);?></td>
                                            <td width="18%" height="48" align="right" valign="middle" class="gall_zoom_icon"><a href="<?php echo SITE_URL;?>download.php?file=<?php echo SITE_URL;?>uploads/gallery/pdf/<?php echo stripslashes($arr_gallery['gallery_pdf']);?>">more<br>info</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
						if($gallery_counter%4 == 0)
						{
							echo '</div></div><div class="product_container"><div class="row">';
						}
						$gallery_counter++;
					}
				}
				?>
      
      			<!--partner area start-->
      			<div class="partner_container">
     				<div class="row"> 
					<?php
                    $sql_partners = "SELECT * FROM `ml_partners` WHERE `partner_status` = 'Active'";
                    $exe_partners = mysqli_query($sql_partners) or die(mysqli_error());
                    $num_partners = mysqli_num_rows($exe_partners);
                    if($num_partners>0)
                    {
                        while($arr_partners = mysqli_fetch_array($exe_partners))
                        {
                            ?>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad-left">
                                <div class="partner_area">
                                <?php if($arr_partners['partner_link']!="") { ?><a href="<?php echo $arr_partners['partner_link'];?>" target="_blank"><?php } ?><img src="<?php echo SITE_URL;?>uploads/partner/<?php echo stripslashes($arr_partners['partner_image']);?>" alt=""><?php if($arr_partners['partner_link']!="") { ?></a><?php } ?>
                                </div>
                            </div>
                            <?php
						}
					}
					?>
    			 	</div>
     		 	</div>
                <!--partner area end-->
        </div>
    </div>
</section>
<!-- page template part end -->

<?php require_once("footer.php");?>