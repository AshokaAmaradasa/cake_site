<?php

use LDAP\Result;

 require_once ROOT_PATH.'Images/productImageSearch.php';
 require_once ROOT_PATH.'configurations/urlconfig.php';


class homepageClassHomeClass extends imagesProductImageSearchClass{

    public $localhost;

    public function __construct($localhost){
        $this->localhost = $localhost;
    } // Constrcut


    public function getPassedQuery($query)
    {
        $passed_query_result = array();

        $select =  mysqli_query($this->localhost, $query);

        $selected_no_rows = mysqli_num_rows($select);

        $product_image = '';

        if($selected_no_rows > 0)
        {
            //if a result was returned
            while($fetch = mysqli_fetch_array($select) )
            {
                $image = $fetch['product_single_image'];

                $product_image = $this -> checkImageInDb(BLOG_IMG_FOLDER,$image);

                $temArray = array
                    (
                        'brand_name' => $fetch['brand_name'],
                        'size_type' => $fetch['size_type'],
                        'size' => $fetch['size'],
                        'product_name' => $fetch['product_name'],
                        'product_id' => $fetch['product_id'],
                        'product_starting_price' => $fetch['product_starting_price'],
                        'product_single_image' => $product_image,
                        'product_discount' => $fetch['product_discount'], 
                        'product_discount_price' =>$fetch['product_discount_price'] ,
                    );//array to fetch data 
                array_push($passed_query_result, $temArray);//push data to the resouce array 
            }
        return array('count'=>$selected_no_rows, 'result_array' => $passed_query_result); //return array to controller
        }
        
        else
        {
            //if no result was was there

        }

    }

    public function getRowsAffected($query)
    {
        $exec_query = mysqli_query($this->localhost, $query); 

        $num_of_rows =  mysqli_num_rows($exec_query);

        return $num_of_rows;
    }

    public function selectRecentProducts()
    {
        $recent_Result_Array = array();

        $query = "SELECT brands.brand_name, sizes.size_type,size, products.product_name,product_id,product_starting_price,product_single_image,product_discount,product_discount_price FROM products join brands on brands.brand_id=products.brand_id JOIN sizes on sizes.size_id=products.size_id ORDER BY products.created_at ASC";

        $recent_Result_Array =  $this -> getPassedQuery($query);

        // print("<pre>".print_r($recent_Result_Array,true)."</pre>");die;
        
        return $recent_Result_Array;



    }

    public function selectDiscountProducts()
    {
        $discount_products = array();

        $query = "SELECT brands.brand_name, sizes.size_type,size, products.product_name,product_id,product_starting_price,product_single_image,product_discount,product_discount_price FROM products join brands on brands.brand_id=products.brand_id JOIN sizes on sizes.size_id=products.size_id where products.product_discount > 0";

        $discount_products = $this-> getPassedQuery($query);

     

        return $discount_products;
        
    }

    public function getSingleProductImages($image_id)
    {
        $sub_image =array();
        $single_image = array();

        $query = "SELECT sub_images.p_image_name, products.product_single_image FROM sub_images JOIN products ON sub_images.product_id=products.product_id where products.product_id = $image_id LIMIT 4";

        $select =  mysqli_query($this->localhost, $query);

        $selected_no_rows1 = mysqli_num_rows($select);
        
        

        // print("<pre>".print_r($selected_no_rows1,true)."</pre>");die;


        if($selected_no_rows1 > 0)
        {
            //if a result was returned
            while($fetch = mysqli_fetch_array($select) )
            {
                $sub_image_name = $fetch['p_image_name'];
                $main_image_name = $fetch['product_single_image'];

                $sub_images = $this -> checkImageInDb(SUB_IMAGES,$sub_image_name);
                $main_image = $this -> checkImageInDb(BLOG_IMG_FOLDER, $main_image_name);

                
                $temArray = array(
                   
                    'sub_image' => $sub_images,
                    'main_image' => $main_image,
                );
                array_push($sub_image, $temArray);//push data to the resouce array   
            }
        }
        else
        {

        }
        return array('images' => $sub_image);

    }

    public function getsinglecolorflavor($product_id_for_single)
    {
        $check_in_colors = "select * from product_color_price where product_id = $product_id_for_single";
        $check_in_flavors = "select * from product_flavor_price where product_id = $product_id_for_single";

        $has_color_changing = $this->getRowsAffected($check_in_colors);
        $has_flavor_changing = $this->getRowsAffected($check_in_flavors);
        

        if($has_color_changing>0)
        {
            //have a changing color/price to the specific product
          
            $get_colors = array();
            $query =" SELECT color.color_name, color.color_id, price.price_id, price.price from color join product_color_price on color.color_id = product_color_price.color_id join price on price.price_id = product_color_price.price_id where product_color_price.product_id = $product_id_for_single";
            $get_the_colors = mysqli_query($this->localhost,$query);

            while($fetch = mysqli_fetch_array($get_the_colors) )
            {
                $temp = array(
                    'property_id_' => $fetch['color_id'],
                    'property_name'=> $fetch['color_name'],
                    'price_id'     => $fetch['price_id'],
                    'property_price' => $fetch['price'],

                );
                array_push($get_colors, $temp);
            }
            
           
            return $get_colors;


           
        }
        
        if($has_flavor_changing > 0)
        {
            //have a changing flavor/price to the specific product

            $get_colors = array();
            $query =" SELECT flavor.flavor_id, flavor.flavor_name, price.price_id, price.price from flavor join product_flavor_price on flavor.flavor_id = product_flavor_price.flavor_id join price on price.price_id = product_flavor_price.price_id where product_flavor_price.product_id = $product_id_for_single";
            $get_the_flavors = mysqli_query($this->localhost,$query);

            while($fetch = mysqli_fetch_array($get_the_flavors) )
            {
                $temp = array(
                    'property_id_' => $fetch['flavor_id'],
                    'property_name'=> $fetch['flavor_name'],
                    'price_id'     => $fetch['price_id'],
                    'property_price' => $fetch['price'],

                );
                array_push($get_colors, $temp);
            }
            
           
            return $get_colors;

            
        }




       
        
       


    }


    






    
    // public function convert_Date($date)
    // {

    //     $dt = strtotime($date);
    //     $dt = date('j\<\s\u\p\>S\<\/\s\u\p\>, F', $dt);

    //     return $dt;
    // }

    // public function fetchSubByCategory($cat)
    // {
    //     $filtered_array = array();

        

    //     $select_query = "SELECT s.award_criteria, s.deadline, s.deadline_text, s.link from submissions as s JOIN submission_category as sc on sc.categ_id = s.sub_cat_id where sc.submission = '$cat'";

    //     $select = mysqli_query($this->localhost, $select_query);

    //     $numofsubmissions = mysqli_num_rows($select);

        

    //     if($numofsubmissions > 0 )
    //     {
    //         while($fetch = mysqli_fetch_array($select))

    //             {
    //                 $event_date = $this->convert_Date($fetch['deadline']);
                    

    //                     $temArray = array
    //                     (
    //                         'award_criteria' => $fetch['award_criteria'],
    //                         // 'deadline' => $event_date,
    //                         'deadline_text' => $fetch['deadline_text'],
    //                         'link' => $fetch['link'],

                            
    //                     );//array to fetch data 

    //                 array_push($filtered_array, $temArray);//push data to the resouce array 
            
                
    //             }
    //     }

    //     return $filtered_array;
    // }

    
   




}




?>