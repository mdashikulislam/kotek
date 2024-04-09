<div>
<h2 class="popupMainTittle"> Select Model Year: </h2>
<div>&nbsp;</div>
<div><img src="./images/searchStep3.png" border="0"/></div>
<div>&nbsp;</div>
<div style="width:400px; text-align:center;">Search available year: <input type="text" name="searchYear" id="searchYear" value="" />&nbsp;<input type="button" name="searchButton" id="searchButton" value="Search" onclick="return getSearchResults('yearSearch','');" /><span id="showError"></span></div>
<div>&nbsp;</div>
<div class="popupModel">
<?php if(!empty($year)) {

// create year list start
$yearArray = array();
foreach ($year  as $key=>$value){ 
for($x = $value['year_from'];$x<= $value['year_to'];$x++)
{
	$yearArray[] = $x;
}
}
$yearArray = array_unique($yearArray);
 asort($yearArray);
// create year list end

// loop year list 
foreach($yearArray  as $key=>$value){ 
echo "<div class='popupModelRow'><a href='#' onclick='return getSearchResults(\"year\",\"".$value."-".$value."\");' title='".$value."' >".$value."</a></div>";
}
}else{echo "<div>No Year Slot Found.</div>";}
?>
</div>
</div>

<div>&nbsp;</div>
<div class="skipBtnWrapper">
	<a href="#" onclick="return goBack('filterProduct/model/<?=$_SESSION['make']?>');" class="prevBtn" title="Previous"></a>
    <a href="#" onclick="return goBack('filterProduct/group/<?=$_SESSION['make']?>');" class="skipStepBtn" title="Skip this step"></a>
</div>