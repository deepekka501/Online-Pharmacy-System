<?php
session_start();

if(!isset($_SESSION["email"])){
    header("location:login.php");


}
$id =  $_SESSION["id"]
?>
<!-- ####################################################################################### -->

<!-- 
        Cart 1 to 1 with user unable to think -->



<!-- ####################################################################################### -->


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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
   <body >
    <!-- Navbar Start -->   
    <?php
    include("navbar.php");

                        include("../connection.php");
                        if ($con->connect_error) {
                            die("Connection failed: " . $con->connect_error);
                        }
                        // $sql = "SELECT * FROM medicine;";
                        // $sql = "SELECT * FROM medicine inner join add_to_cart on medicine.id=add_to_cart.m_id";
                        $sql="SELECT * FROM medicine 
                        inner join orders 
                        on medicine.id=orders.m_id
                        inner join payment
                        on orders.pay_id=payment.id ORDER BY `orders`.`id` DESC"
                        ;


                        $resmed = $con->query($sql);
                        if ($resmed->num_rows > 0) {
                    ?>

<div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Your Orders
                </div>
                <div class="card-body">
                    <div class="row">
                        
<?php

                    // update price and quantity

if (isset($_POST['updateprod'])) {

  $medid =$_POST['medid'];
  $updateqty  =$_POST['updateqty'];
  $price_med  =$_POST['price'];

  $sqlu="UPDATE `add_to_cart`
  SET order_qty = $updateqty, total_price= $updateqty*$price_med
  Where id=$medid;";
  $resord=mysqli_query($con,$sqlu);
  if($resord){
    
    header("location: cart.php");
  }
  else 
  {
    echo "Error : ". $sqlu ."<br>" .mysqli_error($con);
  }

}
?>
<!-- update end  -->


                    <?php

if(array_key_exists('remove',$_POST)){
    echo '<script>alert("Welcome to Geeks for Geeks")</script>'; 

}

// remove 
if (isset($_POST['removemed'])) {

    $medicine_id =$_POST['medicine_id'];
  
    $sql="Delete From add_to_cart Where id=$medicine_id;";

    $result=mysqli_query($con,$sql);
    if($result){
      
        //  echo "<script>alert('Data Deleted Successfully');</script>";
    }
    else 
    {
    //   echo "Error : ". $sqlu ."<br>" .mysqli_error($con);
    }
  
    header("location:cart.php");
  }
// remove end 

    
while($row = $resmed->fetch_assoc()){

        if($row["payment_status"]!='Successful'){
            $val='disabled';
        }
        else{
            $val='';
        }
                        echo "  
                        <div class='col-md-3' style='
                        text-align: center;
                        }'>
                            <img src='../uploads/". $row["image"]."' alt='Trending Product 1' class='img-fluid mb-3' style='height: 100px; '>
                        </div>
                        <div class='col-md-6'>
                            <div class='row'>
                            <div class='col-md-6'>
                            <h5 class='card-title'>Medicine:</b> ". $row["medicine"]."</h5>

                            <h5 class='card-title'>Quantity:</b> ". $row["qty"]."</h5>
                            <p class='card-text'>
                            </div>
                            <div class='col-md-6'>


                            <p class='card-text'><b>Date of Order :</b>". $row["date"]."</p>
                            <p class='card-text'><b>Date of Delivery :</b>". $row["status"]."</p>
                            
                            </div>
                            </div>
                        </div>

                        

                        <div class='col-md-3'>
                           
                            <form action='generate_bill.php' method='post' target='_blank'>

                            <input type='hidden'  value=". $row["pay_id"]." name='pay_id'>

                            <h5 class='card-title'>Price:</b> ". $row["price"]."</h5>
                            <p class='card-text'><b>Payment Status :</b>". $row["payment_status"]."</p>

                            <input class='btn btn-danger btn-sm' type='submit' name='receipt_download'  value='Download Receipt' $val>
                            </form>
                        </div>
                        
                        <hr>
                        "
                        
                        ;
        }


                    } 
                    else {
                       echo "0 results";
                   }
?>

                    </div>
                    <!-- Additional products can be added within similar structure -->
                </div>
        
    </div>
</div>

    <!-- Navbar  -->
   

    <?php
        // echo $_SESSION["email"]
      ?>

<!-- <a href="javascript:window.print()">Click to print</a> -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
     
    </body>
</html>