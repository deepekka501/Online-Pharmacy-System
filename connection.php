<?php

$servername ="localhost";
$username ="root";
$password ="";
$dbname ="pharmacy";



    $con = mysqli_connect($servername,$username,$password,$dbname);

    if(!$con){
        die("Connection to this database faild due to".mysqli_connect_error());
    }
    // else {
    //     echo "connected";
    // }

?>