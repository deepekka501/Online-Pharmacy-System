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
    <script src="https://kit.fontawesome.com/f7a42ab114.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 2em 0;
            text-align: center;
        }

        .hero {
            background-size: cover;
            background-position: center;
            height: 70vh; /* Set hero section height to 50% of the viewport height */
            display: flex;
            text-align:center;
            flex-direction: column;
            justify-content: center;
            position: relative; /* Added position relative for absolute positioning */
            color:white;
        }
        .hero h1, .hero p{

          text-shadow: 2px 2px 2px black, 0 0 1em black, 0 0 0.2em black;
        }

        .search-bar {
            text-align: center; /* Center the search bar */
            margin: 20px 0;
        }

        .search-input {
            width: 80%;
            max-width: 400px;
            padding: 1em;
            border: none;
            border-radius: 5px;
            font-size: 1em;
        }

        .search-button {
            background-color: #ff6600;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 1em 2em;
            margin-top: 1em; /* Added margin-top for spacing */
            cursor: pointer;
        }

        section {
            padding: 2em;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .product-container,
        .trending-container {
            overflow-x: auto; /* Enable horizontal scrolling */
            white-space: nowrap; /* Prevent line breaks in container */
        }

        .product-card{
          display: inline-block;
            width: 150px; /* Set card width */
            /* border: 1px solid #ddd; */
            border-radius: 5px;
            margin: 1em;
            padding: 1em;
            /* background-color: #fff; */
            transition: transform 0.3s; /* Add transition for a smooth effect */
        }
        .trending-card {
            display: inline-block;
            width: 250px; /* Set card width */
            
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 1em;
            padding: 1em;
            background-color: #fff;
            transition: transform 0.3s; /* Add transition for a smooth effect */
        }


        .trending-card img{
            height:180px;
        }
        .trending-card h3{
            font-size: 20px;
        }
        .trending-card p{
            font-size: 15px;
            margin: 0px
        }

        .product-card h3{
          font-size: 15px;
        }

        .product-card img:hover,
        .trending-card:hover {
            transform: scale(1.05); /* Increase size on hover */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow on hover */
        }

        /* Media query for mobile devices */
        @media only screen and (max-width: 768px) {
            .product-container,
            .trending-container {
                overflow-x: hidden; /* Disable horizontal scrolling on mobile */
                white-space: normal; /* Allow line breaks */
                text-align: center; /* Center text for mobile */
            }

            .product-card,
            .trending-card {
                width: 90%; /* Set card width to 90% for better mobile display */
                margin: 1em auto; /* Center the card horizontally */
            }
        }
        
        .result-box ul{
          border-top:1px;
          padding:15px 10px;
          
        }
        .result-box ul li{
          list-style:none;
          border-radius:3px;
          padding:15px 10px;
        }
        .result-box ul li:hover{
          background:#e9f3ff;
        }


body{
background: #d1d5db;
}


.form{

position: relative;
}

.form .fa-search{

position: absolute;
top:20px;
left: 20px;
color: #9ca3af;

}

.form span{

    position: absolute;
right: 17px;
top: 13px;
padding: 2px;
border-left: 1px solid #d1d5db;

}

.left-pan{
padding-left: 7px;
}

.left-pan i{

padding-left: 10px;
}

.form-input{

height: 55px;
text-indent: 33px;
border-radius: 10px;
}

.form-input:focus{

box-shadow: none;
border:none;
}
    </style>
  <body >
    <!-- Navbar Start -->
   <?php
    include("navbar.php");
    ?>



<?php


if (isset($_POST['addtocart'])) {
$medicine_id = $_POST['medicine_id'];
$u_id=$_SESSION["id"];
$qty = 1;
$price = $_POST['price'];

$getdata="SELECT * FROM `add_to_cart` WHERE c_id=$u_id and m_id='$medicine_id'";
    $getresult=mysqli_query($con,$getdata);
    $getdatar=mysqli_num_rows($getresult);
    // echo $getdatar;

    if($getdatar>0){
      echo '<script>
      swal({
      title: "Already Added",
      text: "Medicine already added to cart",
       icon: "warning",
      button: "Close",
      });
  </script>';

    }
    else{
        $sql="INSERT INTO `add_to_cart` (`id`, `m_id`, `c_id`,`order_qty`,total_price) VALUES (NULL, $medicine_id, $u_id, $qty,$price);";
        $result=mysqli_query($con,$sql);
        if($result){
            echo '<script>
                                swal({
                                title: "Added To Cart",
                                text: "Your order has been placed successfully!",
                                 icon: "success",
                                button: "Close",
                                });
                            </script>';
        }   
        else {
          echo '<script>
      swal({
      title: "Someting Went Wrong",
      text: "Internal or external error occur",
       icon: "warning",
      button: "Close",
      });
  </script>';
        }
    }
  }
    
?>


    <!-- Hero Section with Background Images -->
    <div class="hero" id="heroSection" style="background-image: url('https://via.placeholder.com/1920x600');">
        <!-- Search Bar -->

        <!-- <h1>তোমাৰ আৰু মোৰ Pharmacy</h1> -->
        <h1>ONLINE PHARMANCY AND MEDICINE <BR> DELIVERY SYSTEM</h1>
        <!-- <p>ইয়াত দৰৱ পোৱা যায়</p> -->

      <?php
        // echo $_SESSION["id"];
      ?>

        <?php
        
                    include("../connection.php");
                    
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    $sql = "SELECT * FROM category;";
                    $result = $con->query($sql);
            
                    if ($result->num_rows > 0) {
        ?> 
        
        <div class="container p-md-5">
        <form action="" method="POST">
    <div class="input-group ">
    <select class="btn btn-success dropdown-toggle" data-mdb-select-init data-mdb-filter="true"  id="c_id" name="c_id">
  <option value="0">All</option>

  <?php
        while($row = $result->fetch_assoc()){
                echo "
                    <option value=".$row["category_id"].">".$row["category"]."</option>
                ";
                }
  ?>
</select>
<?php
                      } 
                      else {
                              echo "0 results";
                      }
                ?>

      <input type="text"  name="search_name" id="medicine" class="form-control p-lg-3" value="<?php  if(isset($_POST['search_name'])) {echo $_POST['search_name'];} ?>"  type="search" placeholder="Search" aria-label="Search">
      
      <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
     
    </div>
    </form>
    

    <div class="bg-body justify-content-center align-items-center w-100" ></div>
    <div class="row">
      <div class="col-3"> </div>
      <div class="col-6 bg-body"  id="medicineList" ></div>
      
      <div class="col"></div>
    </div>
   </div>


<!-- ############################################################# END SEARCH ###################################### -->
      
<!-- <P>The online pharmacy and medicine delivery system is a comprehensive platform that streamlines the process <br> of ordering, managing, and delivering medications, ensuring convenient and efficient access to pharmaceutical products for customers. -->







</P>
        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio corrupti odit illum soluta? Porro excepturi,<br> sapiente maiores similique iusto eius quos pariatur? Quos, dolore libero. Ea temporibus error voluptates fugit.</p> -->
    </div>
    
    <?php
                  $search        =$_POST['search_name'];
                  
                  if(empty($search)){
                  // $sql = "SELECT * FROM medicine inner join category on medicine.c_id = category.category_id; ";
                 
                  }
                  else{

                    $sql = "SELECT price,id, medicine.image, medicine,medicine.description,quantity,c_id,category.category,category.category_id  FROM medicine inner join category on medicine.c_id = category.category_id  where medicine  LIKE '$search%'; ";
                    
                  
                  
                  $result = $con->query($sql);
                  if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                    ?>



    
    <section class="prob-details" >
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <div class="card shadow">

                   
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

                        
                              echo"  
                                    <h2 class='card-title'><b>Medicine:</b> ". $row["medicine"]."</h2>
                                    <p class='card-text '><b>Description:</b> ". $row["description"]."</p>
                                    <p class='card-text '><b>Availability:</b> ". $row["quantity"]."</p>
                                    <p class='card-text '><b>Category:</b> ". $row["category"]."</p>

                                    <p class='card-text '><b>Price:</b> Rs.". $row["price"]."</p>

                                    <form action='userhome.php' method='POST'>
                                        <input type='hidden' name='medicine_id' value='". $row["id"]."'>
                                        <input type='hidden' name='price' value='". $row["price"]."'>
                                        <input type='submit' class='btn btn-primary' name='addtocart' value='Add to Cart'>
                                     </form> 
                                   ";
                      
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
                         <a href='viewmed.php?medicine_id=". $row["id"]."' style='color:black; text-decoration:none;'>
                        <div class='trending-card'>
                        <img src='../uploads/". $row["image"]."' alt='Product' class='img-fluid mb-3'>
                        <h3>". $row["medicine"]."</h3>
                        <p style=' white-space: nowrap; 
                        width: 150px; 
                        overflow: hidden;
                        text-overflow: ellipsis; '>". $row["description"]." </p>
                        <p class='text-muted'>Rs:". $row["price"]."</p>
                        
                                    <a href='add.php?medicine_id=". $row["id"]."&price=". $row["price"]."'. class='btn btn-primary'>Add to Cart</a>
                                        
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
                      
                      ?>
               
               
                <!-- Add more trending product cards as needed -->
            </div>
        </div>
    </section>


<?php
                                    
                                  }
                     
                                }
                                
            
                            ?>

                  <!-- end  -->


                  </div>
    </div>
   

    <!-- Featured Products Section -->
    <!-- <section id="featured-products">
        <div class="container-fluid ">
            <h2>Shop By Category</h2>

            <div class="product-container">

                <div class="product-card">
                    <img src="https://via.placeholder.com/300" alt="Product 1" class="img-fluid mb-3">
                    <h3>Product 1</h3>
                </div>

              
            </div>
        </div>
    </section> -->

    <!-- Trending Products Section -->




    <section id="trending-products">
        <div class="container-fluid">
            <h2>New Launches</h2>


            <div class="trending-container">

            <?php
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    // $sql = "SELECT * FROM medicine;";
                    $sql = "SELECT * FROM medicine ORDER BY id DESC LIMIT 8;";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()){

                        // <a href='viewmed.php' style='color:black;'>
                        echo "  
                         <a href='viewmed.php?medicine_id=". $row["id"]."&qty=$qty' style='color:black; text-decoration:none;'>
                        <div class='trending-card '>
                        <img src='../uploads/". $row["image"]."' alt='Product' class='img-fluid mb-3'>
                        <h3>". $row["medicine"]."</h3>
                        <p class='text-muted'>Rs:". $row["price"]."</p>
                        
                        <a href='add.php?medicine_id=". $row["id"]."&price=". $row["price"]."'. class='btn btn-primary'>Add to Cart</a>

                                        
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


    <!-- Trending Products Section -->
    <section id="trending-products">
        <div class="container-fluid">
            <h2>Products</h2>


            <div class="trending-container">

            <?php
                    include("../connection.php");
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    $sql = "SELECT * FROM medicine ORDER BY id ASC LIMIT 10;";
                    // $sql = "SELECT * FROM medicine ORDER BY id DESC LIMIT 3;";
                    $result = $con->query($sql);
            
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()){
                        echo "
                                
                         <a href='viewmed.php?medicine_id=". $row["id"]."'  style='color:black; text-decoration:none'>
                        <div class='trending-card'>
                        <img src='../uploads/". $row["image"]."' alt='Trending Product 1' class='img-fluid mb-3'>
                        <h3>". $row["medicine"]."</h3>
                        <p class='text-muted'>Rs:". $row["price"]."</p>

                        <a href='add.php?medicine_id=". $row["id"]."&price=". $row["price"]."'. class='btn btn-primary'>Add to Cart</a>

                                        
                        </div> 
                        </a>";
                        
                        }
                        ?>

                      <a href='viewmed.php' style='color:black; text-decoration:none'>
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


      

    <script>
      
      window.history.pushState({page: 1}, "", "");
        window.onpopstate = function(event) {
        if(event){
            window.location.href = 'userhome.php';
        }
        }
    </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  

     
     <script>
  $(document).ready(function(){


    $('#medicine').keyup(function(){
      var query=$(this).val();
      var c_id=$('#c_id').val();
      if(query!=''){
        $.ajax({
          url:"search.php",
          method:"POST",
          //pass to varibale id here to search for select query c_id and search medicine
          data:{query:query,c_id:c_id},
          success:function(data){
            $('#medicineList').fadeIn();
            $('#medicineList').html(data);
          }
        });
      }
      else{
        $('#medicineList').fadeOut();
        $('#medicineList').html("");
      }
    });
    $(document).on('click','li',function(){
      $('#medicine').val($(this).text());
      $('#medicineList').fadeOut();
    });
  });

</script>


     <script>
        // JavaScript for changing the hero section background dynamically
        // You can add more images to the array as needed
        const backgroundImages = [
            'https://images.unsplash.com/photo-1586015555751-63bb77f4322a?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8cGhhcm1hY3l8ZW58MHx8MHx8fDA%3D',
            'https://images.unsplash.com/photo-1622230208995-0f26eba75875?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHBoYXJtYWN5fGVufDB8fDB8fHww',
            'https://plus.unsplash.com/premium_photo-1682130065973-b4ef09850c61?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fHBoYXJtYWN5fGVufDB8fDB8fHww'
            // Add more image URLs here
        ];

        function changeBackground() {
            const randomIndex = Math.floor(Math.random() * backgroundImages.length);
            const randomImage = backgroundImages[randomIndex];
            document.getElementById('heroSection').style.backgroundImage = `url('${randomImage}')`;
        }

        // Call the function initially
        changeBackground();

        // Set interval to change background every 5 seconds (5000 milliseconds)
        setInterval(changeBackground, 3000);
    </script>
   
  
  
    </body>
</html>