<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Page extends CI_Controller{

    // This function will show abouts us page.
    public function about()
    {
        $this->load->view('front/about');
    }

    // This function will show services page.
    public function services()
    {
        $this->load->view('front/services');
    }

    // This function will show contact us page.
    public function blog()
    {
        $this->load->view('front/blog');
    }
    public function contact()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('message','Message','required');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback"></p>');
        if($this->form_validation->run()==true){

            // email configration:
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'atif83614@gmail.com',
                'smtp_pass' => 'vkyhiaomtlqwrfrn',
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            $this->email->to('atif83614@gmail.com');
            $this->email->from('atif83614@gmail.com');
            $this->email->subject('You have recived an enquirey');

          $name =  $this->input->post('name');
          $email =  $this->input->post('email');
          $msg =  $this->input->post('message');

          $message = "Name:".$name;
          $message .= "<br>";
          $message .= "Email:".$email;
          $message .= "<br>";
          $message .= "Message:".$msg;
          $message .= "<br>";
          $message .= "<br>";
          $message .= "Thanks a lot";

          $this->email->message( $message);
          $this->email->send();

          $this->session->set_flashdata('msg','Thanks for enquiry we will get back soon.');
          redirect(base_url('page/contact'));
                    //  this method insert data in database:

        }
        else{
            $this->load->view('front/contact-us');
        }
        
    }
}

