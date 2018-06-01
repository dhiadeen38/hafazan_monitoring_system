<?php

	$con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

    $name=$_POST["id"];

    $delete_sql="DELETE FROM `user` WHERE username='$name;";
    mysqli_query($con,$delete_sql);// or die("Error in inserting data due to

    if($delete_sql){
			echo "<script>alert('Deletion succesful')</script>";
	//		echo '<script>window.location = "registeruname.php" </script>';

		}

    else{
			echo "Error in deleting data";
		}


?>
