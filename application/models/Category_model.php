<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Category_model extends CI_model
{
public function createdata($data){
       return $this->db->insert('categories', $data);
}

public function getcategory($params = []){
       if(!empty($params['queryString'])){
     $this->db->like('name',$params['queryString']);
       }
      $result = $this->db->get('categories')->result_array();
      return $result;
}

public function getcategorywise($id)
{
       // select * from categories where id={25};
       $this->db->where('id',$id);
    return   $this->db->get('categories')->row_array();
}

//   UPDATE METHOD:
public function updatedata($id,$fromArray){
       $this->db->where('id',$id);
       $this->db->update('categories',$fromArray);
}

              //PUBLIC FUNCTION DELETE :

              public function delete($id){
                     $this->db->where('id',$id);
                     $this->db->delete('categories');
              }


                            // front category:

              public function getcategoryfront(){
                    $this->db->where('categories.status',1);
                    $result = $this->db->get('categories')->result_array();
                    return $result;
              }

}