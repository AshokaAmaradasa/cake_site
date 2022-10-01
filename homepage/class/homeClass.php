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
                        'product_id' => $fetch['product_id'],
                        'product_name' => $fetch['product_name'],
                        'product_category' => $fetch['product_category'],
                        'product_description' => $fetch['product_description'],
                        'product_starting_price' => $fetch['product_starting_price'],
                        'product_single_image' => $product_image,
                        'product_discount' => $fetch['product_discount'],
                        'product_discount_price' => $fetch['product_discount_price'],   
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

    public function selectRecentProducts()
    {
        $recent_Result_Array = array();

        $query = "SELECT * FROM products ORDER BY product_id DESC";

        $recent_Result_Array =  $this -> getPassedQuery($query);
        
        return $recent_Result_Array;

    }

    public function selectDiscountProducts()
    {
        $discount_products = array();

        $query = "SELECT * from products where product_discount > 0";

        $discount_products = $this-> getPassedQuery($query);

        return $discount_products;
        
    }





    public function convert_Date($date)
    {

        $dt = strtotime($date);
        $dt = date('j\<\s\u\p\>S\<\/\s\u\p\>, F', $dt);

        return $dt;
    }

    public function fetchSubByCategory($cat)
    {
        $filtered_array = array();

        

        $select_query = "SELECT s.award_criteria, s.deadline, s.deadline_text, s.link from submissions as s JOIN submission_category as sc on sc.categ_id = s.sub_cat_id where sc.submission = '$cat'";

        $select = mysqli_query($this->localhost, $select_query);

        $numofsubmissions = mysqli_num_rows($select);

        

        if($numofsubmissions > 0 )
        {
            while($fetch = mysqli_fetch_array($select))

                {
                    $event_date = $this->convert_Date($fetch['deadline']);
                    

                        $temArray = array
                        (
                            'award_criteria' => $fetch['award_criteria'],
                            // 'deadline' => $event_date,
                            'deadline_text' => $fetch['deadline_text'],
                            'link' => $fetch['link'],

                            
                        );//array to fetch data 

                    array_push($filtered_array, $temArray);//push data to the resouce array 
            
                
                }
        }

        return $filtered_array;
    }

    
   




}




?>