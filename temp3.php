<?php include('layouts/header.php'); ?>




<?php

include('server/connection.php');

if(isset($_GET['product_id'])){

    $product_id =  $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM product_color_price where product_id = ?"); 
    //we check whether product_id is present in joining table of product_color_price

    $stmt->bind_param("i",$product_id);

    $stmt-> execute();

    $product_join_color = $stmt->get_result();

        if($product_join_color->num_rows > 0)//if yes
        {

                $onch = 1;

                $stmt = $conn->prepare("SELECT * FROM products JOIN product_color_price on (products.p_id=product_color_price.product_id) 
                                        JOIN color on (color.c_id=product_color_price.color_id) 
                                        JOIN price on (price.p_id= product_color_price.price_id) 
                                        WHERE products.p_id = ? LIMIT 1");

                $stmt->bind_param("i",$product_id);

                $stmt-> execute();

                $product_data = $stmt->get_result();

                




        }
        else
        {
          $onch =2;
          echo " not success ";
        }









  //no product id was given
}else{

  header('location: index.php');

}



?>






     <!-- single product -->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">

        <?php  while($row = $product_data-> fetch_assoc()){?>

         
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img id="mainImg" class="img-fluid w-100 pb-1" src="assets/images/<?php echo $row['product_image_1'];?>">
            <div class="small-img-group pb-5">
                <div class="small-img-col">
                    <img src="assets/images/<?php echo $row['product_image_1'];?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/images/<?php echo $row['product_image_2'];?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/images/<?php echo $row['product_image_3'];?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/images/<?php echo $row['product_image_4'];?>" width="100%" class="small-img"/>
                </div>
            </div>
        </div>

        

        <div class="col-lg-5 col-md-12 col-sm-12">  
            <h6><?php echo $row['product_category']?></h6>
            <h3 class="py-4"> <?php echo $row['product_name'];?></h3>
            <h2 id="change_price">Rs.<?php echo $row['product_nor_price'];?></h2>
            <br><br>


          

        <form method="POST" action="cart.php">
              <input type="hidden" name="product_id" value="<?php echo $row['p_id'];?>"/>
              <input type="hidden" name="product_image" value="<?php echo $row['product_image_1'];?>"/>
              <input type="hidden" name="product_name" value="<?php echo $row['product_name'];?>"/>

              <?php if($onch==1 && $row['product_disc_percent'] > 0) {?>
                   <!--if the product doesn't have changing attributes-->
                      <!--if the product have a discount-->
                    <input type="text" name="product_price" value="<?php echo $row['product_disc_price'];?>"/><!--hide later-->

                  <?php } else if($onch==1 && $row['product_disc_percent'] == 0) { ?>
                      <!--if the product do not have a discount-->
                    <input type="text" name="product_price" value="<?php echo $row['product_nor_price'];?>"/><!--hide later-->

                  <?php } else if($onch==2 && $row['product_disc_percent'] == 0) {?><!--if the product have changing attributes-->

                      <input type="text" id="cartchgprice" name="product_price" value="<?php echo $row['product_nor_price'];?>" /><!--hide later-->

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

            

              <?php  } ?>
        </form>

        <?php if($onch == 1){ ?>
        <form method="POST" action = "#">
         
        <br><br>

              <select id="pcolor" name=product_color class="form-select" aria-label="Default select example"  onchange="this.form.submit();">
                <option value="" selected disabled >Open this select menu</option>
                <?php while($row = $product_color_price -> fetch_assoc()){ ?> 
                  <option value=<?php echo $row['c_id'];?>><?php echo $row['color'];?></option>
                <?php } ?>
                <script type="text/javascript">
                   document.getElementById('pcolor').value = "<?php echo $_POST['product_color'];?>";
                </script>
              </select>

          
        </form>
        <?php } ?>



            <?php while($row = $product_desc -> fetch_assoc()){ ?>    
            <h4 class="mt-5 mb-5">Product Details</h4>
            <span> <?php echo $row['product_description'];?> </span>
          
            <?php } ?>

          <?php if($onch == 1){ ?>
            
            <?php while($row = $product_color_to_price -> fetch_assoc()){ ?>
              <script>
                var change_price = "<?php echo "Rs.".$row['price'] ?>"
                document.getElementById("change_price").innerHTML = change_price;
                document.getElementById("cartchgprice").value = change_price;
              </script>
            <?php } ?>
        
          <?php } ?>   

            
        </div>



        
    </div>
        

</section>
          




          <!--Realated products-->
          <section id="related-products" class="my-5 pb-5">
            <div class="container text-center mt-5 py-5">
              <h3>Related Products</h3>
              <hr class="mx-auto">
            </div>
            <div class="row mx-auto container-fluid">
              <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/featured1.jpeg"/>
                <div class="star">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
              </div>
              <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/featured2.jpeg"/>
                <div class="star">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
              </div>
              <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/featured3.jpeg"/>
                <div class="star">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
              </div>
              <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/featured4.jpeg"/>
                <div class="star">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
              </div>
            </div>
          </section>
    








         <!--Footer-->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img class="logo" src="assets/imgs/logo.jpeg"/>
            <p class="pt-3">We provide the best products for the most affordable prices</p>
          </div>
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
           <h5 class="pb-2">Featured</h5>
           <ul class="text-uppercase">
             <li><a href="#">men</a></li>
             <li><a href="#">women</a></li>
             <li><a href="#">boys</a></li>
             <li><a href="#">girls</a></li>
             <li><a href="#">new arrivals</a></li>
             <li><a href="#">clothes</a></li>
           </ul>
          </div>

          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Contact Us</h5>
            <div>
              <h6 class="text-uppercase">Address</h6>
              <p>1234 Street Name, City</p>
            </div>
            <div>
              <h6 class="text-uppercase">Phone</h6>
              <p>123 456 7890</p>
            </div>
            <div>
              <h6 class="text-uppercase">Email</h6>
              <p>info@email.com</p>
            </div>
          </div>
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Instagram</h5>
            <div class="row">
              <img src="assets/imgs/featured1.jpeg" class="img-fluid w-25 h-100 m-2"/>
              <img src="assets/imgs/featured2.jpeg" class="img-fluid w-25 h-100 m-2"/>
              <img src="assets/imgs/featured3.jpeg" class="img-fluid w-25 h-100 m-2"/>
              <img src="assets/imgs/featured4.jpeg" class="img-fluid w-25 h-100 m-2"/>
              <img src="assets/imgs/clothes1.jpeg" class="img-fluid w-25 h-100 m-2"/>
            </div>
          </div>
        </div>



        <div class="copyright mt-5">
          <div class="row container mx-auto">
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
              <img src="assets/imgs/payment.jpeg"/>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
              <p>eCommerce @ 2025 All Right Reserved</p>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
             <a href="#"><i class="fab fa-facebook"></i></a>
             <a href="#"><i class="fab fa-instagram"></i></a>
             <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
        </div>

    </footer>







    

    <script>

     var mainImg = document.getElementById("mainImg");
     var smallImg = document.getElementsByClassName("small-img"); 


     for(let i=0; i<4; i++){
                    smallImg[i].onclick = function(){
                    mainImg.src = smallImg[i].src;
                }

     }

  



    </script>





<?php include('layouts/footer.php'); ?>