<?php
include('../connection.php');

$medicine_id = $_GET['medicine_id'];
$c_id=$_SESSION['id'];

$sql="INSERT INTO `add_to_cart` (`id`, `m_id`, `c_id`,`order_qty`,total_price) VALUES (NULL, $medicine_id, $c_id, 1,100);";

$result=mysqli_query($con,$sql);
if($result){

  echo "<script>alert('Data inserted Created');</script>";

}
else {
  echo "Error : ". $sql ."<br>" .mysqli_error($con);
}


header("location:viewmed.php?medicine_id=$medicine_id")

?>
