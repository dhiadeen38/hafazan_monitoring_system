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
	$username=@$_POST["username"];
	$password=@$_POST["password"];

	$sql5="Select * FROM user where username='$username' ";
	$result=mysqli_query($con,$sql5);

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

			if($user_type=='student'){
					header("Location: ../student/studbiodata.php");
			}
			if($user_type=='lecturer'){
					header("Location: ../lecturer/lectbiodata.php");
			}
			if($user_type=='parent'){
					header("Location: ../parent/parentrecord.php");
			}
			if($user_type=='admin'){
					header("Location: ../admin/createuser.php");
			}

		}

		else
		echo "<script>alert('Password wrong')</script>";
		echo '<script>window.location = "loginpage.php" </script>';

	}

?>

</body>
</html>
