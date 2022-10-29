<!-- <?php
  include('server/connection.php');



  if(isset($_GET['product_id']))
  {
    $product_id = $_GET['product_id'];
    $onch;

    $stmt = $conn->prepare("SELECT * FROM product_color_price where product_id = ?");
    $stmt->bind_param("i",$product_id);

    $stmt-> execute();

    $product_select = $stmt->get_result();

          if($product_select->num_rows > 0)
              {
                
                $onch = 1;
                //select db for product details
                $stmt = $conn->prepare("SELECT * FROM products JOIN product_color_price on (products.p_id=product_color_price.product_id) 
                                        JOIN color on (color.c_id=product_color_price.color_id) 
                                        JOIN price on (price.p_id= product_color_price.price_id) 
                                        WHERE products.p_id = ? LIMIT 1");

                $stmt->bind_param("i",$product_id);

                $stmt-> execute();

                $product = $stmt->get_result();
              


                //select db for select tag 
                $stmt = $conn->prepare("SELECT * FROM products JOIN product_color_price on (products.p_id=product_color_price.product_id) JOIN color on (color.c_id=product_color_price.color_id) JOIN price on (price.p_id= product_color_price.price_id) WHERE products.p_id = ?");
                $stmt->bind_param("i",$product_id);

                $stmt-> execute();

                $product_color_price = $stmt->get_result();



                //select db for description 
                $stmt = $conn->prepare("SELECT * FROM products JOIN product_color_price on (products.p_id=product_color_price.product_id) JOIN color on (color.c_id=product_color_price.color_id) JOIN price on (price.p_id= product_color_price.price_id) WHERE products.p_id = ? LIMIT 1");
                $stmt->bind_param("i",$product_id);
            
                $stmt-> execute();
            
                $product_desc = $stmt->get_result();


                //select db for change price acc to color
                if(isset($_POST['product_color']))
                {
                  
                  $color_id = $_POST['product_color'];

                 
                

                $stmt = $conn->prepare("SELECT * FROM products JOIN product_color_price on (products.p_id=product_color_price.product_id) JOIN color on (color.c_id=product_color_price.color_id) JOIN price on (price.p_id= product_color_price.price_id) WHERE products.p_id = ? and color.c_id = ?");
                $stmt->bind_param("ii",$product_id, $color_id);

                $stmt-> execute();

                $product_color_to_price = $stmt->get_result();

                }
               
                

                
              }
          //if more tables are added just put an elseif here
          else 
                {
                  
                  $stmt = $conn->prepare("SELECT * FROM products where p_id=?");

                  $stmt->bind_param("i",$product_id);

                  $stmt-> execute();

                  $product = $stmt->get_result();

                 

                  $onch = 2;


                  $stmt = $conn->prepare("SELECT * FROM products where p_id=?");

                  $stmt->bind_param("i",$product_id);

                  $stmt-> execute();

                  $product_desc = $stmt->get_result();





                 



                }
          
  }
  else
  {
    //when no product was given go to index

    //header('location: index.php');

  }

 

  

  
?> -->

<?php
require_once '../configurations/urlconfig.php';
require_once '../configurations/dirconfig.php';
include ROOT_PATH.'/db_configurations/dbOperations.php';
require_once ROOT_PATH.'homepage/controller/homeClassController.php';

$images_array = $homepageControllerObj->fetchSingleImages(1);

// print("<pre>".print_r($images_array,true)."</pre>");die;

?>



<?php include('../layouts/header.php');  ?>

<!-- single product -->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">

        

    
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img id="mainImg" class="img-fluid w-100 pb-1" src="<?php echo $images_array['single_image'][0]['main_image'];?>">
            <div class="small-img-group pb-5">
            <?php 
            $size_array = sizeof($images_array['sub_images']);
            for($i=0; $i<$size_array; $i++){
            ?>


                <div class="-img-col">
                    <img src="<?php echo $images_array['sub_images'][$i]['image'];?>" width="100%" class="small-img"/>
                </div>

            <?php } ?>

                <!-- <div class="small-img-col">
                    <img src="assets/images/<?php echo $row['product_image_2'];?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/images/<?php echo $row['product_image_3'];?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/images/<?php echo $row['product_image_4'];?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/images/<?php echo $row['product_image_4'];?>" width="100%" class="small-img"/>
                </div> -->
            </div>
        </div>

        

        <div class="col-lg-5 col-md-12 col-sm-12">  
            <h6><?php echo "dfgmh"?></h6>
            <h3 class="py-4"> <?php echo "dfgmh"?></h3>
            <h2 id="change_price">Rs.<?php echo "dfgmh"?></h2>
            <br><br>


          

        <form method="POST" action="cart.php">
              <input type="hidden" name="product_id" value="<?php echo "dfgmh"?>"/>
              <input type="hidden" name="product_image" value="<?php echo "dfgmh"?>"/>
              <input type="hidden" name="product_name" value="<?php echo "dfgmh"?>"/>

              <?php if($row['product_disc_percent'] > 0 && $onch==2){ ?> <!--if not changing and has discount-->

                <input type="text" name="product_price" value="<?php echo $row['product_disc_price'];?>" /><!--hide later-->

              <?php }

              else if($row['product_disc_percent']==0 && $onch==2){ ?><!--if not changing and no discount-->

                <input type="text" name="product_price" value="<?php echo $row['product_nor_price'];?>" /><!--hide later-->

              <?php } else if($onch==1){?><!--if changing (it has no discount) -->


              <input type="text" id="cartchgprice" name="product_price" value="<?php echo $row['price'];?>" /><!--hide later-->
              <input type="text" id="colorstr" name="product_color_id" /><!--hide later-->

              <?php } ?>

              <input type="number" name="product_quantity" value="1" min="1"/><br><br>


              <?php
                  if(!empty($_POST['product_color'])) { ?>
                    
                    <button class="buy-btn" name="add_to_cart" type="submit"> Add to Cart </button>
               <?php    } else if($onch==2) { ?>
                
                <button class="buy-btn" name="add_to_cart" type="submit"> Add to Cart </button>

              <?php } else { ?>

                <button disabled class="buy-btn" name="add_to_cart" type="submit"> Add to Cart </button>

              <?php }?>

            

              
        </form>

        <?php if($onch == 1){ ?>
        <form method="POST" action = "#">
         
        <br><br>

              <select id="pcolor" name=product_color class="form-select" aria-label="Default select example"  onchange="this.form.submit();">
                <option value="" selected disabled >Open this select menu</option>
                <?php while($row = $product_color_price -> fetch_assoc()){ ?> 
                  <option value=<?php echo $row['c_id'];?>><?php echo $row['color'];?> <?php echo $row['c_id'];?></option>
                <?php } ?>
                <script type="text/javascript">
                   document.getElementById('pcolor').value = "<?php echo $_POST['product_color'];?>";
                   
                   document.getElementById('colorstr').value = "<?php echo $_POST['product_color'];?>";
                   
                </script>
              </select>

          
        </form>
        <?php } ?>



            <?php while($row = $product_desc -> fetch_assoc()){ ?>    
            <h4 class="mt-5 mb-5">Product Details</h4>
            <span> <?php echo $row['product_description'];?> </span>
          
            <?php } ?>

          <?php if($onch == 1){ ?>
            <?php if(isset($product_color_to_price)){?>
            <?php while($row = $product_color_to_price -> fetch_assoc()){ ?>
              <script>
                var change_price = "<?php echo $row['price'] ?>"
                document.getElementById("change_price").innerHTML = change_price;
                document.getElementById("cartchgprice").value = change_price;
              </script>
            <?php } ?>
        
            <?php } ?>
          <?php } ?>   

            
        </div>



        
    </div>
        

</section>







 <!--related products-->
 <section id="related-products" class="my-3 pb-3">
    <div class="container text-center mt-2 py-2">
      <h1 id="popbrands">Related products</h1>
      <hr id="brline" class="mx-auto" data-aos="fade-right">
    </div>
    <div class="row mx-auto container-fluid mx-auto container-fluid">
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/images/nozzlepr.jpg"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="viewwidth p-name">Nozzle for cake decorations ffgdsfg dfg sdf sdf</h5>
        <h4 class="p-price">Rs. 199.8</h4>
        <button class="buy-btn border border border-danger">Buy Now</button>
      </div>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/images/balloonpr.jpg"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="viewwidth p-name">Nozzle for cake decorations ffgdsfg dfg sdf sdf</h5>
        <h4 class="p-price">Rs. 199.8</h4>
        <button class="buy-btn border border border-danger">Buy Now</button>
      </div>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/images/cakeplatespr.jpg"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="viewwidth p-name">Nozzle for cake decorations ffgdsfg dfg sdf sdf</h5>
        <h4 class="p-price">Rs. 199.8</h4>
        <button class="buy-btn border border border-danger">Buy Now</button>
      </div>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/images/cutterpr.jpg"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="viewwidth p-name">Nozzle for cake decorations ffgdsfg dfg sdf sdf</h5>
        <h4 class="p-price">Rs. 199.8</h4>
        <button class="buy-btn border border border-danger">Buy Now</button>
      </div>
      

    </div>


    
  </section>




  
 



  
  <script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

      for(let i=0; i<4; i++){
        smallImg[i].onclick=function()
        {
          mainImg.src = smallImg[i].src;
        }
        
        }
  </script>
  
  
  <?php include('layouts/footer.php');  ?>