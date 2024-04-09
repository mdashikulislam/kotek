<?php

class Vidoes extends Controller {
  function Vidoes(){
    parent::Controller();
	session_start();
    
	if (!isset($_SESSION['userid']) || $_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
    
    $this->tinyMce = '
		<!-- TinyMCE -->
		<script type="text/javascript" src="'. base_url().'js/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
			 tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	plugins : "safari,spellchecker,videobreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",

	// Theme options
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,videobreak,|,insertfile,insertimage",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,

	// Example content CSS (should be your site CSS)
	content_css : "css/example.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "js/template_list.js",
	external_link_list_url : "js/link_list.js",
	external_image_list_url : "js/image_list.js",
	media_external_list_url : "js/media_list.js",

	// Replace values for the template plugin
	template_replace_values : {
		username : "Some User",
		staffid : "991234"
	}
});
		</script>
		<!-- /TinyMCE -->
		';
  }
  

  function index(){
	$data['title'] = "Manage Vidoes";
	$data['main'] = 'admin_videos_home';
	$data['videos'] = $this->MVideos->getAllVidoes();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  

  
  function create(){
   	if ($this->input->post('name')){
  		$this->MVideos->addPage();
  		$this->session->set_flashdata('message','Page created');
  		redirect('admin/videos/index','refresh');
  	}else{
		$data['title'] = "Create Page";
		$data['main'] = 'admin_videos_create';
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('name')){
  		$this->MVideos->updatePage();
  		$this->session->set_flashdata('message','Page updated');
  		redirect('admin/videos/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Page";
		$data['main'] = 'admin_videos_edit';
		$data['video'] = $this->MVideos->getPage($id);
		if (!count($data['video'])){
			redirect('admin/videos/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MVideos->deletePage($id);
	$this->session->set_flashdata('message','Page deleted');
	redirect('admin/videos/index','refresh');
  }


	
}//end class
?>