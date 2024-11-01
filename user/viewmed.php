<?php
session_start();
if(!isset($_SESSION["email"])){
    header("location:login.php");

}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/product.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
   <body >
    <!-- Navbar Start -->   
    <?php
    include("navbar.php");
    ?>

    <?php
        // wrtie here to 

    ?>
    <br>
    <section class="prob-details" >
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <div class="card shadow">

                    <?php
                        include("../connection.php");
                        $medicine_id = $_GET['medicine_id'];
                        if ($con->connect_error) {
                            die("Connection failed: " . $con->connect_error);
                        }
                        // $sql = "SELECT * FROM medicine;";
                        $sql = "SELECT * FROM medicine inner join category on  medicine.c_id=category.category_id where id=$medicine_id";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                    ?>


                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                echo "<img src='../uploads/". $row["image"]."' alt='Product Image' class='img-fluid' style='height: 50vh;'>";

                                ?>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center align-items-center " style="text-align:left;">
                                <div>
                                
                        <?php
                        
                        echo "  
                                    <h2 class='card-title'><b>Medicine:</b> ". $row["medicine"]."</h2>
                                    <p class='card-text '><b>Description:</b> ". $row["description"]."</p>
                                    <p class='card-text '><b>Availability:</b> ". $row["quantity"]."</p>
                                    <p class='card-text '><b>Category:</b> ". $row["category"]."</p>

                                    <p class='card-text '><b>Price:</b> Rs.". $row["price"]."</p>
                                    <a href='add.php?medicine_id=". $row["id"]."&price=". $row["price"]."'. class='btn btn-primary'>Add to Cart</a>
                                    
                                        
                                    ";
                                    

                    } 
                    else {
                            echo "0 results";
                    }

                    
                    ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="trending-products">
        <div class="container-fluid">
            <h2 class="bg-body p-1">Similar category product</h2>


            <div class="trending-container">

            <?php
                    include("../connection.php");
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    // $sql = "SELECT * FROM medicine;";
                    $sql = "SELECT * FROM medicine where c_id=". $row["category_id"].";";

                    // $sql = "SELECT * FROM medicine inner join category on  medicine.c_id=category.category_id where c_id=$medicine_id";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()){

                        // <a href='viewmed.php' style='color:black;'>
                        echo "  
                         <a href='viewmed.php?medicine_id=". $row["id"]."' style='color:black;'>
                        <div class='trending-card'>
                        <img src='../uploads/". $row["image"]."' alt='Product' class='img-fluid mb-3'>
                        <h3>". $row["medicine"]."</h3>
                        <p style=' white-space: nowrap; 
                        width: 200px; 
                        overflow: hidden;
                        text-overflow: ellipsis; '>". $row["description"]." </p>
                        <p class='text-muted'>Rs:". $row["price"]."</p>
                        
                         </div>
                         </a> ";
                        
                        }
                        ?>

                        <a href='viewmed.php' style='color:black; text-decoration:none;'>
                        <div class='trending-card'>
                        <img src='../images/more.png' alt='Product' class='img-fluid mb-3'>
                        <h3>View More</h3>
                     
                        <br>
                        <br>
                         </div> 
                         </a>
                         <?php
                       
                      } 
                      else {
                              echo "0 results";
                      }
  
                      $con->close();
                      
                      ?>
               
               
                <!-- Add more trending product cards as needed -->
            </div>
        </div>
    </section>


<section id="trending-products">
        <div class="container-fluid">
            <h2 class="bg-body p-1">More product</h2>


            <div class="trending-container">

            <?php
                    include("../connection.php");
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    // $sql = "SELECT * FROM medicine;";

                    // $sql = "SELECT * FROM medicine inner join category on  medicine.c_id=category.category_id where c_id=$medicine_id";

                    $sql = "SELECT * FROM medicine ORDER BY id DESC LIMIT 8;";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()){

                        // <a href='viewmed.php' style='color:black;'>
                        echo "  
                         <a href='viewmed.php?medicine_id=". $row["id"]."' style='color:black;'>
                        <div class='trending-card'>
                        <img src='../uploads/". $row["image"]."' alt='Product' class='img-fluid mb-3'>
                        <h3>". $row["medicine"]."</h3>
                        <p style=' white-space: nowrap; 
                        width: 200px; 
                        overflow: hidden;
                        text-overflow: ellipsis; '>". $row["description"]." </p>
                        <p class='text-muted'>Rs:". $row["price"]."</p>
                        
                         </div>
                         </a> ";
                        
                        }
                        ?>

                        <a href='viewmed.php' style='color:black; text-decoration:none;'>
                        <div class='trending-card'>
                        <img src='../images/more.png' alt='Product' class='img-fluid mb-3'>
                        <h3>View More</h3>
                     
                        <br>
                        <br>
                         </div> 
                         </a>
                         <?php
                       
                      } 
                      else {
                              echo "0 results";
                      }
  
                      $con->close();
                      
                      ?>
               
               
                <!-- Add more trending product cards as needed -->
            </div>
        </div>
    </section>





    <!-- Navbar  -->

    <script>
      window.history.pushState({page: 1}, "", "");
    window.onpopstate = function(event) {
        if(event){
            window.location.href = 'userhome.php';
        }
        }
    </script>

    
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
    </body>
</html>