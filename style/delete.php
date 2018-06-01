<?php
$con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());
$sql = "DELETE FROM student WHERE stud_id = '".$_POST["stud_id"]."'";
$result=mysqli_query($con,$sql);
 if($result)
 {
      echo 'Data Deleted';
 }
 ?>
