<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	session_start();
	
	if($_SESSION['Username']==NULL){
		header("location:index.php");
	}
	
	include "connect.php";
	
	$sourceName =  $_POST['sourceName'];
	$agentName =  $_POST['agentName'];
	$agentAddress =  $_POST['agentAddress'];
	
	
	$sql = "INSERT INTO `agentsource`(
			 `sourceName`,
			 `agentName`, 
			 `agentAddress`
			 )
			 
			 VALUES (
			 '$sourceName',
			 '$agentName',
			 '$agentAddress'		 
			 )";
 
		if (!mysqli_query($con,$sql)) {
		  die('Error: ' . mysqli_error($con));
		}
		
		mysqli_close($con);
		echo $checkin . " " . $checkout;
		header("location:../addAgent.php");
	
?>
</body>
</html>