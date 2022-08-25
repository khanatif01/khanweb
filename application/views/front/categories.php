<?php
$this->load->view('front/header');
?>

        <div class="container">
        <h3 class="pt-4 pb-4">Blog</h3>
        <div class="row">
        <?php
                if(!empty($categories)){
                        foreach($categories as $val){
                    ?>

        <div class="col-md-4 mb-4">
        <div class="card">
            <a href="<?php echo base_url('blog/categories/').$val['id']; ?>">
        <!-- image -->
        <?php
        // if(file_exists('./public/uploads/category/thumb/'.$val['image']))  
        if(!empty($val['image'])) {  ?>
            <img class="w-100 rounded" src="<?php echo base_url() .'public/uploads/category/thumb/'.$val['image'];  ?>">

        <?php }  ?>

            </a>
            <div class="card-body pb-0 pt-2">
            <a href="<?php echo base_url('blog/categories/').$val['id']; ?>">
        <h5><?php  echo $val['name'];?></h5>
            </a>
</div>
</div>
</div>
<?php 
                  }

               } ?>
</div>
</div>


<?php
$this->load->view('front/footer');
?>