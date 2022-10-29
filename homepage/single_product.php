<!-- <?php
  include('server/connection.php');

  
?> -->

<?php
require_once '../configurations/urlconfig.php';
require_once '../configurations/dirconfig.php';
include ROOT_PATH.'/db_configurations/dbOperations.php';
require_once ROOT_PATH.'homepage/controller/homeClassController.php';

$images_array = $homepageControllerObj->fetchSingleImages(3);

$fte = $homepageControllerObj->fetchcolorflavors(3);

//  print("<pre>".print_r($fte,true)."</pre>");die;

?>



<?php include('../layouts/header.php');  ?>

<!-- single product -->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">

        

    
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img id="mainImg" class="img-fluid w-100 pb-1" src="<?php echo $images_array['images'][0]['main_image'];?>">
            <div class="small-img-group pb-5">
            <?php 
            $size_array = sizeof($images_array['images']);
            for($i=0; $i<$size_array; $i++){
            ?>


                <div class="-img-col">
                    <img src="<?php echo $images_array['images'][$i]['sub_image'];?>" width="100%" class="small-img"/>
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
            <h3 class="py-4" id="tet"> <?php echo "dfgmh"?></h3>
            <label style="positio:absolute" for="#change_price">Rs.</label><h2 id="change_price"><?php echo "dfgmh"?></h2>
            <br>

            <select id="pcolor" name=product_color class="form-select mb-5 w-50" aria-label="Default select example"  onchange="this.form.submit();">
                <option value="" selected disabled >Open this select menu</option>
                <?php foreach($fte as $key => $value){?>
                <option  value="<?php echo $value['property_price']?>"><?php echo $value['property_name']?></option> 
                <?php }?>
          
                <script type="text/javascript">
                  $('#pcolor').on('change', function(){
                    
                    $("#colorstr").val(this.value);
                    $("#change_price").html(this.value);
                    var tet = $("#pcolor option:selected");
                    $("#tet").text(tet.text());

                   


                  });
                 
                   
                   
                   
                </script>
              </select>


          

        <form method="POST" action="cart.php">
              
              <input type="text" id="colorstr" name="product_color_id" /><!--hide later-->

            

              <input type="number" name="product_quantity" value="1" min="1"/><br><br>


             
                    
              <button class="buy-btn" name="add_to_cart" type="submit"> Add to Cart </button>
            
                
                
              

              <button disabled class="buy-btn" name="add_to_cart" type="submit"> Add to Cart </button>

           
              

              
        </form>

      
    



          


       

      


           
            <h4 class="mt-5 mb-5">Product Details</h4>
            <span> <?php echo "description" ?> </span>
          
           

         
           
              <!-- <script>
                var change_price = ""
                document.getElementById("change_price").innerHTML = change_price;
                document.getElementById("cartchgprice").value = change_price;
              </script> -->

            

            
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
     var mainSrc = mainImg.src;
      for(let i=0; i<4; i++){
        smallImg[i].onclick=function()
        {
          mainImg.src = smallImg[i].src;
        }
        
        }
  </script>
  
  
  <?php include('../layouts/footer.php');  ?>