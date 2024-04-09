<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/jquery.simplyscroll-1.0.4.min.js"></script>
<link rel="stylesheet" href="./css/jquery.simplyscroll-1.0.4.css" media="all" type="text/css">
<script type="text/javascript">
(function($) {
	$(function() { //on DOM ready
		$("#slider-wrapper").simplyScroll({
			className: 'custom',
			autoMode: 'loop',
			pauseOnHover: false,
			frameRate: 20,
			speed: 2
		});
	});
})(jQuery);
</script>
<link rel="stylesheet" href="./css/nivo-slider.css" type="text/css" media="screen" />
<div class="for-photo-gallery">
  <div id="slider-wrapper">
    <div class="section">
      <div class="hp-highlight" style="background:url(./images/photo-gallery/photo-gallery-1.jpg) no-repeat 0 0;"> </div>
    </div>
    <div class="section">
      <div class="hp-highlight" style="background:url(./images/photo-gallery/photo-gallery-2.jpg) no-repeat 0 0;"> </div>
    </div>
    <div class="section">
      <div class="hp-highlight" style="background:url(./images/photo-gallery/photo-gallery-3.jpg) no-repeat 0 0;"> </div>
    </div>
    <div class="section">
      <div class="hp-highlight" style="background:url(./images/photo-gallery/photo-gallery-4.jpg) no-repeat 0 0;"> </div>
    </div>
    <div class="section">
      <div class="hp-highlight" style="background:url(./images/photo-gallery/photo-gallery-5.jpg) no-repeat 0 0;"> </div>
    </div>
  </div>
  <div class="photo-gallery-bg"> </div>
  <div style="clear:both; display:block; float:left; width:100%;">&nbsp;</div>
  <div class="copyright">
    <div class="foot-links">
      <ul>
        <li><a href="<?php echo base_url();?>welcome/customer_care" title="Customer Care">Customer Care</a></li>
        <li><a href="<?php echo base_url();?>welcome/about_us" title="About Us">About Us</a></li>
        <li><a href="<?php echo base_url();?>welcome/company_info" title="Company Info">Company Info</a></li>
        <!--<li><a href="<?php //echo base_url();?>welcome/website_info" title="Website Info">Website Info</a></li>-->
        <li><a href="<?php echo base_url();?>welcome/contact" title="Contact Us">Contact Us</a></li>
        <li></li>
      </ul>
      <p style="text-align:right;">Copyright &copy; <?php echo date("Y"); ?> twinkle my net - all rights reserved.</p>
    </div>
  </div>
</div>
