<?php
include('connect.php');
if($_POST['id'])
{
$id=$_POST['id'];
$sql=mysqli_query($con,"select * from agentsource where sourceName ='".$id."' ORDER BY `agentName` ASC ");
	while($row=mysqli_fetch_array($sql))
	{
		$id=$row['agentName'];
		$data=$row['agentName'];
		echo '<option value="'.$id.'">'.$data.'</option>';
	}
	echo "<option value='%'>All</option>";
}
?>