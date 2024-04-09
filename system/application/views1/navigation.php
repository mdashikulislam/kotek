<?php
$currentProduct  = $this->uri->segment(3);
if (count($navlist)){
  echo "\n<a href=\"#\" title=\"Check Product List Here\" class=\"leftside-menu\"></a><ul id=\"nudgeUs\">";
  foreach ($navlist[0] as $key => $list){
  
    	echo "\n<li class='cat"; 
		if($currentProduct == $key){ echo " active-link";}
		echo "'>\n";
    	echo anchor("welcome/product/".$key,$list);
    

	echo "\n</li>\n";
	}

  echo "\n</ul>\n";
}
?>
<script type="text/javascript">
$(document).ready(function(){
	$(".leftside-menu").click(function(){
		$("#nudgeUs").slideToggle("slow");
		$(this).toggleClass("active"); return false;
	});
});
</script>