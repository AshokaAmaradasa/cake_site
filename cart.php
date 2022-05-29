<?php include('layouts/header.php'); ?>

<?php include('cart_logic.php');?>

    <!--Cart-->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Your Cart</h2>
            <hr>
        </div>
        

        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

          <?php if(isset($_SESSION['cart'])){ ?>  

            <?php foreach($_SESSION['cart'] as $key => $value){ ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/images/<?php echo $value['product_image']; ?>"/>
                        <div>
                            <p><?php echo $value['product_name']; ?></p>
                            <p><?php if(isset($value['product_c_id'])){ echo $value['product_c_id'];} ?></p>
                            <small><span>$</span><?php echo $value['product_price']; ?></small>
                            <br>
                            <form method="POST" action="cart.php">
                                 <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                                 <input type="submit" name="remove_product" class="remove-btn" value="remove"/>
                            </form>
                           
                        </div>
                    </div>
                </td>

                <td>
                    
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
                        <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
                        <input type="submit" class="edit-btn" value="edit" name="edit_quantity"/>
                    </form>
                    
                </td>

                <td>
                    
                    <span class="product-price">$<?php  echo $value['product_quantity'] * $value['product_price']; ?></span>
                </td>
            </tr>

         
            <?php } ?>


            <?php } ?>

         
        </table>


        <div class="cart-total">
          <table>
            <!-- <tr>
              <td>Subtotal</td>
              <td>$155</td>
            </tr> -->
            <tr>
              <td>Total</td>
              <?php if(isset($_SESSION['cart'])){?>
                 <td>$<?php echo $_SESSION['total']; ?></td>
               <?php } ?>  
            </tr>
          </table>
        </div>
    

        <div class="checkout-container">
          <form method="POST" action="checkout.php">
             <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
          </form>
        </div>


    </section>








    <?php include('layouts/footer.php'); ?>