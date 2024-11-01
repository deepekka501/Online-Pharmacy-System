<?php

include("../connection.php");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
session_start();

if(!isset($_SESSION["email"])){
    header("location:login.php");


}
$id =  $_SESSION["id"];
$pay_id=$_POST['pay_id'];

$sql="SELECT * FROM medicine 
inner join orders 
on medicine.id=orders.m_id
inner join payment
on orders.pay_id=payment.id where payment.id=$pay_id";
$resmed = $con->query($sql);
$row = $resmed->fetch_assoc();
// ==========================================get user data=================================

$sqluser="SELECT * FROM user where id=$id";
$resuser = $con->query($sqluser);
$rowuser = $resuser->fetch_assoc();

// ==========================================End of get user data=================================




// ========================================Get payment Details====================================

$sqlpay="SELECT * FROM payment where id=$pay_id";
$respay= $con->query($sqlpay);
$rowpay = $respay->fetch_assoc();

// ========================================End of Get payment Details====================================


// ====================================Get order details====================================

$sqlgetall_orders="SELECT * FROM orders 
inner join medicine
on orders.m_id=medicine.id where orders.pay_id=$pay_id";
$resallorders = $con->query($sqlgetall_orders);

// ====================================Get order details end====================================



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ONLINE PHARMACY AND MEDICINE DELIVERY SYSTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
  </head>
  <style>
    body{margin-top:20px;
background-color:#eee;
}

.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: 1rem;
}
  </style>
   <body >   

   
<div class="container-fluid">
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-15"><?php echo $row['ref_no']; ?><span class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                        <div class="mb-4">
                           <h2 class="mb-1 text-muted">ONLINE PHARMACY AND MEDICINE DELIVERY SYSTEM</h2>
                        </div>
                        <!-- <div class="text-muted">
                            <p class="mb-1">3184 Spruce Drive Pittsburgh, PA 15201</p>
                            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> xyz@987.com</p>
                            <p><i class="uil uil-phone me-1"></i> 012-345-6789</p>
                        </div> -->
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Billed To: <?php echo $rowuser['fullname'] ?></h5>
                                <h5 class="font-size-15 mb-2"><?php echo $row['cont_no'] ?></h5>
                                <p class="mb-1"><?php echo $row['address'] ,', ', $row['district'] ?></p>
                                <p class="mb-1"><?php echo $row['pincode'] ?></p>
                                <p><?php echo $row['phone'] ?></p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div>
                                    <h5 class="font-size-15 mb-1">Ref. No:</h5>
                                    <p><?php echo $row['ref_no']; ?></p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                    <p><?php echo $row['date']; ?></p>
                                </div>
                                
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    
                    <div class="py-2">
                        <h5 class="font-size-15">Order Summary</h5>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end" style="width: 120px;">Total</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    <?php 

                                    $no=1;
                                        while($rowgetorders = $resallorders->fetch_assoc()){
                                            echo '
                                            <tr>
                                            <th scope="row">'.$no.'</th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14 mb-1">'.$rowgetorders['medicine'].'</h5>
                                                    <p class="text-muted mb-0">'.$rowgetorders['description'].'</p>
                                                </div>
                                            </td>
                                            <td>Rs.'.$rowgetorders['price'].'/-</td>
                                            <td>'.$rowgetorders['qty'].'</td>
                                            ';
                                            ?>
                                            
                                            <td class="text-end"><?php echo 'Rs.'.$rowgetorders['price']*$rowgetorders['qty'].'/-' ?></td>
                                           
                                        </tr>
                                           <?php
                                            $no++;
                                        }

                                    ?>
                                   
                                    <!-- end tr -->
                                   
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                        <td class="text-end"><?php echo 'Rs.'.$row['amout'].'/-'; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">
                                            Shipping Charge :</th>
                                        <td class="border-0 text-end">Free</td>
                                        <hr>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                        <td class="border-0 text-end"><h4 class="m-0 fw-semibold"><?php echo 'Rs.'.$row['amout'].'/-'; ?></h4></td>
                                    </tr>
                                    <!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                        <div class="d-print-none mt-4">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i> print</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
</div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
     
    </body>
</html>