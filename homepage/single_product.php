<!-- <?php
  include('server/connection.php');

  
?> -->

<?php
require_once '../configurations/urlconfig.php';
require_once '../configurations/dirconfig.php';
include ROOT_PATH.'/db_configurations/dbOperations.php';
require_once ROOT_PATH.'homepage/controller/homeClassController.php';

if(isset($_GET['product_id']))
{
  $pr_id = $_GET['product_id'];
}
else
{
  header('location: index.php');
}

$images_array = $homepageControllerObj->fetchSingleImages($pr_id);

$fte = $homepageControllerObj->fetchcolorflavors($pr_id);

$single_det_arr = $homepageControllerObj->fetchsingleproductdetails($pr_id);

  // print("<pre>".print_r($ssimages_array,true)."</pre>");die;

?>



<?php include('../layouts/header.php');  ?>

<!-- single product -->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">

        

     
        <div class="col-lg-5 col-md-6 col-sm-12 ">
            <img id="mainImg" class="img-fluid w-100 mb-2 border border-primary" src="<?php echo $images_array['images'][0]['main_image'];?>">
            <div class="small-img-group pb-5">
            <?php 
            $size_array = sizeof($images_array['images']);
            for($i=0; $i<$size_array; $i++){
            ?>
                <div class="-img-col border border-dark">
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

        

        <div class="col-lg-5 col-md-12 col-sm-12 border-right " style="background-color: #f7cac9 ;"> 


            <h3 class="py-1" id="tet"> <?php echo $single_det_arr['result_array'][0]['product_name']?> <span><?php echo $single_det_arr['result_array'][0]['size']?><?php echo $single_det_arr['result_array'][0]['size_type']?></span></h3>
            
            <h6 class="d-inline text-primary">Brand &nbsp; &#10144;  &nbsp; <?php echo $single_det_arr['result_array'][0]['brand_name']?></h6>
             
            <h5 class="d-block mb-3">Category &nbsp; &#10144;  &nbsp;  <?php echo $single_det_arr['result_array'][0]['category']?></h5>

           

            <small><label  class="d-inline" for="#change_price">Rs.</label></small> &nbsp; <h3 id="change_price" class="d-inline"> <?php echo $single_det_arr['result_array'][0]['product_starting_price']?></h3>
            <br>

            <select id="pcolor" name=product_color class="form-select mb-3 w-50 mt-3" aria-label="Default select example"  onchange="this.form.submit();">
                <option value="" selected disabled >Select an option</option>
                <?php foreach($fte as $key => $value){?>
                <option  value="<?php echo $value['property_price']?>" data-property="<?php echo $value['property_id']?>" data-name="<?php echo $value['property_name']?>" ><?php echo $value['property_name']?></option> 
                <?php }?>
          
             
              </select>


          

        <form method="POST" action="cart.php">
              
              <input type="hidden" id="colorstr" name="product_color_price" /><!--hide later-->
              <input type="hidden" id="colorname" name="product_color_id" /><!--hide later-->
              <input type="hidden" id="color_id" name="product_color_name" /><!--hide later-->
              <input type="hidden" id="product_id" name="product_id" value="<?php echo $single_det_arr['result_array'][0]['product_id']?>"/><!--hide later-->
              <input type="hidden" id="product_size" name="product_size" value="<?php echo $single_det_arr['result_array'][0]['size']?> "/><!--hide later-->
              <input type="hidden" id="product_size" name="product_size_type" value="<?php echo $single_det_arr['result_array'][0]['size_type']?> "/><!--hide later-->
              <input type="hidden" id="product_size" name="product_image" value="<?php echo $single_det_arr['result_array'][0]['product_single_image']?> "/><!--hide later-->
              <input type="hidden" id="product_size" name="product_name" value="<?php echo $single_det_arr['result_array'][0]['product_name']?> "/><!--hide later-->
              <input type="hidden" id="product_size" name="product_norm_price" value="<?php echo $single_det_arr['result_array'][0]['product_starting_price']?> "/><!--hide later-->
            

              <input type="number" name="product_quantity" value="1" min="1"/><br><br>

                
              

              <button disabled class="buy-btn" id="disable_btn" name="add_to_cart" type="submit"> Add to Cart </button>

           
              

              
        </form>

      
    



          


       

      


           
            <h4 class="mt-5 mb-2">Product Details</h4>
            <hr>
            <span><?php echo $single_det_arr['result_array'][0]['product_description']?> </span>
          
           

            

            
        </div>



        
    </div>
        

            <script type="text/javascript">
                  $('#pcolor').on('change', function(){

                    $("#disable_btn").prop('disabled', false);
                    $("#colorstr").val(this.value);
                    $("#change_price").html(this.value);
                    var tet = $('#pcolor').find('option:selected').attr('data-property');
                    $("#colorname").val(tet);
                    var tot = $('#pcolor').find('option:selected').attr('data-name');
                    $('#color_id').val(tot);

                    

                  
                  });
                 
            </script>

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