<?php
class Comment_model extends CI_model
{
    //  This method will insert in DB.
    public function create($fromArray)
    {
        $this->db->insert('comment', $fromArray);

    }

    public function getComments($article_id)
    {
        $this->db->where('article_id',$article_id);
        
        $this->db->where('comment.status',1);
        $this->db->ORDER_BY('created_at','DESC');
          $comments = $this->db->get('comment')->result_array();
        //  echo $this->db->last_query();
          return $comments;
    }
}

?>