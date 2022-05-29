<?php
  include('server/connection.php');


  $product_id = 1;

    $stmt = $conn->prepare("SELECT * FROM product_color_price where product_id = ?");
    $stmt->bind_param("i",$product_id);

    $stmt-> execute();

    $product = $stmt->get_result();

  if($product->num_rows > 0)
  {
    

    $stmt = $conn->prepare("SELECT * FROM products JOIN product_color_price on (products.p_id=product_color_price.product_id) JOIN color on (color.c_id=product_color_price.color_id) JOIN price on (price.p_id= product_color_price.price_id) WHERE products.p_id = ? LIMIT");
    $stmt->bind_param("i",$product_id);

    $stmt-> execute();

    $product = $stmt->get_result();


    

    
  }
  //if more tables are added just put an elseif here
  else 
  {
    echo "wrong entry";
  }
  

      

?>






