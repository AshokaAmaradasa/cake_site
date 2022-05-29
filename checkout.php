<?php

  session_start();

  if(!empty($_SESSION['cart']))
  {
    //let the user in 
  }

  else
  {
    // send back to homepage

   header('location: index.php');
  }


?>


<?php include('layouts/header.php');  ?>




<!--Checkout-->

<section class="my-5 py-5" id="register">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight bold">Check Out</h2>
      <hr class="mx-auto">  
    </div>
    <div class="mx-auto container">
      <form id="checkout-form" action="server/place_order.php" method="POST">
          <div class="form-group checkout-small-element">
          <label> Name </label>
          <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required/>
          </div>
        <div class="form-group checkout-small-element">
          <label> Email </label>
          <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" required/>
        </div>
        <div class="form-group checkout-small-element">
          <label> Phone </label>
          <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="phone number" required/>
        </div>
        <div class="form-group checkout-small-element">
          <label> City </label>
          <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required/>
        </div>
        <div class="form-group checkout-large-element">
            <label> Address </label>
            <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required/>
          </div>
        <div class="form-group checkout-btn-container">
          <p> Total amount of the order is : <?php echo $_SESSION['nettotal'];?> </p>
          <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order"/>
        </div>
        
  
  
      </form>
  
    </div>
</section>
  


<?php include('layouts/footer.php');  ?>










  