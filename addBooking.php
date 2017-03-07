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
            Add New Booking
            <small>Add new booking in to the system.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add New Booking</li>
          </ol>
         </section>
         <!-- Main content -->
       	<section class="content">
            <div class="row">
				<div class="col-md-4">
                	<div class="box box-primary">
                        <div class="box-header"><h3 class="box-title">Add new booking.</h3> </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="inc/processAdd.php" method="post">
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
                
                
                
                 <div class="col-md-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <b><H4>Recent Booking</H4></b> 
                                    <div class="pull-right box-tools">
                                    	<a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table id="example2" class="table table-responsive table-hover">
                                        <thead>
                                            <tr>
                                                <th>RSVN Code</th>
                                                <th>Check in</th>
                                                <th>Check out</th>                                                                                               
                                                <th>Hotel</th>                                                
                                                <th>Roomtype</th>                                                
                                                <th>Total Price</th>
                                                <th>Agent</th>
                                                <th>Add Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	 <?php
                                            $result = mysqli_query($con, "SELECT * FROM `all_data` ORDER BY `Date_add` DESC LIMIT 0 , 17");
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo"
                                            <tr>
                                                    <td><a href='#myModal' data-toggle='modal' data-target='#" . $row['id'] . "'>" . $row['REV'] . "</a></td>
                                                    <td>" . $valid_date = date( 'd-M-Y', strtotime($row['Arrival'])) . "</td>
                                                    <td>" . $valid_date = date( 'd-M-Y', strtotime($row['Departure'])) . "</td>                                                    
                                                    <td>" . $row['Hotel'] . "</td>
                                                    <td>" . $row['Room_type'] . "</td>
                                                    <td>" . $row['Total'] . "</td>
                                                    <td>" . $row['Agent'] . "</td>
                                                    <td>" . $row['Date_add'] . "</td>												
                                            </tr>                                           
										   
								<div class='modal fade' id='" . $row['id'] . "' role='dialog'>
									<div class='modal-md'>
									  <div class='modal-dialog'>
										<div class='modal-content'>
										  <div class='modal-header'>
											<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h4 class='modal-title'>Reservation Detail</h4>
										  </div>
										  <div class='modal-body'>
											<div class='row'><div class='col-md-4'>Reservation Code </div> <div class='col-md-6'> " . $row['REV'] . "</div></div>
											<div class='row'><div class='col-md-4'>Check in </div> <div class='col-md-6'> " .$valid_date = date( 'd-M-Y', strtotime($row['Arrival'])). "</div></div>
											<div class='row'><div class='col-md-4'>Check out</div> <div class='col-md-6'> " .$valid_date = date( 'd-M-Y', strtotime($row['Departure'])). "</div></div>
											<div class='row'><div class='col-md-4'>Room night </div> <div class='col-md-6'>" . $row['Room_night'] . "</div></div>
											<div class='row'><div class='col-md-4'>Hotel </div> <div class='col-md-6'>" . $row['Hotel'] . "</div></div>
											<div class='row'><div class='col-md-4'>Roomtype </div> <div class='col-md-6'>" . $row['Room_type'] . "</div></div>
											<div class='row'><div class='col-md-4'>Room used </div> <div class='col-md-6'>" . $row['Room_used'] . "</div></div>
											<div class='row'><div class='col-md-4'>Room Rate </div> <div class='col-md-6'>" . $row['Price'] . "</div></div>
											<div class='row'><div class='col-md-4'>Total </div> <div class='col-md-6'>" . $row['Total'] . "</div></div>											
											<div class='row'><div class='col-md-4'>Agent </div> <div class='col-md-6'>" . $row['Agent'] . "</div></div>
											<div class='row'><div class='col-md-4'>Date Add </div> <div class='col-md-6'>" . $row['Date_add'] . "</div></div>
											<div class='row'><div class='col-md-4'>Note </div> <div class='col-md-6'>" . $row['Note'] . "</div></div>	
										  </div>
										  <div class='modal-footer'>
											
											<a href='editBooking.php?id=".$row['id']."'><button class='btn btn-warning'>Edit</button></a>
											<a href='inc/delete.php?id=".$row['id']."'><button class='btn btn-danger'>Delete</button></a>	
											<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
																							
										  </div>
										</div><!-- /.modal-content -->
									  </div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
								  </div><!-- /.example-modal -->
                                            ";
                                            }
                                            ?>
                                        </tbody>
                                    </table> 
                                </div>
                                <div class="box-footer"><a href="viewBooking.php">View All Booking in system</a></div>
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                            
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