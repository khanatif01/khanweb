<?php
$this->load->view('front/header');
?>
 <div class="container">

<h3 class="pt-4 pb-4">Blog</h3>
<div class="row">
    <div class="col-md-12">
        <h3><?php echo $articles['title']; ?>
</h3>
<div class="d-flex justify-content-between">
    <p class="text-muted">Posted By:<strong>  <?php  echo $articles['author']; ?></strong>  <strong>Atif Khan</strong> on  <strong> <?php  echo date('d M Y',strtotime($articles['created_at'])); ?></strong>  </p>
    <a href="#" class="text-muted p-2 bg-light text-uppercase"></strong><?php echo $articles['category_name']; ?><strong></a>
</div>
<?php
if(!empty($articles['image']))  {  ?>
<img class="w-100 rounded mt-2" src="<?php echo base_url().'public/uploads/articles/thumb_admin/'.$articles['image'] ?>">
<?php
}?>
<div class="mt-3">
<?php
echo $articles['description'];
?>


       
            <div class="col-md-9 pl-0" id="comment-box">
                <?php
                if(validation_errors()!= "")  {  ?>
                <div class="alert alert-danger">
                    <h4 class="alert-heading">please fix the following errors. </h4>
                        <?php echo validation_errors(); ?>
                </div>
<?php
                } ?>

<?php
                if(!empty($this->session->flashdata('message'))!= "")  {  ?>
                <div class="alert alert-success">
                        <?php echo $this->session->flashdata('message'); ?>
                </div>
<?php
                } ?>
            
                 <div class="card">
                 <form name="commentform" id="commentform" method="POST" action="<?php echo base_url('blog/detail/'.$articles['id']); ?>#comment-box">
                    <div class="card-body ">
                      <p>Enter Your Comments here.</p>
                          <div class="form-group">
                          <textarea placeholder="Comments here" name="comment" id="comment" class="form-group w-100" value="<?php  echo set_value('comment') ?>"  ></textarea>
                            </div>
                            <div class="form-group">
                            <label class="">Your Name</label>
                            <input placeholder="Name" type="text" name="name" id="name" value="<?php  echo set_value('name');  ?>"class="form-control w-50">
                          </div>
             <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                    </div>
            </form>
           
                    <?php
                    if(!empty($comments))   {
                        foreach($comments as $comment) { ?>
                        <div class="user-comment mt-3 ml-1">
                            <p class=" ml-2"><strong><?php echo $comment['name'];  ?></strong></p>
                            <p class=" text-muted font-italic"><?php echo $comment['comment'];  ?></p>
                          <small><?php echo date('d/m/y',strtotime($comment['created_at'])) ?></small>
                        </div>
<hr>
                    <?php
                        }  
                }  ?>
               

             </div>

</div>


</div>
</div>

</div>
    </div>

<?php
$this->load->view('front/footer');
?>