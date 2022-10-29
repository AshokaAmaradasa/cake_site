<?php



class imagesProductImageSearchClass 
{
    public function checkImageInFolder($folder, $image)
    {
        
        $thumbnail_image = "https://via.placeholder.com/500x250/d3d3d3/FFFFFF/?text=Houseofcaketools";
        if(file_exists(ADMIN_UPLOADS_PATH.$folder.$image) && (strlen($image) > 0) ){
            $thumbnail_image = ADMIN_UPLOADS_URL.$folder.$image;
        }

        return $thumbnail_image;

    }



    public function checkImageInDb($folder,$image)
    {
       
        if ($image == '0' or $image == null ) {
            $cover = "https://via.placeholder.com/300/d3dgdd/FFFFFF/?text=house_of_cake_tools";
                
        }else{
             $cover = $this->checkImageInFolder($folder, $image);
        }

        return $cover;

        
    }




}


?>