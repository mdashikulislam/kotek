<script src="./js/shopgallery.js"></script>
<script src="./js/slides.min.jquery.js"></script>
<script type="text/javascript">
		$(function(){
			$('#products').slides({
				preload: true,
				preloadImage: '../../images/loading.gif',
				play: 3000,
				pause: 3000,
				hoverPause: false,
				effect: 'slide, fade',
				crossfade: true,
				slideSpeed: 350,
				fadeSpeed: 500,
				generateNextPrev: true,
				generatePagination: false
			});
		});
</script>

<div class="for-shop">
	<div id="products_example">
	<div id="products">
        <div class="slides_container">
            <img src="./images/product-img-1.jpg" width="416" alt="1" />
            <img src="./images/product-img-2.jpg" width="416" alt="2" />
            <img src="./images/product-img-3.jpg" width="416" alt="3" />					
            <img src="./images/product-img-4.jpg" width="416" alt="4" />
            <img src="./images/product-img-5.jpg" width="416" alt="5" />
        </div>
    <div class="shop-bg"></div>
        <ul class="pagination">
            <li><a href="#"><img src="./images/prod-thumb-1.png" alt="1" /></a></li>
            <li><a href="#"><img src="./images/prod-thumb-2.png" alt="2" /></a></li>
            <li><a href="#"><img src="./images/prod-thumb-3.png" alt="3" /></a></li>
            <li><a href="#"><img src="./images/prod-thumb-4.png" alt="4" /></a></li>
            <li><a href="#"><img src="./images/prod-thumb-5.png" alt="5" /></a></li>
        </ul>
    </div>
    </div>
  <div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>