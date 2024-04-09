<?php

class MCarmodel extends Model{

	function MCarmodel(){
		parent::Model();
	}

function getCarmodel($id){
    $data = array();
    $options = array('id' => id_clean($id));
    $Q = $this->db->getwhere('carmodel',$options,1);
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }
  function getModelByMaker($makerId)
 {
	 $this->db->select('id,title');
	 $this->db->where('maker',$makerId);
         $this->db->order_by("title", "asc"); 
    $Q = $this->db->get('carmodel');
	$data = array();
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
		 $data[$row['id']] = $row['title'];
       }
    }
    $Q->free_result();  
    return $data; 
	 
  }
  
  function getYearListByModel($modelId)
  {
	 if(!empty($modelId))
	 {$this->db->select('id,name,year_to,year_from');
	 $this->db->where('model',$modelId);
	 $this->db->group_by('year_to');
	 $this->db->group_by('year_from');
	 
    $Q = $this->db->get('products');
	 }else{
		    
	if(!empty($_SESSION['make']))  {$make_search = " AND  c.maker ='".$_SESSION['make']."' "; }
	
     $Q = $this->db->query('SELECT p.*,m.name as maker_name,c.title as model_name FROM products p, carmodel c 
LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id '.$make_search.' group by p.year_to,p.year_from '); 
	} $data = array();
     if ($Q->num_rows() > 0){
         $data = $Q->result_array();
	   
    }
    $Q->free_result();  
    return $data; 
	  
  }
  
  function getGroupListByYear($yearSpan) 
  { 
   
  $yearSpan1 = explode('-',$yearSpan); $year_search =""; $model_search =""; $make_search ="";
    if(!empty($_SESSION['model'])) {$model_search = " AND  p.model ='".$_SESSION['model']."' "; }
	if(!empty($_SESSION['make']))  {$make_search = " AND  c.maker ='".$_SESSION['make']."' "; }
	if(isset($yearSpan1[0]) && isset($yearSpan1[1])){
  	$year_search = " AND p.year_to >= '".$yearSpan1[0]."' AND p.year_from <= '".$yearSpan1[1]."' ";
	}else{ $_SESSION['year'] =""; }	

     $Q = $this->db->query('SELECT p.*,m.name as maker_name,c.title as model_name FROM products p, carmodel c 
LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id '.$model_search.' '.$make_search.' '.$year_search.' ');
		 
		
	 //$this->db->where('model',$modelId);
	 //$this->db->group_by("category_id"); 
 //   $Q = $this->db->get('products');
 $data = array();
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
		   $cat = $this->MCats->getCategory($row['category_id']);		  
		   if(!empty($cat['id'])){
                      $data[$cat['id']] = $cat['name']; }
       }
    }
    $Q->free_result();  
    return $data; 
	  
  }
  function getGroupListByModel($modelId)
  {
	$Q = $this->db->query('SELECT c.name,c.id FROM products AS p, categories AS c WHERE p.category_id = c.id AND p.model = "'.$modelId.'"');
	 //$this->db->where('model',$modelId);
	 //$this->db->group_by("category_id"); 
 //   $Q = $this->db->get('products');
 $data = array();
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
		 $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
	  
  }
  
 	function getCarmodelName($id){
    $data = array();
     $this->db->select('title');
     $this->db->where('id',$id);
     $Q = $this->db->get('carmodel');
    if ($Q->num_rows() > 0){
      foreach ($Q->result_array() as $row){
       return  $row['title'];
       }
    }

    $Q->free_result();    
     
 }
	
 function getAllCarmodels(){
     $data = array();
     $Q = $this->db->get('carmodel');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }
 function getCarMaker()
 {
	$this->db->select('id,image,name');
    $Q = $this->db->get('maker');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
		 $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data;  
  }
 function getActiveCarmodel(){
     $data = array();
     /** Carmodels table has fields of id, name and status.
      * the following will select all the ids and names where status is active
      * If there are any data, then the results are stored as arrays in $row.
      * then $row name is stored in $row id.
      */
     $this->db->select('id,image,name');
     $this->db->where('status','active');
     $Q = $this->db->get('carmodel');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']][0] = $row['image'];
		 $data[$row['id']][1] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 } 
 
 function createCarmodel(){
	$data = array( 
		'title' => db_clean($_POST['title'],32),
		'status' => db_clean($_POST['status'],8),
		'description' => db_clean($_POST['carmodel_desc']),
		'maker' => db_clean($_POST['maker'])
	);

	/* if ($_FILES){
		$config['upload_path'] = './images/carmodel/';
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
		  		redirect('admin/carmodel/index','refresh');
			}
			$image = $this->upload->data();
		
			if ($image['file_name']){
				$data['image'] = "images/carmodel/".$image['file_name'];
		
			}
		}
		} */
	

	$this->db->insert('carmodel', $data);	 
 }
 
 function updateCarmodel(){
	$data = array( 
		'title' => db_clean($_POST['title'],32),
		'status' => db_clean($_POST['status'],8),
		'description' => db_clean($_POST['carmodel_desc']),
     	'maker' => db_clean($_POST['maker'])
	);

 /*   if ($_FILES){
		$config['upload_path'] = './images/carmodel/';
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
		  		redirect('admin/carmodel/index','refresh');
			}
			$image = $this->upload->data();
		
			if ($image['file_name']){
				$data['image'] = "images/carmodel/".$image['file_name'];
		
			}
		}
	}

*/
 	$this->db->where('id', id_clean($_POST['id']));
	$this->db->update('carmodel', $data);	
 
 }
 
 function deleteCarmodels($id){
 //	$data = array('status' => 'inactive');

$model_search = " AND  p.model ='".$id."' ";
	 $Q = $this->db->query('SELECT p.*,m.name as maker_name,c.title as model_name FROM products p, carmodel c 
LEFT JOIN maker m ON m.id = c.maker WHERE p.model = c.id '.$model_search.' ');
	 
	 $data = array();
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){		  
		 $this->db->query("delete from products where id = '".$row['id']."'");
       }
    }

 	$this->db->where('id', id_clean($id));
	$this->db->delete('carmodel');
	
 } 
  
  
  function createmaker()
  {
	  
	  $this->db->select('Group');
    $Q = $this->db->query('SELECT * FROM test ');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
		 $test = $row['model'];
		
		if(!empty($row['model'])){
		 $Q1 = $this->db->query('SELECT `id` FROM carmodel where title= "'.$row['model'].'"');
		 $maker = $Q1->result_array();
		 
		 // get category id 
		 $Q2 = $this->db->query('SELECT `id` FROM categories where name= "'.$row['Group'].'"');
		 $cat = $Q2->result_array();
		 
		
		 if(!empty($maker)){
		echo $makerId = $maker[0]['id'];
		echo $partnum = $row['Part Number']; 
		echo $nm = $row['Product']; 
		echo $year = explode("-",$row['Year']); 
		echo $specification = $row['Specification']; 
		echo $catID = $cat[0]['id']; 
		
		echo "<br/><br/>"; 
		if(empty($year[0])){$year[0] = "00"; } if(!isset($year[1]) || empty($year[1])){$year[1] = "01"; }
		$year[0] = (int)$year[0]; $year[1] = (int)$year[1];
		$this->db->query("insert into products (`name`,`shortdesc`,`category_id`,`model`,`part_number`,`year_to`,`year_from`,`status`)values('$nm','$specification','$catID','$makerId','$partnum','$year[0]','$year[1]','active')");
		 }
		 //
		}
		 
       }
    }
   // $Q->free_result();  
    //return $data;  
}

function setYear()
{ /* 
	
	 $Q = $this->db->query('SELECT * FROM products ');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
		 $year_to = $row['year_to'];
		 $year_from = $row['year_from'];
		 $id = $row['id'];
		 
		 //if($year_to <12){$year_to = 2000+$year_to; $this->db->query('update products set `year_to` = "'.$year_to.'" where id= "'.$id.'"');}
		 ///if($year_to > 50 && $year_to < 100 ){ echo "sagar"; $year_to = 1900+$year_to; $this->db->query('update products set `year_to` = "'.$year_to.'" where id= "'.$id.'"');
		 //}
		// if($year_from <12){$year_from = 2000+$year_from; $this->db->query('update products set `year_from` = "'.$year_from.'" where id= "'.$id.'"');}
		 if($year_from > 50 && $year_from <100 ){$year_from = 1900+$year_from; $this->db->query('update products set `year_from` = "'.$year_from.'" where id= "'.$id.'"');}
	   }
	 }
	 */
}

function updateCarmodelSt($id,$status)
	{
      $data = array('status' => $status);
      $this->db->where('id',$id);
      $this->db->update('carmodel',$data);  
	
	}
 
}//end class
?>