<?php

$con=mysqli_connect("localhost","root","","hafazan") or die("Cannot connect to server".mysqli_error());

$idCustomer=@$_POST["idCustomer"];
$sql="DELETE FROM customer WHERE idCustomer='$idCustomer' ";
$result=mysqli_query($con,$sql) or die("Error in sql due to ".mysql_error());

if($result)
  echo "Succesfully deleted.";

else
  echo 'Error in deleting the data';

?>
