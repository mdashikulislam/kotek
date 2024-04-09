<?php $TOTALPRICE = $_SESSION['totalprice'];

if (count($_SESSION['cart'])){
	$count = 1;
	foreach ($_SESSION['cart'] as $PID => $row){	
		/* echo "<b>". $row['count'] . " " . $row['name'] . " @ " . $row['price']."<br/>";
		echo "<input type='hidden' name='item_name_".$count."' value='".$row['name']."'/>\n";
		echo "<input type='hidden' name='item_quantity_".$count."' value='".$row['count']."'/>\n";
		echo "<input type='hidden' name='item_price_".$count."' value='".$row['price']."'/>\n";
		echo "<input type='hidden' name='item_currency_".$count."' value='USD'/>\n";
		echo "<input type='hidden' name='ship_method_name_".$count."' value='UPS Ground'/>\n";
		echo "<input type='hidden' name='ship_method_price_".$count."' value='5.00'/>\n"; */
		$TOTALPRICE += 5;
		$count++;
	}
}


$this_script = "http://test:8090/twinklemynet/index.php/welcome/orderComplete";
require_once($_SERVER['DOCUMENT_ROOT'].'/twinklemynet/system/paypal/paypal.class.php');
require_once('./system/paypal/paypal.php');
?>
<?

$p->submit_paypal_post(); 

?>


<script type="text/javascript">
function myfunc () {
var frm = document.getElementById("paypal_form");
frm.submit();
}
window.onload = myfunc;
</script>