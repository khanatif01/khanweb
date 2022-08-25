<?php $this->load->view('front/header'); ?>

<div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo base_url('public/images/slide1.jpg'); ?>"  class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url('public/images/slide2.jpg'); ?>" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url('public/images/slide3.jpg'); ?>" class="d-block w-100" alt="...">
    </div>
  </div>
 <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
</div>



<div class="container pt-4 pb-4">
<h3 class="pb-3">About Company</h3>
        <p class="text-muted">
        Topic sentences are similar to mini thesis statements. Like a thesis statement, a topic sentence has a specific main point. Whereas the thesis is the main point of the essay, the topic sentence is the main point of the paragraph. Like the thesis statement, a topic sentence has a unifying function. But a thesis statement or topic sentence alone doesn’t guarantee unity. An essay is unified if all the paragraphs relate to the thesis, whereas a paragraph is unified if all the sentences relate to the topic sentence. Note: Not all paragraphs need topic sentences. In particular, opening and closing paragraphs, which serve different functions from body paragraphs, generally don’t have topic sentences.
</p>
<p class="text-muted">
Often, the body paragraph demonstrates and develops your topic sentence through an ordered, logical progression of ideas. There are a number of useful techniques for expanding on topic sentences and developing your ideas in a paragraph. Illustration in a paragraph supports a general statement by means of examples, details, or relevant quotations (with your comments).
</p>
</div>
<div class="bg-light pb-5">
<div class="container">
    <h3 class="pt-3 mb-4">OUR SERVICES</h3>
<div class="row">
        <div class="col-md-3">
        <div class="card h-100">
  <img src="<?php echo base_url('public/images/box1.jpg') ?>" class="card-img-top" alt="">
  <div class="card-body">
    <h5 class="card-title">Web Devlopment</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the .</p>
    
  </div>
</div>
</div>
<div class="col-md-3">
        <div class="card h-100">
  <img src="<?php echo base_url('public/images/box2.jpg') ?>" class="card-img-top" alt="">
  <div class="card-body">
    <h5 class="card-title">Digital Marketing</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the .</p>
    
  </div>
</div>
</div>
<div class="col-md-3">
        <div class="card h-100" style="">
  <img src="<?php echo base_url('public/images/box3.jpg') ?>" class="card-img-top" alt="">
  <div class="card-body">
    <h5 class="card-title">Mobile App Devlopment</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the .</p>
    
  </div>
</div>
</div>
<div class="col-md-3">
        <div class="card h-100" style="">
  <img src="<?php echo base_url('public/images/box4.jpg') ?>" class="card-img-top" alt="">
  <div class="card-body">
    <h5 class="card-title">IT Consulting Service</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the .</p>
    
  </div>
</div>
</div>
</div>
</div>
</div>

            <!-- //  dynamic pages: -->

         <?php   if(!empty($articles))   {  ?>
            <div class="pb-4 pt-4 mt-3"> 
                <div class="container ">
  <h3 class="pt-2 mb-4">LATEST BLOG</h3>
  <div class="row">
     <?php     foreach($articles as $art)  {   ?>
    <div class="col-md-3">
      <div class="card h-100">
        <a href="<?php echo base_url().'blog/detail/'.$art['id']; ?>">
      <?php  if(file_exists('./public/uploads/articles/thumb_front/'.$art['image']))  { ?>

        <img src="<?php echo base_url('public/uploads/articles/thumb_front/'.$art['image']) ?>" class="card-img-top" alt="">
      <?php  }  ?>
      </a>
        <div class="card-body">
       
          <p class="card-text"><?php echo $art['title'];  ?></p>
          <a class="btn btn-primary btn-sm" href="<?php echo base_url().'blog/detail/'.$art['id']; ?>">Read More</a>
        </div>
      </div>
    </div>
    <?php  }  ?>
    <!-- <div class="col-md-3">
      <div class="card h-100" style="">
        <img src="
						<?php echo base_url('public/images/box2.jpg') ?>" class="card-img-top" alt="">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the .</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card h-100" style="">
        <img src="
							<?php echo base_url('public/images/box3.jpg') ?>" class="card-img-top" alt="">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the .</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card h-100" style="">
        <img src="
								<?php echo base_url('public/images/box4.jpg') ?>" class="card-img-top" alt="">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the .</p>
        </div>
      </div>
    </div> -->
  </div>
</div> 
</div>

        <?php } ?>

   <?php $this->load->view('front/footer'); ?>