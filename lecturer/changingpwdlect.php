<?php
  session_start();
	$con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $name=$_SESSION["username"];
  $curr_pwd=$_POST["curr_pwd"];
  $new_pwd=$_POST["new_pwd"];
  $new_pwd2=$_POST["new_pwd2"];

  $query = "select password from lecturer where lect_id='$name' ";
  $result = mysqli_query($con , $query);

  $row=mysqli_fetch_row($result);
  $data_pwd=$row[0];

  if ($data_pwd==$curr_pwd) {
    if ($new_pwd==$new_pwd2) {
      $changepwd_sql="UPDATE `lecturer` SET `password` = '$new_pwd' WHERE `lecturer`.`lect_id` = '$name'";
      mysqli_query($con,$changepwd_sql);// or die("Error in inserting data due to

      if($changepwd_sql){
        $_SESSION['message']='<div class="alert alert-success alert-dismissable">
  			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			  <strong>Changing password succesful</strong>
  			</div>';
  			header("location:changepwdlect.php ");

  		}

      else{
        $_SESSION['message']='<div class="alert alert-danger alert-dismissable">
  			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			  <strong>Error in updating password</strong>
  			</div>';
  			header("location:changepwdlect.php ");

  		}
    }
    else {
      $_SESSION['message']='<div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Your password is not match</strong>
      </div>';
      header("location:changepwdlect.php ");
    }
  }
  else {
    $_SESSION['message']='<div class="alert alert-danger alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Wrong password</strong>
    </div>';
    header("location:changepwdlect.php ");
  }


?>
