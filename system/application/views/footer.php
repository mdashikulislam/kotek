<div class="footerTopWrapper">
	<div class="footerBgLeft"> </div>
    <div class="footerBgCenter"> </div>
    <div class="footerBgRight"> </div>
</div>
<div class="footerBottom">
	<div class="footerClients">
    	<ul class="footerClientList">
        	<li> <img src="./images/clientApra.png" alt="APRA"/> </li>
        </ul>
    </div>
      <?php $getFooterPagesList  = $this->MPages->getFooterPages();?>
    <div class="footerNavWrapper">
    	<ul class="footerNav">
            <li id="active_one"><a href="<?php echo base_url();?>" title="Home" <?php $url_key = $this->uri->segment(2); if($url_key ==''){ echo "class='active'";} else {echo "class='non-active'";}?>>Home</a> | </li>
            <li><a href="<?php echo base_url();?>pages/filterProduct" title="Products"  rel="facebox" <?php $url_key = $this->uri->segment(2); if($url_key =='shop'){ echo "class='active'";}?>>Products</a> | </li>
            <li><a href="<?php echo base_url();?>pages/promotions" title="Promotions" <?php $url_key = $this->uri->segment(2); if($url_key =='giftVoucher'){ echo "class='active'";}?>>Promotions</a> | </li>
            <!--li><a href="<?php echo base_url()."pages/view/technical-info";?>" title="Technical Info" <?php $url_key = $this->uri->segment(2); if($url_key =='blog-press'){ echo "class='active'";}?>>Technical Info</a> | </li-->
            <li><a href="<?php echo base_url();?>pages/contact" title="Contact Us" <?php $url_key = $this->uri->segment(2); if($url_key ==''){ echo "class='active'";}?> >Contact Us</a> | </li>
            <li><a href="<?php echo base_url();?>pages/faq" title="FAQ" <?php $url_key = $this->uri->segment(2); if($url_key ==''){ echo "class='active'";}?> style="padding-right:0;">FAQ</a>&nbsp;|&nbsp;</li><?php if(!empty($getFooterPagesList)){ $countFooter = 1; $countF =count($getFooterPagesList);
			foreach($getFooterPagesList as $key=>$valueFooter){
				?><li><a href="<?php echo base_url();?>pages/view/<?php echo $valueFooter['path']; ?>" title="<?php echo $valueFooter['name']; ?>" ><?php echo $valueFooter['name']; ?></a> <?php if($countF > $countFooter) echo "|"; ?> </li>
            <?php $countFooter++;
			} 			
			}?>
            <!--li><a href="<?php echo base_url();?>pages/view/privacy" title="privacy" <?php $url_key = $this->uri->segment(2); if($url_key ==''){ echo "class='active'";}?> style="padding-right:0;">Privacy Policy</a>&nbsp;|&nbsp;</li-->
            <!--li><a href="<?php echo base_url();?>pages/view/order_info" title="Order Info" <?php $url_key = $this->uri->segment(2); if($url_key ==''){ echo "class='active'";}?> style="padding-right:0;">Order Info</a></li-->
          </ul>
          <p class="copyrights"> <?php echo date("Y") ?> All Rights Reserved </p>
    </div>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26465164-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</div>