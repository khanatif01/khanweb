<?php $this->load->view('admin/header'); ?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Articles</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item  "><a href="<?php echo base_url().'admin/home'; ?>">Home</a></li>
              <li class="breadcrumb-item  "><a href="<?php //echo base_url().'admin/category/index' ?>">Articles</a></li>
              <li class="breadcrumb-item active">Edit Articles</li>
              <li class="breadcrumb-item active"><?php echo $article['title']; ?></li>
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
            Edit Articles  "<?php echo $article['title']; ?>"
</div>
</div>
<style>
    .error{
        color:red;
    }

    </style>
    </div>

   <!-- <form name="categoryForm" id="categoryForm" method="POST" action="<?php //echo base_url().'admin/article/create' ?>" > -->
 <?php  echo form_open_multipart('admin/article/edit/'.$article['id']); ?> 
<div class="card-body">
  <?php
  // apply session 
  
  ?>
  
  <div class="form-group">
  <label>Category</label>
    <select  name="category-id" id="category-id" class="form-control <?php echo (form_error('category-id')!= "" ) ? 'is-invalid' : '';?>">
        <option value="">Select a Category</option>
       
<?php
if(!empty($category)) {
                        //this is  varible :
    foreach( $category as $categorie) {
      $selected = ($article['category'] == $categorie['id']) ? true : false;
        ?>
       
        <option <?php echo set_select('category-id',$categorie['id'],$selected); ?>  value="<?php echo $categorie['id']; ?>"><?php echo  $categorie['name']; ?></option>
        <?php
    }
}
?>
</select>
<div class="valid-feedback"> </div>
<?php echo form_error('category-id'); ?>
  </div>
  <div class="form-group">
    <label>Title</label>
    <input type="text" name="title" id="title" value="<?php echo set_value('title',$article['title']); ?>" class="form-control <?php echo (form_error('title') != "" ) ? 'is-invalid' : '';?>" >
    <?php echo form_error('title'); ?>
    <div class="valid-feedback"> </div>
  </div>
  <div class="form-group">
    <label>Description</label>
    <textarea type="text" name="description" id="description"  class="textarea"> <?php echo set_value('description',$article['description']); ?>  </textarea>
  </div>
  <div>
    <label>Image</label> <br>
    <input type="file" name="image" id="image" class="<?php echo (!empty($imageerror))  ? 'is-invalid' : '';?>">
    <br>
    <?php
    $path = './public/uploads/articles/'.$article['image'];  //directory path:
      if(($article['image']!= "")  && file_exists($path)){
        ?>
<img  class="mt-3 h-50" src="<?php echo base_url('public/uploads/articles/'.$article['image']); ?>">
        <?php
       } else {
       ?>
         <img  src="<?php echo base_url('public/uploads/articles/download.png'); ?>">
         <?php

       } ?>
  
    <?php if(!empty($imageerror))  echo $imageerror;
    ?>
  </div> <br>
  <div class="form-group">
    <label>Author</label>
    <input type="text" name="author" id="author" value="<?php echo set_value('author',$article['author']); ?>" class="form-control <?php echo (form_error('author') != "" ) ? 'is-invalid' : '';?>">
    <?php echo form_error('author'); ?>
    <div class="valid-feedback"> </div>
</div>
  <div class="custom-control custom-radio float-left ml-2 mt-3">
            <input class="custom-control-input" value="1" type="radio" id="statusActive" name="status" <?php echo ($article['status'] == 1) ? 'checked' : ''; ?>>
            <label for="statusActive" class="custom-control-label">Active</label>
           
</div>
<div class="custom-control custom-radio float-left ml-3 mt-3">
            <input class="custom-control-input" value="0" type="radio" id="statusBlock" name="status" <?php echo ($article['status'] == 0) ? 'checked' : ''; ?>>
            <label for="statusBlock" class="custom-control-label">Block</label>         
</div> 
     </div class="card-footer">
     <button type="submit" name="submit" class="btn btn-primary ml-2 mt-2 mb-2">Update</button>
     <a href="<?php echo base_url().'admin/article/index' ?>" class="btn btn-secondary ml-3 mt-2 mb-2">Back</a>
     <div>
</div>
</form>
          </div>
        </div>
      </div>
    </div>
  </div> 
  
<?php $this->load->view('admin/footer');  ?>
