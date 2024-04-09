<div>
<h2 class="popupMainTittle"> Year: </h2>
<div>&nbsp;</div>
<div><img src="./images/searchStep3.png" border="0"/></div>
<div>&nbsp;</div>
<div style="width:400px; text-align:center;">Search available year: <input type="text" name="searchYear" id="searchYear" value="" />&nbsp;<input type="button" name="searchButton" id="searchButton" value="Search" onclick="return getSearchResults('yearSearch','');" /><span id="showError"></span></div>
<div>&nbsp;</div>
<div class="popupModel">
<?php if(!empty($year)) {foreach($year  as $key=>$value){
echo "<div class='popupModelRow'><a href='#' onclick='return getSearchResults(\"year\",\"".$value['year_from']."-".$value['year_to']."\");' title='".$value['name']."' >".$value['year_from']." - ".$value['year_to']."</a></div>";
}
}else{echo "<div>No Year Slot Found.</div>";}
?>
</div>
</div>

<div>&nbsp;</div>
<div class="skipBtnWrapper">
	<a href="#" onclick="return goBack('filterProduct/model/<?=$_SESSION['make']?>');" class="prevBtn"></a>
    <a href="#" onclick="return goBack('filterProduct/group/<?=$_SESSION['make']?>');" class="skipStepBtn"></a>
</div>