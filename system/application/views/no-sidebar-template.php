<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<base href="<?=base_url();?>">
<link href="<?= base_url();?>css/default.css" rel="stylesheet" type="text/css" />
<noscript>
Javascript is not enabled! Please turn on Javascript to use this site.
</noscript>
<script type="text/javascript" src="./js/jquery-1.4.3.min.js" ></script>
<script type="text/javascript" src="./js/jquery.validate.js" ></script>
<script type="text/javascript">
//<![CDATA[
base_url = '<?= base_url();?>';
//]]>
</script>
</head>
<body>
<div id="wrapper">
  <div id="maincontainer">
    <div id="header">
      <?php $this->load->view('header');?>
    </div>
    <div id="maincontent">
      <div id='globalnav'>
        <ul>
          <li class="photo_gallary" id="active_one"><a href="<?php echo base_url();?>welcome/photo_gallery" title="Photo Gallery" <?php $url_key = $this->uri->segment(2); if($url_key =='photo_gallery'){ echo "class='active-tab'";} else {echo "class='non-active'";}?>>photo gallery</a></li>
          <li class="shop"><a href="<?php echo base_url();?>welcome/shop" title="Shop" <?php $url_key = $this->uri->segment(2); if($url_key =='shop'){ echo "class='active-tab'";}?>>shop</a></li>
          <li class="gift"><a href="<?php echo base_url();?>welcome/giftVoucher/20" title="Gift Certificate" <?php $url_key = $this->uri->segment(2); if($url_key =='giftVoucher'){ echo "class='active-tab'";}?>>gifts</a></li>
          <li class="blog"><a href="<?php echo base_url();?>blog-press" title="Blog &amp; Press" <?php $url_key = $this->uri->segment(2); if($url_key =='blog-press'){ echo "class='active-tab'";}?>>blog &amp; press</a></li>
          <li style="background:none;" class="twinkle"><a href="<?php echo base_url();?>welcome/power_sterring_kit" title="Twinkle Gives Back" <?php $url_key = $this->uri->segment(2); if($url_key =='power_sterring_kit'){ echo "class='active-tab'";}?>>twinklegivesback</a></li>
        </ul>
        
        <!--<div id="last-tab">
        <ul>
        	<li><a href="<?php //echo base_url();?>welcome/power_sterring_kit" title="Twinkle Gives Back" <?php //$url_key = $this->uri->segment(2); if($url_key =='power_sterring_kit'){ echo "class='active-tab'";}?>>twinklegivesback</a></li>
        </ul>
        </div>-->
        
        <div id="search">
         <?php 
                        echo form_open("welcome/search");
               			?> <input type="text" name="term" id="term"  maxlength ="64" size="15" value="enter keyword or item #"  onfocus="$(this).val('');" /> <?
                        echo form_submit("submit","search");
                        echo form_close();
            ?>
            <div style="clear:both;"></div>
            <div align="right">
          	<?php if(isset($_SESSION['customer_id'])) { ?>
            <?php echo anchor("welcome/profile",$_SESSION['customer_first_name']);?>, <?php echo anchor("welcome/logout",'Logout');?>
            <?php } ?>
            <?php echo "view basket"; if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){ echo " (".count($_SESSION['cart'])." items )"; }else{ echo "(0 item)";} 
			if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){ echo " | "; echo anchor("welcome/cart", "checkout");}else{ if(!isset($_SESSION['customer_id'])) { echo " | "; echo anchor("welcome/login", "login"); }}
			
			?>
            </div>
        </div>
      </div>
      <!--<div id="nav">-->
        <?php //$this->load->view('navigation');?>
      <!--</div>-->
      
      <div id="container">
      	<div class="fixed-icon"><div id="for-tag-image"></div>
      	<!-- Script for displaying icon with delay -->
		<script type="text/javascript">
        function load(){
            $("#for-tag-image").html('<p><a href="<?php echo base_url();?>welcome/power_sterring_kit" title="Twinkle gives back"><img src="./images/twinkle-gives-back-icon.png" alt="Twinkle gives back tag" /></a></p>');
        }
        $(function(){
          setInterval("load()",1000);
        });
        $(document).ready(function () {
          setTimeout(function () {
              $('#for-tag-image').hide();
          }, 10000);
        });
        </script>
        </div>
        <div class="main-content">
        <?php $this->load->view($main);?>
      </div>
	</div>
      <div id="footer">
        <?php $this->load->view('footer');?>
      </div>
    </div>
  </div>
</div>
<!--<a href="#" id="toTop">^ Scroll to Top</a>
<script type="text/javascript" src="<?php //echo base_url();?>js/customtools.js" ></script>-->
<script type="text/javascript">
		//Define the plugin
		$.fn.nudge = function(params) {
			//set default parameters
			params = $.extend({
				amount: 10,				//amount of pixels to pad / marginize
				duration: 300,			//amount of milliseconds to take
				property: 'padding', 	//the property to animate (could also use margin)
				direction: 'left',		//direction to animate (could also use right)
				toCallback: function() {},	//function to execute when MO animation completes
				fromCallback: function() {}	//function to execute when MOut animation completes
			}, params);
			//For every element meant to nudge...
			this.each(function() {
				//variables
				var $t = $(this);
				var $p = params;
				var dir = $p.direction;
				var prop = $p.property + dir.substring(0,1).toUpperCase() + dir.substring(1,dir.length);
				var initialValue = $t.css(prop);
				/* fx */
				var go = {}; go[prop] = parseInt($p.amount) + parseInt(initialValue);
				var bk = {}; bk[prop] = initialValue;
				
				//Proceed to nudge on hover
				$t.hover(function() {
							$t.stop().animate(go, $p.duration, '', $p.toCallback);
						}, function() {
							$t.stop().animate(bk, $p.duration, '', $p.fromCallback);
						});
			});
			return this;
		};
	
	/* usages */
	$(document).ready(function() {
		/* usage 1 */
		$('#nudgeUs li a').nudge();
		/* usage 2 */
		$('#nudgeUs2 li a').nudge({
			property: 'margin',
			direction: 'left',
			amount: 10,
			duration: 400,
			toCallback: function() { $(this).css('color','#f00'); },
			fromCallback: function() { $(this).css('color','#000'); }
		});
		


	});
/*$(function(){
  $.fn.scrollToTop=function(){
    $(this).hide().removeAttr("href");if($(window).scrollTop()!="0"){
      $(this).fadeIn("slow")
      }
      var scrollDiv=$(this);$(window).scroll(function(){
        if($(window).scrollTop()=="0"){
          $(scrollDiv).fadeOut("slow")
          }else{
            $(scrollDiv).fadeIn("slow")
            }
            });
      $(this).click(function(){
        $("html, body").animate({scrollTop:0},"slow")
        }
        )}
      });

$(function() {
$("#toTop").scrollToTop();
});*/

</script>
</body>
</html>