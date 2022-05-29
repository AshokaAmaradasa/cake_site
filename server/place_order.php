<?php 

session_start();

include('connection.php');




//if user isn't logged in 
if(!isset($_SESSION['logged_in']))
{
    header('location:../login.php?message=Let us Login before we continue to place the order');
    exit;
}
//if user is logged in
else
{

                if(isset($_POST['place_order']))
                {

                    //get user info & store it in database

                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $city = $_POST['city'];
                        $address = $_POST['address'];
                        $order_cost = $_SESSION['nettotal'];
                        $order_status = "not paid";
                        $user_id = $_SESSION['user_id'];
                        date_default_timezone_set('Asia/Colombo');
                        $order_date = date('Y-m-d H:i:s');

                    $stmt =  $conn->prepare("insert into orders(order_cost,order_status,user_id,user_phone,user_city,user_address,order_date,user_email)
                                        VALUES(?,?,?,?,?,?,?,?);");

                        $stmt-> bind_param('isiissss', $order_cost,$order_status,$user_id,$phone,$city,$address,$order_date,$email);

                        $stmt_status = $stmt->execute();

                        if(!$stmt_status)
                        {
                                header('location:index.php');
                                exit;
                        }
                    // issue new order & store order info in database 

                        $order_id = $stmt->insert_id;

                        



                    //get products from cart (from session)
                

                    foreach($_SESSION['cart'] as $key => $value)
                    {
                        $product = $_SESSION['cart'][$key];
                        $product_id = $product['product_id'];
                        $product_name = $product['product_name'];
                        $product_image = $product['product_image'];
                        $product_price = $product['product_price'];
                        $product_quantity = $product['product_quantity'];

                    //store each single item in order_items database

                        $stmt1 = $conn->prepare("insert into order_items(order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date) 
                                        values(?,?,?,?,?,?,?,?)");
                        
                        $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price,$product_quantity,$user_id,$order_date); 
                        
                        
                        $stmt1->execute();
                    }





                    //remove everything from cart  --> delay until payment is done
                    //unset($_SESSION['nettotal']);
                    //unset($_SESSION['cart']);
                    


                    //inform user whether every thing is fine or there is a problem 

                    header('location: ../payment.php?order_status=order placed successfully');

                }
                else
                {

                }


}

?>