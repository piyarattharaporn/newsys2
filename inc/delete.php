<?php
session_start();
include('connect.php');

	$result = mysqli_query($con,"SELECT * FROM `all_data` WHERE `id` = ".$_REQUEST['id']." ");
	while($row = mysqli_fetch_array($result))
	{
		$reservationCode = $row['REV'];
                $Guestname = $row['GuestName'];
		$note = $row['Note'];
		$checkin = $row['Arrival'];
		$checkout = $row['Departure'];
		$hotel = $row['Hotel'];
		$roomtype = $row['Room_type'];
		$roomUsed = $row['Room_used'];
		$roomNight = $row['Room_night'];
		$source = $row['Source'];
		$agent = $row['Agent'];
		$price = $row['Price'];
		$totalPrice = $row['Total'];
		$add_by = $_SESSION['Username'];
	
	
	$sql = "INSERT INTO `delete_data`(
			 `REV`,
                         `GuestName`,
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
			 `Add_by`
			 )
			 
			 VALUES (
			 '$reservationCode',
                         '$Guestname',
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
			 '$add_by'			 
			 )";
 
		if (!mysqli_query($con,$sql)) {
		  die('Error: ' . mysqli_error($con));
		}
		else
			mysqli_query($con,"DELETE FROM `all_data` WHERE `all_data`.`id` ='".$_REQUEST['id']."'");
			//echo "Sucess Op";
			header("location:../viewBooking.php");
	}
	
	
	
	mysqli_close($con);
	 
    
?>