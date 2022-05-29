
<?php





if(isset($_POST['add_to_cart'])){

    //if user has already added a product to cart
    if(isset($_SESSION['cart'])){

       $products_array_ids = array_column($_SESSION['cart'],"product_id"); // [2,3,4,10,15]


       //if product has already been addedcto cart or not
       if( !in_array($_POST['product_id'], $products_array_ids) ){

            $product_id = $_POST['product_id'];
      
              $product_array = array(
                              'product_id' => $_POST['product_id'],
                              'product_name' =>  $_POST['product_name'],
                              'product_price' => $_POST['product_price'],
                              'product_image' => $_POST['product_image'],
                              'product_quantity' => $_POST['product_quantity']
              );
      
              $_SESSION['cart'][$product_id] = $product_array;


        //product has already been added
       }
       else
       {
            $products_array_ids1 = array_column($_SESSION['cart'],"product_c_id"); 

            if(!in_array($_POST['product_c_id'], $products_array_ids1))
            {
                $color_id = $_POST['product_id'];

                $product_array = array(
                    'product_id' => $_POST['product_id'],
                    'product_name' =>  $_POST['product_name'],
                    'product_price' => $_POST['product_price'],
                    'product_image' => $_POST['product_image'],
                    'product_quantity' => $_POST['product_quantity'],
                    'product_c_id' => $_POST['product_c_id']
                    );

                $_SESSION['cart'][$product_id] = $product_array;
            }
            else
            {
         
                echo '<script>alert("Product was already to cart");</script>';
            }

       }


      //if this is the first product
    }else{
 
       $product_id = $_POST['product_id'];
       $product_name = $_POST['product_name'];
       $product_price = $_POST['product_price'];
       $product_image = $_POST['product_image'];
       $product_quantity = $_POST['product_quantity'];

       $product_array = array(
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'product_price' => $product_price,
                        'product_image' => $product_image,
                        'product_quantity' => $product_quantity
       );

       $_SESSION['cart'][$product_id] = $product_array;
       // [ 2=>[] , 3=>[], 5=>[]  ]


      


      


    }


    //calculate total
    calculateTotalCart();






//remove product from cart
}else if(isset($_POST['remove_product'])){

  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);
  

  //calculate total
  calculateTotalCart();



}else if( isset($_POST['edit_quantity']) ){

    //we get id and quantity from the form
   $product_id = $_POST['product_id'];
   $product_quantity = $_POST['product_quantity'];

   //get the product array from the session
   $product_array = $_SESSION['cart'][$product_id];

   //update product quantity
   $product_array['product_quantity'] = $product_quantity;


   //return array back its place
   $_SESSION['cart'][$product_id] = $product_array;


   //calculate total
   calculateTotalCart();

   

}else{
  // header('location: index.php');
}





function calculateTotalCart(){

     $total_price = 0;
     $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $value){
 
        $product =  $_SESSION['cart'][$key];

        $price =  $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price =  $total_price + ($price * $quantity);
        $total_quantity = $total_quantity + $quantity;
        

    }

    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;

}





?>
