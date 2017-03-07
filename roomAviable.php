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
				$_POST['hotel'] = 'The Journey Patong';
			
			if(empty($_POST['reservationDate']))
				$_POST['reservationDate'] = date('Y-m-d') ." - ". date('Y-m-d');
				
			$trimmed = explode(" ",$_POST['reservationDate']);
			$from = date( 'Y-m-d', strtotime($trimmed['0']));
			$to = date( 'Y-m-d', strtotime($trimmed['2']));
		  ?>
          
          <div class="row">
          	<div class="col-md-12">
                <div class="box">
                	<div class="box-header"><?php echo $_POST['hotel'] . "<br />From : " .$from . "<br />To : " .$to ;?></div>
                    <div class="box-body">
                    <table class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr>
                          <th rowspan="2"><p align='center'>Date</p></th>
                          <?php
                            $result = mysqli_query($con,"SELECT * FROM `hotelroomtype` WHERE hotelName = '".$_POST['hotel']."'");
                            while($row = mysqli_fetch_array($result)) 
                            {
                                echo "<th colspan='2'><p align='center'>".$row['roomtypeName']."</p></th>"; 
                            }
                            ?>
                          <th colspan="2"><p align='center'>Total OCC</p></th>
                          <th colspan="2"><p align='center'>Total AVL</p></th>
                                            
                       </tr>
                          <?php
                            $result = mysqli_query($con,"SELECT * FROM `hotelroomtype` WHERE hotelName = '".$_POST['hotel']."'");
                            while($row = mysqli_fetch_array($result)) 
                            {
                                echo "<th><p align='center'>OCC</p></th>									  
									  <th><p align='center'>AVL</p></th>
									  
									  "; 
                            }
                            ?> 
                            <th><p align='center'>OCC</p></th>
                        	<th><p align='center'>OCC (%)</p></th>
                            <th><p align='center'>AVL</p></th>
                        	<th><p align='center'>AVL (%)</p></th>
                       </tr> 
                    </thead>
                     <tbody>
                     <?php
					 	
                     	while ($from <= $to) 
						{	
							$totalOCC = 0;
							$totalAVL = 0;
							$maxRoom = 0;
							
							$changeFormat = date("d-F-Y", strtotime($from));
						 	echo "<tr>";
						 	echo "<td>".$changeFormat."</td>";
						 
						 	$result = mysqli_query($con,"SELECT * FROM `hotelroomtype` WHERE hotelName = '".$_POST['hotel']."'");
                            while($row = mysqli_fetch_array($result)) 
                            {
                             	
								$result_occ = mysqli_query($con,"
								SELECT SUM(`Room_used`) as total FROM `all_data` 
								WHERE `Departure` > '".$from."'
								AND `Arrival`<= '".$from."'
								AND `Hotel`='".$_POST['hotel']."'
								AND `Room_type` = '".$row['roomtypeName']."'
								");
                            	while($row_occ = mysqli_fetch_array($result_occ)) 
								{
									if($row_occ['total'] == NULL)
										$row_occ['total'] = 0;
										
									echo "<td align='center'>".$row_occ['total']."</td>";
									$AVL = $row['maxRoom']-$row_occ['total'];
									
									if($AVL>=0)
										echo "<td align='center'>".$AVL."</td>";
									else
										echo "<td align='center'><font color ='red'>".$AVL."</font></td>";
									
									$totalOCC = $totalOCC + $row_occ['total'];
									$totalAVL = $totalAVL + $AVL;
									
								}								
								   
                            }
							
							
							$percentOCC = ($totalOCC/($totalAVL+$totalOCC)*100);
							$percentAVL = ($totalAVL/($totalAVL+$totalOCC)*100);
							if($percentOCC <= 20)
							{
								$color = "#ff0000";
							}
							else if($percentOCC > 20 && $percentOCC <= 80 )
							{
								$color = "#FF8000";
							}
							else if($percentOCC > 80)
							{
								$color = "#00ff00";
							}
							else
							{
								$color = "#000000";
							}
							
							echo "<td align='center'>".$totalOCC."</td>";
							echo "<td align='center'><font color='".$color."'>".number_format($percentOCC,2)."%</font></td>";
							echo "<td align='center'>".$totalAVL."</td>";
							echo "<td align='center'>".number_format($percentAVL,2)."%</td>";
							
							
							

							$from = date ("Y-m-d", strtotime("+1 day", strtotime($from)));
							
						 echo "</tr>";
						
						 }
					 ?>
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