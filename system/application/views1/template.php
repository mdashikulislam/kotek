<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<base href="<?=base_url();?>">
<link href="<?= base_url();?>css/default.css" rel="stylesheet" type="text/css" />
<noscript>
Javascript is not enabled! Please turn on Javascript to use this site.
</noscript>
<link rel="shortcut icon" href="./images/favicon.ico" >
<script type="text/javascript" src="./js/jquery.min.js" ></script>
<script src="./js/facebox.js" type="text/javascript"></script>
<script type="text/javascript" src="./js/jquery.validate.js" ></script>
<link href="<?= base_url();?>css/facebox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : './images/loading.gif',
        closeImage   : './images/closelabel.png'
      })
    });
	
var siteUrl = "<?php echo base_url();?>";
  </script>
<script type="text/javascript" src="./js/js-functions.js" ></script>

</head>
<body>
<div id="wrapper">
    <div id="header">
      <?php $this->load->view('header');?>
    </div>
    
    <!-- Main Content Area starts here -->
    <div id="maincontent">
      <div id="container">

            <div class="content">
                <?php $this->load->view($main);?>
            </div>
        
      </div>
       
      <div id="footer">
          <?php $this->load->view('footer');?>
      </div>
    </div>
</div>

</body>
</html>
