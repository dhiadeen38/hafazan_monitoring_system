<?php
  session_start();
	$con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $curr_syllabus=$_POST["curr_syllabus"];
  $id=$_POST["id"];

    $update_sql="UPDATE `programme` SET `curr_syllabus` = '$curr_syllabus' WHERE `programme`.`programme_id` = '$id'";
    mysqli_query($con,$update_sql);// or die("Error in inserting data due to


    if($update_sql){
      $_SESSION['message']='<div class="alert alert-success alert-dismissable">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Update succesful</strong>
			</div>';
			header("location:createuser.php ");

		}

    else{
      $_SESSION['message']='<div class="alert alert-danger alert-dismissable">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error in updating syllabus</strong>
			</div>';
			header("location:createuser.php ");
		}

?>
