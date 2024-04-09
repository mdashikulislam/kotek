<?php
echo '<pre>
<h1>code</h1>
<h2>Originally from controllers/welcome.php</h2>
 function cat($id){
  	
	$cat = $this->MCats->getCategory($id);
	// $id is the thirdn in URI which represents the ID and any variables that will be passed to the controller.
	
	if (!count($cat)){
		redirect(\'welcome/index\',\'refresh\');
	}
	$data[\'title\'] = "Claudia\'s Kids | ". $cat[\'name\'];
	
	if ($cat[\'parentid\'] < 1){
		//show other categories
		$data[\'listing\'] = $this->MCats->getSubCategories($id);
		$data[\'level\'] = 1;
	}else{
		//show products
		$data[\'listing\'] = $this->MProducts->getProductsByCategory($id);
		$data[\'level\'] = 2;

	}
	$data[\'category\'] = $cat;
	$data[\'main\'] = \'category\';
	$data[\'navlist\'] = $this->MCats->getCategoriesNav();
	$this->load->vars($data);
	$this->load->view(\'template\');
 }

<h2>Originally from models/mcats.php</h2>
 function getSubCategories($catid){
     $data = array();
     $this->db->select(\'id,name,shortdesc\');
     $this->db->where(\'parentid\', id_clean($catid));
     $this->db->where(\'status\', \'active\');
     $this->db->orderby(\'name\',\'asc\');
     $Q = $this->db->get(\'categories\');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
       		$sql = "select thumbnail as src 
       				from products 
       				where category_id=".id_clean($row[\'id\'])."
       				and status=\'active\'
       				order by rand() limit 1";
       		$Q2 = $this->db->query($sql);
 
       	
       		if($Q2->num_rows() > 0){
				$thumb = $Q2->row_array();
       			$THUMB = $thumb[\'src\'];
       		}else{
       			$THUMB = \'\';
       		}
       		$Q2->free_result();
       		$data[] = array(
       			\'id\' => $row[\'id\'], 
       			\'name\' => $row[\'name\'], 
       			\'shortdesc\' => $row[\'shortdesc\'],
       			\'thumbnail\' => $THUMB
       		);
       	}
    }
    $Q->free_result();  
    
    return $data; 

 }

<h2>$category</h2>';
print_r ($category);
echo'<br /><h2>$listing</h2>';
print_r ($listing);
echo'<br /><h2>$parentid</h2>';
print_r ($parentid);
echo'<br /><h2>$main</h2>';
print_r ($main);
echo'<br /><h2>$level</h2>';
print_r ($level);

echo'<br />

<h2>Originally from models/mcats.php</h2>
 function getCategoriesNav(){
     $data = array();
     $this->db->select(\'id,name,parentid\');
     $this->db->where(\'status\', \'active\');
     $this->db->orderby(\'parentid\',\'asc\');
     $this->db->orderby(\'name\',\'asc\');
     $this->db->groupby(\'parentid,id\');
     $Q = $this->db->get(\'categories\');
     if ($Q->num_rows() > 0){
       foreach ($Q->result() as $row){
			if ($row->parentid > 0){
				$data[0][$row->parentid][\'children\'][$row->id] = $row->name;
			
			}else{
				$data[0][$row->id][\'name\'] = $row->name;
			}
		}
    }
    $Q->free_result(); 
    return $data; 
 }


<h2>$navlist</h2>';
print_r ($navlist);
echo "</pre>";

?>