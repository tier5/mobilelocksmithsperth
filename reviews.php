<?php require_once("header.php");?>

<!-- page template part start -->
<section>
    <div class="body_content">
        <div class="container">
            <div class="row">
                <div class="services_section clearfix">
                    <div class="in_service_header">Client <span>Reviews</span></div>
          			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    	<?php
						$adjacents = 3;
						$query = "SELECT COUNT(*) as `num` FROM `ml_testimonials` WHERE `testimonial_status` = 'Active'";
						$total_pages = mysql_fetch_array(mysql_query($query));
						$total_pages = $total_pages['num'];
                        if($total_pages>0)
                        {
							/* Setup vars for query. */
							$targetpage = SITE_URL."reviews/page";	//your file name  (the name of this file)
							$limit = $testimonial_records_per_page; 	//how many items to show per page
							$page = $_GET["page"];
							if($page) 
								$start = ($page - 1) * $limit; 			//first item to display on this page
							else
								$start = 0;								//if no page var is given, set start to 0
			
							/* Get data. */
							$sql_testimonial = "SELECT * FROM `ml_testimonials` WHERE `testimonial_status` = 'Active' ORDER BY `testimonial_id` DESC LIMIT $start, $limit";
							$result = mysql_query($sql_testimonial);
								
							if ($page == 0) $page = 1;					//if no page var is given, default to 1.
							$prev = $page - 1;							//previous page is page - 1
							$next = $page + 1;							//next page is page + 1
							$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
							$lpm1 = $lastpage - 1;						//last page minus 1
                            
                        /* 
                            Now we apply our rules and draw the pagination object. 
                            We're actually saving the code to a variable in case we want to draw it more than once.
                        */
                        $pagination = "";
                        if($lastpage > 1)
                        {	
                            $pagination .= "<div class=\"page_no_area\"><ul>";
                            
                            //pages	
                            if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
                            {	
                                for ($counter = 1; $counter <= $lastpage; $counter++)
                                {
                                    if ($counter == $page)
                                        $pagination.= "<li><a href=\"#\" class=\"page_nomain\">$counter</a></li>";
                                    else
                                        $pagination.= "<li><a href=\"$targetpage/$counter\">$counter</a></li>";					
                                }
                            }
                            elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
                            {
                                //close to beginning; only hide later pages
                                if($page < 1 + ($adjacents * 2))		
                                {
                                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                                    {
                                        if ($counter == $page)
                                            $pagination.= "<li><a href=\"#\" class=\"page_nomain\">$counter</a></li>";
                                        else
                                            $pagination.= "<li><a href=\"$targetpage/$counter\">$counter</a></li>";					
                                    }
                                    $pagination.= "...";
                                    $pagination.= "<li><a href=\"$targetpage/$lpm1\">$lpm1</a></li>";
                                    $pagination.= "<li><a href=\"$targetpage/$lastpage\">$lastpage</a></li>";		
                                }
                                //in middle; hide some front and some back
                                elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                                {
                                    $pagination.= "<li><a href=\"$targetpage/1\">1</a></li>";
                                    $pagination.= "<li><a href=\"$targetpage/2\">2</a></li>";
                                    $pagination.= "...";
                                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                                    {
                                        if ($counter == $page)
                                            $pagination.= "<li><a href=\"#\" class=\"page_nomain\">$counter</a></li>";
                                        else
                                            $pagination.= "<li><a href=\"$targetpage/$counter\">$counter</a></li>";					
                                    }
                                    $pagination.= "...";
                                    $pagination.= "<li><a href=\"$targetpage/$lpm1\">$lpm1</a></li>";
                                    $pagination.= "<li><a href=\"$targetpage/$lastpage\">$lastpage</a></li>";		
                                }
                                //close to end; only hide early pages
                                else
                                {
                                    $pagination.= "<li><a href=\"$targetpage/1\">1</a></li>";
                                    $pagination.= "<li><a href=\"$targetpage/2\">2</a></li>";
                                    $pagination.= "...";
                                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                                    {
                                        if ($counter == $page)
                                            $pagination.= "<li><a href=\"#\" class=\"page_nomain\">$counter</a></li>";
    
                                        else
                                            $pagination.= "<li><a href=\"$targetpage/$counter\">$counter</a></li>";					
                                    }
                                }
                            }
                            
                            $pagination.= "</ul></div>";	
                            }
                            while($arr_testimonials = mysql_fetch_array($result))
                            {
                            	?>
                                <div class="review_container">
                              		<div class="row">
                                        <div class="adjust1">
                                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                                                <div class="author_imgd">
												<?php if($arr_testimonials['sender_type'] =="General") { ?>
                                                <?php if($arr_testimonials['sender_image']!="") { ?>
                                                    <img class="img-responsive" src="<?php echo SITE_URL;?>uploads/testimonial/thumb/<?php echo $arr_testimonials['sender_image'];?>" alt="">
                                                    <?php } else { ?>
                                                    <img class="img-responsive" src="<?php echo SITE_URL;?>img/no_image.png" alt="">
                                                    <?php } ?>
                                                    <?php } else { ?>
                                                    <img src="<?php echo $arr_testimonials['sender_image'];?>" border="0" alt="" />
                                                    <?php } ?>
                                                </div>
                                       		</div>
                               				<div class=" col-lg-10 col-md-10 col-sm-9 col-xs-12">
                                         		<div class="testimo_txtd all_txt">
                                             		<p><?php echo nl2br(stripslashes($arr_testimonials['sender_comments']));?></p>
                                           		</div>
                                             	<span class="auther_named">-- <?php echo stripslashes($arr_testimonials['sender_name']);?>, <?php echo stripslashes($arr_testimonials['sender_city']);?></span> 
                                         	</div>
                               			</div>
                          			</div>
                        		</div>                                
                            	<?php
							}
							?>
							<?php echo $pagination;?>
							<?php
						}
						else
						{
						?>
								<div class="review_container">
									<div class="review_text_area" style="color:#FF0000">No review found</div>
								</div>
						<?php
						}
						?>
						</div>
         				<?php require_once("post_review.php");?>   
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page template part end -->

<?php require_once("footer.php");?>