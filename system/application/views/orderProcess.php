<script type="text/javascript">
function shipAddress()
{

var shipOption = $("#shipAdd:checked").val();
alert(shipOption);
if(shipOption == 0)
{
$("#customer_first_nameS").val($("#customer_first_name").val());
$("#emailS").val($("#email").val());
$("#customer_last_nameS").val($("#customer_last_name").val());
$("#phone_numberS").val($("#phone_number").val());
$("#addressS").val($("#address").val());
$("#post_codeS").val($("#post_code").val());
$("#stateS").val($("#state").val());
$("#cityS").val($("#city").val());
$("#countryS").val($("#country").val());
}
else{
$("#customer_first_nameS").val("");
$("#emailS").val("");
$("#customer_last_nameS").val("");
$("#phone_number").val("");
$("#address").val("");
$("#post_code").val("");
$("#cityS").val("");
$("#stateS").val("");
$("#country").val("");
}
}


</script>
<div class="top-content-bg"></div>
<div class="content-mid">
	<h1>Shopping Cart</h1>
    <?php if(isset($paymentStatus)) { 	echo '<p style="border:1px solid #c98c21; background:#7b5722; padding:5px; margin-bottom:10px; float:left; color:#ffffff;">'.$paymentStatus.".</p>";   } ?>
    
    <div style="clear:both;"></div>
    <div class="result-table">
    <table cellpadding="0" cellspacing="0" border="0">
      <?php
            $TOTALPRICE = $_SESSION['totalprice'];
            if (count($_SESSION['cart'])){
					echo "<tr valign='top'>";
                    echo "<td><strong>Qty</strong></td>";
                    echo "<td><strong>Product Name</strong></td>"; 
                    echo "<td><strong>Unit Price</strong></td>";
                    echo "<td><strong>Subtotal</strong></td>";
                    //echo "<td>&nbsp;</td>\n";
                    echo "</tr>\n";
                foreach ($_SESSION['cart'] as $PID => $row){	
                    $data = array(	
                            'name' => "li_id[$PID]", 
                            'value'=>$row['count'], 
                            'id' => "li_id_$PID", 
                            'class' => 'process',
                            'size' => 5
                    );
                    
			
					
                    echo "<tr valign='top'>\n";
                    echo "<td>". form_input($data)."</td>\n";
                    echo "<td id='li_name_".$PID."'>". $row['name']."</td>\n"; 
                    echo "<td id='li_price_".$PID."'>$". $row['price']."</td>\n";
                    echo "<td id='li_total_".$PID."'>$".number_format($row['price'] * $row['count'], 2,'.',',')."</td>\n";
                    //echo "<td>&nbsp;</td>\n";
                    echo "</tr>\n";
                }
              if(isset($_SESSION['giftVoucherPrice']) && !empty($_SESSION['giftVoucherPrice'])) { 
       echo "<tr valign='top'>\n";
                echo "<td colspan='3' align='right'><strong>Gift Certificate</strong></td>\n";
                echo "<td>$".$_SESSION['giftVoucherPrice']."</td>\n";
                
                echo "</tr>\n";
        }  if(isset($_SESSION['TAX']) && !empty($_SESSION['TAX'])) { 
                echo "<tr valign='top'>\n";
                echo "<td colspan='3' align='right'><strong>TAX</strong></td>\n";
                echo "<td>$".$_SESSION['TAX']."</td>\n";                
                echo "</tr>\n";
        } 

                echo "<tr valign='top'>\n";
                echo "<td colspan='3' align='right'><strong>Shipping</strong></td>\n";
                echo "<td>$0</td>\n";
			    echo "</tr>\n";
				echo "<tr valign='top'>\n";
                echo "<td colspan='3' align='right'><strong>Total</strong></td>\n";
                echo "<td>$".$TOTALPRICE."</td>\n";
                
                echo "</tr>\n";
            
            }else{
                //just in case!
                echo "<tr><td>No items to show here!</td></tr>\n";
            }//end outer if count
            ?>
    </table>
    </div>
	<?
    //var_export($_SESSION);
    $_SESSION['cart'] ="";
    $_SESSION['totalprice'] ="";
    $_SESSION['purchase'] ="";
	$_SESSION['giftVoucherPrice'] ="";
    //session_destroy();
    ?>
</div>
<div class="bottom-content-bg"></div>