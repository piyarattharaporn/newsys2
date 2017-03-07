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
	
	echo $_REQUEST['id'];
	
	$sqlDateAdd = mysqli_query($con,"SELECT `Date_add` FROM `all_data` WHERE `id` = '".$_REQUEST['id']."' ");
	while($row = mysqli_fetch_array($sqlDateAdd))
	{
		$dateAdd = $row['Date_add'];
	}
	
	$trimmed = explode(" ",$_POST['reservationDate']);
	$checkin = date( 'Y-m-d', strtotime($trimmed['0']));
	$checkout = date( 'Y-m-d', strtotime($trimmed['2']));

	$reservationCode = $_POST['resNum'];
	$Guestname = $_POST['Guestname'];
	$PaxAdult = $_POST['PaxAdult'];
	$PaxChild = $_POST['PaxChild'];
	$hotel = $_POST['hotel'];
	$roomtype = $_POST['roomtype'];
	$roomUsed = $_POST['roomUsed'];
	$night = round(abs(strtotime($trimmed['0'])-strtotime($trimmed['2']))/86400);
	$roomNight = $night*$roomUsed;
	$source = $_POST['source'];
	$agent = $_POST['agent'];
	$price = $_POST['price'];
	$totalPrice = $roomNight*$price;
	$note = $_POST['note'];
	$Breakfast = $_POST['breakfast'];
	$Payment = $_POST['payment'];
	
	$add_by = $_SESSION['Username'];
	
	
	$sql = "UPDATE `all_data` SET
	`REV` = '$reservationCode',
	`Guestname` = '$Guestname',
	`Pax_adult` = '$PaxAdult',
	`Pax_child` = '$PaxChild', 
	`Note`= '$note',
	`Arrival`= '$checkin',
	`Departure`= '$checkout',
	`Source`= '$source',
	`Agent`= '$agent',
	`Hotel`= '$hotel',
	`Room_type`= '$roomtype',
	`Room_used`= '$roomUsed',
	`Room_night`= '$roomNight',
	`Price`= '$price',
	`Total`= '$totalPrice',
	`Payment` = '$Payment',
	`Breakfast` = '$Breakfast',
	`Date_add` = '$dateAdd',
	`editBy`= '$add_by' 
	
	WHERE id = '".$_REQUEST['id']."' ";
 
		if (!mysqli_query($con,$sql)) {
		  die('Error: ' . mysqli_error($con));
		}
		
		mysqli_close($con);
		
		header("location:../editBooking.php?id=".$_REQUEST['id']." ");
	
?>
</body>
</html>