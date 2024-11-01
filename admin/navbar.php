<div class="container-fluid shadow p-3 mb-5 bg-white">



<nav class="navbar navbar-expand-lg fixed-top" >
        <div class="container-fluid">
          <a class="navbar-brand me-auto" href="#">Logo</a>
          
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Logo</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav flex-grow-1 ps-5 ">
                <li class="nav-item">
                  <a class="nav-link " href="adminhome.php">Dashboard</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mx-lg-2" href="getalluser.php">Users</a>
                </li>

                <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Category
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="addcate.php">Add Category</a></li>
            <li><a class="dropdown-item" href="viewCategory.php">Show Category</a></li>
          </ul>
        </li>
                
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Medicines
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="addMedicines.php">Add Medicines</a></li>
            <li><a class="dropdown-item" href="viewMedicines.php">Show Medicines</a></li>
          </ul>
        </li>
                  
               
              
            </div>
          </div>
          
          

          <div class="btn-group dropstart">
  <a  class="" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
      <i class="fa fa-user-circle-o" style="font-size:35px; color:black; cursor:pointer;"></i>
  </a>



  <ul class="dropdown-menu dropdown-menu-lg-end">
    <li><button class="dropdown-item" type="button">View Profile</button></li>
    <li><a href="../logout.php" class="dropdown-item" type="button">Logout</a></li>
    
  </ul>
</div>
          <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>

      </div>