<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	
	session_start();
	
	$user=$_SESSION["userid"];
	
	echo "Welcome $user";
	
	if(isset($user))
	{
?>
<?php		
		
	}
	
	else	
		echo "No session exist or session has expired. Please log in again";
	
?>	


</body>
</html>