<?php
//page 80 Professional codeigniter

function getCategoriesNav(){
    $data = array();
    $Q = $this-> db-> get(‘categories’);
        if ($Q-> num_rows() > 0){
            foreach ($Q-> result() as $row){
            $data[$row-> id] = $row-> name;
            }
        }
    $Q-> free_result();
    return $data;
}


// page 90

/*
 
 function getCategoriesNav(){
$data = array();
$this- > db- > where(‘parentid < ’, 1);
$this- > db- > where(status’, ‘active’);
$this- > db- > orderby(‘name’,’asc’);
$Q = $this- > db- > get(‘categories’);
if ($Q- > num_rows() > 0){
foreach ($Q- > result_array() as $row){
$data[$row[‘id’]] = $row[‘name’];
}
}
$Q- > free_result();
return

          */
?>
