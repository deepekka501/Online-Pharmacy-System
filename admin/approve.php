
<?php

include("../connection.php");
session_start();
if(!isset($_SESSION["email"])){
    header("location:../logout.php");
}


$o_id=$_POST['o_id'];
?>

<!-- ----------------------------------- Replyy  -->
<?php
       $sql="SELECT * from orders where id=$o_id";
       $resmed = $con->query($sql);
       $rowgetMess = $resmed->fetch_assoc();
?>

<?php
if (isset($_POST['update_order'])) {

    $order_id=$_POST['id_order'];

    $order_status=$_POST['statuss'];

    $sqlreply="UPDATE `orders` SET `status` = '$order_status' WHERE `orders`.`id` =  '$order_id';";

    $resultfeedss=mysqli_query($con,$sqlreply);

  header("location: vieworders.php");
  if($resultfeedss){
  }
  else {
    echo "Error : ". $sqlreply ."<br>" .mysqli_error($con);
  }

}
?>
<!-- ----------------------------------- Replyy  end-->




<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Bootstrap Admin Dashboard</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        <li class="breadcrumb-item active">Delivery Status</li>
      </ol>
      
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i>Delivery Status</div>
        <div class="card-body">

        <div class="table-responsive">
        <div class="container bg-body p-5">
        <h2 class="text-center mb-4">Delivery Status</h2>
        



        <form action="" method="POST">
        <div class='mb-3'>
                <input type='hidden' class='form-control'  value='<?php echo $o_id ?>' name='id_order' >
                
              </div>
              <div class='mb-3'>
                <label for='status' class='form-label'>Delivery Status</label>
                <select class='form-select' id='status' name='statuss' required>
                <option value='' selected disabled><?php echo $rowgetMess['status']; ?></option>
                <option value='Delivered'>Delivered</option>
                <option value='Not Delivered'>Not Delivered</option>

                </select>
                </div>
            <!-- <div class='mb-3'>
            <label for='date' class='form-label'>Delivery Date</label>
            <input type='date' class='form-control' name='delivery_date' id='date' min = ".date('Y-m-d' , strtotime('+1 days'))."  required>
            </div> -->
                <!-- <input type='submit' name='update_order' class='btn btn-primary' > -->

                <input type="submit" name="update_order" class="btn btn-primary" value="Submit">
                
            </form>
    </div>
        </div>
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
      </div>
      
    </div>
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
