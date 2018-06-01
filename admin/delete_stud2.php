<?php
session_start();
$con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

$id=@$_POST["id"];

$delete_sql="DELETE FROM `student` WHERE `student`.`stud_id`='$id' ";

$result=mysqli_query($con,$delete_sql);// or die("Error in sql due to ".mysql_error());

if($result){
  $_SESSION['message']='<div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Delete succesful</strong>
  </div>';
  header("location:allrecords.php ");
}

else{
  $_SESSION['message']='<div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error in deleting data</strong>
  </div>';
  header("location:allrecords.php ");
}

?>
