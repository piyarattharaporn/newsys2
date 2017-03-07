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
	
	
	$sql = "INSERT INTO `all_data`(
			 `REV`, 
			 `GuestName`,
			 `Pax_adult`,
			 `Pax_child`,
			 `Note`, 
			 `Arrival`, 
			 `Departure`, 
			 `Source`, 
			 `Agent`, 
			 `Hotel`, 
			 `Room_type`, 
			 `Room_used`, 
			 `Room_night`, 
			 `Price`, 
			 `Total`,
			 `Breakfast`,
			 `Payment`,
			 `Add_by`
			 )
			 
			 VALUES (
			 '$reservationCode',
			 '$Guestname',
			 '$PaxAdult',
			 '$PaxChild',
			 '$note',
			 '$checkin',
			 '$checkout',			 
			 '$source',
			 '$agent',			 
			 '$hotel',
			 '$roomtype',			 
			 '$roomUsed',
			 '$roomNight',			 
			 '$price',
			 '$totalPrice',
			 '$Breakfast',
			 '$Payment',
			 '$add_by'			 
			 )";
 
		if (!mysqli_query($con,$sql)) {
		  die('Error: ' . mysqli_error($con));
		}
		
		mysqli_close($con);
		
		/*echo "night = ".round(abs(strtotime($trimmed['0'])-strtotime($trimmed['2']))/86400)." <br /> " ;
		echo "Room Used = ".$roomUsed ." <br /> " ;
		echo "Room night = ".$roomNight ." <br /> " ;
		echo "Price = ".$price ." <br /> " ;
		echo "Total Price = ".$totalPrice ." <br /> " ;*/
		
		header("location:../addBooking.php");
	
?>
</body>
</html>