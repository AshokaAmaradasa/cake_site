<?php 

  session_start();
  require_once '../configurations/urlconfig.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="<?php echo URL ?>assets/css/styles.css"/>
    <link rel="stylesheet" href="<?php echo URL ?>assets/css/anim.css"/>
    <link rel="stylesheet" href="<?php echo URL ?>assets/css/button.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="aos-by-red.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

   
</head>



<body>
  <!--navigation bar-->
    <nav class="navbar navbar-expand-lg navbar-light py-3 fixed-top " id="navbar" >
        <div class="container-fluid">
            <img src="<?php echo URL ?>assets/images/logo.jpg" width="5%" height="5%" style="border-radius: 50%;"/>
          <a class="navbar-brand" href="#" style="padding: 10px; color: #FAC73B;">  House of Cake Tools </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
              <li class="nav-item"> 
                <a class="nav-link" href="index.php"> Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="shop.php"> Shop</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#"> AboutUs</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#"> ContactUs </a>
              </li>
              
              <li class="nav-item">
               <a href="cart.php"><i class="fas fa-shopping-bag" aria-hidden="true"><?php if(isset($_SESSION['total_quantity']) && $_SESSION['total_quantity']!=0){ ?>
                    <span class="cart-quantity"> <?php echo $_SESSION['total_quantity']; ?></span>
              
              <?php } ?>
              </i></a> 
               <a href="account.php"><i class="fas fa-user"></i></a> 
                
              </li>
              
            </ul>
           
          </div>
        </div>
    </nav>