<?php  //var_export($maker);
$array_sort  = array();

foreach($maker as $key => $name)
{ $chkVar = strtoupper(substr($name['name'],0,1));
    if( $chkVar == "A" || $chkVar == "B" || $chkVar == "C" || $chkVar == "D" || $chkVar == "E"  )
    {
      $array_sort[0][$name['id']] = $name['name'];
    } 
	 if( $chkVar == "F" || $chkVar == "G" || $chkVar == "H" || $chkVar == "I" || $chkVar == "J"  )
    {
      $array_sort[1][$name['id']] = $name['name'];
    }
	 if( $chkVar == "K" || $chkVar == "L" || $chkVar == "M" || $chkVar == "N" || $chkVar == "O"  )
    {
      $array_sort[2][$name['id']] = $name['name'];
    }
	if( $chkVar == "P" || $chkVar == "Q" || $chkVar == "R" || $chkVar == "S" || $chkVar == "T"  )
    {
      $array_sort[3][$name['id']] = $name['name'];
    }
	if( $chkVar == "U" || $chkVar == "V" || $chkVar == "W" || $chkVar == "X" || $chkVar == "Y"  || $chkVar == "Z" )
    {
      $array_sort[4][$name['id']] = $name['name'];
    } 
}
?>
<div id="test" style="font-size:11px;">
<h2 class="popupMainTittle"> Product Selection: </h2>
<div>&nbsp;</div>
<div><img src="./images/searchStep1.png" border="0"/></div>
<div id="popupProduct">
<table cellpadding="0" cellspacing="0" border="0" width="750" class="popupTable">
<tr>
<td>
<div class="popupSingleProduct">
<div class="popupAlphaTitles">A-E</div>
<?php foreach($array_sort[0] as $key1=>$value1)
{
	echo "<div class='popupBullet'> <a href='#' onclick='return getSearchResults(\"make\",\"".$key1."\");' title='".$value1."' >".$value1."</div>";	
}

?>
</div>
</td>
<td>
<div class="popupSingleProduct">
<div class="popupAlphaTitles">F-J</div>
<?php foreach($array_sort[1] as $key1=>$value1)
{
	echo "<div class='popupBullet'> <a href='#' onclick='return getSearchResults(\"make\",\"".$key1."\");' title='".$value1."' >".$value1."</div>";	
}

?>
</div>
</td>
<td>
<div class="popupSingleProduct">
<div class="popupAlphaTitles">K-O</div>
<?php foreach($array_sort[2] as $key1=>$value1)
{
	echo "<div class='popupBullet'> <a href='#' onclick='return getSearchResults(\"make\",\"".$key1."\");' title='".$value1."' >".$value1."</div>";	
}

?>
</div>
</td>
<td>
<div class="popupSingleProduct">
<div class="popupAlphaTitles">P-T</div>
<?php foreach($array_sort[3] as $key1=>$value1)
{
	echo "<div class='popupBullet'> <a href='#' onclick='return getSearchResults(\"make\",\"".$key1."\");' title='".$value1."' >".$value1."</div>";	
}

?>
</div>
</td>
<td>
<div class="popupSingleProduct">
<div class="popupAlphaTitles">U-Z</div>
<?php foreach($array_sort[4] as $key1=>$value1)
{
	echo "<div class='popupBullet'> <a href='#' onclick='return getSearchResults(\"make\",\"".$key1."\");' title='".$value1."' >".$value1."</div>";	
}

?>
</div>

</td>
</tr>
</table>
</div>

</div>