<?php

  include('connection.php');
  if (isset($_POST['create'])) {

    echo 'User Submitted';
    $fullname   =$_POST['fullname'];
    $email      =$_POST['email'];
    $phone      =$_POST['phone'];
    $password   =$_POST['password'];
    $cpassword  =$_POST['cpassword'];


    $getdata="select * from user where email='".$_POST['email']."'";
    $getresult=mysqli_query($con,$getdata);

    $getdatar=mysqli_num_rows($getresult);
    echo $getdatar;
    if($getdatar>0){
      echo "<script>alert('User Already Exists');</script>";
    }
    else{
      

    $sql="INSERT INTO `user` ( `id`,`fullname`, `email`, `phone`, `password`) VALUES ( null,'$fullname','$email','$phone','$password');";

    $result=mysqli_query($con,$sql);
    if($result){
      header('login.php');
      echo "Hello";
      echo "<script>alert('Account Created');</script>";
      

    }
    else {
      echo "Error : ". $sql ."<br>" .mysqli_error($con);
    }

  }

  }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/loginform.css">
    <link rel="stylesheet" href="./css/nav.css">
  </head>
  <body>

 <!-- Navbar Start -->
 <?php
    include("navbar.php");
    ?>
      <!-- Navbar End -->

    

      <section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10" style="margin-top: 7vh;">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <!-- <img src="images/medicine.png"
                    style="width: 55px;" alt="logo"> -->
                  <h1 class="mt-1 mb-5 pb-1">Registration</h1>
                </div>
                

                <form action="reg.php" method="POST">


                    <!-- <h1>Registration</h1> -->
                  <p>Please enter your information</p>

                  <div class="form-outline mb-2">
                    <input type="text" id="fullname" name="fullname" class="form-control"
                      placeholder="fullname" required/>
                    <label class="form-label" for="fullname">Full Name</label>
                  </div>
                  <div class="form-outline mb-2">
                    <input type="email" id="email" name="email" class="form-control"
                      placeholder="email" required/>
                    <label class="form-label" for="email">Email</label>
                  </div>

                  <div class="form-outline mb-2">
                    <input type="number" id="phone" name="phone" class="form-control"
                      placeholder="phone" required/>
                    <label class="form-label" for="phone">Phone</label>
                  </div>

                  <div class="form-outline mb-2">
                    <input type="password" id="password" name="password" class="form-control" 
                    placeholder="password" required/>
                    <label class="form-label" for="password">Password</label>
                  </div>
                  
                  <div class="text-center pt-1 mb-3 pb-1">
                    
                      <input type="submit" name="create" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" value="Sign-in">

                   
                  </div>
                  

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Already have an account?</p>
                    <a class="btn btn-outline-danger" href="login.php">Login Now</a>
                  </div>

                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We are more than just a pharmacy</h4>
                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                  exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>