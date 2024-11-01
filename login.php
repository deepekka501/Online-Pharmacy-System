<?php
    include("connection.php");
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"]=="POST") {

        $email=$_POST["email"];
        $password=$_POST["password"];

        $sql="select * from user where email='".$email."' AND password='".$password."';";

        $result=mysqli_query($con,$sql);

        if(mysqli_num_rows($result)>0){
          $row=mysqli_fetch_array($result);

          if ($row["usertype"]=="user") {
            
            $price="SELECT * FROM user;";
            $res = $con->query($price);
            $p_row = $res->fetch_assoc();

            

            $_SESSION["id"]=$p_row["id"];
            // echo "user";
            $_SESSION["email"]=$email;
            


            header("location: user/userhome.php");
          }
          elseif ($row["usertype"]=="admin") {
            // echo "admin";
            $_SESSION["email"]=$email;

            header("location: admin/adminindex.php");
          }
        }
        else{
          $error[] = 'incorrect email or password!';
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
                  <h1 class="mt-1 mb-5 pb-1">Login</h1>
                  
                </div>
                

                <form action="#" method="POST">
                  

                    <?php
                        
                        
                        // if($result){
                        //   echo "<div class='alert alert-danger' role='alert'>
                        //   email / Password doesn't invalid!
                        // </div>";

                        // }
                        
                        if(isset($error)){
                          foreach($error as $error){
                             echo '<span class="error-msg">'.$error.'</span>';
                            //  echo "<div class='alert alert-danger' role='alert'>";
                          };
                       };
                        

                    ?>


                  <p>Please login to your account</p>

                  <div class="form-outline mb-4">
                    <input type="email" id="username" name="email" class="form-control"
                      placeholder="username" required/>
                    <label class="form-label" for="username">Username</label>
                  </div>

                  <div class="form-outline mb-2">
                    <input type="password" id="password" name="password" class="form-control" 
                    placeholder="password" required/>
                    <label class="form-label" for="password">Password</label>
                    
                  </div>
                  <div class="form-outline mb-2">
                      <!-- <a class="text-muted " href="#!">Forgot password?</a> -->
                </div>
                  <div class="text-center pt-1 mb-3 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Log
                      in</button>
                   
                  </div>
                  

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <a class="btn btn-outline-danger" href="reg.php">Create new</a>
                  </div>

                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We are more than just a pharmacy</h4>
                <p class="small mb-0">The online pharmacy and medicine delivery system is a comprehensive platform that streamlines the process 
                  of ordering, managing, and delivering medications, ensuring convenient and efficient access to 
                  pharmaceutical products for customers.</p>
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
