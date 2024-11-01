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
if (isset($_POST['sent'])) {

    $subject_feed=$_POST['subject'];
    $message_feed=$_POST['message'];

    $sqlfeed="INSERT INTO `feedbacks` (`feedback_id`, `u_id`, `message`, `reply`, `subject`) VALUES (NULL, '$id', '$subject_feed', 'Not Yet Reply', '$message_feed');";


  $resultfeed=mysqli_query($con,$sqlfeed);
  if($resultfeed){
    echo '<script>
    swal({
    title: "Feedback sent!",
    text: "Your feedback has been sent successfully! ",
     icon: "success",
    button: "Close",
    });
    </script>';

  }
  else {
    echo "Error : ". $sql ."<br>" .mysqli_error($con);
  }

}




                        // $sql = "SELECT * FROM medicine;";
                        // $sql = "SELECT * FROM medicine inner join add_to_cart on medicine.id=add_to_cart.m_id";
                        $sql="SELECT * FROM feedbacks WHERE u_id = $id ORDER BY feedback_id DESC;;"
                        ;
                        $resmed = $con->query($sql);
                        if ($resmed->num_rows > 0) {
?>



                    <br>

                    <div class="container mt-5 bg-body p-5">
        <h2 class="text-center mb-4">Send Feedback</h2>
        <form method="POST" action="feedbacks.php">
        
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter subject">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter your message"></textarea>
                            
            </div>
            <br>
            <input type="submit" name="sent" class="btn btn-primary" value="Submit">
        </form>
    </div>

<div class="container-fluid mt-5">
            <div class="card">
                <div class="card-header">
                    Your Messgaes
                </div>
                <div class="card-body">
                    <div class="row">
                        

                    <?php



    
while($row = $resmed->fetch_assoc()){

                        echo "  
                        <div class='col-md-2' style='
                        text-align: center;
                        }'>
                       
                        </div>
                        <div class='col-md-10'>
                            <div class='row'>
                            
                            <div class='col-md-6'>
                            <p class='card-text'><b> ". $row["feedback_id"]." . Subject : ". $row["subject"]."</b></p>
                            <p class='card-text'><b>  Sent Message : ". $row["message"]."</b></p>
                            <b>Reply :</b>
                            <p class='card-text'>
                                <textarea name='' id='' cols='70' rows='5' disabled> ". $row["reply"]."</textarea>
                            </p>
                            </div>
                            </div>
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
   


     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
     
    </body>
</html>