<div id='pleft'>	
<?php
  echo "<h2>".$category['name']."</h2>\n";
  echo "<p>".$category['shortdesc'] . "</p>\n";
  
  foreach ($listing as $key => $list){
    echo "<div class='productlisting'>";
	switch($level){
		  // category level is 1, and product is 2
		  // see function cat($id) in controllers/welcome.php 
			case "1":
			echo '<a href="' . site_url(). '/welcome/cat/'.$list['id']. '">';
			echo '<img src="'.base_url().$list['thumbnail'].'"'. "border='0' class='thumbnail'/>\n";
			echo "</a>";
			echo "<h4>";
			echo anchor('welcome/cat/'.$list['id'],$list['name']);
			echo "</h4>\n";
			break;
			
			case "2":
			echo '<a href="' . site_url(). '/welcome/product/'.$list['id']. '">';
			echo '<img src="'.base_url().$list['thumbnail'].'"'. "border='0' class='thumbnail'/>\n";
			echo "</a>";
			echo "<h4>";
			 echo anchor('welcome/product/'.$list['id'],$list['name']);
			echo "</h4>\n";
			// echo ;
			break;
		}
    
  
    echo $list['shortdesc'].
    	"<br/>" . anchor('welcome/cart/'.$list['id'],'add to cart').
		"</div>";	
  }
?>
</div>
