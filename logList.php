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
              <div class="box-tools pull-right input-group date">
              	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button class="btn btn-default pull-right" id="daterange-btn">
                    <i class="fa fa-calendar"></i> Range
                    <i class="fa fa-caret-down"></i>
                </button>
                </form>            
              </div>
            </div>
            <div class="box-body">
             	 <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Reservation Code</th>
                        <th>Check in</th>
                        <th>Check out</th>
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
                        <th>Delete </th>
                      </tr>
                    </thead>
                     <tbody>
                   		<?php
								if($_POST['start'] && $_POST['end'] == NULL)
								{
									$_POST['start'] = date('Y-m-d',$t); 
									$_POST['end'] = date('Y-m-d',$t);
								}
								else
								{
									
								}
								
								$result = mysqli_query($con,"SELECT * FROM `all_data` WHERE `Date_add` = '".$t."' ");
								while($row = mysqli_fetch_array($result)) {
										echo"
										
											<tr>
												<td>".$row['REV']."</td>
												<td>".$in = date( 'd-M-Y', strtotime($row['Arrival']))."</td>
												<td>".$out = date( 'd-M-Y', strtotime($row['Departure']))."</td>
												<td>".$row['Room_night']."</td>
												<td>".$row['Hotel']."</td>
												<td>".$row['Room_type']."</td>
												<td>".$row['Room_used']."</td>
												<td>".$row['Price']."</td>
												<td>".$row['Total']."</td>
												<td>".$row['Source']."</td>
												<td>".$row['Agent']."</td>										
												<td>".$add = date( 'd-M-Y', strtotime($row['Date_add']))."</td>
												<td><button class ='btn btn-block btn-warning btn-xs fa fa-pencil'> </button></td>
												<td><button class ='btn btn-block btn-danger btn-xs fa fa-eraser'> </button></td>
												
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

    <!-- Page script -->
    <script type="text/javascript">
      $(function () {
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                  },
                  startDate: moment().subtract('days', 29),
                  endDate: moment()
                },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );
      });
    </script>
    
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