<h1>Please Confirm Your Order</h1>
<p>Please confirm your order before clicking the Buy Now button below. If you have changes, <?php echo anchor("welcome/cart", "go back to your shopping cart");?>.</p>


<?php /*?><form method="POST" 
		action="https://sandbox.google.com/checkout/v2/checkoutForm/Merchant/912256454751601" 
		accept-charset="utf-8">
<?php */?>		
<p>
<?php
$TOTALPRICE = $_SESSION['totalprice'];

if (count($_SESSION['cart'])){
	$count = 1;
	foreach ($_SESSION['cart'] as $PID => $row){	
		echo "<div>". $row['count'] . " " . $row['name'] . " @ " . $row['price']."<br/>";
		echo "<input type='text' name='item_name_".$count."' value='".$row['name']."'/>\n";
		echo "<input type='text' name='item_quantity_".$count."' value='".$row['count']."'/>\n";
		echo "<input type='text' name='item_price_".$count."' value='".$row['price']."'/>\n";
		echo "<input type='text' name='item_currency_".$count."' value='GBP'/>\n";
		echo "<input type='text' name='ship_method_name_".$count."' value='UPS Ground'/>\n";
		echo "<input type='text' name='ship_method_price_".$count."' value='5.00'/>\n";
		echo "</div>";
		$TOTALPRICE += 5;
		$count++;
	}
}

echo "<b>TOTAL (w/shipping): ". $TOTALPRICE;
?>
</p>
<?php /*?><input type="image" name="Google Checkout" alt="Fast checkout through Google"
src="http://checkout.google.com/buttons/checkout.gif?merchant_id=change-this-now&w=180&h=46&style=white&variant=text&loc=en_US"
height="46" width="180"/>
</form><?php */?>

<?php /*?>
<form action="https://sandbox.google.com/checkout/api/checkout/v2/checkoutForm/Merchant/912256454751601" id="BB_BuyButtonForm" method="post" name="BB_BuyButtonForm" target="_top">
    <table cellpadding="5" cellspacing="0" width="1%">
        <tr>
            <td align="right" width="1%">
                <select name="item_selection_1">
                    <option value="1">£12.00 - testing</option>
                    <option value="2">£14.00 - testing1</option>
                </select>
                <input name="item_option_name_1" type="hidden" value="testing"/>
                <input name="item_option_price_1" type="hidden" value="12.0"/>
                <input name="item_option_description_1" type="hidden" value="testing"/>
                <input name="item_option_quantity_1" type="hidden" value="1"/>
                <input name="item_option_currency_1" type="hidden" value="GBP"/>
                <input name="item_option_name_2" type="hidden" value="testing1"/>
                <input name="item_option_price_2" type="hidden" value="14.0"/>
                <input name="item_option_description_2" type="hidden" value="testing"/>
                <input name="item_option_quantity_2" type="hidden" value="1"/>
                <input name="item_option_currency_2" type="hidden" value="GBP"/>
            </td>
            <td align="left" width="1%">
                <input alt="" src="https://sandbox.google.com/checkout/buttons/buy.gif?merchant_id=912256454751601&amp;w=117&amp;h=48&amp;style=white&amp;variant=text&amp;loc=en_US" type="image"/>
            </td>
        </tr>
    </table>
</form><?php */?>

<a href="welcome/paypalGateway" >Paypal</a>

<div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div>
<form name="doPayment" id="doPayment" action="payments_pro/do_direct_payment_demo" method="post">
<div>Credit card Type <select name="cardtype" id="cardtype" >
		 <option value="">Select Card Type</option>
          <option value="Visa">Visa</option>
          <option value="MasterCard">MasterCard</option>
          <option value="Amex">Amex</option>
          <option value="Discover">Discover</option>

</select></div>
<div>Credit card no <input type="text" name="cardNo" id="cardNo" value="" /></div>
<div>Expiration data</div>
<div>Month :  <input type="text" name="month" id="month" value="" /></div>
<div>Year:  <input type="text" name="year" id="year" value="" /></div>
<div>Card verification no:  <input type="text" name="ccv" id="ccv" value="" /></div>
<input type="submit" name="submit" id="submit" value="continue" />
</form>
