<?php 


include('server/connection.php');


//searched products only
if(isset($_POST['search']))
{
  $category = $_POST['category'];
  $price = $_POST['price'];

  $stmt = $conn->prepare("SELECT * FROM products where product_category=? AND product_price<=?");

  $stmt-> bind_param('si', $category, $price);

  $stmt-> execute();
  
  $products = $stmt->get_result();
  



}
//all products are displayed
else
{

  $stmt = $conn->prepare("SELECT * FROM products");

  $stmt-> execute();
  
  $products = $stmt->get_result();
  

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/css/styles.css"/>
    <link rel="stylesheet" href="assets/css/anim.css"/>
    <link rel="stylesheet" href="assets/css/button.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="aos-by-red.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    

    <style>
      #newtous .container
      {
        align-items: flex-start;
      }
      .product img
      {
        box-sizing: border-box;
        object-fit: cover;
      }
      .pagination a
      {
        color: coral;
      }
      .pagination li:hover a
      {
        color:aliceblue;
        background-color: coral;
      }
    </style>
</head>




<body>

<!--navigation bar-->
  <nav class="navbar navbar-expand-lg navbar-light py-3 navbar-hide-on-scroll fixed-top " id="navbar" >
      <div class="container-fluid">
          <img src="assets/images/logo.jpg" width="5%" height="5%" style="border-radius: 50%;"/>
        <a class="navbar-brand" href="#" style="padding: 10px; color: #FAC73B;">  House of Cake Tools </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            <li class="nav-item"> 
              <a class="nav-link" href="index.html"> Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="shop.html"> Shop</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#"> AboutUs</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#"> ContactUs </a>
            </li>
            
            <li class="nav-item">
              <i class="fas fa-shopping-bag" aria-hidden="true"></i>
              <i class="fas fa-user"></i>
            </li>
            
          </ul>
         
        </div>
      </div>
  </nav>


<!--search-->
<section id="search" class="my-5 py-5 ms-2">
  <div class="container mt-5 py-5">
    <p>Search Products</p>
    <hr>
  </div>
    <form action="shop.php" method="post">
      <div class="row mx-auto container">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <p>Category</p>
            <div class="form-check">
              <input class="form-check-input" value="cake tools" type="radio" name="category" id="category_one">
              <label class="form-check-label" for="flexRadioDefault1"> 
                Shoes
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input"  value="party items" type="radio" name="category" id="category_two" checked/>
              <label class="form-check-label" for="flexRadioDefault2">
                Coats
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" value="decorate" type="radio" name="category" id="category_two" checked/>
              <label class="form-check-label" for="flexRadioDefault2">
                Watches
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" value="icing" type="radio" name="category" id="category_two" checked/>
              <label class="form-check-label" for="flexRadioDefault2">
                Bags
              </label>
            </div>
        </div>
      </div>

      <div class="row mx-auto container mt-5">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <p>Price</p>
          <input type="range" class="form-range w-50" name="price" value="100" min="1" max="1000" id="customRange2">
          <div class="w-50">
            <span style="float: left;">1</span>
            <span style="float: right;">1000</span>
            <br>
            <p><span id="demo"></span></p>
          </div>
        </div>
      </div>

      <div class="form-group my-3 mx-3">
        <input class="btn btn-primary" type="submit" name="search" value="search"/>
      </div>
      

    </form>
  



</section>







<!--shop-->
  <section id="shopsdes" class="my-3 py-5">
    <div class="container  mt-5 py-3">
      <h1 id="popbrands">Recently Added Products,</h1> 
    </div>
    <div class="row mx-auto container-fluid">
      <?php while($row = $products -> fetch_assoc()) {?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image'];?>"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="viewwidth p-name"><?php echo $row['product_name'];?></h5>
        <h4 class="p-price">Rs.<?php echo $row['product_price'];?></h4>
        <a class=" btn buy-btn border border border-danger" href="<?php echo "single_product.php?product_id=".$row['product_id'];?>">Buy Now</a>
      </div>


      <?php } ?>
      
        
      <nav aria-label="Page navigation example ">

        <ul class="pagination justify-content-center mt-5">
          <li class="page-item"> <a class="page-link" href="#" >Previous</a> </li>
          <li class="page-item"> <a class="page-link" href="#">1</a> </li>
          <li class="page-item"> <a class="page-link" href="#">2</a> </li>
          <li class="page-item"> <a class="page-link" href="#">3</a> </li>
          <li class="page-item"> <a class="page-link" href="#">Next</a> </li>
        </ul>

      </nav>
      
      </div>

    </div>


    
  </section>





  

<!--footer-->
<footer class="mt-3 py-5">
  <div class="row container mx-auto pt-4">
    <div class="footer-one col-lg-3 col-md-6 col-sm-12">
      <img  data-toggle="tooltip" data-placement="bottom" title="House Of Cake Tools" class="footer_logo" src="assets/images/logo.jpg"/>
      <p class="pt-3">'House of Cake Tools' provides the customers with best products for reasonable prices.We are also responsible for providing the best service for our valuable customers.</p>
    </div>
    <div class="footer-one col-lg-3 col-md-6 col-sm-12">
     <h5 class="pb-2 ">Featured</h5>
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
        <img src="assets/images/brand1.png" class="img-fluid w-25 h-100 m-2"/>
        <img src="assets/images/brand2.jpg" class="img-fluid w-25 h-100 m-2"/>
        <img src="assets/images/brand3.png" class="img-fluid w-25 h-100 m-2"/>
        <img src="assets/images/brand4.jpg" class="img-fluid w-25 h-100 m-2"/>
        <img src="assets/images/brand5.jpg" class="img-fluid w-25 h-100 m-2"/>
      </div>
    </div>
  </div>



  <div class="copyright mt-5">
    <div class="row container mx-auto">
      <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
        <img data-aos="fade-right" data-toggle="tooltip" data-placement="bottom" title="Cash On Delivery" src="assets/images/cashondeli.jpg"/>
        <img data-aos="fade-left" data-toggle="tooltip" data-placement="bottom" title="Bank Deposit" src="assets/images/bankdep.png"/>
      </div>
      <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
        <p>CreativeXync @ 2025 All Right Reserved</p>
      </div>
      <div class="social col-lg-3 col-md-5 col-sm-12 mb-4  mx-auto">
        
       <a  data-aos="fade-left" href="#"><i class="fab fa-facebook"></i></a>
       <a  data-aos="fade-left" data-aos-delay="300" href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>

</footer>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="assets/javascript/anime.js"></script> 
  <script>
        var slider = document.getElementById("customRange2");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value;

        slider.oninput = function() {
          output.innerHTML = this.value;
        }
    </script>

  
  
</body>
</html>