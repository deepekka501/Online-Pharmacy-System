
<?php

include("../connection.php");
session_start();
if(!isset($_SESSION["email"])){
    header("location:../logout.php");
}


?>
<?php
$sqlc = "SELECT COUNT(id) AS `count` FROM medicine";
$resultc = $con->query($sqlc);
if ($resultc->num_rows > 0) {
    $rowc = $resultc->fetch_assoc();
    $medicineCount = $rowc['count']; // Extract the count value
} else {
    echo "No data found in the medicine table."; // Handle no results scenario
}
?>

<!-- Count orders -->
<?php
$sqlc = "SELECT COUNT(id) AS `count` FROM orders;";
$resulto = $con->query($sqlc);

if ($resulto->num_rows > 0) {
    $rowo = $resulto->fetch_assoc();
    $ordersCount = $rowo['count']; // Extract the count value
} else {
    echo "No data found in the medicine table."; // Handle no results scenario
}
?>

<!-- total amout payd -->

<?php
$sqlpay = "SELECT SUM(amout) AS `count` FROM payment;";
$resulpay = $con->query($sqlpay);
if ($resulpay->num_rows > 0) {
    $rowpay = $resulpay->fetch_assoc();
    $payCount = $rowpay['count']; // Extract the count value
} else {
    echo "No data found in the medicine table."; // Handle no results scenario
}
?>

<!-- total amout payd -->
<?php
$sqlu = "SELECT COUNT(id) AS `count` FROM user where usertype='user';";
$resultu = $con->query($sqlu);
if ($resultu->num_rows > 0) {
    $rowu = $resultu->fetch_assoc();
    $userCount = $rowu['count']; // Extract the count value
} else {
    echo "No data found in the medicine table."; // Handle no results scenario
}
?>
<?php
      $sqlgetMed = "SELECT * FROM medicine join category on medicine.c_id = category.category_id; ; ";
      $resgetMed = $con->query($sqlgetMed);
?>

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
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white o-hidden h-100 " style="background-color: #343a40;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-plus"></i>
              </div>

              
              <div class="mr-5  ">  Total Medicine : <h4> <?php echo  $medicineCount;?></h4></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white o-hidden h-100" style="background-color: #343a40;">
            <div class="card-body">
              <div class="card-body-icon">
              <i class="fa fa-fw fa-shopping-cart"></i>
               
              </div>
              <div class="mr-5">Total Orders : <h4><?php echo  $ordersCount;?></h4></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white o-hidden h-100" style="background-color: #343a40;">
            <div class="card-body">
              <div class="card-body-icon">
              <i class="fa fa-fw fa-rupee"></i>
              </div>
              <div class="mr-5"> Total Payment Received :<h4>  <?php echo $payCount; ?> </h4></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white o-hidden h-100" style="background-color: #343a40;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user"></i>
              </div>
              <div class="mr-5">Total Users : <h4><?php echo $userCount; ?></h4></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header"  style="background-color: #343a40; color:white">
          <i class="fa fa-area-chart"></i> Medicine Details</div>
        <div class="card-body">

        <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                <thead>
            <tr class="text-center align-middle">
                            <th>Id</th>
                            <th>Medicine</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Manufacturing Date</th>
                            <th>Expiry Date</th>
                            <th>Available quantity</th>
                            <th>Price</th>
            </tr>
        </thead>
        <tbody>
        <?php
                    if ($resgetMed->num_rows > 0) {
                       
                                    
                        // output data of each row
                        while($rowgetMess = $resgetMed->fetch_assoc()){
                          echo "<tr >  
                                    <td class='text-center align-middle'>" . $rowgetMess["id"]. "</td>
                                   
                                    <td class='text-center align-middle'>" . $rowgetMess["medicine"]. "</td>
                                    <td class='text-center align-middle'>" . $rowgetMess["category"]. "</td>

                                    
                                    <td class='text-center align-middle'>" . $rowgetMess["description"]. "</td>

                                    <td class='text-center align-middle'>" . $rowgetMess["manufacturing_date"]. "</td>
                                    <td class='text-center align-middle'>" . $rowgetMess["expiry_date"]. "</td>
                                    <td class='text-center align-middle'>" . $rowgetMess["quantity"]. "</td>
                                    <td class='text-center align-middle'>Rs: " . $rowgetMess["price"]. "</td>
                                    
            

                                </tr>";
                              }
                       
                            } 
                            else {
                                    echo "0 results";
                            }
        
                            $con->close();
                        ?>
            <!-- More rows here -->
        </tbody>
    </table>
    </div>
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
      </div>
      
      
      <!-- Example DataTables Card-->
      
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2017</small>
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
