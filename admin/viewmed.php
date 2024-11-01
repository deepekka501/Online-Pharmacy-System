
<?php

include("../connection.php");
session_start();
if(!isset($_SESSION["email"])){
    header("location:../logout.php");
}


?>

<!-- get all medicine date   -->
<?php
      $sqlgetMed = "SELECT * FROM medicine join category on medicine.c_id = category.category_id; ; ";
      $resgetMed = $con->query($sqlgetMed);

if (isset($_POST['updatemed'])) {

    
    $medid=$_POST['med_id'];
    $medqty=$_POST['med_qty'];


    $updateSql="UPDATE `medicine` SET `quantity` = '$medqty' WHERE `medicine`.`id` = '$medid';";
    $resultu = mysqli_query($con, $updateSql);
    if ($resultu) {

        header("location: viewmed.php");
    } else {
        echo "Error : " . $sqlu . "<br>" . mysqli_error($con);
    }
    # code...
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
        <li class="breadcrumb-item active">View Medicine</li>
      </ol>
      <!-- Icon Cards-->
     
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> All Medicine</div>
        <div class="card-body">

        <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                <thead>
            <tr class="text-center align-middle" style="background-color: #343a40; color:white">
                            <th>Id</th>
                            <th>Image</th>

                            <th>Medicine</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Manufacturing Date</th>
                            <th>Expiry Date</th>
                            <th>Available quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                            <th>Update</th>


            </tr>
        </thead>
        <tbody>
        <?php
                    if ($resgetMed->num_rows > 0) {
                       
                                    
                        // output data of each row
                        while($rowgetMess = $resgetMed->fetch_assoc()){
                          echo "<tr >  
                                    <td class='text-center align-middle'>" . $rowgetMess["id"]. "</td>
                                    <td class='text-center align-middle' style='height: 100px; text-align: center;' >
                                    <img src='../uploads/". $rowgetMess["image"]."' alt='Trending Product 1' class='img-fluid mb-3' style='height: 100px; '>
                                </td>
                                    <td class='text-center align-middle'>" . $rowgetMess["medicine"]. "</td>
                                    <td class='text-center align-middle'>" . $rowgetMess["category"]. "</td>

                                    
                                    <td class='text-center align-middle'>" . $rowgetMess["description"]. "</td>

                                    <td class='text-center align-middle'>" . $rowgetMess["manufacturing_date"]. "</td>
                                    <td class='text-center align-middle'>" . $rowgetMess["expiry_date"]. "</td>
                                    <td class='text-center align-middle'>" . $rowgetMess["quantity"]. "</td>
                                    <td class='text-center align-middle'>Rs: " . $rowgetMess["price"]. "</td>

                                    <form method='POST' action=''>
                                    <td class='text-center align-middle'>
                                    <input type='hidden' name='med_id' value=" . $rowgetMess["id"]. ">
                                    <input type='number' name='med_qty'  min='1' value=" . $rowgetMess["quantity"]. ">

                                    <input type='submit' name='updatemed' class='btn btn-primary mt-1' value='Add'>

                                    </form>

                                    <form method='POST' action='updatemed.php'>
                                    <td class='text-center align-middle'>
                                    <input type='hidden' name='meds_id' value=" . $rowgetMess["id"]. ">

                                    <input type='submit' name='updatemed' class='btn btn-primary mt-1' value='Update'>

                                    </form>
                                </td> 
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
