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

   





    

}
$homepageControllerObj = new homepageControllerHomeClass($localhost);
?>