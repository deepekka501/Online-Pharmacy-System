
<?php


include("../connection.php");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
session_start();

$id =  $_SESSION["id"];
// Payment
        $fullname= $_POST['fullname'];
        $oid=$_POST['o_id'];;
        $date= $_POST['date'];
        $amount= $_POST['amount'];

// order 
        $address = $_POST['address'];
        $district = $_POST['district'];
        $pincode = $_POST['pincode'];
        $phone = $_POST['phone'];
        echo $amount;
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
    <link rel="stylesheet" href="../css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

<?php
if (isset($oid)) {
    // $check = "INSERT INTO payment values(null,1,22,$date)";
    $pay ="INSERT INTO `payment` VALUES (NULL, '$amount', '$oid', '$date','Online','Successful')";
    $pay_res = mysqli_query($con, $pay);
    // echo "it worked";
    if($pay_res){
        
        $get_payment= "SELECT * FROM `payment` where `ref_no`='$oid'";
        $res_payment = $con->query($get_payment);
        $pay_row = $res_payment->fetch_assoc();


        

        if (isset($address)) {

            $sql = "SELECT * FROM add_to_cart where c_id=$id";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // echo "$row[m_id]  $currentDate $address $district $pincode"  ;
                    $check = "INSERT INTO orders values(null,$id,'$date','Processing...',$row[m_id],$row[order_qty],'$address','$district',$pincode,$phone,$pay_row[id])";
                    $check_res = mysqli_query($con, $check);

                    // $uppdate ="UPDATE `medicine` SET `quantity`= $row[quatity]-$row[order_qty] WHERE `medicine`.`id` = $row[m_id]";
                    // $update_res = mysqli_query($con, $uppdate);


                }
                if ($check_res) {
                    // echo 'it worked';
                    
                header("location:cart.php");
                }
                else{
                    echo 'did not work';
                }
            } else {
                echo '<script>alert("Message")</script>';
            }
        }
    }
    else{
        echo 'did t work';
    }
}
else{
    echo "wont work";
}


?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>