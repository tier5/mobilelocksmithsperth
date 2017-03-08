<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="header">
        <a class="logo" href="#"><img src="img/logo.png" alt="" title=""/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>    
</div>
<div class="menu">                
        <div class="breadLine">            
            <div class="arrow"></div>
            <div class="adminControl active">
                Hi, Administrator
            </div>
        </div>
        <div class="admin">
            <ul class="control">                
                <li><span class="icon-share-alt"></span> <a href="logout.php">Logout</a></li>
            </ul>
		</div>
        <ul class="navigation"> 
            <li <?php if($current_page == 'site_stats.php') { ?>class = "active"<?php } ?>>
                <a href="site_stats.php">
                    <span class="isw-documents"></span><span class="text">Site Statistics</span>
                </a>
            </li> 
            <li <?php if($current_page == 'site_settings.php') { ?>class = "active"<?php } ?>>
                <a href="site_settings.php">
                    <span class="isw-documents"></span><span class="text">Site Settings</span>
                </a>
            </li> 
            <li <?php if($current_page == 'change_password.php') { ?>class = "active"<?php } ?>>
                <a href="change_password.php">
                    <span class="isw-archive"></span><span class="text">Change Password</span>                 
                </a>
            </li>
            <li <?php if($current_page == 'seo_settings.php' || $current_page == 'edit_seo_settings.php') { ?>class = "active"<?php } ?>>
                <a href="seo_settings.php">
                    <span class="isw-list"></span><span class="text">SEO Settings</span>                 
                </a>
            </li>
            <li class="openable <?php if($current_page == 'add_edit_banner.php' || $current_page == 'banner_list.php') { ?>active<?php } ?>">
                <a href="#">
                    <span class="isw-list"></span><span class="text">Banner Management</span>
                </a>
                <ul>
                    <li <?php if($current_page == 'add_edit_banner.php') { ?>class = "active"<?php } ?>>
                        <a href="add_edit_banner.php">
                            <span class="icon-pencil"></span><span class="text">Add Banner</span>
                        </a>
                    </li>                                                                                          
                    <li <?php if($current_page == 'banner_list.php') { ?>class = "active"<?php } ?>>
                        <a href="banner_list.php">
                            <span class="icon-list"></span><span class="text">Banner List</span>
                        </a>     
                   </li>
                </ul>                                
            </li>
            <li <?php if($current_page == 'edit_homepage.php') { ?>class = "active"<?php } ?>>
                <a href="edit_homepage.php">
                    <span class="isw-archive"></span><span class="text">Homepage Content</span>                 
                </a>
            </li>
            <li class="openable <?php if($current_page == 'edit_block1.php' || $current_page == 'edit_block2.php') { ?>active<?php } ?>">
                <a href="#">
                    <span class="isw-list"></span><span class="text">Local Professional</span>
                </a>
                <ul>
                    <li <?php if($current_page == 'edit_block1.php') { ?>class = "active"<?php } ?>>
                        <a href="edit_block1.php">
                            <span class="icon-pencil"></span><span class="text">Edit Left Panel</span>
                        </a>
                    </li>                                                                                          
                    <li <?php if($current_page == 'edit_block2.php') { ?>class = "active"<?php } ?>>
                        <a href="edit_block2.php">
                            <span class="icon-list"></span><span class="text">Edit Right Panel</span>
                        </a>     
                   </li>
                </ul>                                
            </li> 
            <li class="openable <?php if($current_page == 'add_edit_photo.php' || $current_page == 'photo_list.php') { ?>active<?php } ?>">
                <a href="#">
                    <span class="isw-list"></span><span class="text">Gallery Management</span>
                </a>
                <ul>
                    <li <?php if($current_page == 'add_edit_photo.php') { ?>class = "active"<?php } ?>>
                        <a href="add_edit_photo.php">
                            <span class="icon-pencil"></span><span class="text">Add Photo</span>
                        </a>
                    </li>                                                                                          
                    <li <?php if($current_page == 'photo_list.php') { ?>class = "active"<?php } ?>>
                        <a href="photo_list.php">
                            <span class="icon-list"></span><span class="text">Photo List</span>
                        </a>     
                   </li>
                </ul>                                
            </li> 
            <li class="openable <?php if($current_page == 'add_edit_partner.php' || $current_page == 'partner_list.php') { ?>active<?php } ?>">
                <a href="#">
                    <span class="isw-list"></span><span class="text">Partner Management</span>
                </a>
                <ul>
                    <li <?php if($current_page == 'add_edit_partner.php') { ?>class = "active"<?php } ?>>
                        <a href="add_edit_partner.php">
                            <span class="icon-pencil"></span><span class="text">Add Partner</span>
                        </a>
                    </li>                                                                                          
                    <li <?php if($current_page == 'partner_list.php') { ?>class = "active"<?php } ?>>
                        <a href="partner_list.php">
                            <span class="icon-list"></span><span class="text">Partner List</span>
                        </a>     
                   </li>
                </ul>                                
            </li> 
            <li <?php if($current_page == 'testimonial_list.php' || $current_page == 'testimonial_details.php') { ?>class = "active"<?php } ?>>
                <a href="testimonial_list.php">
                    <span class="isw-list"></span><span class="text">Review Management</span>                 
                </a>
            </li>
            <li class="openable <?php if($current_page == 'add_edit_service.php' || $current_page == 'service_list.php') { ?>active<?php } ?>">
                <a href="#">
                    <span class="isw-list"></span><span class="text">Service Management</span>
                </a>
                <ul>
                    <li <?php if($current_page == 'add_edit_service.php') { ?>class = "active"<?php } ?>>
                        <a href="add_edit_service.php">
                            <span class="icon-pencil"></span><span class="text">Add Service</span>
                        </a>
                    </li>                                                                                          
                    <li <?php if($current_page == 'service_list.php') { ?>class = "active"<?php } ?>>
                        <a href="service_list.php">
                            <span class="icon-list"></span><span class="text">Service List</span>
                        </a>     
                   </li>
                </ul>                                
            </li> 
       </ul>
</div>
