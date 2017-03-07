<?php
include('connect.php');
if($_POST['id'])
{
$id=$_POST['id'];
$sql=mysqli_query($con,"select * from hotelroomtype where hotelName ='".$id."'");
	while($row=mysqli_fetch_array($sql))
	{
		$id=$row['roomtypeName'];
		$data=$row['roomtypeName'];
		echo '<option value="'.$id.'">'.$data.'</option>';
	}
}
?>