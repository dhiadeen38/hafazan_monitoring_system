<?php

	session_start();
	$type=$_SESSION["type"];
	if(isset($_SESSION["username"]))
	{

		if ($type=="admin") {
			session_destroy();
			echo "You have have successfully logged out";
			header("Location: ../homepage/admin/loginpage.php");
		}
		else {
			session_destroy();
			echo "You have have successfully logged out";
			header("Location: ../homepage/loginpage.php");
		}

	}

	else{
		echo "No session exist or session is expired. Please log in again";
		header("Location: ../homepage/loginpage.php");
	}

?>
