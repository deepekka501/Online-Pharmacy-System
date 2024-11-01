
<?php

session_start();
include('../connection.php');


$medicine_id = $_GET['medicine_id'];
$u_id=$_SESSION["id"];
$qty = 1;

$price = $_GET['price'];



$getdata="SELECT * FROM `add_to_cart` WHERE c_id=$u_id and m_id='$medicine_id'";
    $getresult=mysqli_query($con,$getdata);
    $getdatar=mysqli_num_rows($getresult);
    echo $getdatar;

    if($getdatar>0){
      echo "<script>alert('User Already Exists');</script>";

    }
    else{
        $sql="INSERT INTO `add_to_cart` (`id`, `m_id`, `c_id`,`order_qty`,total_price) VALUES (NULL, $medicine_id, $u_id, $qty,$price);";
        $result=mysqli_query($con,$sql);
        if($result){
            echo "<script>alert('Data inserted Created');</script>";
        }   
        else {
            echo "Error : ". $sql ."<br>" .mysqli_error($con);
        }
    }
    

// header("location:userhome.php?medicine_id=$medicine_id");
header("location:cart.php");


?>