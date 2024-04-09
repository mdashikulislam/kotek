<div>
<div id="years">
<?php $setLinks =""; $xs = 1; $dataLinks ="";
foreach($years as $key=>$value) 
{
//$setLinks .= "<div>".$value['year']."</div>";	
$setLinks .=   "<li><a href='#tab".$xs."' title=".$value['year'].">".$value['year']."</a></li>";


$getAdvertise = $this->MNews->getAdsByYear($value['year']);

$dataLinks .= "<div id='tab".$xs."' class='tab_content'>"; 
foreach($getAdvertise as $xx=>$yy)
{
$dataLinks .= "<div style='float:left; width:14%;'>";	
$dataLinks .=  "<div><a href='".base_url().$yy['image']."' target='_blank' ><img src='".$yy['thumbnail']."' /></a><br/><span class='centerText'><a href='".base_url().$yy['image']."' target='_blank' title='".$yy['title']."' >".$yy['title']."</a></span></div>";	
	
$dataLinks .=  "</div>";	
}
$dataLinks .=  "</div>";

$xs++;
}

?>

<style type="text/css">

</style>

<script type="text/javascript">

$(document).ready(function() {

	//Default Action
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});

});
</script>

<div class="container1">

    <ul class="tabs">
     <?php echo  $setLinks ?>

    </ul>
    <div class="tab_container">
    <?php echo $dataLinks; ?>
    </div>
</div>

</div>
</div>