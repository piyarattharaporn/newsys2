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
      <?php
	  	$bookID = $_REQUEST['id']; 
	  ?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Reservation 
            <small>#
				<?php 
					$sqlFetchData = mysqli_query($con,"SELECT `REV` FROM `all_data` WHERE id = '".$bookID."' ");
					 while($row = mysqli_fetch_array ($sqlFetchData) )
					 {
						echo $row['REV']; 
					 }
				?>
            </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Invoice</li>
          </ol>
        </section>

       <?php
               		 
			 $sqlFetchData = mysqli_query($con,"SELECT * FROM `all_data` WHERE id = '".$bookID."' ");
			 while($row = mysqli_fetch_array ($sqlFetchData))
			 {			 
			   ?>

        <!-- Main content -->
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header" align="center">
              <img src="dist/img/main-logo.png">
              <small><address>
                369/110 yaowarad 5 Talad-Yai, Phuket, Thailand  83000<br>
                Phone: (+66) 076-212753<br/>
                Email: rsvn1@projecttalent18.com
              </address></small>               
               <small class="pull-right">Reservation Number #<?php echo $row['REV']; ?></small>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          

          <!-- Table row -->
          <div class="row">
            <div class="table-responsive col-xs-12">
            
              <table class="table no-border">
               
                  <tr><td> </td></tr>
                  <tr><td> </td></tr>
                  
                  <tr> 
                  	<th>Attention</th> <td>Reservation Hotel <strong><?php echo $row['Hotel']; ?></strong></td>                                        
                  </tr>               
                                    
                  <tr>
                  	<th>Agent</th> <td><?php echo $row['Agent']; ?></td>
                  </tr>
                  
                  <tr>                  	
                  	<th>Guest name</th> <td><?php echo $row['GuestName']; ?></td> 
                    <th>Pax</th> <td> Adult : <?php echo $row['Pax_adult'];?> &nbsp; Child : <?php echo $row['Pax_child']; ?></td>
                  </tr>
                  
                  <tr>
                  	  <th>Arrival Date</th> <td><?php echo $in =  date( 'd-F-Y', strtotime($row['Arrival'])); ?></td>                   	  
                  </tr>
                  <tr>
	               	  <th>Departure Date</th> <td><?php echo $out = date( 'd-F-Y', strtotime($row['Departure'])); ?></td>
                  </tr>
                  
                  <tr>
                  	  <th>Room Type</th> <td><?php echo $row['Room_type']; ?></td>                  	  
                  	  <th>Room Used</th> <td><?php echo $row['Room_used']; ?></td>                                           
                  </tr>                  

                  <tr>
                  	<th>No. Night(s)</th> <td><?php echo $night = round(abs(strtotime($row['Arrival'])-strtotime($row['Departure']))/86400); ?></td>                  	
                                       
                  </tr>  
                  
                   <tr>
                   	<th>Room Rate</th>  <td><?php echo $row['Price']; ?></td>
                   	<th>Total Price</th> <td><?php echo $row['Total']; ?></td>
                   </tr>                
                  
                  <tr><td> </td></tr>
                  
                  <tr><th>Other Drescription</th> <td><?php echo $row['Breakfast']; ?></td></tr>                  
                  <tr><th>Payment Type</th><td><?php echo $row['Payment']; ?></td></tr>
                  
                  <tr><td> </td></tr>
                  <tr><td> </td></tr>
                  <tr><td> </td></tr>
                  <tr><td> </td></tr>
                  
                  <tr>
                  	<td align="center">
						<?php 
								$confirmBy = $row['Add_by']; 
								$findName = mysqli_query($con,"SELECT * FROM `user` WHERE `user` = '".$confirmBy."' ");
								while($fullName = mysqli_fetch_array($findName))
								{
									echo $fullName['name'] . " " . $fullName['surname'];
								}
						?>
                    </td> 
                    <td align="center">............................</td>           
                  </tr>
                  <tr>
                  	<td align="center"><strong>Confirmed By</strong></td> <td align="center"><strong>Issued By</strong></td>
                  </tr>
                  
                  <?php }?>
              </table>
            </div><!-- /.col -->
          </div><!-- /.row -->

		<div class="row">
            <div class="col-xs-12">
              
            </div><!-- /.col -->
          </div><!-- /.row -->          

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">                         
              <button class="btn btn-primary pull-right" onClick="window.print();" 5px;"><i class="fa fa-print"></i> Print</button>
            </div>
          </div>
        </section><!-- /.content -->
        <div class="clearfix"></div>
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
        <!-- FastClick -->
        <script src='plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- ChartJS 1.0.1 -->
        <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>

       
     
  </body>
</html>