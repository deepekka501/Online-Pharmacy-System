<div class="container-fluid shadow p-3 mb-5 bg-white">



<nav class="navbar navbar-expand-lg fixed-top" >
        <div class="container-fluid">
          <a class="navbar-brand me-auto" href="#" > <img src="logo.jpg" width="100px" height="80px" alt="" srcset="">Pharmacy</a>
          
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Logo</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav flex-grow-1 ps-5 ">
                <li class="nav-item">
                  <a class="nav-link " href="userhome.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="order.php">Orders</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="feedbacks.php">Feedbacks</a>
                </li>
              
            </div>
          </div>
          



          <div class="btn-group dropstart">

         

 
  <a href="cart.php" class="dropdown-item" type="button"> 
    
    <i class="fa fa-shopping-cart" style="font-size:30px; color:#198754; cursor:pointer;"></i>
    <?php
                    include("../connection.php");
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    $sql = "SELECT COUNT(*) as count FROM add_to_cart;";
                    // $sql = "SELECT * FROM medicine ORDER BY id DESC LIMIT 3;";
                    $result = $con->query($sql);
            
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()){
                       
                        echo "
                        ".$row['count']."
                                        
                        ";
                        
                        }
                      }
                        ?>
</a>


</div>

<div class="btn-group dropstart">

<a  class="" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
    <!-- <i ></i> -->
    <i class="fa fa-user-circle-o ms-3"  style="font-size:35px; color:#198754; cursor:pointer;"></i>
</a>

<ul class="dropdown-menu dropdown-menu-lg-end">
  <!-- <li><button class="dropdown-item" type="button">View Profile</button></li> -->
  
  <li><a href="order.php" class="dropdown-item" type="button">My Orders</a></li>
  <li><a href="../logout.php" class="dropdown-item" type="button">Logout</a></li>
</ul>

</div>
          <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>

      </div>