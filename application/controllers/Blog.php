<?php
class Blog extends CI_controller
{
    public function index($page=1)
    {
        $this->load->model('Article_model');
        $this->load->helper('text');
        //  This is pagination concept  start :
        $this->load->library('pagination');
        $perpage=3;
        $param['offset'] = $perpage;
        $param['limit'] = ($page*$perpage)-$perpage;

        $config['base_url'] = base_url('blog/index');
        $config['total_rows'] = $this->Article_model->getArticlesCount();
    //    exit;
         $config['per_page'] = $perpage;
        $config['use_page_numbers'] = true;
  
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class ='disable page-item '><li class ='active page-item'> <a href='#'   class=\"page-link\">";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a> </li>";
        $config['next_tag_open'] = "<li class=\"page-item\">";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li class=\"page-item\">";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li class=\"page-item\">";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li class=\"page-item\">";
        $config['last_tagl_close'] = "</li>";
        $config['attributes'] = array('class'=>'page-link');
  
        $this->pagination->initialize($config);
        $pagination_links = $this->pagination->create_links();
     //   pagination concept  end :
       
       $articles = $this->Article_model->getArticleFront($param);  //$param to show limit value.
        $data =[];
        $data['articles'] = $articles;
        $data['pagination_links'] = $pagination_links;
        $this->load->view('front/blog', $data);
    }
    public function category()
    {
        $this->load->model('Category_model');
       $categories = $this->Category_model->getcategoryfront();
       $data = [];
       $data['categories'] = $categories;
      // print_r($data); //to check the data is pass or not :
        $this->load->view('front/categories',$data);
    }

//   Detail page here:
    public function detail($id)
    {
        $this->load->library('form_validation');
        $this->load->model('Article_model');
        $this->load->model('Comment_model');
       $articles = $this->Article_model->getArticle($id);
       $data= [];
       $data['articles'] = $articles;
      $comments = $this->Comment_model->getComments($id);
      $data['comments'] = $comments;
     
       $this->form_validation->set_rules('name','Name','required|min_length[5]');
       $this->form_validation->set_rules('comment','Comment','required|min_length[20]');
       $this->form_validation->set_error_delimiters('<p class="mb-0"></p>');
       if($this->form_validation->run() == true) 
       {
        // set the in database:
        $fromArray = [];
        $fromArray['name'] = $this->input->post('name');
        $fromArray['comment'] = $this->input->post('comment');
        $fromArray['article_id'] = $id;
        $fromArray['created_at'] = date('Y-m-d H-i-s');

        $this->Comment_model->create($fromArray);
        $this->session->set_flashdata('message','Your comment has been posted successfully');
        redirect(base_url('blog/detail/'.$id));
       }
       else{
        $this->load->view('front/detail',$data);
       }


    //    $this->load->view('front/detail',$data);
    }


    public function categories($category_id,$page=1)
    {
        $this->load->library('pagination');
        $this->load->model('Category_model');
        $this->load->model('Article_model');
        $this->load->helper('text');
        //  This is pagination concept  start :
           $category = $this->Category_model->getcategory($category_id);
           //print_r($category);
           if(!empty($category)){
           
           }
           else{
            redirect(base_url().'blog/category');
           }

        $perpage=3;
        $param['offset'] = $perpage;
        $param['limit'] = ($page*$perpage)-$perpage;
        $param['category_id'] = $category_id; 

        $config['base_url'] = base_url('blog/category'.$category_id);
        $config['total_rows'] = $this->Article_model->getArticlesCount($param);
        $config['uri_segment'] = 4;
    //    exit;
         $config['per_page'] = $perpage;
        $config['use_page_numbers'] = true;
  
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class ='disable page-item '><li class ='active page-item'> <a href='#'   class=\"page-link\">";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a> </li>";
        $config['next_tag_open'] = "<li class=\"page-item\">";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li class=\"page-item\">";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li class=\"page-item\">";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li class=\"page-item\">";
        $config['last_tagl_close'] = "</li>";
        $config['attributes'] = array('class'=>'page-link');
  
       // $this->pagination->initialize($config);
        $pagination_links = $this->pagination->create_links();
       

      
     //   pagination concept  end :
       
       $articles = $this->Article_model->getArticleFront($param);  //$param to show limit value.
        $data =[];
        $data['articles'] = $articles;
        $data['category'] = $category;
        $data['pagination_links'] = $pagination_links;
        $this->load->view('front/category_article', $data);
        
    }



}