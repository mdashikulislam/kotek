<div class="logo">
	<a href="<?php echo base_url();?>index.php" title="Kotek - Your Ultimate Choice in Power Steering Kits"> <img src="<?php echo base_url(); ?>images/kotekLogo.png" width="187" height="128" alt="Kotek - Your Ultimate Choice in Power Steering Kits"  /> </a>
</div> <!-- logo ends -->

<div class="altimateChoice"> <img src="<?php echo base_url(); ?>images/altimateChoice.png" width="220" height="42" alt="Your Ultimate Choice in Power Steering Kits"  />
</div> <!-- altimateChoice ends -->

<div class="topRightWrapper">
	<div class="needHelp"> Need Help? </div>
    <div class="emailTop"> <a href="mailto:sales@kotek.com" title="E-mail">E-mail</a> our customer support team,<br/> or just give us a call. </div>
    <div class="phoneTop"> 949.863.3126 </div>
    <div class="loginTop"> 
         <div id="search">
       
        <div align="right">
          <?php echo anchor("admin/dashboard/logout/","Logout");?> </div>
      </div>
  </div>
</div> <!-- topRightWrapper ends -->
<div style="clear:both;"> </div>
<div class="navigationTop">
  <ul id="nav">
    <li><?php echo anchor("admin/dashboard/index","dashboard");?></li>
    <li><?php echo anchor("admin/pages/", "CMS");?>
    	<ul>
        	<li><?php echo anchor("admin/pages/", "pages");?>
            	<ul>
                	<li><?php echo anchor("admin/pages/", "Manage Pages");?></li>
                    <li><?php echo anchor("admin/pages/create/", "Create New Page");?></li>
                </ul>
            </li>
            <li><?php echo anchor("admin/faq/", "FAQ");?>
            	<ul>
                	<li> <?php echo anchor("admin/faq/", "Manage FAQ");?> </li>
                    <li> <?php echo anchor("admin/faq/create/", "Create New FAQ");?> </li>
                </ul>
            </li>
            <li><?php echo anchor("admin/news/", "News");?>
            	<ul>
                	<li> <?php echo anchor("admin/news/", "Manage News");?> </li>
                    <li> <?php echo anchor("admin/news/create/", "Create New News");?> </li>
                </ul>
            </li>
            <li><?php echo anchor("admin/testimonial/", "Testimonials");?>
            	<ul>
                	<li> <?php echo anchor("admin/testimonial/", "Manage Testimonials");?> </li>
                    <li> <?php echo anchor("admin/testimonial/create/", "Create New Testimonial");?> </li>
                </ul>
            </li>
        </ul>
    </li>
    
    <li><?php echo anchor("admin/products/", "Product Management");?>
    	<ul>
        	<li><?php echo anchor("admin/products/", "products");?>
            	<ul>
                	<li> <?php echo anchor("admin/products/", "Manage Products");?> </li>
                    <li> <?php echo anchor("admin/products/create/", "Create New Product");?> </li>
                </ul>
            </li>
            <li><?php echo anchor("admin/categories/","Groups");?>
            	<ul>
                	<li> <?php echo anchor("admin/categories/","Manage Groups");?> </li>
                    <li> <?php echo anchor("admin/categories/create/","Create New Group");?> </li>
                </ul>
            </li>
            <li><?php echo anchor("admin/carmodel/", "Model");?>
            	<ul>
                	<li> <?php echo anchor("admin/carmodel/", "Manage Models");?> </li>
                    <li> <?php echo anchor("admin/carmodel/create/", "Create New Model");?> </li>
                </ul>
            </li>
            <li><?php echo anchor("admin/maker/", "Maker");?>
            	<ul>
                	<li> <?php echo anchor("admin/maker/", "Manage Makers");?> </li>
                    <li> <?php echo anchor("admin/maker/create/", "Create New Maker");?> </li>
                </ul>
            </li>
            <li><?php echo anchor("admin/distributors/", "distributors");?>
            	<ul>
                	<li> <?php echo anchor("admin/distributors/", "Manage Distributors");?> </li>
                    <li> <?php echo anchor("admin/distributors/createDistributor/", "Create New distributor");?> </li>
                </ul>
            </li>
           <li><?php echo anchor("admin/dimensions/", "Dimensions");?>
            	<ul>
                	<li> <?php echo anchor("admin/dimensions/", "Manage Dimensions");?> </li>
                    <li> <?php echo anchor("admin/dimensions/create/", "Create New Dimension");?> </li>
                </ul>
            </li>
        </ul>
    </li>
    
    <li><?php echo anchor("admin/orders/customers", "Leads");?>
    	<ul>
        	<li><?php echo anchor("admin/orders/customers", "Manage Leads");?></li>
            <li><?php echo anchor("admin/subscribers/", "Subscribers");?>
            	<ul>
                	<li> <?php echo anchor("admin/subscribers/", "Manage Subscribers");?> </li>
                    <li> <?php echo anchor("admin/subscribers/sendemail/", "Contact Subscribers");?> </li>
                </ul>
            </li>
       <li> <?php echo anchor("admin/orders/userlog", "User log");?> </li>
       <li> <?php echo anchor("admin/orders/newRegistration", "New lead request");?> </li>
       <li> <?php echo anchor("admin/subscribers/requests", "User request");?> </li>
        </ul>
    </li>
    
    <li><?php echo anchor("admin/advertise/","Advertise");?>
    	<ul>
        	<li> <?php echo anchor("admin/advertise/","Manage Advertise");?> </li>
            <li> <?php echo anchor("admin/advertise/create/","Create New Advertise");?> </li>
        </ul>
    </li>    
    
    <li><?php echo anchor("admin/banner/", "Banners");?>
    	<ul>
        	<li><?php echo anchor("admin/banner/", "Manage Banners");?></li>
            <li><?php echo anchor("admin/banner/create/", "Create New Banner");?></li>
        </ul>
    </li>
    
    <li><?php echo anchor("admin/admins/", "Admin Users");?>
    	<ul>
        	<li><?php echo anchor("admin/admins/", "Manage Admin Users");?></li>
            <li><?php echo anchor("admin/admins/create/", "Create New Admin User");?></li>
        </ul>
    </li>
    
    
    
    
   
    
    <!--li><?php echo anchor("admin/videos/", "videos");?></li-->
    
    
    
    
    
    
    <?php /*?><li><?php echo anchor("admin/dashboard/logout/", "logout");?></li>
    <li><?php echo anchor("admin/orders/", "orders");?></li>
    <li><?php echo anchor("admin/colors/", "colors");?></li>
    <!--li><?php //echo anchor("admin/sizes/", "sizes");?></li-->
    <li><?php echo anchor("admin/orders/giftvouchers", "gift certificates");?></li><?php */?>
  </ul>
  
</div>
