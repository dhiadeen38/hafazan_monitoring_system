<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login.php</title>
</head>
<body>
<?php

	$con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

	$user_type=$_POST["user_type"];
	$username=$_POST["username"];

	//type-checking comparison operator is necessary
	if (strpos($username, '/') !== false) {
		//PERCENT SIGN FOUND

		$username = str_replace('/', '', $username);
	}


	$password=$_POST["password"];
	if($user_type=='student'){

		$sql="Select * FROM student where stud_id='$username' ";
		$result=mysqli_query($con,$sql);

		if(mysqli_num_rows($result)==0){
			echo "<script>alert('User does not exist')</script>";
			echo '<script>window.location = "loginpage.php" </script>';
		}
		else
		{
			$row=mysqli_fetch_array($result,MYSQLI_BOTH);
			if($row["password"]==$password)
			{
				session_start();

				$_SESSION["username"]=$username;
				header("Location: ../student/studbiodata.php");

			}

			else{
				echo "<script>alert('Password wrong')</script>";
				echo '<script>window.location = "loginpage.php" </script>';
			}
		}
	}
	if($user_type=='lecturer'){
		$sql2="Select * FROM lecturer where lect_id='$username' ";
		$result2=mysqli_query($con,$sql2);

		if(mysqli_num_rows($result2)==0){
			echo "<script>alert('User does not exist')</script>";
			echo '<script>window.location = "loginpage.php" </script>';
		}
		else
		{
			$row=mysqli_fetch_array($result2,MYSQLI_BOTH);
			if($row["password"]==$password)
			{
				session_start();

				$_SESSION["username"]=$username;
				header("Location: ../lecturer/lectbiodata.php");

			}
			else{
				echo "<script>alert('Password wrong')</script>";
				echo '<script>window.location = "loginpage.php" </script>';

			}
		}
	}
	if($user_type=='parent'){
		$sql3="Select * FROM student where ic_no='$username' ";
		$result3=mysqli_query($con,$sql3);

		if(mysqli_num_rows($result3)==0){
			echo "<script>alert('User does not exist')</script>";
			echo '<script>window.location = "loginpage.php" </script>';
		}
		else
		{
				session_start();

				$_SESSION["username"]=$username;
				header("Location: ../parent/parentrecord.php");

		}
	}
	if($user_type=='admin'){
		$sql4="Select * FROM admin where admin_id='$username' ";
		$result4=mysqli_query($con,$sql4);

		if(mysqli_num_rows($result4)==0){
			echo "<script>alert('User does not exist')</script>";
			echo '<script>window.location = "loginpage.php" </script>';
		}
		else
		{
			$row=mysqli_fetch_array($result4,MYSQLI_BOTH);
			if($row["password"]==$password)
			{
				session_start();

				$_SESSION["username"]=$username;
				$_SESSION["type"]="admin";
				header("Location: ../admin/createuser.php");

			}

			else{
				echo "<script>alert('Password wrong')</script>";
				echo '<script>window.location = "loginpage.php" </script>';

			}
		}
	}

?>

</body>
</html>
