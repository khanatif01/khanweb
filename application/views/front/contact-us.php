<?php
$this->load->view('front/header');
?>
        <div  class="container-fluid" style="background-image : url(../public/images/ball-bright-close-up-clouds-207489.jpg);">
            
            <div class="row">
                <div class="col-md-12">
                <h1 class="text-center text-white pt-5 mb-5">Contact Us</h1>
                    </div>
                    <div class="container pb-5 ">
                    <div class="row">
                        <div class="col-md-7 ">
                                    <div class="card h-100 mb-5">
                                        <div class="card-header bg-secondary text-white">
                                            Have any query or question?
                                        </div>
                                        <div class="card-body mb-5">
                                            <?php
                                            if(!empty($this->session->flashdata('msg')))   {  ?>
                                        <div class="alert alert-success">
                                                    <?php echo $this->session->flashdata('msg'); ?>
                                            </div>

                                          <?php  } ?>
                                            
                                     <form action="<?php echo base_url('page/contact'); ?>" method="post" id="contact-form" name="contact-form" >
                                    <div class="form-group">
                                              <label>Name</label>
                                        <input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" class="form-control <?php echo (form_error('name')!= "") ? 'is-invalid' : ''; ?>" >
                                             <?php echo form_error('name');  ?>
                                            </div>
                                                 <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" name="email" id="email" class="form-control <?php echo (form_error('email')!= "") ? 'is-invalid' : ''; ?>" value="<?php echo set_value('name'); ?>">
                                                    <?php echo form_error('email');  ?>
                                                 </div>
                                                 <div class="form-group">
                                                    <label>Message</label>
                                                    <textarea name="message" id="message" class="form-control <?php echo (form_error('message')!= "") ? 'is-invalid' : ''; ?>" rows="5" value="<?php echo set_value('name'); ?>"></textarea>
                                                    <?php echo form_error('message');  ?>
                                                 </div>
                                                 <button type="submit" id="submit" class="btn btn-primary" >Submit</button>
                                             </form>
                                        </div>
                                </div>

                    </div>
                    <div class="col-md-5 ">
                        <div class="card h-100">
                        <div class="card-header bg-secondary">
                            Reach Us
                        </div>
                        <div class="card-body">
                            <p class="mb-0"><strong>Customer Service</strong></p>
                            <p class="mb-0">Phone: +91 797039XXX</p>
                            <p class="mb-0">E-mail: Ehtesam@gmail.com</p>

                            <p class="mb-4">&nbsp;</p>
                            <p class="mb-0"><strong>Headquater</strong></p>
                            <p class="mb-0">Company Inc</p>
                            <p class="mb-0">12/22 Park Avenue Road Delhi</p>
                            <p class="mb-0">550051 Ashapur India</p>
                            <p class="mb-0">Phone: +91 797039XXX</p>
                            <p class="mb-0">E-mail: atif83614@gmail.com</p>


                            <p class="mb-4">&nbsp;</p>
                            <p class="mb-0"><strong>Headquater</strong></p>
                            <p class="mb-0">Company Inc</p>
                            <p class="mb-0">12/22 Park Avenue Road Delhi</p>
                            <p class="mb-0">550051 Ashapur India</p>
                            <p class="mb-0">Phone: +91 797039XXX</p>
                            <p class="mb-0">E-mail: atif83614@gmail.com</p>
</div>
</div>

                    </div>

</div>
</div>
</div>

</div>

      



      <?php
$this->load->view('front/footer');
?>
      