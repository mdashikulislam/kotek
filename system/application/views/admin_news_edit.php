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

 

  $("#newsForm").validate({

        rules: {  title:{   required : true,  minlength: 3,  maxlength: 250 }

		  },

        messages: { 	title: { required: "Please enter news title" }

		}

	});

      });

  

  </script>

<h1 class="pageTitle"><?php echo $title;?></h1>

<div class="dashboardWrapper">

<?php

$fdata = array('name'=>'newsForm','id'=>'newsForm');

echo form_open_multipart('admin/news/edit', $fdata);



echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";



echo "<tr>";

echo "<td width='150'><label for='name'>Title<span class='red'>*</span> :</label></td><td width='810'>";

$data = array('name'=>'title','id'=>'title','class'=>'textfield','size'=>150, 'value'=>$news['title']);

echo form_input($data) ."</td>";

echo "</tr>";



echo "<tr>";

echo "<td><label for='status'>Status :</label></td><td>";

$options = array('active' => 'active', 'inactive' => 'inactive');

echo form_dropdown('status',$options, $news['status']) ."</td>";

echo "</tr>";



echo "<tr>";

echo "<td><label for='long'>Description<span class='red'>*</span> :</label></td><td>\n";

$data = array('name'=>'elm1','id'=>'elm1','rows'=>5, 'cols'=>'40', 'value'=>$news['description']);

echo form_textarea($data) ."</td>\n";

echo "</tr>";



echo "<tr><td>&nbsp;</td><td>";



echo form_hidden('id',$news['id']);

echo "<input type='submit' value='' class='updateNewsBtn' title='Update News' />";

echo "</td></tr>";



echo "</table>";



echo form_close();



?>

</div>

