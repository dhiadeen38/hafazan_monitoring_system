<?php
  session_start();
	$con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $name=$_POST["name"];
  $halaqah=$_POST["halaqah"];
  $id=$_POST["id"];

  $update_sql="UPDATE `student` SET `stud_name` = '$name',`stud_id` = '$id' WHERE `student`.`stud_id` = '$id'";
  mysqli_query($con,$update_sql);// or die("Error in inserting data due to

  if($update_sql){
    $_SESSION['message']='<div class="alert alert-success alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Update succesful</strong>
    </div>';
    header("location:allrecords.php ");

  }

  else{
    $_SESSION['message']='<div class="alert alert-danger alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error in updating syllabus</strong>
    </div>';
    header("location:allrecords.php ");
  }

?>
