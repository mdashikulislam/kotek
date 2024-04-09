<div class="logo">
	<a href="<?php echo base_url();?>" title="Kotek - Your Ultimate Choice in Power Steering Kits"> <img src="<?php echo base_url(); ?>images/kotekLogo.png" width="187" height="128" alt="Kotek - Your Ultimate Choice in Power Steering Kits"  /> </a>
</div> <!-- logo ends -->

<div class="altimateChoice"> <img src="<?php echo base_url(); ?>images/altimateChoice.png" width="220" height="42" alt="Your Ultimate Choice in Power Steering Kits"  />
</div> <!-- altimateChoice ends -->

<div class="topRightWrapper">
	<div class="needHelp"> Need Help? </div>
    <div class="emailTop"> <a href="mailto:sales@kotek.com" title="E-mail">E-mail</a> our customer support team,<br/> or just give us a call. </div>
    <div class="phoneTop"> 949.863.3126 </div>
    <div class="loginTop"> <div id="search">
    <?php /*?><?php 
                        echo form_open("welcome/search");
               			?>
    <input type="text" name="term" id="term"  maxlength ="64" size="15" value="enter keyword or item #"  onfocus="$(this).val('');" />
    <?
                        echo form_submit("submit","search");
                        echo form_close();
            ?>
    <div style="clear:both;"></div><?php */?>
    <div align="right">
     
      <?php if(isset($_SESSION['customer_id'])) {
				if($_SESSION['customer_type'] =='admin') {
				?>
            <?php echo anchor("admin/dashboard",$_SESSION['customer_first_name']);?>, <?php echo anchor("pages/logout",'Logout');?>
            <?php
				}
				if($_SESSION['customer_type'] =='user') {
				?>
             <?php echo anchor("pages/profile",$_SESSION['customer_first_name']);?>, <?php echo anchor("pages/logout",'Logout');?>
            <?php
				}
			} ?>
      <?php if(!isset($_SESSION['customer_id'])) { echo anchor("pages/login", "Login"); echo anchor("pages/registration", " Register");  }
			
			?> </div>
  </div> </div>
</div> <!-- topRightWrapper ends -->

<div class="navigationTop">
  <ul>
    <li id="active_one"><a href="<?php echo base_url();?>" title="Home" <?php $url_key = $this->uri->segment(2); if($url_key ==''){ echo "class='active'";} else {echo "class='non-active'";}?>>Home</a></li>
    <li><a href="<?php echo base_url();?>pages/filterProduct" title="Products"  rel="facebox" <?php $url_key = $this->uri->segment(2); if($url_key =='shop'){ echo "class='active'";}?>>Products</a></li>
    <li><a href="<?php echo base_url();?>pages/promotions" title="Promotions" <?php $url_key = $this->uri->segment(2); if($url_key =='promotions'){ echo "class='active'";}?>>Promotions</a></li>
    <li><a href="<?php echo base_url()."pages/view/technical-info";?>" title="Technical Info" <?php $url_key = $this->uri->segment(3); if($url_key =='technical-info'){ echo "class='active'";}?>>Technical Info</a></li>
    <li><a href="<?php echo base_url();?>pages/contact" title="Contact Us" <?php $url_key = $this->uri->segment(2); if($url_key =='contact'){ echo "class='active'";}?>>Contact Us</a></li>
  </ul>
  
</div>
