<?php
session_start();
	$con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $name=$_POST["name"];
  $id=$_POST["id"];
	$syllabus=$_POST["syllabus"];

  $query = "select * from programme where programme_name='$name' ";
  $result = mysqli_query($con , $query);

  if (mysqli_num_rows($result)>0) //to return the query result in number of rows
  {
    die("Data already exist");
  }
  else{
    $insert_sql="INSERT INTO `programme`(`programme_name`, `programme_id`, `curr_syllabus`) VALUES ('$name','$id','$syllabus')";
    mysqli_query($con,$insert_sql);// or die("Error in inserting data due to

    if($insert_sql){
			$_SESSION['message']='<div class="alert alert-success alert-dismissable">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Registration succesful</strong>
			</div>';
			header("location:createuser.php ");

		}

    else{
			$_SESSION['message']='<div class="alert alert-danger alert-dismissable">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error in inserting new data</strong>
			</div>';
			header("location:createuser.php ");
		}
  }

?>
