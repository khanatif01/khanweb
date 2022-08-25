<?php $this->load->view('admin/header'); ?>

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/home' ?>">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
        <?php if($this->session->flashdata('success') !="") { ?>
            <div class="alert alert-success"> <?php echo $this->session->flashdata('success'); ?>  </div>
        <?php }  ?>
        <?php if($this->session->flashdata('error') !="") { ?>
            <div class="alert alert-danger"> <?php echo $this->session->flashdata('error'); ?>  </div>
        <?php }  ?>
         <div class="card">
          <div class="card-header">
            <div class="card-title">
            <form  id="searchForm" name="searchForm" method="GET" action="">
                 <div class="input-group mb-0">
                    <input type="text" value="<?php //echo $queryString; ?>" class="form-control" placeholder="search" name="q">
                     <div class="input-group-append">
                       <button class="input-group-text" id="basic-addon1">
                         <i class="fas fa-search">   </i>
</button>
</div>
</div>
</form>
</div>
<div class="card-tools">
    <a href="<?php echo base_url().'admin/category/create' ?>" class="btn btn-primary"> <i class="fas fa-plus"> </i>  Create</a>
</div>
            </div>
<div class="card-body">
    <table class="table">
        <tr>
            <th width="50">#</th>
            <th>Name</th>
            <th width="100">status</th>
            <th width="160" class="text-center">Action</th>
        </tr>
<?php  if(!empty($categories)) { ?>
  <?php  foreach($categories as $categoryRow) { ?>

        <tr>
        <td><?php echo $categoryRow['id']; ?> </td>
        <td><?php echo $categoryRow['name']; ?></td>
        
        <td>
          <?php
            if($categoryRow['status'] == 1) {
             ?>
            <span class="badge badge-success">Active</span>
            <?php  
            }
             else {
               ?>
              <span class="badge badge-danger">Block</span>
              <?php  
            } 
             ?>
        </td>
        <td class="text-center">
            <a href="<?php echo base_url().'admin/category/edit/'.$categoryRow['id']; ?>" class="btn btn-primary btn-sm">
                <i class="far fa-edit"></i>Edit
              </a>

            <a href="javascript:void(0);" onclick="DeleteCategory(<?php echo $categoryRow['id']; ?>)" class="btn btn-danger btn-sm ml-1">
            <i class="far fa-trash-alt"></i>Delete</a>
</td>
</tr>
<?php  }  ?>
<?php } else{ ?>
     <tr  class="text-center"  >  
    <td  colspan="4"><strong>Record not found  </strong> </td>  
</tr>
  <?php } ?>

    </table>
     </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
  <br><br><br><br><br><br><br><br>
<?php $this->load->view('admin/footer');  ?>

<script type="text/javascript">
         function DeleteCategory(id){
          if(confirm("Are are sure to delete this category?")){
           // alert("You are sure to delete this category")+id;
        window.location.href="<?php echo base_url().'admin/category/delete/'; ?>"+id;
           
          }
        }
  </script>
