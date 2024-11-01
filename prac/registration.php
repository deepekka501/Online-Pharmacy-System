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
      

    $sql="INSERT INTO `user` ( `id`,`fullname`, `email`, `password`, `phone`) VALUES ( null,'$fullname','$email','$password','$phone');";

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


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/reg.css">
</head>

<body>

  <div class="container">
   
    
  </div>


  <div class="container p-5">
    
    <form action="registration.php" method="post" class="w-50 p-5 shadow-lg p-3 mb-5 bg-body-tertiary rounded" >
      <h1>Registration Form</h1>
      <p><strong>Please Enter Your Details </strong></p>
      <div class="mb-3">
        <label for="fullname" class="form-label">Full Name</label>
        <input type="text" class="form-control" name="fullname" id="fullname" />
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" id="exampleInputEmail1" />
      </div>
      
      <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="number" class="form-control" name="phone" id="phone" />
      </div>
     
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1" />
      </div>
      <div class="mb-3">
        <label for="exampleInputcPassword1" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="cpassword" id="exampleInputcPassword1" />
      </div>
      
      <input type="submit" name="create" class="btn btn-primary" value="Sign-up">
      already have and account<a href="login.php">Login</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>