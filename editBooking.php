<!DOCTYPE html>
<?php
    session_start();
  	include "inc/connect.php";
	
  	if($_SESSION['Username']==NULL){
		
		$sqlProcessMember = mysqli_query($con, "UPDATE user SET online='deactive' WHERE user ='".$_SESSION['Username']."'; "); 
	
		if (mysqli_query($con, $sqlProcessMember)) {
			echo "Record deleted successfully";
		} else {
			echo "Error deleting record: " . mysqli_error($con);
		}
	
    header("location:index.php");
	}
  
  $t = time();
?>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php include "inc/pageConfig.php"; echo $page_title; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function()
		{
		$(".hotel").change(function()
		{
		var id=$(this).val();
		var dataString = 'id='+ id;
		
		$.ajax
		({
		type: "POST",
		url: "inc/getRoomtype.php",
		data: dataString,
		cache: false,
		success: function(html)
		{
		$(".roomtype").html(html);
		}
		});
		
		});
		
		});
	</script>
    <script type="text/javascript">
		$(document).ready(function()
		{
		$(".source").change(function()
		{
		var id=$(this).val();
		var dataString = 'id='+ id;
		
		$.ajax
		({
		type: "POST",
		url: "inc/getAgent.php",
		data: dataString,
		cache: false,
		success: function(html)
		{
		$(".agent").html(html);
		}
		});
		
		});
		
		});
	</script>
    			
  </head>
  <body class="skin-black sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="home.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>PJTL</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Project </b>Talent</span>
        </a>

        <!-- Header Navbar -->
      <?php include"inc/navTop.php";?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <?php 
        include "inc/asideMenu.php";
		include "inc/connect.php";
      ?>
	
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Update Booking
            <small>Update booking.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Update Booking</li>
          </ol>
         </section>
         <!-- Main content -->
       	<section class="content">
            <div class="row">
                 <div class="col-md-4">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <b><H4>Last Booking Detail</H4></b> 
                                    <div class="pull-right box-tools">
                                    	
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table class="table table-responsive table-hover">
                                        
                                        <tbody>
                                        	 <?php
											
                                            $result = mysqli_query($con, "SELECT * FROM `all_data` WHERE id = ".$_REQUEST['id']." ");
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo"
                                           
                                                    <tr><th>RSVN Code</th><td>" . $row['REV'] . "</td></tr>
													<tr><th>Guest Name</th><td>" . $row['GuestName'] . "</td></tr>
													<tr><th>Pax</th><td> Adult " . $row['Pax_adult'] . " Child ".$row['Pax_child']."</td></tr>
                                                    <tr><th>Date Duration</th><td>" 
													.$valid_date = date( 'd-M-Y', strtotime($row['Arrival']))." - ". $valid_date = date( 'd-M-Y', strtotime($row['Departure'])) . "</td</tr>                                             
                                                    <tr><th>Hotel</th><td>" . $row['Hotel'] . "</td></tr>
                                                    <tr><th>Roomtype</th><td>" . $row['Room_type'] . "</td></tr>
													<tr><th>Room used</th><td>" . $row['Room_used'] . "</td></tr>
                                                    <tr><th>Price</th><td>" . $row['Price'] . "</td></tr>
                                                    <tr><th>Agent</th><td>" . $row['Agent'] . "</td></tr>
                                                    <tr><th>Add Date</th><td>" . $row['Date_add'] . "</td></tr>
													<tr><th>Other Description</th><td>" . $row['Breakfast'] . "</td></tr>
													<tr><th>Payment</th><td>" . $row['Payment'] . "</td></tr>
													<tr><th>Note</th>	<td>" . $row['Note'] . "</td></tr>												
                                            </tr>                                           
										   
								
                                            ";
                                            }

                                            ?>
                                        </tbody>
                                    </table> 
                                </div>
                                <div class="box-footer"><a href="viewBooking.php">View All Booking in system</a></div>
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                        
                        
                        
                        <div class="col-md-4">
                	<div class="box box-primary">
                        <div class="box-header"><h3 class="box-title"><?php
                          	$sql=mysqli_query($con,"select REV from all_data where id = '".$_REQUEST['id']."'");
                            while($row=mysqli_fetch_array($sql))
							{
								echo "<strong>Update Reservation ID : </strong>".$row['REV'];
							}
						  ?> </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="inc/processUpdate.php?id=<?php echo $_REQUEST['id']; ?>" method="post">
                          <div class="box-body">
                         
                          <div class="form-group">
                            <label>Reservation Date:</label>
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                              	<input type="text" name="reservationDate" class="form-control pull-right" id="reservation"/></div><!-- /.input group -->
                          </div>
                          
                          <div class="form-group">
                              <label>Reservation number</label>
                              <input type="text" name="resNum" class="form-control"  placeholder="RSVN number">
                            </div>
                            
                            <div class="form-group">
                              <label>Guest Name</label>
                              <input type="text" name="Guestname" class="form-control"  placeholder="Guest Name">
                            </div>
                            
                            <div class="form-group">
                              <label>Pax Adult</label>
                              <input type="number" name="PaxAdult" class="form-control">
                            </div>
                            
                            <div class="form-group">
                              <label>Pax Child</label>
                              <input type="number" name="PaxChild" class="form-control">
                            </div>
                            
                                                        
                            <div class="form-group">
                              <label>Hotel</label>
                              <select name="hotel" class="hotel form-control">
                                <option selected="selected">--Select Hotel--</option>
                                <?php
                               
                                $sql=mysqli_query($con,"select * from hotellist");
                                while($row=mysqli_fetch_array($sql))
                                {
                                $id=$row['hotelName'];
                                $data=$row['hotelName'];
                                echo '<option value="'.$id.'">'.$data.'</option>';
                                } ?>
                                </select> 
                            </div>
                            
                            <div class="form-group">
                              <label>Roomtype</label>
                                <select name="roomtype" class="roomtype form-control">
                                <option selected="selected">--Select Roomtype--</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                              <label>Room used</label>
                              <input type="number" name="roomUsed" class="form-control"  placeholder="Room Used">
                            </div>
                            
                            <div class="form-group">
                              <label>Source</label>
                              <select name="source" class="source form-control">
                                <option selected="selected">--Select Source--</option>
                                <?php
                               
                                $sql=mysqli_query($con,"select DISTINCT(sourceName) from agentsource ORDER BY sourceName ASC");
                                while($row=mysqli_fetch_array($sql))
                                {
                                $id=$row['sourceName'];
                                $data=$row['sourceName'];
                                echo '<option value="'.$id.'">'.$data.'</option>';
                                } ?>
                                </select> 
                            </div>
                            
                            <div class="form-group">
                              <label>Agent Name</label>
                                <select name="agent" class="agent form-control">
                                <option selected="selected">--Select Agent Name--</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                              <label>Price</label>
                              <input type="number" step="0.01" name="price" class="form-control"  placeholder="Price Per Roomnight">
                            </div>
                            
                            <div class="form-group">
                              <label>Note</label>
                              <textarea name="note" class="form-control" rows="3" placeholder="Note ..."></textarea>
                            </div>
                            
                            
                            <div class="form-group">
                              <label>Breakfast</label>
                                <select name="breakfast" class="form-control">
                                	<option selected="Room only">Room only</option>
                                    <option selected="Room only">Room Breakfast</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                              <label>Payment</label>
                                <select name="payment" class="form-control">
                                	<option selected="Room only">Hotel Collect</option>
                                    <option selected="Room only">City Ledger</option>
                                </select>
                            </div>
                           
                            
                        <div class="box-footer text-right">
                        	<button type="submit" class="btn btn-primary">Submit</button>
                            
                        </div>
                        </div>
                        </form>
                      </div><!-- /.box -->
                </div>
                            
           </div>
              
        </section>
      
      </div><!-- /.content-wrapper -->
      <!-- Main Footer --> 
      <!-- Control Sidebar -->     
      <?php 
        include "inc/footer.php";
        include"inc/asideMenuRight.php";
      ?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
	
        
	<script type="text/javascript">
	  $(function () {      
		//Date range picker
		$('#reservation').daterangepicker();
		//Date range picker with time picker
		
	  });
	</script>
	
       
     
  </body>
</html>