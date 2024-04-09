<?php

class MNews extends Model{

	function MNews(){
		parent::Model();
	}

	function getNews($id){
		$data = array();
		$options = array('id' => id_clean($id));
		$Q = $this->db->getwhere('news',$options,1);
		if ($Q->num_rows() > 0){
		  $data = $Q->row_array();
		}
	
		$Q->free_result();    
		return $data;    
	 }
	function getNewsName($id){
    $data = array();
     $this->db->select('title');
     $this->db->where('id',$id);
     $Q = $this->db->get('news');
    if ($Q->num_rows() > 0){
      foreach ($Q->result_array() as $row){
       return  $row['title'];
       }
    }

    $Q->free_result();    
     
 }
 function getAllNews(){
     $data = array();
	  $this->db->select('id,title,description,status');
          $this->db->where('status', 'active');
     $Q = $this->db->get('news');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }
function getAllNewsAdmin(){
     $data = array();
	  $this->db->select('id,title,description,status');
       
     $Q = $this->db->get('news');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }
 function getAllNewsActive(){
     $data = array();
	  $this->db->select('id,title,description,status');
 $this->db->where('status','active');
     $Q = $this->db->get('news');
	
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }
 function getActiveNews(){
     $data = array();
     /** News table has fields of id, name and status.
      * the following will select all the ids and names where status is active
      * If there are any data, then the results are stored as arrays in $row.
      * then $row name is stored in $row id.
      */
     $this->db->select('id,title,description');
     $this->db->where('status','active');
     $Q = $this->db->get('news');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['title'];
       }
    }
    $Q->free_result();  
    return $data; 
 }
 
 
  function getActiveNewsProduct(){
     $data = array();
     /** News table has fields of id, name and status.
      * the following will select all the ids and names where status is active
      * If there are any data, then the results are stored as arrays in $row.
      * then $row name is stored in $row id.
      */
     $this->db->select('id,title,description');
     $this->db->where('status','active');
     $Q = $this->db->get('news');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['title']."(".$row['description'].")";
       }
    }
    $Q->free_result();  
    return $data; 
 }
 
 function createNews(){
	$data = array( 
		'title' => db_clean($_POST['title'],250),
		'status' => db_clean($_POST['status'],8),
		'description' => db_clean($_POST['elm1'])
	);
	
	

	/* if ($_FILES){
		$config['upload_path'] = './images/news/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);	
	
		if (strlen($_FILES['image']['title'])){
			if(!$this->upload->do_upload('image')){
				$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 200 KB');
		  		redirect('admin/news/index','refresh');
			}
			$image = $this->upload->data();
		
			if ($image['file_title']){
				$data['image'] = "images/news/".$image['file_title'];
		
			}
		}
		} */
	

	$this->db->insert('news', $data);	 
 }
 
 
 function updateNews(){
	$data = array( 
		'title' => db_clean($_POST['title'],250),
		'status' => db_clean($_POST['status'],8),
		'description' => db_clean($_POST['elm1'])
	
	);

 /*   if ($_FILES){
		$config['upload_path'] = './images/news/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '1024';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);	
	
		if (strlen($_FILES['image']['title'])){
			if(!$this->upload->do_upload('image')){
				$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 200 KB');
		  		redirect('admin/news/index','refresh');
			}
			$image = $this->upload->data();
		
			if ($image['file_title']){
				$data['image'] = "images/news/".$image['file_title'];
		
			}
		}
	}
*/

 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('news', $data);	
 
 }
 
 function deleteNews($id){
 //	$data = array('status' => 'inactive');
 	$this->db->where('id', id_clean($id));
	$this->db->delete('news');
	
 } 
 
 
 
 // Testimonial section 
 
 /**  Here managing add/ edit / delete functionality **/
 
	 function createTestimonial(){
		$data = array( 
			'title' => db_clean($_POST['title']),
			'status' => db_clean($_POST['status'],8),
			'description' => $_POST['description']
		);
			$this->db->insert('testimonial', $data);	 
	 }
	 
	 function updateTestimonial(){
		$data = array( 
			'title' => db_clean($_POST['title'],32),
			'status' => db_clean($_POST['status'],8),
			'description' => $_POST['description']
		
		);
		$this->db->where('id', id_clean($_POST['id']));
		$this->db->update('testimonial', $data);	
	 }
	 
	 function deleteTestimonial($id){
		$this->db->where('id', id_clean($id));
		$this->db->delete('testimonial');	
	 } 
 
 	 function getAllTestimonial(){
     $data = array();
	  $this->db->select('id,title,description,status');
          $this->db->where('status', 'active');
     $Q = $this->db->get('testimonial');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 	}
  function getAllTestimonialAdmin(){
     $data = array();
	  $this->db->select('id,title,description,status');
         
     $Q = $this->db->get('testimonial');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 	}
 function getTestimonial($id){
		$data = array();
		$options = array('id' => id_clean($id));
		$Q = $this->db->getwhere('testimonial',$options,1);
		if ($Q->num_rows() > 0){
		  $data = $Q->row_array();
		}
	
		$Q->free_result();    
		return $data;    
	 }
 
 
 
  // Home Page Banner section 
 
 /**  Here managing add/ edit / delete functionality **/
 
	 function createBanner(){
		$data = array( 
			'title' => db_clean($_POST['title'],32),
			'status' => db_clean($_POST['status'],8),
			'place_order' => db_clean($_POST['place_order'],8),
			
		);
		
		if ($_FILES){
		
		  if (strlen($_FILES['image']['name'])){
			$config['upload_path'] = './images/banner/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '1024';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$this->load->library('upload', $config);	
			
			if (strlen($_FILES['image']['name'])){
			if(!$this->upload->do_upload('image')){
			$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 1 MB');
			redirect('admin/banner/index','refresh');
			}
			$image = $this->upload->data();
			
			if ($image['file_name']){
			$data['image'] = "images/banner/".$image['file_name'];
			
			}
			}
			
		  }
		
		if (strlen($_FILES['thumbnail']['name'])){
 		    $config= array();
			$config['upload_path'] = './images/banner/thumbnail/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '50';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			
			$this->upload->initialize($config);
			//$this->load->library('upload', $config);	

			if (strlen($_FILES['thumbnail']['name'])){
			if(!$this->upload->do_upload('thumbnail')){
			$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 50 KB');
			redirect('admin/banner/index','refresh');
			}
			$image = $this->upload->data();
			
			if ($image['file_name']){
			$data['thumbnail'] = "images/banner/thumbnail/".$image['file_name'];
			}
			}				
		}
	}

		
			$this->db->insert('banner', $data);	 
	 }
	 
	 function updateBanner(){
		$data = array( 
			'title' => db_clean($_POST['title'],32),
			'status' => db_clean($_POST['status'],8),
			'place_order' => db_clean($_POST['place_order'],8),
		);
				if ($_FILES){
				$this->load->library('upload');	
				if (strlen($_FILES['image']['name'])){
				$config['upload_path'] = './images/banner/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '1024';
				$config['remove_spaces'] = true;
				$config['overwrite'] = false;
				//$this->load->library('upload', $config);	
				$this->upload->initialize($config);
				if (strlen($_FILES['image']['name'])){
				if(!$this->upload->do_upload('image')){
				$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 1 MB');
				redirect('admin/banner/index','refresh');
				}
				$image = $this->upload->data();
				
				if ($image['file_name']){
				$data['image'] = "images/banner/".$image['file_name'];
				
				}
				}
				
				}
				
				if (strlen($_FILES['thumbnail']['name'])){
				$config= array();
				$config['upload_path'] = './images/banner/thumbnail/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '50';
				$config['remove_spaces'] = true;
				$config['overwrite'] = false;
				
				$this->upload->initialize($config);
				
				
				if (strlen($_FILES['thumbnail']['name'])){
				if(!$this->upload->do_upload('thumbnail')){
				$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 50 KB');
				redirect('admin/banner/index','refresh');
				}
				$image = $this->upload->data();
				
				if ($image['file_name']){
				$data['thumbnail'] = "images/banner/thumbnail/".$image['file_name'];
				}
				}				
				}
				}
		$this->db->where('id', id_clean($_POST['id']));
		$this->db->update('banner', $data);	
	 }
	 function updateBannerSt($id,$status)
	{
     $data = array('place_order' => $status);
      $this->db->where('id',$id);
      $this->db->update('banner',$data);  
	
	}
	 function deleteBanner($id){
		$this->db->where('id', id_clean($id));
		$this->db->delete('banner');	
	 } 
 
 	 function getAllBanner(){
     $data = array();
	  $this->db->select('id,title,image,thumbnail,status,place_order');
	  $this->db->order_by("place_order", "asc"); 
     $Q = $this->db->get('banner');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 	}
function getAllBannerAdmin(){
     $data = array();
	  $this->db->select('id,title,image,thumbnail,status,place_order');
	  $this->db->order_by("place_order", "asc"); 
     $Q = $this->db->get('banner');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 	}
	function getAllBannerActive(){
     $data = array();
	  $this->db->select('id,title,image,thumbnail,status,place_order');
	  $this->db->where('status', 'active');
	  $this->db->order_by("place_order", "asc"); 
     $Q = $this->db->get('banner');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 	}
	function getBanner($id){
		$data = array();
		$options = array('id' => id_clean($id));
		$Q = $this->db->getwhere('banner',$options,1);
		if ($Q->num_rows() > 0){
		  $data = $Q->row_array();
		}
	
		$Q->free_result();    
		return $data;    
	 }
 
 	  // Home Page Advertise section 
 
 /**  Here managing add/ edit / delete functionality **/
 
	 function createAdvertise(){
		$data = array( 
			'title' => db_clean($_POST['title'],32),
			'year' => db_clean($_POST['year'],32),
			'status' => db_clean($_POST['status'],8),
			
		);
		
		if ($_FILES){
		
		  if (strlen($_FILES['image']['name'])){
			$config['upload_path'] = './images/advertise/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '1075';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			$this->load->library('upload', $config);	
			
			if (strlen($_FILES['image']['name'])){
			if(!$this->upload->do_upload('image')){
			$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 1MB');
			redirect('admin/advertise/index','refresh');
			}
			$image = $this->upload->data();
			
			if ($image['file_name']){
			$data['image'] = "images/advertise/".$image['file_name'];
			
			}
			}
			
		  }
		
		if (strlen($_FILES['thumbnail']['name'])){
 		    $config= array();
			$config['upload_path'] = './images/advertise/thumbnail/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '40';
			$config['remove_spaces'] = true;
			$config['overwrite'] = false;
			
			$this->upload->initialize($config);
			//$this->load->library('upload', $config);	

			if (strlen($_FILES['thumbnail']['name'])){
			if(!$this->upload->do_upload('thumbnail')){
			$this->session->set_flashdata('error','Allowed only gif,jpg or png thumbnail images with file size of max 40 KB');
			redirect('admin/advertise/index','refresh');
			}
			$image = $this->upload->data();
			
			if ($image['file_name']){
			$data['thumbnail'] = "images/advertise/thumbnail/".$image['file_name'];
			}
			}				
		}
	}

		
			$this->db->insert('advertise', $data);	 
	 }
	 
	 function updateAdvertise(){
		$data = array( 
			'title' => db_clean($_POST['title'],32),
			'year' => db_clean($_POST['year'],32),
			'status' => db_clean($_POST['status'],8),
		);
				if ($_FILES){
				$this->load->library('upload');	
				if (strlen($_FILES['image']['name'])){ 
				$config['upload_path'] = './images/advertise/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '1075';
				$config['remove_spaces'] = true;
				$config['overwrite'] = false;
				$this->upload->initialize($config);	
				
				if (strlen($_FILES['image']['name'])){
				if(!$this->upload->do_upload('image')){
				$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 1MB');
				redirect('admin/advertise/index','refresh');
				}
				$image = $this->upload->data();
				
				if ($image['file_name']){
				$data['image'] = "images/advertise/".$image['file_name'];
				
				}
				}
				
				}
				
				if (strlen($_FILES['thumbnail']['name'])){
				$config= array();
				$config['upload_path'] = './images/advertise/thumbnail/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '40';
				$config['remove_spaces'] = true;
				$config['overwrite'] = false;
				
				$this->upload->initialize($config);
				//$this->load->library('upload', $config);	
				
				if (strlen($_FILES['thumbnail']['name'])){
				if(!$this->upload->do_upload('thumbnail')){ 
				$this->session->set_flashdata('error','Allowed only gif,jpg or png thumbnail images with file size of max 40 KB');
				redirect('admin/advertise/index','refresh');
				}
				$image = $this->upload->data();
				
				if ($image['file_name']){
				$data['thumbnail'] = "images/advertise/thumbnail/".$image['file_name'];
				}
				}				
				}
				}
		$this->db->where('id', id_clean($_POST['id']));
		$this->db->update('advertise', $data);	
	 }
	 
	 function deleteAdvertise($id){
		$this->db->where('id', id_clean($id));
		$this->db->delete('advertise');	
	 } 
 
 	 function getAllAdvertise(){
     $data = array();
	  $this->db->select('id,title,image,thumbnail,status');
     $Q = $this->db->get('advertise');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }$Q->free_result();  
    return $data; 
	 }
	function getAllAdvertiseYear(){
     $data = array();
	  $this->db->select('id,year');
     $this->db->group_by("year"); 
	 $Q = $this->db->get('advertise');
	 
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 	}
	
			function getAdsByYear($year){
			$data = array();
			$this->db->select('id,title,image,thumbnail,status');
			$this->db->where('year', $year);
			$this->db->where('status','active');
			$Q = $this->db->get('advertise');
$data= array();
			if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
			$data[] = $row;
			}
			}
			return $data;
			}
	function getAdvertise($id){
		$data = array();
		$options = array('id' => id_clean($id));
		$Q = $this->db->getwhere('advertise',$options,1);
		if ($Q->num_rows() > 0){
		  $data = $Q->row_array();
		}
	
		$Q->free_result();    
		return $data;    
	 }	
 
	 function updateAdvertiseSt($id,$status)
	{
      $data = array('status' => $status);
      $this->db->where('id',$id);
      $this->db->update('advertise',$data);  
	
	}
 
}//end class
?>