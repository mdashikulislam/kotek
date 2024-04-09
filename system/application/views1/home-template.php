<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<base href="<?=base_url();?>">
<link href="<?= base_url();?>css/default.css" rel="stylesheet" type="text/css" />
<noscript>
Javascript is not enabled! Please turn on Javascript to use this site.
</noscript>
<link rel="shortcut icon" href="./images/favicon.ico" >
<script type="text/javascript" src="./js/jquery.min.js" ></script>
<script src="./js/facebox.js" type="text/javascript"></script>
<script type="text/javascript" src="./js/jquery.validate.js" ></script>
<link href="<?= base_url();?>css/facebox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
  $(document).ready(function() {

 $.validator.addMethod("noSpecialChars", function(value, element) {
      return this.optional(element) || /^[a-z0-9\_\ ]+$/i.test(value);
  }, "This field must contain only letters, numbers, or underscore.");

 $.validator.addMethod("NumbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9\-\ \+]+$/i.test(value);
    }, "Phone must contain only numbers, + and -.");
  
 $.validator.addMethod("selectNone",function(value, element) { 
    if (element.value == "")  {  return false; } else { return true;} },
  "Please select an option.");
 
  $("#searchProduct").validate({
        rules: {  
		make: {selectNone:true },
		group: {selectNone:true },		
		year:{ required: false,	maxlength: 4, minlength: 4, NumbersOnly:true }	
		  },
        messages: { 
		make: { required: "Please choose Make", selectNone:"Please choose Make" },  
		group: { required: "Please choose Group", selectNone:"Please choose Group" },
		year: { NumbersOnly:"Please enter Year in YYYY format eg. 2011",minlength: "Please enter Year in YYYY format eg. 2011" }
        }       });
      });
  
  </script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : './images/loading.gif',
        closeImage   : './images/closelabel.png'
      })
    });
	
var siteUrl = "<?php echo base_url();?>";
  </script>
  
  <script type="text/javascript" src="./js/js-functions.js" ></script>
  <!-- for Coda Slider -->
<script type="text/javascript" src="./js/coda-slider.1.1.1.pack.js" ></script>
<script type="text/javascript" src="./js/jquery-easing-1.3.pack.js" ></script>
<script type="text/javascript" src="./js/jquery-easing-compatibility.1.2.pack.js" ></script>
<script type="text/javascript">	
		var theInt = null;
		var $crosslink, $navthumb;
		var curclicked = 0;		
		theInterval = function(cur){
			clearInterval(theInt);			
			if( typeof cur != 'undefined' )
				curclicked = cur;			
			$crosslink.removeClass("active-thumb");
			$navthumb.eq(curclicked).parent().addClass("active-thumb");
				$(".stripNav ul li a").eq(curclicked).trigger('click');			
			theInt = setInterval(function(){
				$crosslink.removeClass("active-thumb");
				$navthumb.eq(curclicked).parent().addClass("active-thumb");
				$(".stripNav ul li a").eq(curclicked).trigger('click');
				curclicked++;
				if( 3 == curclicked )
					curclicked = 0;				
			}, 7000);
		};		
		$(function(){			
			$("#main-photo-slider").codaSlider();			
			$navthumb = $(".nav-thumb");
			$crosslink = $(".cross-link");			
			$navthumb
			.click(function() {
				var $this = $(this);
				theInterval($this.parent().attr('href').slice(1) - 1);
				return false;
			});			
			theInterval();
		});
	</script>
    
<!-- added for home page testimonials -->
<script language="javascript">
$(document).ready(function(){
	$('#testimonials .slide');
	setInterval(function(){
		$('#testimonials .slide').filter(':visible').fadeOut(3500,function(){
			if($(this).next('li.slide').size()){
				$(this).next().fadeIn(3500);
			}
			else{
				$('#testimonials .slide').eq(0).fadeIn(3500);
			}
		});
	},3500);	
});	
</script>

<!-- for News Slider -->
<script type="text/javascript" src="./js/jquery.bxSlider.min.js" ></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#slider1').bxSlider();
  });
</script>
</head>
<body>
<div id="wrapper">
    <div id="header">
      <?php $this->load->view('header');?>
    </div>
    
    <!-- Main Content Area starts here -->
    <div id="maincontent">
      <div id="container">
      	<a href="<?php echo base_url();?>index.php/pages/filterProduct" class="compreSearchBtn" title="Comprehensive Search" rel="facebox"></a>
      	<div id="page-wrap">
          <div class="slider-wrap">
            <div id="main-photo-slider" class="csw">
              <div class="panelContainer">
              <?php $bannerList = $this->MNews->getAllBannerActive();
			  foreach($bannerList as $key=>$value){
			  ?><div class="panel" title="Sealing Solution for Heavy Duty">
               	<img src="<?=$value['image']?>"  />
               </div>
               <?php } ?>
              </div>
            </div>
            <div id="movers-row">
          <?php $xx = 1; foreach($bannerList as $key=>$value){ ?>
			  
               <div><a href="#<?=$xx?>" class="cross-link"><img src="<?=$value['thumbnail']?>" class="nav-thumb" alt="temp-thumb" /></a></div>
               
               <?php $xx++; } ?>
            </div>
          </div>
		</div>
        
        <div class="newsWrapper">
        	<div class="newsLeft"> </div>
            <div class="newsRight">
            	<div class="inTheNews"> In The News </div>
                <div class="mainNewsSection">
                	<ul id="slider1"> <?php $newsList = $this->MNews->getAllNewsActive();
					foreach($newsList as $key12=>$value12)
					{

					 echo "<li>".$value12['description']."</li>";
					}

					?>
                    </ul>
                </div>
            </div>
            <div class="followUs">
            	<a href="#" class="facebook" title="Follow us on Facebook"></a>
                <a href="#" class="twiiter" title="Twitter"></a>
            </div>
        </div>
        
            
        
        <div class="bottomThreeWrapper">
        	<div class="bottom3Top"> </div>
            <div class="bottom3Bottom">
            	<h2 class="boxTitle"> Quick Search </h2>
                <form name="searchProduct" id="searchProduct" method="post" action="<?php echo base_url();?>index.php/pages/searchProduct">
                	<div class="for_contact_form">
                        <table class="searchForm" cellspacing="0" cellpadding="0">
                            
                            <tr><td align="right" width="60"><label>Make:</label></td><td><select name="make" id="make" onchange="showModel()">
                            <option value="">Select Make</option>
                            <?php $modelList = $this->MMaker->getAllMakers();
							$make_quick =0;
							if(isset($_SESSION['make_quick']) && !empty($_SESSION['make_quick'])) { $make_quick = $_SESSION['make_quick'];	}
							foreach($modelList as $key=>$value){ $slect =""; if($make_quick == $value['id']){$slect = "selected";}
								echo '<option value="'.$value['id'].'" '.$slect.'>'.ucfirst(strtolower($value['name'])).'</option>';
								}
							
							?>
                            	
                            </select></td></tr>
                            
                            <tr><td align="right"><label>Model:</label></td><td id="showModel"><select name="model" id="model">
                            <option value="">Select Model</option></select></td></tr>
                            
                            <tr><td align="right"><label>Year:</label></td><td><input type="text" name="year" id="year" value="" class="textfield" /></td></tr>
                            
                            <tr><td align="right"><label>Group:</label></td>
                          
                            <td>
                              <select name="group" id="group">
                            <option value="">Select Group</option>
                            <?php $modelList = $this->MCats->getAllCategories();
							$group_quick =0;
							if(isset($_SESSION['make_quick']) && !empty($_SESSION['group_quick'])) { $group_quick = $_SESSION['group_quick'];	}
							foreach($modelList as $key=>$value){ $slect =""; if($group_quick == $value['id']){$slect = "selected";}
								echo '<option value="'.$value['id'].'" '.$slect.'>'.ucfirst(strtolower($value['name'])).'</option>';
								}
							
							?>
                            	
                            </select>
                            </td></tr>
                            
                            <tr><td align="right"><label>Products:</label></td><td><select name="product" id="product">
                            <option value="">Select Product</option>
                            <?php $productList = $this->MProducts->getAllProductList();
							$group_quick =0;
							if(isset($_SESSION['product_quick']) && !empty($_SESSION['product_quick'])) { $group_quick = $_SESSION['product_quick'];	}
							foreach($productList as $key=>$value){ $slect =""; if($group_quick == $value['id']){$slect = "selected";}
								echo '<option value="'.$value['name'].'" '.$slect.'>'.ucfirst(strtolower($value['name'])).'</option>';
								}
							
							?>
                            	
                            </select></td></tr>
                            
                            <tr><td></td><td><input type="submit" name="submit" value="" class="startSearchBtn" title="Start Search" alt="Start Search"  /></td><td></td></tr>
                        </table>
                    </div> <!-- for_contact_form ends -->
                </form>
            </div>
        </div>
        
        <div class="bottomThreeWrapper">
        	<div class="bottom3Top"> </div>
            <div class="bottom3Bottom">
            	<h2 class="boxTitle"> Welcome to KOTEK </h2>
                <div class="welcomeWrapper" style="font-size:12px;">
               <?php $pageContent  = $this->MPages->getPage(1);
			   echo substr(strip_tags($pageContent['content']),0,500).".....";
			   
			   ?>
                </div>
                <a href="<?= base_url();?>/index.php/pages/view/about_us" class="knowMore" title="Know More"> know more </a>
            </div>
        </div>
        
        <div class="bottomThreeWrapper">
        	<div class="bottom3Top"> </div>
            <div class="bottom3Bottom">
            	<h2 class="boxTitle"> Signup for eNewsletter </h2>
                <div class="welcomeWrapper">
                    <div class="newsletter">
                        <!--form action="<?php echo base_url(); ?>index.php/welcome/subscribe" method="post" name="subscribe" id="subscribe" -->
                        <table cellpadding="0" cellspacing="0" border="0" class="searchForm">
                            <tr>
                                <td width="80" align="right"> Enter e-mail: </td>
                                <td> <input type="text" value="enter your email address" size="30" maxlength="30" name="subscribe_email" id="subscribe_email" onclick="$(this).val('');" class="textfield" /> </td>
                            </tr>
                            <tr>
                                <td>&nbsp;  </td>
                                <td> <input type="button" value="" class="subscribeBtn" title="Subscribe" onclick="return subscribe();" /> </td>
                            </tr>
                        </table>
                        <!--/form-->
                    </div>
                    <ul id="testimonials"><?
                    $testimonialList = $this->MNews->getAllTestimonial();
					$tt =0;
					foreach($testimonialList as $key=>$value){
						$showTest = '';
						if($tt != 0){$showTest = 'style="display: none"';}
					?>
                            <li class="slide"  <?=$showTest?>> <?=substr($value['description'],0,50)."..."?><br/> <b><?=$value['title']?></b></li>
                            <?php $tt++;  } ?>
                           
                        </ul>
                </div>
                <a href="<?= base_url();?>/index.php/pages/testimonial" class="knowMore" title="Know More"> know more </a>
            </div>
        </div>
        <div style="clear:both;"> </div>
      </div>
    </div>
    <div id="footer">
          <?php $this->load->view('footer');?>
      </div>
</div>
<?php if(isset($_SESSION['make_quick']) && !empty($_SESSION['make_quick'])) { ?>
<script type="text/javascript">
showModel();
</script>
<?php } ?>
</body>
</html>
