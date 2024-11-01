
<?php

include("../connection.php");
session_start();
if(!isset($_SESSION["email"])){
    header("location:../logout.php");
}
?>

<?php
include("../connection.php");
if (isset($_POST['create'])) {

  $medicine  =$_POST['medicine'];
  $desc      =$_POST['description'];
  $manufacturing_date      =$_POST['manufacturing_date'];
  $c_id      =$_POST['c_id'];
  $price      =$_POST['price'];
  $exp_date   =$_POST['expiry_date'];
  $qty        =$_POST['quantity'];

  if ($_FILES["image"]["error"]===4) {
    echo "<script> alert('Image does not exist');</script>";
  }
  else{
    $fileName=$_FILES["image"]["name"];
    $fileSize=$_FILES["image"]["size"];
    $tmpName=$_FILES["image"]["tmp_name"];

    $validImageExtension=['jpg', 'jpeg', 'png'];
    $imageExtension=explode('.',$fileName);
    $imageExtension=strtolower(end($imageExtension));

    if(!in_array($imageExtension,$validImageExtension)){
      echo "<script> alert('Invalid image Extension');</script>";
  
    }
    else if($fileSize>1000000){
      echo "<script> alert('Image size is to0 large');</script>";

    }
    else{
      $newImageName = uniqid();
      $newImageName .='.' . $imageExtension;
      // $folder = "../uploads/" . $newImageName;

      move_uploaded_file($tmpName,'../uploads/' . $newImageName);
      $query="INSERT INTO medicine VALUES(Null,'$medicine','$manufacturing_date','$newImageName','$desc','$c_id','$price','$exp_date','$qty')";

      

      mysqli_query($con,$query);
      echo "<script> alert('Successfully Added');
           
      </script>";

    }
  }

  }

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
        <li class="breadcrumb-item active">Add Medicine</li>
      </ol>
      
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Add Medicines</div>
        <div class="card-body">

        <section class="h-100 gradient-form" >
    <div class="container">
                <div class="card rounded-3 text-black">
                    <div class="card-body p-md-5">
                        <div class="text-center">
                        </div>
                        <form action="addMedicines.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <!-- <p class="text-center mb-1">Please enter medicine information</p> -->

                            <div class="mb-3">
                                <label for="medicine" class="form-label">Medicine Name</label>
                                <input type="text" id="medicine" name="medicine" class="form-control" placeholder="Medicine Name" pattern="[a-zA-Z][a-zA-Z ]{2,}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" placeholder="Description" required></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="manufacturing_date" class="form-label">Manufacturing Date</label>
                                    <input type="date" id="manufacturing_date" name="manufacturing_date" max = "<?php echo date('Y-m-d' , strtotime('-1 days')); ?>" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="expiry_date" class="form-label">Expiry Date</label>
                                    <input type="date" id="expiry_date" name="expiry_date" min = "<?php echo date('Y-m-d' , strtotime('+1 days')); ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="c_id" class="form-label">Category : </label>
                                <select class="form-select" id="c_id" name="c_id" required>
                                    <option value="">Select Category </option>
                                    <?php
                                        include("../connection.php");
                                        if ($con->connect_error) {
                                            die("Connection failed: " . $con->connect_error);
                                        }
                                        $sql = "SELECT * FROM category;";
                                        $result = $con->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()){
                                                echo "<option value='" . $row["category_id"]. "'>" . $row["category"]. "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No categories available</option>";
                                        }
                                        $con->close();
                                    ?>
                                </select>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Quantity" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" id="price" name="price" class="form-control" placeholder="Price" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="image" name="image" class="form-control" accept=".jpg, .jpeg, .png" required>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" name="create" class="btn btn-primary btn-lg btn-block">Add Medicine</button>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
</section>

        </div>
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
<script>
    let name = document.getElementById("medicine");
    name.addEventListener("input", function(e){
        name.setCustomValidity('');//remove message when new text is input
    });
    name.addEventListener("invalid", function(e){
        name.setCustomValidity('Invalid input! please enter characters');//custom validation message for invalid text
    });
</script>
</body>
</html>
