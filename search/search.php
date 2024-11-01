
<?php

include("../connection.php");
if (isset($_POST["query"])) {

    $c_id = $_GET['c_id'];
    $query = "SELECT * FROM medicine WHERE c_id=".$_POST["c_id"]." AND medicine LIKE '%".$_POST["query"]."%';";
    $result = mysqli_query($con,$query);

    $output='<ul class="list-unstyled">';
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            $output .='<li>'.$row["medicine"].'</li>';
        }
    }
    else{

        $output .='<li>Medicine does not exist</li>';
    }

    $output .='</ul>';

    echo $output;
}













                      ?>