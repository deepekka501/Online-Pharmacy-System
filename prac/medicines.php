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
  </head>
  <body >
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand me-auto" href="#">Logo</a>
          
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Logo</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link" href="adminhome.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mx-lg-2"  href="getalluser.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="#">Orders</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mx-lg-2 active" aria-current="page" href="#">Medicines</a>
                  </li>
                  
                  
            </div>
            
          </div>
          
          <a href="../logout.php" class="login-button">Log-out</a>
          <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>
      <!-- Navbar End -->
      <div class="container-fluid pt-4" id="contantmar">
        <div class="row">
                  <h1 class="bg-primary text-white text-center p-2">All Users</h1>
                    <?php
                    include("../connection.php");
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    $sql = "SELECT * FROM user;";
                    $result = $con->query($sql);
                    ?>
                    
                    <!-- <table>
                        <tr>
                            <th>Id</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Deptarment Contact No</th> 
                        </tr> -->
                        <?php
                    if ($result->num_rows > 0) {
                        // echo "
                        //     <tr>
                        //         <th align='center'></th>
                        //         <th align='center'></th>
                        //         <th align='center'></th>
                        //         <th align='center'></th>

                        //     </tr>";
                                    
                        // output data of each row
                        while($row = $result->fetch_assoc()){
                            // echo "<tr>  
                            //         <td align='center'>" . $row["id"]. "</td>
                            //         <td align='center'>" . $row["fullname"]. "</td>
                            //         <td align='center'>" . $row["email"]. "</td>
                            //         <td align='center'>" . $row["phone"]. "</td>

                            //     </tr>";

                                echo "
                                <div class='col-sm-3 mt-2 '>

                                <div class='card shadow p-3 mb-5 rounded '>
                                <div class='card-header'>
                                  Featured
                                </div>
                                <div class='card-body'>
                                  <p>Id: " . $row["id"]. "</p>
                                  <p>Name: " . $row["fullname"]. "</p>
                                  <p>Email: " . $row["email"]. "</p>
                                  <p>Phone: " . $row["phone"]. "</p>
                                </div>
                                <div class='card-footer text-body-secondary'>
                                <a href='#' class='btn btn-primary'>View</a>
                                <a href='#' class='btn btn-primary'>Orders</a>
                                <a href='#' class='btn btn-primary'>Payments</a>

                                </div>
                              </div>
                              </div>
                                ";
                        }
                       
                    } 
                    else {
                            echo "0 results";
                    }

                    $con->close();
                ?>
                    <!-- </table> -->
                    </div>
      </div>

     

      

    
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>