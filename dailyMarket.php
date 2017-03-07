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
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
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
            Room Avaliable
            <small>Room occupied</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Room Avaliable</li>
          </ol>
         </section>
         <!-- Main content -->
		  <section class="content">

          <!-- Default box -->
          <div class="row">
          <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Select Date and Hotel</h3>
              <div class="box-tools pull-right">
              	<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Hide Button"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
             <form role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                          <div class="box-body">
                         
                          <div class="form-group">
                            <label>Date :</label>
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                              	<input type="text" name="reservationDate" class="form-control pull-left" id="reservation"/></div><!-- /.input group -->
                          </div>
         
                            <div class="form-group">
                              <label>Hotel</label>
                              <select name="hotel" class="hotel form-control">
                               	<?php                               
                                    $sql=mysqli_query($con,"select * from hotellist");
                                    while($row=mysqli_fetch_array($sql))
                                    {
                                    $id=$row['hotelName'];
                                    $data=$row['hotelName'];
                                    echo '<option value="'.$id.'">'.$data.'</option>';
                                    } 
								?>
                                </select> 
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
                                <option value="%">All</option>
                                </select> 
                            </div>
                            
                            
                            <div class="form-group">
                              <label>Agent Name</label>
                                <select name="agent" class="agent form-control">
                                <option selected="selected">--Select Agent Name--</option>
                                
                                </select>
                            </div>
                            
                        	<button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
            		</div><!-- /.box-body -->
            <div class="box-footer">
              Please click hide button before print
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
          </div>
          </div>
          
		  <?php
          	if(empty($_POST['hotel']))
				$_POST['hotel'] = '%';

			if(empty($_POST['source']))
				$_POST['source'] = '%';

			if(empty($_POST['agent']))
				$_POST['agent'] = '%';
						
			if(empty($_POST['reservationDate']))
				$_POST['reservationDate'] = date('Y-m-d') ." - ". date('Y-m-d');
				
			$trimmed = explode(" ",$_POST['reservationDate']);
			$from = date( 'Y-m-d', strtotime($trimmed['0']));
			$to = date( 'Y-m-d', strtotime($trimmed['2']));
		  ?>
          
          <div class="row">
          	<div class="col-md-12">
                <div class="box">
                	<div class="box-header">
						<?php echo "
									<strong>Hotel : </strong>".$_POST['hotel'] . 
									"<br />From : " .$fromValid = date( 'd-M-Y', strtotime($from)) . 
									"<br />To : " .$toValid = date( 'd-M-Y', strtotime($to)) .
									"<br /> Source : " .$_POST['source'].
									"<br /> Agent : " .$_POST['agent'] 
						;?>
                    </div>
                    <div class="box-body">
                    	<table class="table table-bordered table-hover table-striped">
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
   
                      </tr>
                    </thead>
                     <tbody>
                   		<?php
								$Total = 0;
								$GrandTotal = 0;

								
									$result_inhouse = mysqli_query($con,"
									SELECT * FROM `all_data` WHERE 
									`Departure` > '".$from."'
									AND `Arrival`<= '".$to."'
									AND `Hotel` like '".$_POST['hotel']."'
									AND `Source` like '".$_POST['source']."'
									AND `Agent` like '".$_POST['agent']."'
									ORDER BY Arrival ASC
									");
									while($row = mysqli_fetch_array($result_inhouse)) 
									{
										if($row['Arrival'] < $from)
										{
											echo "Have in house of ".$row['REV']." <br />";
											echo "Date diff from to day ".$AnewDate = round(abs(strtotime($from)-strtotime($row['Arrival']))/86400) ."<br />";
											echo "Date diff from Depart ".$AnewDateDep = round(abs(strtotime($row['Departure'])-strtotime($from))/86400) ."<br /> <br />";
											
										}
										
										if($row['Departure'] > $to)
										{
											echo "Have in house of ".$row['REV']." <br />";
											echo "Date diff from to day ".$DnewDate = round(abs(strtotime($to)-strtotime($row['Departure']))/86400) ."<br />";
											echo "Date diff from Depart ".$DnewDateDep = round(abs(strtotime($to)-strtotime($row['Departure']))/86400) ."<br /> <br />";
											
										}
										
										echo "<tr>
												
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
												<td>".$row['Date_add']."</td>
										</tr>";
										
										$Total = $Total + $row['Price'];
										$GrandTotal = $GrandTotal + $row['Total'];	
									
									}
									
									$from = date ("Y-m-d", strtotime("+1 day", strtotime($from)));
								
								
						?>
                        <tr>
                        	<td colspan="7" align="center"><strong>Booking Revenue</strong></td>
                            <td><?php echo $TitalFormat = number_format($Total,2); ?></td>
                            <td><?php echo $GrandFormat = number_format($GrandTotal,2); ?></td>
                            <td colspan="3"></td>
                        </tr>
                	</tbody>
                </table> 
                    	
                    </div>
            </div>            
          </div>
          

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

	
        
	<script type="text/javascript">
	  $(function () {      
		//Date range picker
		$('#reservation').daterangepicker();
		//Date range picker with time picker
		
	  });
	</script>
	

       
     
  </body>
</html>