<?php
$this->load->view('front/header');
?>
            <div class="container">

                <h3 class="pt-4 pb-4">Blog <?php // echo $articles['name']; ?></h3>

                <?php
                if(!empty($articles)){
                        foreach($articles as $val){
                    ?>
                <div class="row mb-5">
                    <div class="col-md-4">
                        <!-- Image Upload Here -->
                        <?php 
                        if(file_exists('./public/uploads/articles/thumb_admin/'.$val['image']))  { ?>
                        <img class="w-100 rounded" src="<?php echo base_url().'public/uploads/articles/thumb_admin/'.$val['image'] ?>">

                      <?php  }  ?>
            </div>
                <div class="col-md-8">
                    <p class="bg-light pt-2 pb-2 pl-3">
                        <a href="<?php echo base_url().'blog/categories/'.$val['category']; ?>" class="text-muted text-uppercase"><?php echo $val['category_name'];  ?></a>
                        </p>
                        <h3>
                            <a href="<?php  echo base_url('blog/detail/').$val['id']; ?>"><?php echo $val['title']; ?> </a>
                    </h3>
                    <p><?php  echo  word_limiter(strip_tags($val['description']),45); ?>
                    <a href="<?php  echo base_url('blog/detail/').$val['id']; ?>" class="text-muted" >ReadMore</a> </p>
                </p>
                    
                     <p>The oldest classical British and Latin writing had little or no space between words and could be written in boustrophedon (alternating directions). Over time, text direction (left to right) became standardized. 
                    <p class="text-muted">Posted By:<strong> <?php  echo $val['author']; ?></strong>  <strong>Atif Khan</strong> on  <strong> <?php  echo date('d M Y',strtotime($val['created_at'])); ?></strong>
                   
                </p>
               
            </div>
        </div>
             <?php 
                  }

               } ?>

               <div class="row">
                <div class="col-md-12">
                    <?php
                echo $pagination_links;
                    ?>
            </div>
            </div>
    </div>

<?php
$this->load->view('front/footer');
?>