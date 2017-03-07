<?php
	session_start();
	mysql_connect("localhost","projectt_rev","123456");
	
	mysql_select_db("projectt_revsys2");

	$strSQL = "SELECT * FROM user WHERE user like '".mysql_real_escape_string($_POST['user'])."' 
	and password = '".mysql_real_escape_string($_POST['password'])."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	
	date_default_timezone_set('Asia/Bangkok');
	$t=time();
	echo $timeNow = date ("Y-m-d H:i:s",$t);
	
        
	
	if(!$objResult || ($objResult['Status'] == 'limited'))
	{
			
			header("location:../index.php");
	}
	else
	{
			$_SESSION["UserID"] = $objResult["id"];
			$_SESSION["Username"] = $objResult["user"];
			$_SESSION["Status"] = $objResult["status"];
			$_SESSION["Name"] = $objResult["name"];
	
			$con=mysqli_connect("localhost","projectt_rev","123456","projectt_revsys2");
			// Check connection
			if (mysqli_connect_errno()) {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
                        
			else
			{
				echo $_SESSION['Name'];
				$sqlProcessMember = mysqli_query($con, "UPDATE user SET online='active' , lastLogin = '".$timeNow."' WHERE user ='".$_SESSION['Username']."'; ");
				                             		
			}
			
			
			
			session_write_close();
			header("location:../home.php?select_year=2017");
	
	}
	
	mysql_close();
	
?>