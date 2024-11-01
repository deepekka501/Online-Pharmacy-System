<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy - Home</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/heroes/hero-3/assets/css/hero-3.css" />
    <link rel="stylesheet" href="./css/nav.css">
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
            text-shadow: 2px 2px 2px black, 0 0 1em black, 0 0 0.2em black;
        }

        .search-bar {
            text-align: center; /* Center the search bar */
            /* margin: 20px; */
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
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 1em;
            padding: 1em;
            background-color: #fff;
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
        .trending-card img{
            height:180px;
        }

        .product-card:hover,
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
    </style>
</head>
<body>
    <header>
    <?php include("navbar.php"); ?>
    </header>
    <!-- Hero Section with Background Images -->
    <div class="hero" id="heroSection" style="background-image: url('https://via.placeholder.com/1920x600');">
        <!-- Search Bar -->
        <h1>ONLINE PHARMANCY AND MEDICINE <br>DELIVERY SYSTEM</h1>
        <p>ইয়াত দৰৱ পোৱা যায়</p>

        <div class="search-bar">
            <?php
                    include("connection.php");
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    $sql = "SELECT * FROM category;";
                    $result = $con->query($sql);
            
                    if ($result->num_rows > 0) {
                    ?>
    <select class="search-input mb-2" aria-label="Default select example">
                    <option selected>Select Medicine Category</option>
        <?php
                      while($row = $result->fetch_assoc()){

                echo "
                    <option value=".$row["category_id"].">".$row["category"]."</option>
                ";
                
                        }
            ?>
            <!-- <option value="1">aOne</option> -->
    </select>
                <?php
                      } 
                      else {
                              echo "0 results";
                      }
                      $con->close();
                      ?>

                <!-- Add more product cards as needed -->


    
            <input type="text" class="search-input mb-2" placeholder="Search for products...">
            <a href="login.php">
            <button class="search-button mb-2">Search</button>
            </a>
        </div>
        
        
 
        

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio corrupti odit illum soluta? Porro excepturi,<br> sapiente maiores similique iusto eius quos pariatur? Quos, dolore libero. Ea temporibus error voluptates fugit.</p>
    </div>
    <!-- Featured Products Section -->
    

    <!-- Trending Products Section -->
    <section id="trending-products">
        <div class="container-fluid">
            <h2>Recent Products</h2>


            <div class="trending-container">
            <?php
                    include("connection.php");
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    $sql = "SELECT * FROM medicine;";
                    $result = $con->query($sql);
            
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()){
                        echo "
                                
                        <div class='trending-card'>
                        <img src='uploads/". $row["image"]."' alt='Trending Product 1' class='img-fluid mb-3' >
                        <h3>". $row["medicine"]."</h3>
                        <p class='text-muted'>Rs:". $row["price"]."</p>
                        <button type='button' class='btn btn-primary'>Add To Cart</button>
                        
                         </div> ";
                        
                        }
                        ?><a href="login.php">
                        <div class='trending-card'>
                        <img src='images/more.png' alt='Product' class='img-fluid mb-3'>
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

    <footer class="fixed-bottom">
        <p class="text-center text-white">&copy; 2024 PHARMANCY MANAGEMENT AND MEDICINE DELIVERY SYSTEM . All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  

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
