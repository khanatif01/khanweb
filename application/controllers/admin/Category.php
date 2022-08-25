<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

				public function __construct()
		{
			parent::__construct();
			$admin = $this->session->userdata('admin');
			if(empty($admin)){
				$this->session->set_flashdata('msg','Your session has been expired! login again');
				redirect(base_url().'admin/login/index');
			}
			$this->load->helper(array('form', 'url'));
			$this->load->library('upload');
			$this->load->model('Category_model');
			$this->load->library('image_lib');
			$this->load->helper('common_helper');
		}

	// This method will show category list:
	public function index()
	{
		//  sarching concept:
		$queryString = $this->input->get('q');
		$params['queryString'] = $queryString;

	$categorie = $this->Category_model->getcategory($params);
	$data['categories'] = $categorie;
	$data['query_string'] = $queryString;
	$data['mainModule'] = 'category';
	$data['subModule'] = 'viewCategory';
       $this->load->view('admin/category/list',$data);
	}
    // This method will create category list:
    public function create()
	{
			$this->load->helper('common_helper');	
			$data['mainModule'] = 'category';
			$data['subModule'] = 'createCategory';
		$config['upload_path']          = './public/uploads/category/';
		$config['allowed_types']        = 'gif|jpg|png|pdf|webp';
		$config['encrypt_name']        = true;
		
                
        $this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->load->model('Category_model');
		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
		$this->form_validation->set_rules('name','Name','trim|required');
			if($this->form_validation->run() == TRUE ){
			 if(!empty($_FILES['image']['name'])){
			// 	//   user has upload file:
			 	if($this->upload->do_upload('image')){
					
					// resizing image logic :
					$img = $this->upload->data();
					$this->image_lib->initialize($config);
					resizeImage($config['upload_path'].$img['file_name'],$config['upload_path'].'thumb/'.$img['file_name'],150,120);

					// file uploaded  successfully then run this code::
			$name['name'] = $this->input->post('name');
            $img = $this->upload->data();
            $created_at = date('Y-m-d : H-i-a');
            $image = $img['file_name'];
            $data = array();
			
            $data['name'] = $this->input->post('name');
            $data['image'] = $image;
            $data['created_at'] = $created_at;
			$this->Category_model->createdata($data);
			$this->session->set_flashdata('success','Category added successfully');
			redirect(base_url().'admin/category/index');
					
				}
				else{
					//  we  got some error:
					$data['img_error'] = $this->upload->display_errors('<p class="invalid-feedback">','</p>');
					$this->load->view('admin/category/create', $data);
				}
			}
			else{		
		//  file not uploaded then run this code and successfully create category :

           $data = array();	
            $data['name'] = $this->input->post('name');        
            $data['created_at'] = $created_at;
			$this->Category_model->createdata($data);
			$this->session->set_flashdata('success','Category added successfully');
			redirect(base_url().'admin/category/index');
	
		}
	}
		 else {
		 	$this->load->view('admin/category/create',$data);
		 }
		}


    // This method will edit category:
    public function edit($id)
	{
		$this->load->helper('common_helper');
		$this->load->model('Category_model');
		$data['mainModule'] = 'category';
		$data['subModule'] = '';
	$category =	$this->Category_model->getcategorywise($id);
	
	if(empty($category)){
		$this->session->set_flashdata('error','Invalid User Id');
		redirect(base_url().'admin/category/index');
	}
		
		$config['upload_path']          = './public/uploads/category/';
		$config['allowed_types']        = 'gif|jpg|png|pdf|webp';
		$config['encrypt_name']        = true;
                
        $this->load->library('upload', $config);
		$this->upload->initialize($config);
	
		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
		$this->form_validation->set_rules('name','Name','trim|required');
			if($this->form_validation->run() == TRUE ){
				
				if(!empty($_FILES['image']['name'])){
					// 	//   user has upload file:
						 if($this->upload->do_upload('image')){
							
							// resizing image logic :
							$img = $this->upload->data();
							$this->image_lib->initialize($config);
							resizeImage($config['upload_path'].$img['file_name'],$config['upload_path'].'thumb/'.$img['file_name'],50,80);
		
							// file uploaded  successfully then run this code::
					$name['name'] = $this->input->post('name');
					$img = $this->upload->data();
					$created_at = date('Y-m-d : H-i-a');
					$image = $img['file_name'];
					$data = array();
					
					$data['name'] = $this->input->post('name');
					$data['image'] = $image;
					$data['updated_at'] = $created_at;
					$this->Category_model->updatedata($id,$data);
							if(file_exists('./public/uploads/category/'.$category['image'])){
								unlink('./public/uploads/category/'.$category['image']);
							}
							if(file_exists('./public/uploads/category/thumb/'.$category['image'])){
								unlink('./public/uploads/category/thumb/'.$category['image']);
							}
							

					$this->session->set_flashdata('success','Category updated successfully');
					redirect(base_url().'admin/category/index');
							
						}
						else{
							//  we  got some error:
							$data['img_error'] = $this->upload->display_errors('<p class="invalid-feedback">','</p>');
							$data['category'] = $category;
							$this->load->view('admin/category/edit',$data);
							
						}
					}
					else{		
				//  file not uploaded then run this code and successfully create category :
		
				   $data = array();	
					$data['name'] = $this->input->post('name');      
					$data['updated_at'] = date('Y-m-d : H-i-s');  
					//$data['updated_at'] = $created_at;
					$this->Category_model->updatedata($id,$data);
					$this->session->set_flashdata('success','Category updated successfully');
					redirect(base_url().'admin/category/index');
			
				}
			}
				
	else{
		$data['category'] = $category;
			$this->load->view('admin/category/edit',$data);
	}
}




    // This method will delete category:


    public function delete($id)
	{
		$this->load->model('Category_model');
	$category =	$this->Category_model->getcategorywise($id);
	
	if(empty($category)){
		$this->session->set_flashdata('error','category not found');
		redirect(base_url().'admin/category/index');
	}
	if(file_exists('./public/uploads/category/'.$category['image'])){
		unlink('./public/uploads/category/'.$category['image']);
	}
	if(file_exists('./public/uploads/category/thumb/'.$category['image'])){
		unlink('./public/uploads/category/thumb/'.$category['image']);
	}

       	$this->Category_model->delete($id);
		$this->session->set_flashdata('success','Category deleted successfully');
		redirect(base_url().'admin/category/index');

		
	}
}

