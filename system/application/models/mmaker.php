<?php

class MMaker extends Model{

	function MMaker(){
		parent::Model();
	}

function getMaker($id){
    $data = array();
    $options = array('id' => id_clean($id));
    $Q = $this->db->getwhere('maker',$options,1);
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
 
 	function getMakerName($id){
    $data = array();
     $this->db->select('name');
     $this->db->where('id',$id);
     $Q = $this->db->get('maker');
    if ($Q->num_rows() > 0){
      foreach ($Q->result_array() as $row){
       return  $row['name'];
       }
    }

    $Q->free_result();    
     
 }
	
	
 function getAllMakers(){
     $data = array();
	  $this->db->orderby('name','asc');
     $Q = $this->db->get('maker');
	 
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }
 
 function getActiveMaker(){
     $data = array();
     /** Makers table has fields of id, name and status.
      * the following will select all the ids and names where status is active
      * If there are any data, then the results are stored as arrays in $row.
      * then $row name is stored in $row id.
      */
     $this->db->select('id,image,name');
     $this->db->where('status','active');
     $Q = $this->db->get('maker');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']][0] = $row['image'];
		 $data[$row['id']][1] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 } 
 
 function createMaker(){
	$data = array( 
		'name' => db_clean($_POST['name'],32),
		'status' => db_clean($_POST['status'],8),
		'description' => db_clean($_POST['maker_desc'])
	);

	/* if ($_FILES){
		$config['upload_path'] = './images/maker/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '20o';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);	
	
		if (strlen($_FILES['image']['name'])){
			if(!$this->upload->do_upload('image')){
				//$this->upload->display_errors();
				$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 200 KB');
		  		redirect('admin/maker/index','refresh');
			}
			$image = $this->upload->data();
		
			if ($image['file_name']){
				$data['image'] = "images/maker/".$image['file_name'];
		
			}
		}
		} */
	

	$this->db->insert('maker', $data);	 
 }
 
 function updateMaker(){
	$data = array( 
		'name' => db_clean($_POST['name'],32),
		'status' => db_clean($_POST['status'],8),
		'description' => db_clean($_POST['maker_desc'])
	
	);

 /*   if ($_FILES){
		$config['upload_path'] = './images/maker/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '20o';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);	
	
		if (strlen($_FILES['image']['name'])){
			if(!$this->upload->do_upload('image')){
				//$this->upload->display_errors();
				//exit();
				$this->session->set_flashdata('error','Allowed only gif,jpg or png images with file size of max 200 KB');
		  		redirect('admin/maker/index','refresh');
			}
			$image = $this->upload->data();
		
			if ($image['file_name']){
				$data['image'] = "images/maker/".$image['file_name'];
		
			}
		}
	}

*/
 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('maker', $data);	
 
 }
 
 function deleteMakers($id){
 //	$data = array('status' => 'inactive');

	  $make_search = " AND  c.maker ='".$id."' ";
	 $Q = $this->db->query('SELECT p.*,m.name as maker_name,c.title as model_name FROM products p, carmodel c 
LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id '.$make_search.' ');
	 
	 $data = array();
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
		 
		 $this->db->query("delete * from products where id = '".$row['id']."'");
       }
    }



 	$this->db->where('id', id_clean($id));
	$this->db->delete('maker');
	
 } 
 
 
 function updateMakerSt($id,$status)
	{
      $data = array('status' => $status);
      $this->db->where('id',$id);
      $this->db->update('maker',$data);  
	
	}
 
}//end class
?>