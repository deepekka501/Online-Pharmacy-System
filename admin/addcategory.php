<?php
session_start();
if(!isset($_SESSION["email"])){
    header("location:../logout.php");

}

?>
<?php

include('../connection.php');
if (isset($_POST['create'])) {

  $category   =$_POST['category'];
  $desc      =$_POST['description'];


  $getdata="select * from category where category='".$_POST['category']."'";
  $getresult=mysqli_query($con,$getdata);

  $getdatar=mysqli_num_rows($getresult);
  echo $getdatar;
  if($getdatar>0){
    echo "<script>alert('Category Type Already Exists');</script>";
  }
  else{
    

    $sql="INSERT INTO `category` (`category_id`, `category`, `description`) VALUES (NULL, '$category', '$desc');";


  $result=mysqli_query($con,$sql);
  if($result){
    header('addmedicines.php');
    echo "<script>alert('Data inserted Created');</script>";

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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../css/loginform.css">
    <!-- <link rel="stylesheet" href="../css/nav.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'><link rel="stylesheet" href="./style.css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>

 <!-- Navbar Start -->
 <?php
    include("dashborad_nav.php");
    ?>
      <!-- Navbar End -->

    

      <section class="gradient-form" style=" margin: 15vh;">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-xl-10" style="margin-top: 7vh;">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <!-- <img src="images/medicine.png"
                    style="width: 55px;" alt="logo"> -->
                  <h1 class="mt-1 mb-5 pb-1">Add Category</h1>
                </div>
                

                <form action="addcategory.php" method="POST">
                  

                    <!-- <h1>Registration</h1> -->
                  <p>Please enter category information</p>

                  <div class="form-outline mb-2">
                    <input type="text" id="category" name="category" class="form-control"
                      placeholder="category" required/>
                    <label class="form-label" for="category">Category</label>
                  </div>
                  <div class="form-outline mb-2">
                    <input type="text" id="description" name="description" class="form-control"
                      placeholder="description" required/>
                    <label class="form-label" for="description">Description</label>
                  </div>
                  <div class="text-center pt-1 mb-3 pb-1">
                      <input type="submit" name="create" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" value="Add">
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We are more than just a pharmacy</h4>
                <p class="small mb-0">
                  The online pharmacy and medicine delivery system is a comprehensive platform that streamlines the process 
                  <br> of ordering, managing, and delivering medications, ensuring convenient and efficient access to 
                  pharmaceutical products for customers. </p>


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