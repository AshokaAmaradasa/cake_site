<?php
require_once ROOT_PATH.'homepage/class/homeClass.php';

class homepageControllerHomeClass extends homepageClassHomeClass{

    public $localhost;

    public function __construct($localhost)
    {
        $this->localhost = $localhost;
    } // Constrcut
    

    public function fetchRecentProducts()
    {
        $fetch_recent_array = array();
        $fetch_recent_array = $this->selectRecentProducts();
        return $fetch_recent_array;
    }

    public function fetchDiscountProducts()
    {
        $fetch_discount = array();
        $fetch_discount = $this->selectDiscountProducts();
        return $fetch_discount;
    }

    public function fetchSingleImages($image_id)
    {
        $fetch_images = array();
        $fetch_images = $this->getSingleProductImages($image_id);
        return $fetch_images;
    }

    public function fetchcolorflavors($pr)
    {
        $colflav = array();
        $colflav = $this->getsinglecolorflavor($pr);
        return $colflav;
    }

    public function fetchsingleproductdetails($product_id)
    {
        $single_arr = array();
        $single_arr = $this->getsingleproductdetail($product_id);
        return $single_arr;

    }

   





    

}
$homepageControllerObj = new homepageControllerHomeClass($localhost);
?>