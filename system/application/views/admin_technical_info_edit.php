<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title><?php echo $title; ?></title>
<link href="<?= base_url();?>css/admin.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?= base_url();?>css/demo_table.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript">
//<![CDATA[
base_url = '<?= base_url();?>';
//]]>
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/customtools.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/menuNavigation.js" ></script>

<style type="text/css">
.createBtn {
    width: 160px;
    height: 45px;
    text-align: center;
    color: #ffffff;
    /*background: url(../images/createBannerBtn.png) no-repeat scroll 0 top;*/
    border: none;
    cursor: pointer;
    padding: 0;
    margin: 0px 0 0 0;
    text-transform: uppercase;
    text-decoration: none;
    font-weight: normal;
    font-size: 12px;
    display: inline-block;
}

textarea {
    /*//width: 174px;*/
    /*height: 18px;*/
    /*background: url(../images/textfieldBg.png) no-repeat scroll 0 0;*/
    border: 1;
    margin: 0;
    padding: 4px;
    color: #6B6B6B;
}  

.technicalCreateBtn {
    background-color: #2f689a;
    border-radius: 5px;
    height: 38px;
    margin: -3px;
    width: 184px;
    color: white !important;
}    
</style>

<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico" >
</head>
<body>
<div id="wrapper">
    <div id="header">
      <?php $this->load->view('admin_header');?>
    </div>
    <div id="main">
       




<script type="text/javascript">
  $(document).ready(function() {
 $.validator.addMethod('filesize', function(value, element, param) {
    // param = size (en bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    return this.optional(element) || (element.files[0].size <= param) 
});
  $("#bannerForm").validate({
        rules: {  name:{   required : true},
                  keyword:{   required : true},
                  description:{   required : true},
                  content:{   required : true}
          },
        messages: {     title: { required: "Please enter required" },
                        keyword: { required: "Please enter required" },
                        description: { required: "Please enter required" },
                        content: { required: "Please enter required" },
                        title: { required: "Please enter required" }
        }
    });
      });
  
  </script>
<h1 class="pageTitle"><?php echo $title;?></h1>



<div class="dashboardWrapper">
    <form method='post' name='bannerForm' id='bannerForm' action='<?php echo base_url() ?>admin/technical/update'>    
        <table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>
            <input type='hidden' name='updated_id' id='updated_id' value='<?php echo $record[0]->id; ?>'>
            <tr>
                <td width='150'><label for='name'>Name<span class='red'>*</span> :</label></td>
                <td width='810'><input type='text' name='name' id='name' value='<?php echo $record[0]->name; ?>' class='textfield'></td>
            </tr>
            <tr>
                <td width='150'><label for='name'>Keywords<span class='red'>*</span> :</label></td>
                <td width='810'><input type='text' name='keyword' id='keyword' value='<?php echo $record[0]->keywords; ?>' class='textfield'></td>
            </tr>
            <tr>
                <td width='150'><label for='name'>Description<span class='red'>*</span> :</label></td>
                <td width='810'><input type='text' name='description' id='description' value='<?php echo $record[0]->description; ?>' class='textfield'></td>
            </tr>
            <tr>
                <td width='150'><label for='name'>Link<span class='red'>*</span> :</label></td>
                <td width='810'>
                    <!-- <input type='text' name='content' id='content' value='<?php echo $record[0]->content; ?>' class='textfield'> -->
                    <textarea name='content' id='content' cols='30' rows='4' style="width: 175px; height: 57px;"><?php echo $record[0]->content; ?></textarea>
                </td>
            </tr>
            <tr>
                <td width='150'><label for='name'>Video<span class='red'>*</span> :</label></td>
                <td width='810'><iframe width="420" height="315"  allowfullscreen="allowfullscreen" src="<?php echo $record[0]->content; ?>"></iframe></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type='submit' value='UPDATE' class='technicalCreateBtn' /></td>
            </tr>
        </table>
    </form>        
</div>




    </div>
        <div id="footer"> 
      <?php $this->load->view('admin_footer');?>
    </div>
</div>

</body>
</html>

<script type="text/javascript">
<script type="text/javascript">

$(document).ready( function() {

    $("#tablesorter").dataTable( {

        "iDisplayLength": 40,

                "oLanguage": {

            "sLengthMenu": 'Display <select>'+

                '<option value="20">20</option>'+

                '<option value="40">40</option>'+

                '<option value="60">60</option>'+

                '<option value="80">80</option>'+

                '<option value="100">100</option>'+

                '<option value="-1">All</option>'+

                '</select> records'

        },

        "aoColumns": [
{ "sWidth": "5%", "sClass": "center", "bSortable": false },
        { "sWidth": "10%" },

        { "sWidth": "40%" },

        { "sWidth": "15%" },

        { "sWidth": "15%", "sClass": "center", "bSortable": false },

        { "sWidth": "25%", "sClass": "center", "bSortable": false } ]

    } );

});    
</script>
