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
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="dist/css/skins/skin-black.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
           All Booking
            <small>Project Talent Co.,Ltd</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">View All Boking</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">All Booking</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            <div class="box-body table-responsive">
             	 <table id="example1" class="table table-bordered table-hover table-responsive">
                    <thead>
                      <tr>
                        <th>Reservation Code</th>
                        <th>Guestname</th>
                        <th>Check in</th>
                        <th>Check out</th>
                        <th>Note</th>
                        <th>Roomnight</th>
                        <th>Hotel</th>
                        <th>Roomtype</th>
                        <th>Roomused</th>
                        <th>Room Rate</th>
                        <th>Total Price</th>
                        <th>Source</th>
                        <th>Agent</th>                        
                        <th>Add Date</th>
                        <th>Update</th>
                        <th>Cancel</th>
                      </tr>
                    </thead>   
                     <tbody>
                   		<?php
								$result = mysqli_query($con,"SELECT * FROM `all_data`");
								while($row = mysqli_fetch_array($result)) {
										echo"
										
											<tr>
												<td>".$row['REV']."</td>
                                                                                                <td>".$row['GuestName']."</td>    
												<td>".$in = date( 'd-M-Y', strtotime($row['Arrival']))."</td>
												<td>".$out = date( 'd-M-Y', strtotime($row['Departure']))."</td>
												<td>".$row['Note']."</td>
												<td>".$row['Room_night']."</td>
												<td>".$row['Hotel']."</td>
												<td>".$row['Room_type']."</td>
												<td>".$row['Room_used']."</td>
												<td>".$row['Price']."</td>
												<td>".$row['Total']."</td>
												<td>".$row['Source']."</td>
												<td>".$row['Agent']."</td>										
												<td>".$add = date( 'd-F-Y', strtotime($row['Date_add']))."</td>
												<td><a href='editBooking.php?id=".$row['id']."'> <button class ='btn btn-block btn-warning btn-xs fa fa-pencil'> </button></a></td>
												<td><a href='inc/delete.php?id=".$row['id']."'><button class ='btn btn-block btn-danger btn-xs fa fa-eraser'> </button></a></td>
												
										  </tr>
										  
								
										";
									}
																			
						?>
                	</tbody>
                </table> 
            </div><!-- /.box-body -->
            <div class="box-footer">
            	All Booking in our system.
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
        </section><!-- /.content -->
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
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
       
     
  </body>
</html>