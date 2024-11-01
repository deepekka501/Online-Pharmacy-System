
<?php
session_start();
if(!isset($_SESSION["email"])){
    header("location:../logout.php");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  
  <body >
    <!-- Navbar Start -->
    <?php
    include("navbar.php");
    
    ?>
    
      <!-- Navbar End -->
     <div class="container-fluid">
      
     <section class="filter-section ">
    <div class="container-fluid  bg-body pb-3">
        <div class="row">
        
            <div class="col-md-3">
              <form action="" method="POST">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Search by medicine name..."  name="search_name" value="<?php  if(isset($_POST['search_name'])) {echo $_POST['search_name'];} ?>"  aria-label="Search">
                    <button class="btn btn-success" type="submit">
                <i class="fa fa-search" style="font-size:20px"></i></button>
                </form>

<div class="dropdown ms-2">
  <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
<i class="fa fa-filter" style="font-size:20px"></i></button>
  <ul class="dropdown-menu">
    <li></li>
    <li><a class="dropdown-item" href="#">short by Name</a></li>

    <li><a class="dropdown-item" href="#">short by Expiry Date</a></li>

    <li><a class="dropdown-item" href="#">short by Manufacturing Date</a></li>
    <li><a class="dropdown-item" href="#">From low to high</a></li>
    <li><a class="dropdown-item" href="#">From high to low</a></li>

  </ul>
</div>
                </div>
            </div>
            
        </div>
    </div>
</section>


        <div class="row ">
                  
                    <?php
                    include("../connection.php");

                    $search        =$_POST['search_name'];
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }
                    
                    if(empty($search)){
                    $sql = "SELECT * FROM medicine inner join category on medicine.c_id = category.category_id; ";
                    }
                    else{

                      $sql = "SELECT * FROM medicine inner join category on medicine.c_id = category.category_id  where medicine  LIKE '$search%'; ";
                      
                    }

                    $result = $con->query($sql);
                    ?>

                    <!-- new -->

                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                <thead>
            <tr class="text-center align-middle">
                            <th>Id</th>
                            <th>image</th>
                            <th>Medicine</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Manufacturing Date</th>
                            <th>Expiry Date</th>
                            <th>Available quantity</th>
                            <th>Price</th>
                            <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
                    if ($result->num_rows > 0) {
                       
                                    
                        // output data of each row
                        while($row = $result->fetch_assoc()){
                          echo "<tr >  
                                    <td class='text-center align-middle'>" . $row["id"]. "</td>
                                    <td class='text-center align-middle' style='height: 100px; text-align: center;' >
                                        <img src='../uploads/". $row["image"]."' alt='Trending Product 1' class='img-fluid mb-3' style='height: 100px; '>
                                    </td>
                                    <td class='text-center align-middle'>" . $row["medicine"]. "</td>
                                    <td class='text-center align-middle'>" . $row["category"]. "</td>

                                    
                                    <td class='text-center align-middle'>" . $row["description"]. "</td>

                                    <td class='text-center align-middle'>" . $row["manufacturing_date"]. "</td>
                                    <td class='text-center align-middle'>" . $row["expiry_date"]. "</td>
                                    <td class='text-center align-middle'>" . $row["quantity"]. "</td>
                                    <td class='text-center align-middle'>Rs: " . $row["price"]. "</td>
                                    <td class='text-center align-middle'>
                                        <button type='button' class='btn btn-primary'>Edit</button> 
                                        <button type='button' class='btn btn-danger'>Delete</button>
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



                    <!-- end  -->


                    </div>
      </div>
     

      

    
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>