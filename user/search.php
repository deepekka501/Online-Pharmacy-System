
<?php

include("../connection.php");
if (isset($_POST["query"])) {

    $c_id = $_POST["c_id"];

    if($c_id==0){
        $query = "SELECT * FROM medicine where medicine LIKE '%".$_POST["query"]."%';";
    }
    else{
        $query = "SELECT * FROM medicine WHERE c_id=".$_POST["c_id"]." AND medicine LIKE '%".$_POST["query"]."%';";
    }
    $result = mysqli_query($con,$query);

    $output='<ul class="list-unstyled">';
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $output .='<li style="color:black; cursor:pointer;" >'.$row["medicine"].'</li>';
        }
    }
    else{

        $output .='<li style="color:black;">Medicine does not exist</li>';
    }

    $output .='</ul>';

    echo $output;
}













                      ?>