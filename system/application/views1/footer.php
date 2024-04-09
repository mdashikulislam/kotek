<div class="footerTopWrapper">
	<div class="footerBgLeft"> </div>
    <div class="footerBgCenter"> </div>
    <div class="footerBgRight"> </div>
</div>
<div class="footerBottom">
	<div class="footerClients">
    	<ul class="footerClientList">
        	<li> <img src="./images/clientApra.png" alt="APRA"/> </li>
            <li> <img src="./images/clientCqc.png" alt="CQC"/> </li>
            <li> <img src="./images/clientThird.png" alt=""/> </li>
        </ul>
    </div>
    <div class="footerNavWrapper">
    	<ul class="footerNav">
            <li id="active_one"><a href="<?php echo base_url();?>index.php" title="Home" <?php $url_key = $this->uri->segment(2); if($url_key ==''){ echo "class='active'";} else {echo "class='non-active'";}?>>Home</a> | </li>
            <li><a href="<?php echo base_url();?>index.php/pages/filterProduct" title="Products"  rel="facebox" <?php $url_key = $this->uri->segment(2); if($url_key =='shop'){ echo "class='active'";}?>>Products</a> | </li>
            <li><a href="<?php echo base_url();?>index.php/pages/promotions" title="Promotions" <?php $url_key = $this->uri->segment(2); if($url_key =='giftVoucher'){ echo "class='active'";}?>>Promotions</a> | </li>
            <li><a href="<?php echo base_url()."index.php/pages/view/technical-info";?>" title="Technical Info" <?php $url_key = $this->uri->segment(2); if($url_key =='blog-press'){ echo "class='active'";}?>>Technical Info</a> | </li>
            <li><a href="<?php echo base_url();?>index.php/pages/contact" title="Contact Us" <?php $url_key = $this->uri->segment(2); if($url_key =='twinkle_gives_back'){ echo "class='active'";}?> >Contact Us</a> | </li>
            <li><a href="<?php echo base_url();?>index.php/pages/view/order_info" title="Order Info" <?php $url_key = $this->uri->segment(2); if($url_key =='twinkle_gives_back'){ echo "class='active'";}?> style="padding-right:0;">Order Info</a></li>
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