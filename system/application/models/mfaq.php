<?php



class MFaq extends Model{



	function MFaq(){

		parent::Model();

	}



function getFaq($id){

    $data = array();

    $options = array('id' => id_clean($id));

    $Q = $this->db->getwhere('faq',$options,1);

    if ($Q->num_rows() > 0){

      $data = $Q->row_array();

    }



    $Q->free_result();    

    return $data;    

 }

 

 	function getFaqName($id){

    $data = array();

     $this->db->select('question');

     $this->db->where('id',$id);

     $Q = $this->db->get('faq');

    if ($Q->num_rows() > 0){

      foreach ($Q->result_array() as $row){

       return  $row['question'];

       }

    }



    $Q->free_result();    

     

 }

	

 function getAllFaqs(){

     $data = array();

     $Q = $this->db->get('faq');

     if ($Q->num_rows() > 0){

       foreach ($Q->result_array() as $row){

         $data[] = $row;

       }

    }

    $Q->free_result();  

    return $data; 

 }

 

 function getActiveFaq(){

     $data = array();

     /** Faqs table has fields of id, name and status.

      * the following will select all the ids and names where status is active

      * If there are any data, then the results are stored as arrays in $row.

      * then $row name is stored in $row id.

      */

     $this->db->select('*');

     $this->db->where('status','active');

     $Q = $this->db->get('faq');

     if ($Q->num_rows() > 0){

       foreach ($Q->result_array() as $row){

		// $data[$row['id']][1] = $row['question'];
		 $data[] = $row;

       }

    }

    $Q->free_result();  

    return $data; 

 } 

 

 function createFaq(){

	$data = array( 

		'question' => db_clean($_POST['question'],32),

		'status' => db_clean($_POST['status'],8),

		'description' => db_clean($_POST['faq_desc'])

	);



	/* if ($_FILES){

		$config['upload_path'] = './images/faq/';

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

		  		redirect('admin/faq/index','refresh');

			}

			$image = $this->upload->data();

		

			if ($image['file_name']){

				$data['image'] = "images/faq/".$image['file_name'];

		

			}

		}

		} */

	



	$this->db->insert('faq', $data);	 

 }

 

 function updateFaq(){

	$data = array( 

		'question' => db_clean($_POST['question'],32),

		'status' => db_clean($_POST['status'],8),

		'description' => db_clean($_POST['faq_desc'])

	

	);



 /*   if ($_FILES){

		$config['upload_path'] = './images/faq/';

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

		  		redirect('admin/faq/index','refresh');

			}

			$image = $this->upload->data();

		

			if ($image['file_name']){

				$data['image'] = "images/faq/".$image['file_name'];

		

			}

		}

	}



*/

 	$this->db->where('id', id_clean($_POST['id']));

	$this->db->update('faq', $data);	

 

 }

 

 function deleteFaqs($id){

 //	$data = array('status' => 'inactive');

 	$this->db->where('id', id_clean($id));

	$this->db->delete('faq');

	

 } 

 
}//end class

?>