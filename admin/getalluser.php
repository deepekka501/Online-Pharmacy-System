
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
  <style>
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
  </style>
  <body >
    <!-- Navbar Start -->
    <?php
    include("navbar.php");
    ?>
    
      <!-- Navbar End -->
     <div class="container ">
      
        <div class="row">
                  
                    <?php
                    include("../connection.php");
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    $sql = "SELECT * FROM user;";
                    $result = $con->query($sql);
                    ?>
                    
                    <table >
                    <h1 class="bg-primary text-white text-center p-2">All Users</h1>
                        <tr >
                            <th>Id</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                        <?php
                    if ($result->num_rows > 0) {
                       
                                    
                        // output data of each row
                        while($row = $result->fetch_assoc()){
                            echo "<tr>  
                                    <td>" . $row["id"]. "</td>
                                    <td>" . $row["fullname"]. "</td>
                                    <td>" . $row["email"]. "</td>
                                    <td>" . $row["phone"]. "</td>

                                </tr>";

                              //   echo "
                              //   <div class='col-sm-3 mt-2 '>

                              //   <div class='card shadow p-3 mb-5 rounded '>
                              //   <div class='card-header'>
                              //     Featured
                              //   </div>
                              //   <div class='card-body'>
                              //     <p>Id: " . $row["id"]. "</p>
                              //     <p>Name: " . $row["fullname"]. "</p>
                              //     <p>Email: " . $row["email"]. "</p>
                              //     <p>Phone: " . $row["phone"]. "</p>
                              //   </div>
                              //   <div class='card-footer text-body-secondary'>
                              //   <a href='#' class='btn btn-primary'>View</a>
                              //   <a href='#' class='btn btn-primary'>Orders</a>
                              //   <a href='#' class='btn btn-primary'>Payments</a>

                              //   </div>
                              // </div>
                              // </div>
                              //   ";
                        }
                       
                    } 
                    else {
                            echo "0 results";
                    }

                    $con->close();
                ?>
                    </table>
                    </div>
      </div>
     

      

    
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>