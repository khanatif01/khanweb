<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function index()
	{

        $admin = $this->session->userdata('admin');
        if(!empty($admin)){ 
            redirect(base_url().'admin/home/index');
        }
       //echo password_hash('admin',PASSWORD_DEFAULT);
        $this->load->library('form_validation');
		$this->load->view('admin/login');
	}

public function authenticate(){
    $this->load->library('form_validation');
    $this->load->model('Admin_model');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $this->form_validation->set_rules('username','Please fill Username','trim|required');
    $this->form_validation->set_rules('password','Please fill Password','trim|required');
    $this->form_validation->set_message('required','{field} '); // to give your own message in form validation:
    
    if( $this->form_validation->run()== true){
      $username =  $this->input->post('username');
        $admin = $this->Admin_model->getByUsername($username);
        if(!empty($admin)){
            $password =  $this->input->post('password');
            if(password_verify($password , $admin['password']) == true){
            $adminArray['user_id'] = $admin['id'];
            $adminArray['username'] = $admin['username'];
            $this->session->set_userdata('admin',$adminArray);
            redirect(base_url().'admin/Home');

            }
            else{
                $this->session->set_flashdata('msg','Usename or Password is invalid');
                redirect(base_url().'admin/login/index'); 
            }
        }
        else{
            $this->session->set_flashdata('msg','Usename or Password is invalid');
            redirect(base_url().'admin/login/index');
        }
    }
        else{
            $this->load->view('admin/login');
        }
       
    }


    public function logout(){
        $this->session->unset_userdata('admin');
        redirect(base_url().'admin/login/index');
    }
    // public function checkName($str){
    //     if($str=='test'){
    //         $this->form_validation->set_message('checkName','The{field} filed can not be word "test"');
    //         return false;
    //     }
    //     else{
    //         return true;
    //     }

    // }
} 
