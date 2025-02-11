<script type="text/javascript" src="<?php echo base_url(); ?>js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<script type="text/javascript">
  $(document).ready(function() {

$.validator.addMethod("noSpecialChars", function(value, element) {
      return this.optional(element) || /^[a-z0-9\_\ ]+$/i.test(value);
  }, "This field must contain only letters, numbers, or underscore.");

 $.validator.addMethod("NumbersOnly", function(value, element) {
        return this.optional(element) || /^[0-9\-\ \+]+$/i.test(value);
    }, "Phone must contain only numbers, + and -.");

 
  $("#formPages").validate({
        rules: {  name:{   required : true},
		path:{   required : true}

		  },
        messages: { 
		name: { required: "Please enter Title/Page name"},
		path: { required: "Please enter path"}
		  
        }       });
      });
  
  </script>
<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
$fdata = array('name'=>'formPages', 'id'=>'formPages');
echo form_open('admin/pages/create',$fdata);

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='pname'>Title/Page Name<span class='red'>*</span> :</label></td><td width='810'>";
$data = array('name'=>'name','id'=>'pname','class'=>'textfield','size'=>25);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='short'>Keywords :</label></td><td>";
$data = array('name'=>'keywords','id'=>'short','class'=>'textfield','size'=>40);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='desc'>Description :</label></td><td>";
$data = array('name'=>'elm1','id'=>'elm1','class'=>'textfield','size'=>40);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='fpath'>Path/FURL<span class='red'>*</span> :</label></td><td>";
$data = array('name'=>'path','id'=>'fpath','class'=>'textfield','size'=>50);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='short'>Display in :</label></td><td>";
echo "<select name='display_in' id='display_in'>
<option value='1'>Link</option>
<option value='2'>Header</option>
<option value='3'>Footer</option>
<option value='4'>Header & Footer</option>
</select></td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='short'>Page display order :</label></td><td>";
$data = array('name'=>'order_show','id'=>'order_show','class'=>'textfield','size'=>40);
echo form_input($data) ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><label for='long'>Content :</label></td><td>";
$data = array('name'=>'content','id'=>'long','rows'=>5, 'cols'=>'40');
echo form_textarea($data) ."</td>";
echo "</tr>";

echo "<tr style='display:none;'>";
echo "<td><label for='status'>Status :</label></td><td>";
$options = array('active' => 'active');
echo form_dropdown('status',$options) ."</td>";
echo "</tr>";

echo "<tr><td>&nbsp;</td><td>";
echo "<input type='submit' value='' class='createPageBtn' title='Create Page' />";
echo "</td></tr>";

echo "</table>";

echo form_close();


?>
</div>