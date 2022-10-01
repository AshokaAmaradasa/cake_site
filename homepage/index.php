<?php // include('../layouts/header.php'); 

require_once '../configurations/urlconfig.php';
require_once '../configurations/dirconfig.php';
include ROOT_PATH.'/db_configurations/dbOperations.php';
require_once ROOT_PATH.'homepage/controller/homeClassController.php';

$recent_array = $homepageControllerObj->fetchRecentProducts();

$discount_sec_arr = $homepageControllerObj->fetchDiscountProducts();



//  print("<pre>".print_r($recent_array,true)."</pre>");die;


?>

<?php include('../layouts/header.php');  ?>

   
  <!--corousel-->    
    <section id="corusel" >
     

      <div id="carouselExampleCaptions" class="carousel slide carousel-fade " data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
     
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="5000">
            <img src="<?php echo URL ?>assets/images/color.jpg" class="d-block w-100" id="cr_image">
            <div class="carousel-caption d-md-block">
              <h5> Best Deals </h5>
              <p style="color: rgb(255, 255, 255);">Got It? Love It? And Wanna Buy It?</p>
              <div class="pure-button fuller-button white"><span class="txt_siz">MORE INFO</span> </div>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="5000">
            <img src="<?php echo URL ?>assets/images/converted.jpg" class="d-block w-100" id="cr_image">
            <div class="carousel-caption  d-md-block" >
              <h5>Deco tools</h5>
              <p>Need Tools to Decorate? One Stop for All Your Equipment Needs..</p>
              <div class="pure-button fuller-button white"><span class="txt_siz">SHOP NOW</span></div>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="5000">
            <img src="<?php echo URL ?>assets/images/shop.jpg" class="d-block w-100" id="cr_image">
            <div class="carousel-caption  d-md-block">
              <h5>Cake Ingredients</h5>
              <p>Missing Out Some Cake Ingredients? Check with Us.. </p>
              <div class="pure-button fuller-button white"><span class="txt_siz">SHOP WITH US</span></div>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="5000">
            <img src="<?php echo URL ?>assets/images/converted.jpg" class="d-block w-100" id="cr_image">
            <div class="carousel-caption  d-md-block" >
              <h5>Party Deco's</h5>
              <p>Wishing Having a Party? Try Out Our New Deco Ideas..</p>
              <div class="pure-button fuller-button white"><span class="txt_siz">GET IT FROM HERE</span></div>
            </div>
          </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>


  <!--new to us section-->
    <section id="newtous" class="my-5 pb-5">
      <div class="container text-center mt-3 py-3 pl-0">
        <h1 id="popbrands">Recently Added Products,</h1>
        <hr id="brline" class="mx-auto" data-aos="fade-right">
      </div>
      <div class="row mx-auto container-fluid">.
        
        


      <?php foreach($recent_array['result_array'] as $key => $singleNews) {?>
      

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="<?php echo $singleNews['product_single_image']; ?>"/>
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="viewwidth p-name"><?php echo $singleNews['product_name']; ?></h5>
          <h4 class="p-price">Rs. <?php echo $singleNews['product_starting_price']; ?></h4>
          <a href="<?php echo "single_product.php?product_id=".$singleNews['product_id'];?>"><button class="buy-btn border border border-danger">Buy Now</button></a>
        </div>
        <?php } ?>
        <div class="buttons">
          <div class="container">
            <a href="shop.php" class="btn effect04" data-sm-link-text="Explore More"><span>Looking for more products</span></a>
          </div>
        </div>
           
      </div>


      
    </section>

  <!--mid banner section-->
  <section id="banner" class="p-0 m-0">
      <div class="container">
        <h4>Grab Our Special Offers From Our Store</h4>
        <h5>Don't forget to grab special offers, Upto more than 30% discounts on selected items</h5>
        <br>
        <button type="button" class="btn btn-outline-warning ">Shop Now</button>
      </div>
  </section>

  <!--discount store-->
  <section id="discountsec" class="my-3 pb-3">
    <div class="container text-center mt-2 py-2">
      <h1 id="popbrands">Discount Section </h1>
      <hr id="brline" class="mx-auto" data-aos="fade-right">
    </div>
    <div class="row mx-auto container-fluid mx-auto container-fluid">

    
    <?php foreach($discount_sec_arr['result_array'] as $key => $discount) { ?>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="<?php echo $discount['product_single_image'];?>"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="viewwidth p-name"><?php echo $discount['product_name'];?></h5>
        <h4 class="p-price">Rs. <?php echo $discount['product_discount_price']; ?></h4>
        <h6 class="viewwidth p-name" data-aos="fade-right">I was : Rs.<del><?php echo $discount['product_starting_price']; ?></del></h6>
        <a href="<?php echo "single_product.php?product_id=".$discount['product_id'];?>"><button class="buy-btn border border border-danger">Buy Now</button></a>
      </div>
      <?php } ?>
      
     
      <div class="buttons">
        <div class="container">
          <a href="#" class="btn effect04" data-sm-link-text="Explore More"><span>Searching More Discounts</span></a>
        </div>
      </div>
    </div>


    
  </section>


  <!--catogories section-->
      <section id="catagories" >
        <h1 id="popbrands"> We Focus On , </h1>
        <hr id="brline" class="mx-auto" data-aos="fade-right">
          <div class="row p-0 m-0">
            <div class="one col-lg-3 col-md-12 col-sm-12 p-0 ">
              <img class="img-fluid cat-img" src="../assets/images/cakeinsec.jpg"/>
              <div class="details">
                <h2>Cake Ingredients</h2>
                <div class="pure-button fuller-button white"><span class="txt_siz">MORE INFO</span> </div>
              </div>
            </div>
            <div class="one col-lg-3 col-md-12 col-sm-12 p-0">
              <img class="img-fluid cat-img" src="../assets/images/caketollssec.jpg"/>
              <div class="details">
                <div class="details">
                  <h2>Cake Tools</h2>
                  <div class="pure-button fuller-button white"><span class="txt_siz">MORE INFO</span> </div>
                </div>
              </div>
            </div>
            <div class="one col-lg-3 col-md-12 col-sm-12 p-0 ">
              <img class="img-fluid cat-img" src="../assets/images/partydecosec.jpg"/>
              <div class="details">
                <h2>Party Items</h2>
                <div class="pure-button fuller-button white"><span class="txt_siz">MORE INFO</span> </div>
              </div>
            </div>
            <div class="one col-lg-3 col-md-12 col-sm-12 p-0 ">
              <img class="img-fluid cat-img" src="../assets/images/backimage.gif"/>
              <div class="details">
                <h2> Rent Items </h2>
                <div class="pure-button fuller-button white"><span class="txt_siz">MORE INFO</span> </div>
              </div>
            </div>
          </div>

      </section>

<!--contact us-->


  <!--brands section-->
    <section id="brandsec" class="container">
    

      <h1 id="popbrands"> Popular Brands </h1>
      <hr id="brline" class="mx-auto" data-aos="fade-right">
      
        <div class="branddiv row">
          <img class="brandimg img-fluid col-lg-2 col-md-3 col-sm-6"  src="../assets/images/brand1.png"/> 
          <img class="brandimg img-fluid col-lg-2 col-md-3 col-sm-6" src="../assets/images/brand2.jpg"/> 
          <img class="brandimg img-fluid col-lg-2 col-md-3 col-sm-6" src="../assets/images/brand3.png"/> 
          <img class="brandimg img-fluid col-lg-2 col-md-3 col-sm-6" src="../assets/images/brand6.png"/>
          <img class="brandimg img-fluid col-lg-2 col-md-3 col-sm-6" src="../assets/images/brand4.jpg"/>
          <img class="brandimg img-fluid col-lg-2 col-md-3 col-sm-6" src="../assets/images/brand5.jpg"/>
        </div>
    </section>


    <?php include('../layouts/footer.php');  ?>
   