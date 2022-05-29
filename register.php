<?php

session_start();
include('server/connection.php');

if(isset($_SESSION['logged_in']))
{
  header('location:account.php');
  exit;

}


  if(isset($_POST['register']))
  {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];


    //check passwords doesnt match
    if($password !== $confirmPassword)
    {
      header('location: register.php?error=passwords does not match');
    }

    //password is less than 6 characters
    else if(strlen($password) < 8)
    {
      header('location: register.php?error=password must be at least 8 charachters');
    }

    //if there is no error
    else
    {
                    //check whether there is a already registered user in the system 
              $stmt1 = $conn->prepare("select count(*) from users where user_email=?");
              $stmt1->bind_param('s',$email);
              $stmt1->execute();
              $stmt1->bind_result($num_rows);
              $stmt1->store_result();
              $stmt1->fetch();

              if($num_rows != 0)
              {
                header('location: register.php?error=user already exists login with your credentials');
              }
              else
              {
                // creating a new user
                 $stmt = $conn -> prepare("insert into users (user_name,user_email,user_password)
                                           values(?,?,?)");

                  $stmt->bind_param('sss', $name, $email, md5($password));



                  //if account created successfully 
                  if($stmt->execute())
                  {
                      $user_id = $stmt->insert_id;
                      $_SESSION['user_id'] = $user_id;
                      $_SESSION['user_email'] = $email;
                      $_SESSION['user_name'] = $name;
                      $_SESSION['logged_in'] = true;
                      header('location:account.php?register_success=You have registered successfully');
              
                  }
                  //account could not be created 
                  else
                  {
                    header('location:register.php?error=could not create an account at the emoment');
                  }



              }



              

    }




  }



?>






<?php include('layouts/header.php');  ?>

<!--register-->
<section class="my-5 py-5" id="register">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight bold">Register</h2>
    <hr class="mx-auto">  
  </div>
  <div class="mx-auto container">
    <form id="register-form" method="POST" action="register.php">
      <p style="color:red;"> <?php if(isset($_GET['error'])){ echo $_GET['error'];} ?> </p>
        <div class="form-group">
        <label> Name </label>
        <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required/>
        </div>
      <div class="form-group">
        <label> Email </label>
        <input type="email" class="form-control" id="register-email" name="email" placeholder="Email" required/>
      </div>
      <div class="form-group">
        <label> Password </label>
        <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required/>
      </div>
      <div class="form-group">
        <label> Confirm Password </label>
        <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required/>
      </div>
      <div class="form-group">
        <input type="submit" class="btn" id="register-btn" name="register" value="Register"/>
      </div>
      <div class="form-group">
        <a id="login-url"  href="login.php "class="btn">Do you have an account? Login here </a>
      </div>


    </form>

  </div>
</section>











<?php include('layouts/footer.php');  ?>
 