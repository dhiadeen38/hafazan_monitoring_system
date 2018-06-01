<?php
  session_start();
	$con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $id=$_POST["id"];
  $curr_page=$_POST["curr_page"];

    $update_log="INSERT INTO `update_log`(`updated_page_memorized`,`stud_id`) VALUES ('$curr_page','$id')";
    mysqli_query($con,$update_log);// or die("Error in inserting data due to

    $update_sql="UPDATE `student` SET `page_memorized` = '$curr_page' WHERE `student`.`stud_id` = '$id'";
    mysqli_query($con,$update_sql);// or die("Error in inserting data due to



    if($update_sql && $update_log){
      $_SESSION['message']='<div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Update succesful</strong>
      </div>';
      header("location:myhalaqah.php ");

    }

    else{
      $_SESSION['message']='<div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error in updating syllabus</strong>
      </div>';
      header("location:myhalaqah.php ");
    }

?>
