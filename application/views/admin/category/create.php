<?php $this->load->view('admin/header'); ?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item  "><a href="<?php echo base_url().'admin/home'; ?>">Home</a></li>
              <li class="breadcrumb-item  "><a href="<?php //echo base_url().'admin/category/index' ?>">Categories</a></li>
              <li class="breadcrumb-item active">Create New Categories</li>
            </ol>
          </div>
        </div>
      </div>
     </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-lg-12">
           <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
            Create New Category 
</div>
</div>
<style>
    .error{
        color:red;
    }

    </style>
    </div>

<!-- //<form name="categoryForm" id="categoryForm" method="POST" action="<?php //echo base_url().'admin/category/create' ?>" >         -->
<?php echo form_open_multipart('admin/category/create'); ?>
<div class="card-body">
  
  <div class="form-group">
    <label>Name</label>
    <input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" class="form-control <?php echo (form_error('name') != "") ? 'is-invalid' : ''; ?>">
    <?php echo form_error('name'); ?>
  </div>
  <div>
    <label>Image</label> <br>
    <input type="file" name="image" id="image" class=" <?php echo (!empty($img_error)) ? 'is-invalid' : ''; ?>">
   
    <?php  if(isset($img_error)): echo $img_error;endif;?>
  </div>
  <div class="custom-control custom-radio float-left ml-2 mt-3">
            <input class="custom-control-input" value="1" type="radio" id="statusActive" name="status" checked="">
            <label for="statusActive" class="custom-control-label">Active</label>
           
</div>
<div class="custom-control custom-radio float-left ml-3 mt-3">
            <input class="custom-control-input" value="0" type="radio" id="statusBlock" name="status">
            <label for="statusBlock" class="custom-control-label">Block</label>
           
</div>
    
     </div class="card-footer">
     <button type="submit" name="submit" class="btn btn-primary ml-2 mb-2">Submit</button>
     <a href="<?php echo base_url().'admin/category/index' ?>" class="btn btn-secondary ml-3 mb-2">Back</a>
     <div>
</div>
</form>
          </div>
        </div>
      </div>
    </div>
  </div> 
  
<?php $this->load->view('admin/footer');  ?>
