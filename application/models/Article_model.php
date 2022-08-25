<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Article_model extends CI_model
{
    public function getArticle($id){
$this->db->select('articles.*,categories.name as category_name');

        $this->db->where('articles.id',$id);

        $this->db->join('categories','categories.id=articles.category','left');
        $query = $this->db->get('articles');
        //echo $this->db->last_query();
        $articles =  $query->row_array();

        // select * from articles where id={your id};
        
        return $articles;

    }

    public function getArticles($param = array()){
        if(isset($param['offset']) &&  isset($param['limit'])){
            $this->db->limit($param['offset'], $param['limit']);
        }
        if( isset($param['q'])){
            // you search both value title and author:
            $this->db->or_like('title',trim($param['q']));
            $this->db->or_like('author',trim($param['q']));
        }

       $query = $this->db->get('articles');
   //  return  $this->db->last_query();
        $category = $query->result_array();
        return $category;
    }
    //  this is searching concept:

    public function getArticlesCount($param = array()){
       
        if( isset($param['q'])){
            // you search both value title and author:
            $this->db->or_like('title',trim($param['q']));
            $this->db->or_like('author',trim($param['q']));
        }
        if(isset($param['category_id'])) {
            $this->db->where('category',$param['category_id']);
        }
        
     $result = $this->db->count_all_results('articles');
    // echo $this->db->last_query(); 
     return $result;
        
     }

// This metod is save article in data base:

    public function addArticle($fromArray){
        $this->db->insert('articles',$fromArray);
        return $this->db->insert_id();

    }
    public function updateArticle($id,$fromArray){
        $this->db->where('id',$id);
      return  $this->db->update('articles',$fromArray);

    }
    public function deleteArticle($id){
        $this->db->where('id',$id);
        $this->db->delete('articles');

    }



    // front Model

    public function getArticleFront($param = array()){
        if(isset($param['offset']) &&  isset($param['limit'])){
            $this->db->limit($param['offset'], $param['limit']);
        }
        if( isset($param['q'])){
            // you search both value title and author:
            $this->db->or_like('title',trim($param['q']));
            $this->db->or_like('author',trim($param['q']));
        }
        if(isset($param['category_id'])) {
            $this->db->where('category',$param['category_id']);
        }
        // left join apply here:
        $this->db->select('articles. *,categories.name as category_name');
        $this->db->where('articles.status',1);
        $this->db->ORDER_BY('articles.created_at','ASC');
       
        $this->db->join('categories', 'categories.id=articles.category','left');
       $query = $this->db->get('articles');
   // echo  $this->db->last_query();  // this is the last query. before result print last query.
        $category = $query->result_array();
       
        return $category;
    }
   




}