<div class="top-content-bg"></div>
<div class="content-mid">
<h1>Search Result</h1>
  	
<?php
if (count($results)){
	/**
	 * Output from welcome/search will be id,name,shortdesc,thumbnail
	 */
	
	foreach ($results as $key => $list){
		echo "<div class='productlisting'><img src='".$list['thumbnail']."' width='70' height='70' border='0' style='float:left;margin-right:15px; width:70px;'/>\n";
		echo "<h3>";
		echo anchor('welcome/product/'.$list['id'],$list['name']);
		echo "</h3>\n";
		echo "</div>";	
	}
}else{
	echo "<p>Sorry, no records were found to match your search term.</p>";
}
?>
</div>
<div class="bottom-content-bg"></div>