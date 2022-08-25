<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $admin = $this->session->userdata('admin');
    if(empty($admin)){
        $this->session->set_flashdata('msg','Your session has been expired! login again');
        redirect(base_url().'admin/login/index');
    }
}
        // This method will show article page:
    public function index($page=1){
      $perpage=5;
      $param['offset'] =  $perpage;
      $param['limit']  = ($page* $perpage)- $perpage;
      $param['q'] = $this->input->get('q');
      // print_r($_GET);
      $this->load->model('Article_model');
      //  This is pagination concept:
      $this->load->library('pagination');
      $config['base_url'] = base_url('admin/article/index');
      $config['total_rows'] = $this->Article_model->getArticlesCount($param);
      $config['per_page'] = 5;
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
      // $param['offset'] = $config['per_page'];
      // $param['limit']  = ($page*$config['per_page'])- $config['per_page'];
      // $param['q'] = $this->input->get('q');
       $articles = $this->Article_model->getArticles($param);
       $data['q'] = $this->input->get('q');
       $data['articles'] = $articles;
       $data['pagination_links'] =  $pagination_links;
       $data['mainModule'] = 'article';
       $data['subModule'] = 'viewArticle';
    $this->load->view('admin/article/list',$data);
    }

  // This method will show create article page:
    public function create(){
      $this->load->model('Category_model');
      $this->load->model('Article_model');
      $this->load->helper('common_helper');	
      $data['mainModule'] = 'article';
      $data['subModule'] = 'createArticle';
      $category = $this->Category_model->getcategory();
      $data['category']  = $category;
  //  file uploading process:
  
    $config['upload_path']  = './public/uploads/articles/';
    $config['allowed_types']  = 'gif|jpg|png|pdf|exe';
    $config['encrypt_name']  = true;
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
    $this->form_validation->set_rules('category-id','Category','trim|required');
    $this->form_validation->set_rules('title','Title','trim|required');
    $this->form_validation->set_rules('author','Author','trim|required');
    if($this->form_validation->run() == TRUE){
        //  form_validation successfully then we can proceed:
          if(!empty($_FILES['image']['name'])){

            //  here we will image uploaded successfully rhn this code:
            
           if( $this->upload->do_upload('image')){
            $data= $this->upload->data();
            // print_r($data);
            $img = $this->upload->data();
            resizeImage($config['upload_path'].$img['file_name'],$config['upload_path'].'thumb_front/'.$img['file_name'],1120,800);
            resizeImage($config['upload_path'].$img['file_name'],$config['upload_path'].'thumb_admin/'.$img['file_name'],300,225);
            $fromArray['image'] = $data['file_name'];
            $fromArray['title'] = $this->input->post('title');
            $fromArray['description'] = $this->input->post('description');
            $fromArray['category'] = $this->input->post('category-id');
            $fromArray['author'] = $this->input->post('author');
            $fromArray['status'] = $this->input->post('status');
            $fromArray['created_at'] = date('Y-m-d : H-i-s');
            $this->load->model('Article_model');
            $this->Article_model->addArticle($fromArray);
            $this->session->set_flashdata('success','File uploaded successfully');
            redirect(base_url().'admin/article/index');
            

           }
           else{
            //   give some error:
           $errors = $this->upload->display_errors('<p class="invalid-feedback">','</p>');
           $data['imageerror'] = $errors;
           $this->session->set_flashdata('error','File  not uploaded ');
            $this->load->view('admin/article/create',$data);

           }

          }
          else{

            // without image insert data then run this code:

            $fromArray['title'] = $this->input->post('title');
            $fromArray['description'] = $this->input->post('description');
            $fromArray['category'] = $this->input->post('category-id');
            $fromArray['author'] = $this->input->post('author');
            $fromArray['status'] = $this->input->post('status');
            $fromArray['created_at'] = date('Y-m-d : H-i-s');
            $this->load->model('Article_model');
            $this->Article_model->addArticle($fromArray);
            $this->session->set_flashdata('success','File uploaded successfully');
            redirect(base_url().'admin/article/index');

          }

    }
    else{

      //  form not validate then show error:

      $this->load->view('admin/article/create',$data);

    }
     
    }



  // This method will show  edit article page:

    public function edit($id){
      $this->load->helper('common_helper');	
      $this->load->library('form_validation');
        $this->load->model('Article_model');
        $this->load->model('Category_model');
        $data['mainModule'] = 'article';
        $data['subModule'] = '';
        
         $article = $this->Article_model->getArticle($id);
        
         if(empty($article)){

          $this->session->set_flashdata('error','Article not Found');
          redirect(base_url().'admin/article/index');
         }
         else{

          $this->load->model('Category_model');
            $category = $this->Category_model->getcategory();
             $data['category']  = $category;
             $data['article']  = $article;

             $config['upload_path']  = './public/uploads/articles/';
             $config['allowed_types']  = 'gif|jpg|png|pdf|exe';
             $config['encrypt_name']  = true;
         
             $this->load->library('upload',$config);
             $this->upload->initialize($config);
             $this->load->library('form_validation');
             $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
             $this->form_validation->set_rules('category-id','Category','trim|required');
             $this->form_validation->set_rules('title','Title','trim|required');
             $this->form_validation->set_rules('author','Author','trim|required');
             if($this->form_validation->run() == TRUE){
                 //  form_validation successfully then we can proceed:
                   if(!empty($_FILES['image']['name'])){
         
                     //  here we will image uploaded successfully rhn this code:
                     
                    if( $this->upload->do_upload('image')){
                     $data= $this->upload->data();
                     // print_r($data);
                     $img = $this->upload->data();

                     //  this method remove  old image from thumb_admin  folder.
                     $path = './public/uploads/articles/thumb_admin/'.$article['image'];  //directory path:
                     if(($article['image']!= "")  && file_exists($path)){
                      unlink($path);
                     }
                      //  this method remove  old image from thumb_front folder.
                     $path = './public/uploads/articles/thumb_front/'.$article['image'];  //directory path:
                     if(($article['image']!= "")  && file_exists($path)){
                      unlink($path);
                     }
                      //  this method remove  old image from articles folder.
                     $path = './public/uploads/articles/'.$article['image'];  //directory path:
                     if(($article['image']!= "")  && file_exists($path)){
                       unlink($path);
                       }   

                     resizeImage($config['upload_path'].$img['file_name'],$config['upload_path'].'thumb_front/'.$img['file_name'],1120,800);
                     resizeImage($config['upload_path'].$img['file_name'],$config['upload_path'].'thumb_admin/'.$img['file_name'],300,225);
                     $fromArray['image'] = $data['file_name'];
                     $fromArray['title'] = $this->input->post('title');
                     $fromArray['description'] = $this->input->post('description');
                     $fromArray['category'] = $this->input->post('category-id');
                     $fromArray['author'] = $this->input->post('author');
                     $fromArray['status'] = $this->input->post('status');
                     $fromArray['updated_at'] = date('Y-m-d : H-i-s');
                     $this->load->model('Article_model');
                     $this->Article_model->updateArticle($id, $fromArray);
                     $this->session->set_flashdata('success','File updated successfully');
                     redirect(base_url().'admin/article/index');
                     
         
                    }
                    else{
                     //   give some error:
                    $errors = $this->upload->display_errors('<p class="invalid-feedback">','</p>');
                    $data['imageerror'] = $errors;
                    $this->session->set_flashdata('error','File  not uploaded ');
                    $this->load->view('admin/article/edit',$data);
         
                    }
         
                   }
                   else{
         
                     // without image insert data then run this code:
         
                     $fromArray['title'] = $this->input->post('title');
                     $fromArray['description'] = $this->input->post('description');
                     $fromArray['category'] = $this->input->post('category-id');
                     $fromArray['author'] = $this->input->post('author');
                     $fromArray['status'] = $this->input->post('status');
                     $fromArray['updated_at'] = date('Y-m-d : H-i-s');
                     $this->load->model('Article_model');
                     $this->Article_model->updateArticle($id,$fromArray);
                     $this->session->set_flashdata('success','File updated successfully');
                     redirect(base_url().'admin/article/index');
         
                   }
             }
             else{
         
               //  form not validate then show error:
                $this->load->view('admin/article/edit',$data);
         
               }         
         }
    }

  // This method will delete article page:

    public function delete($id){
      $this->load->model('Article_model');
      $article = $this->Article_model->getArticle($id);
        
         if(empty($article)){

          $this->session->set_flashdata('error','Article not Found');
          redirect(base_url().'admin/article/index');
         }
         
         $this->Article_model->deleteArticle($id);
         $this->session->set_flashdata('success','Article deleted successfully');
         redirect(base_url().'admin/article/index');
        // echo $id;
    }
    
}
