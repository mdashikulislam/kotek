<script src="./js/jquery-easing-1.3.pack.js"></script>
<script src="./js/jquery-easing-compatibility.1.2.pack.js"></script>
<script src="./js/coda-slider.1.1.1.pack.js"></script>
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
			
			theInt = setInterval(function() {
					$crosslink.removeClass("active-thumb");
					$navthumb.eq(curclicked).parent().addClass("active-thumb");
					$(".stripNav ul li a").eq(curclicked).trigger('click');
					curclicked++;
					if( 6 == curclicked )
							curclicked = 0;
					
			}, 3000);
	};
	
	// DOM Ready
	$(function() {
			
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

<div class="for-shop">
    <div class="slider-wrap">
      <div id="main-photo-slider" class="csw">
        <div class="panelContainer">
          <div class="panel" title="Panel 1">
            <div class="wrapper"> <img src="./images/product-img-1.jpg" width="416" height="505" alt="Product Image 1"> </div>
          </div>
          <div class="panel" title="Panel 2">
            <div class="wrapper"> <img src="./images/product-img-2.jpg" width="416" height="505" alt="Product Image 2"> </div>
          </div>
          <div class="panel" title="Panel 3">
            <div class="wrapper"> <img src="./images/product-img-3.jpg" width="416" height="505" alt="Product Image 3" class="floatLeft"> </div>
          </div>
          <div class="panel" title="Panel 4">
            <div class="wrapper"> <img src="./images/product-img-4.jpg" width="416" height="505" alt="Product Image 4"> </div>
          </div>
          <div class="panel" title="Panel 5">
            <div class="wrapper"> <img src="./images/product-img-5.jpg" width="416" height="505" alt="Product Image 5"> </div>
          </div>
        </div>
      </div>
    </div>
    <div class="shop-bg"> </div>
    <div class="slider-wrap">
      <div id="main-photo-slider" class="csw">
      	<div id="movers-row">
      	<div><a href="#1" class="cross-link"><img src="./images/prod-thumb-1.png" class="nav-thumb" alt="Product thumb 1"></a></div>
        <div><a href="#2" class="cross-link"><img src="./images/prod-thumb-2.png" class="nav-thumb" alt="Product thumb 2"></a></div>
        <div><a href="#3" class="cross-link"><img src="./images/prod-thumb-3.png" class="nav-thumb" alt="Product thumb 3"></a></div>
        <div><a href="#4" class="cross-link"><img src="./images/prod-thumb-4.png" class="nav-thumb" alt="Product thumb 4"></a></div>
        <div><a href="#5" class="cross-link"><img src="./images/prod-thumb-5.png" class="nav-thumb" alt="Product thumb 5"></a></div>
      </div>
      </div>
    </div>
  <div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>