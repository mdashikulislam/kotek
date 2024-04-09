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
<script type="text/javascript">
function updateOrderStatus(status, id)
{

var reqUrl = "/twinklemynet/index.php/admin/orders/updateOrderStatus/"+id+"/"+status
$.ajax({
  url: reqUrl,
  context: document.body,
  success: function(){
    alert("Order status updated");
  }
});
}

</script>
<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico" >
</head>
<body>
<div id="wrapper">
  		<div id="header">
		  <?php $this->load->view('admin_header');?>
        </div>
		<div id="main">
		  <?php $this->load->view($main);?>
        </div>
  		<div id="footer"> 
		  <?php $this->load->view('admin_footer');?>
        </div>
</div>


<script type="text/javascript">
function deletechecked(message)
{
    var answer = confirm(message)
    if (answer){
       return true;
    }
    
    return false;  
}  

</script>

</body>
</html>
