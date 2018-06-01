<?php

	$con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

  $name=$_POST["name"];
  $id=$_POST["id"];

  $query = "select * from lecturer where lect_name='$name' ";
  $result = mysqli_query($con , $query);

  if (mysqli_num_rows($result)>0) //to return the query result in number of rows
  {
    die("Data already exist");
  }
  else{
    $insert_sql="INSERT INTO `lecturer`(`lect_name`, `lect_id`) VALUES ('$name','$id')";
    mysqli_query($con,$insert_sql);// or die("Error in inserting data due to

    if($insert_sql){
			echo "<script>alert('Registeration succesful')</script>";
			echo '<script>window.location = "registerlecturer.php" </script>';

		}

    else{
			echo "Error in inserting new data";
		}

  }

?>
