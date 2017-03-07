<?php
	include "connect.php";
	session_start();
	

	echo $_SESSION["Username"]."<br>";
	$name = $_SESSION["Username"];
	
	$sqlProcessMember = mysqli_query($con, "UPDATE user SET online='deactive' WHERE user ='".$_SESSION['Username']."'; "); 
	
	if (mysqli_query($con, $sqlProcessMember)) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . mysqli_error($con);
	}
	
	mysqli_close($con);
	session_destroy();
	
	header("location:../index.php");
?>