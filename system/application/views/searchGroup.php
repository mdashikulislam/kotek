<div>
<h2 class="popupMainTittle"> Select Product Group: </h2>
<div>&nbsp;</div>
<div><img src="./images/searchStep4.png" border="0"/></div>
<div class="popupModel">
<?php if(!empty($group)) {foreach($group  as $key=>$value){
echo "<div class='popupModelRow'><a href='#' onclick='return getSearchResults(\"group\",\"".$key."\");' title='".$value."' >".$value."</a></div>";
}
}else{echo "<div>No Group Found</div>";}
?>
</div>
</div>
<div class="skipBtnWrapper">
    <a href="#" onclick="return goBack('filterProduct/year/<?=$_SESSION['model']?>');" class="prevBtn" style="margin-right:20px;" title="Previous">&nbsp;</a>
</div>