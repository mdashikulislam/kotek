<script type="text/javascript" src="./js/jquery.idTabs.min.js"></script>
<div class="top-content-bg"></div>
<div class="content-mid">
	<h1><strong>it&acute;s time</strong> to twinkle</h1>
    <div id="prod-content">
      <?php
        echo form_open_multipart('welcome/cart/'.$product['id']);
        if ($this->session->flashdata('conf_msg')){ //change!
            echo "<div class='message'>";
            echo $this->session->flashdata('conf_msg');
            echo "</div>";
        }
      ?>
      
      
      <?php
          echo "<img src='".$product['thumbnail']."' border='0' align='left'/>\n";
          echo "<h2>".$product['name']."</h2>\n";
          echo "<p>".$product['longdesc'] . "<br/>\n";
          echo "Colors: ";
          foreach ($assigned_colors as $value){
          echo "<input type='radio' name='colors' id='colors' value='".$value."' /> ". $colors[$value] . "&nbsp;";
          }
          echo "<br/>";
      ?>
      <?php 	if($product['id'] == 1 || $product['id'] == 5){
      		if($product['id'] == 1){
      ?>
      <div>
        <div>Added lace to border</div>
        <div>lace
          <input type="radio" name="lace" id="lace" value="1" checked="checked" />
          Yes &nbsp;
          <input type="radio" name="lace" id="lace" value="1" />
          NO</div>
      </div>
      <?php } ?>
      <div>&nbsp;</div>
      <div>Lettering options</div>
      <div>1. Choose your script. (Click on style to view letters)</div>
      <div>
        <?php
            foreach ($assigned_sizes as $value){
                echo "<input type='radio' name='fonts' id='fonts' value='".$value."' /> <img src='./".$sizes[$value] . "' border='0' />&nbsp;";
            } 
            echo "<br/>";
        //  echo anchor('welcome/cart/'.$product['id'],'add to cart') . "</p>\n";
        ?>
      </div>
      <div>Enter your personalize text</div>
      <div>Line 1:
        <input type="text" name="textLine1" id="textLine1" value=""/>
      </div>
      <div>Line 2:
        <input type="text" name="textLine2" id="textLine2" value=""/>
      </div>
      <div>&nbsp;</div>
      <div>Select the color for your personalized text</div>
      <div>
        <div style="float:left; width:10%;">
          <div>White
            <input type="radio" name="textColor" id="textColor" value="white" />
          </div>
        </div>
        <div style="float:left; width:10%;">
          <div>Brown
            <input type="radio" name="textColor" id="textColor" value="brown" />
          </div>
        </div>
        <div style="float:left; width:15%;">
          <div>Orange
            <input type="radio" name="textColor" id="textColor" value="orange" />
          </div>
        </div>
        <div style="float:left; width:10%;">
          <div>Green
            <input type="radio" name="textColor" id="textColor" value="green" />
          </div>
        </div>
        <div style="float:left; width:20%;">
          <div>Baby blue
            <input type="radio" name="textColor" id="textColor" value="babay_blue" />
          </div>
        </div>
        <div style="float:left; width:10%;">
          <div>Blue
            <input type="radio" name="textColor" id="textColor" value="blue" />
          </div>
        </div>
        <div style="float:left; width:10%;">
          <div>Pick
            <input type="radio" name="textColor" id="textColor" value="pick" />
          </div>
        </div>
        <div style="float:left; width:10%;">
          <div>Purple
            <input type="radio" name="textColor" id="textColor" value="purple" />
          </div>
        </div>
      </div>
    </div>
	<?php
		}
		echo form_submit('submit','Add to basket');
		echo form_close();

	?>
</div>
<div class="bottom-content-bg"></div>