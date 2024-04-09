<div>
<h2 class="popupMainTittle"> Models: </h2>
<div>&nbsp;</div>
<div><img src="./images/searchStep2.png" border="0"/></div>
<div class="popupModel">
<?php
if(!empty($model)){
foreach($model  as $key=>$value){ 
echo "<div class='popupModelRow'><a href='#' onclick='return getSearchResults(\"model\",\"".$key."\");' title='".$value."' >".$value."</a></div>";
}
}
else{echo "<div>No Model Found</div>";}
?>
</div>
</div>
<div>&nbsp;</div>
<div style="clear:both;">&nbsp;</div>
<div class="skipBtnWrapper">
	<a href="#" onclick="return goBack('filterProduct');" class="prevBtn" title="Previous"></a>
	<a href="#" onclick="return goBack('filterProduct/year/0');" class="skipStepBtn" title="Skip this step"></a>
</div>