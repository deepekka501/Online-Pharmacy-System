<?php


include("../connection.php");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
session_start();

if (!isset($_SESSION["email"])) {
    header("location:login.php");
}
$id =  $_SESSION["id"]
?>
<!-- ####################################################################################### -->




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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <!-- Navbar Start -->
    <?php
    include("navbar.php");

    // $sql = "SELECT * FROM medicine;";
    // $sql = "SELECT * FROM medicine inner join add_to_cart on medicine.id=add_to_cart.m_id";
    $sqlmed = "SELECT * FROM medicine inner join add_to_cart on medicine.id=add_to_cart.m_id ORDER BY `add_to_cart`.`id` ASC";
    $resmed = $con->query($sqlmed);
    
    ?>
    

<?php
// #################################################### remove --------------------------------------------------------------------------------------------------------------------
if (isset($_POST['removemed'])) {



    echo '<script>
      swal({
      title: "Already Added",
      text: "Medicine already added to cart",
       icon: "warning",
      button: "Close",
      });
  </script>';

    
    $medicine_id = $_POST['medicine_id'];

    
    $sqlrev = "Delete From add_to_cart Where id=$medicine_id;";

    $resultrev = mysqli_query($con, $sqlrev);
    if ($resultrev) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();

    } else {
        //   echo "Error : ". $sqlu ."<br>" .mysqli_error($con);
    }
    //header("location:cart.php");
}
//###################################################### remove end ################################################
    ?>




<?php

//############################################## update price and quantity  ##############################################

if (isset($_POST['updateprod'])) {


    $medid = $_POST['medid'];
    $updateqty  = $_POST['updateqty'];
    $price_med  = $_POST['price'];

    $sqlu = "UPDATE `add_to_cart`
    SET order_qty = $updateqty, total_price= $updateqty*$price_med
    Where id=$medid;";

    $resultu = mysqli_query($con, $sqlu);
    if ($resultu) {

        header("location: cart.php");
    } else {
        echo "Error : " . $sqlu . "<br>" . mysqli_error($con);
    }
}
?>
<!--######################################## update end  ##############################################-->




<?php
// =====================================select payment by oid========================

// ===============================end==============================


?>

        <!-- ################################ CASH ON DELEIVERY #################################### -->
        <?php

        if (isset($_POST['ordernowcod'])) {
            $address = $_POST['address'];
            $district = $_POST['district'];
            $pincode = $_POST['pincode'];
            $phone = $_POST['phone'];
            $amount= $_POST['amount'];
            
            $o_id='OID'.rand(100000000,9999999999).'END';

            $sqladd = "SELECT * FROM add_to_cart where c_id=$id";
            $resultadd = $con->query($sqladd);
            $currentDate = date('Y-m-d');

            $pay ="INSERT INTO `payment` VALUES (NULL, '$amount', '$o_id', '$currentDate','Cash on Delivery','Unpaid')";
            $pay_res = mysqli_query($con, $pay);

            if($pay_res){

              
                        $get_payment= "SELECT * FROM `payment` where `ref_no`='$o_id'";
                        $res_payment = $con->query($get_payment);
                        $pay_row = $res_payment->fetch_assoc();
                        $pay_id=  $pay_row['id'];
// ------------------------------------------------------update
                        // $medid=$row['m_id'];
                        // $get_med= "SELECT * FROM `medicine` where `id`='$medid'";
                        // $res_med = $con->query($get_med);
                        // $med_row = $res_med->fetch_assoc();
                        // $med_qty=  $med_row['quantity'];
                        // $o_qty=$row['order_qty'];
                        // $newqty=$med_qty-$o_qty;
                        // --------------------------------------------update-------------------------


            if ($resultadd->num_rows > 0) {

                while ($row = $resultadd->fetch_assoc()) {

                    // echo "$row[m_id]  $currentDate $address $district $pincode"  ;
                    $check = "INSERT INTO orders values(null,$id,'$currentDate','Processing...',$row[m_id],$row[order_qty],'$address','$district',$pincode,$phone,$pay_id)";
                    $check_res = mysqli_query($con, $check);

                    // $uppdate ="UPDATE `medicine` SET `quantity`= 100-$row[order_qty] WHERE `id` = $row[m_id]";
                    // $update_res = mysqli_query($con, $uppdate);


                }
                if ($check_res) {
                    echo '<script>
swal({
title: "Order Placed!",
text: "Your order has been placed successfully! ",
 icon: "success",
button: "Close",
});
</script>';
                }
            } else {
                echo '<script>alert("Message")</script>';
            }

                
        }else{
            echo '<script>
            swal({
            title: "did not Order Placed!",
            text: "Your order has been placed successfully!",
             icon: "success",
            button: "Close",
            });
            </script>';
        }
        }

        ?>

        <!-- ########################################### END CASH ON  DELEIVERY ############################################-->


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mt-2">
                    <div class="card">
                        <div class="card-header">
                            Your Cart
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <?php
                            if ($resmed->num_rows > 0) {
                            while ($row = $resmed->fetch_assoc()) {
                                echo "  
                        <div class='col-md-3' style='
                        text-align: center;
                        }'>
                            <img src='../uploads/" . $row["image"] . "' alt='Trending Product 1' class='img-fluid mb-3' style='height: 100px; '>
                        </div>
                        <div class='col-md-6'>
                            
                            <h5 class='card-title'>Medicine:</b> " . $row["medicine"] . "</h5>
                            <p class='card-text'><b>Price:</b> Rs." . $row["price"] . "</p>
                            <p class='card-text'>

                            <FORM ACTION='cart.php' METHOD='POST'>
                            <input type='hidden' value=" . $row["id"] . " name='medid' id=''>
                            <input type='number' min='1'  value=" . $row["order_qty"] . " name='updateqty'>
                            
                            <input type='hidden'  value=" . $row["price"] . " name='price'>

                            <input class='btn btn-success btn-sm' type='submit' name='updateprod' value='ADD'>
                            </FORM>
                            
                            </p>
                        </div>


                        <div class='col-md-3'>
                           
                            <form action='cart.php' method='post'>

                            <input type='hidden'  value=" . $row["id"] . " name='medicine_id'>


                            <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>
  Remove
</button>

<!-- Modal -->
<div class='modal fade' id='staticBackdrop' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h1 class='modal-title fs-5' id='staticBackdropLabel'>Confirm Deletion</h1>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        Are you sure you want to delete this item?
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
        <button class='btn btn-danger'  type='submit' name='removemed' value='Remove'> Confirm <i class='fa fa-trash-o' style='color:white'></i></button>
      </div>
    </div>
  </div>
</div>

                            </form>
                        </div>
                        <hr>
                        ";
                            }
                        } else {
                            echo "0 results";
                        }
                            ?>
                            <!-- ---------------------------------Pop up code for remove -->

 <!-- Button trigger modal -->


                            <!-- ---------------------------------End Pop up code for remove -->

                            </div>
                            <!-- Additional products can be added within similar structure -->
                        </div>
                    </div>
                </div>
                <?php

                $sqlc = "SELECT COUNT(id) AS `count` FROM add_to_cart WHERE c_id=$id";
                $resultc = $con->query($sqlc);
                if ($resultc->num_rows > 0) {
                    $rowc = $resultc->fetch_assoc();

                    $price = "SELECT SUM(total_price) AS `price` FROM add_to_cart inner join medicine on add_to_cart.m_id=medicine.id;";
                    $res = $con->query($price);
                    $p_row = $res->fetch_assoc();
                ?>


                    <div class="col-md-4 mt-2">
                        <div class="card w-100">
                            <div class="card-header">
                                Cart Summary
                            </div>
                            <div class="card-body">
                                <?php
                                echo "
                    <p>Total Items: " . $rowc['count'] . "</p>
                    
                    <p>Delivery charges: Free</p>
                    <p>Total Cost: Rs " . $p_row['price'] . ".00/-</p>
                        ";
                                $total_price = $p_row['price'];
                                ?>
                                <!-- <a href="#" class="btn btn-primary btn-block">Checkout</a> -->


                                <h4>Place Order</h4>

                                <hr>
                                <p>Please select your payment method</p>


                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-block w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                    <B>CASH ON DELIVERY</B>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">CASH ON DELIVERY</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="cart.php" method="post">
                                                    <P>Please enter your delivery details</P>
                                                    <div class="form-group">
                                                        <label class="form-label" for="phone">phone</label>
                                                        <input type="number" id="phone" name="phone" class="form-control" placeholder="phone" required />

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="address">address</label>
                                                        <!-- <input type="text" id="address" name="address" class="form-control" placeholder="address" required /> -->
                                                        <textarea name="address" class="form-control" id="address" cols="40" rows="2" placeholder="address" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="district">district</label>
                                                        <input type="text" id="district" name="district" class="form-control" placeholder="district" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="pincode">Pincode</label>
                                                        <input type="text" id="pincode" name="pincode" class="form-control" placeholder="Pincode" required />
                                                    </div>
                                                    <input type="hidden" name="amount" value="<?php echo $p_row['price']; ?>">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                <input type="submit" class="btn btn-primary btn-block" name="ordernowcod" value="Pay Cash on Delivery">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="text-center">OR</h4>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success btn-block w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                    <B>PAY NOW</B>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success text-white">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Pay Now</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">



                                                <?php
                                              

                                                $sqluser = "SELECT * FROM user where id=$id;";
                                                $resultuser = mysqli_query($con, $sqluser);
                                                if ($resultuser->num_rows > 0) {
                                                    $rowuser = $resultuser->fetch_assoc();
                                                }
                                                $name = $rowuser['fullname'];
                                                $email = $rowuser['email'];
                                                $phone = $rowuser['phone'];
                                                ?>


                                                <form action="payscript.php" method="post">
                                                    <!-- <div class="form-group">
                                                        <label class="form-label" for="fullname">Fullname</label>
                                                        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="" required />

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input type="email" id="email" name="email" class="form-control" placeholder="email" required />
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label class="form-label" for="phone">phone</label>
                                                        <input type="number" id="phone" name="phone" class="form-control" placeholder="phone" required />

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="address">address</label>
                                                        <!-- <input type="text" id="address" name="address" class="form-control" placeholder="address" required /> -->
                                                        <textarea name="address" class="form-control" id="address" cols="40" rows="2" placeholder="address" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="district">district</label>
                                                        <input type="text" id="district" name="district" class="form-control" placeholder="district" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="pincode">Pincode</label>
                                                        <input type="text" id="Pincode" name="pincode" class="form-control" placeholder="Pincode" required />
                                                    </div>
                                                    <?php
                                                    echo "
                                                    <input type='hidden' name='fullname' value='$name'/>
                                                    <input type='hidden'  name='email' value='$email'/>
                                                    <input type='hidden'  name='amount' value='$total_price'/>";
                                                    ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-success btn-block" value="Pay Now">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                            </div>

                        </div>

                    </div>

                <?php
                } else {
                    echo "0 results";
                ?>
                    <div class="col-md-4 mt-2">
                        <div class="card">
                            <div class="card-header">
                                Cart Summary
                            </div>
                            <div class="card-body">
                                <?php
                                echo "
                        
                    <p>Total Items: 0</p>
                    <p>Total Cost: Rs 0.0</p>
                        ";
                                ?>
                                <a href="#" class="btn btn-primary btn-block">Checkout</a>
                            </div>
                        </div>
                    </div>
                <?php

                }
                ?>
            </div>
        </div>

        <!-- Navbar  -->


        <?php
        // echo $_SESSION["email"]
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>