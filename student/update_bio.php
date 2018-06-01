<?php
  session_start();
	$con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $id=$_SESSION["username"];
  $phone_no=$_POST["phone_no"];
  $email=$_POST["email"];

    $update_sql="UPDATE `student` SET `phone_no` = '$phone_no',`email` = '$email' WHERE `student`.`stud_id` = '$id'";
    mysqli_query($con,$update_sql);// or die("Error in inserting data due to

    if($update_sql){
      $_SESSION['message']='<div class="alert alert-success alert-dismissable">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Update succesful</strong>
			</div>';
			header("location:studbiodata.php ");

		}

    else{
      $_SESSION['message']='<div class="alert alert-danger alert-dismissable">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error in updating biodata</strong>
			</div>';
			header("location:studbiodata.php ");
		}

?>
