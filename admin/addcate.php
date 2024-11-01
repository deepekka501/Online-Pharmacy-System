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


<!--end get all medicine date   -->

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Bootstrap Admin Dashboard</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link rel="stylesheet" href="../css/loginform.css">
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->

  <?php
    include("dashborad_nav.php");
    ?>
   
  
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      
      <!-- Icon Cards-->
     
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Add Category</div>
        <div class="card-body">



        <section class="gradient-form">
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
                  of ordering, managing, and delivering medications, ensuring convenient and efficient access to 
                  pharmaceutical products for customers. </p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
        
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
      </div>
      
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Online pharmacy management System</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</body>
</html>
