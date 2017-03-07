<!DOCTYPE html>
<?php
session_start();
include "inc/connect.php";

if ($_SESSION['Username'] == NULL) {

    $sqlProcessMember = mysqli_query($con, "UPDATE user SET online='deactive' WHERE user ='" . $_SESSION['Username'] . "'; ");

    if (mysqli_query($con, $sqlProcessMember)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }

    header("location:index.php");
}

$t = time();
$select_year = $_REQUEST['select_year'];

 $today = date('Y-m-d');

if ($select_year == NULL) {
    $select_year = '2015';
}
?>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php
            include "inc/pageConfig.php";
            echo $page_title;
            ?></title>
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
        <script>
            function disableClick() {
            document.onclick = function (event) {
            if (event.button == 2) {
            alert('Right Click not avalible');
                    return false;
            }
            }
            }
        </script>
    </head>
    <body class="skin-black sidebar-mini" onLoad="disableClick()">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="home.php?select_year=2015" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>PJTL</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Project </b>Talent</span>
                </a>

                <!-- Header Navbar -->
                <?php include"inc/navTop.php"; ?>
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
                        Dashboard
                        <small>All Data Transection.</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashdoard</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title"> Graph Occupancy <small>(Display on base percentages)</small></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <div class="btn-group">
                                            <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar"></i></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="home.php?select_year=2015">Year 2015</a></li>
                                                <li><a href="home.php?select_year=2016">Year 2016</a></li>
                                                <li><a href="home.php?select_year=2017">Year 2017</a></li>                                              
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-8">

                                            <?php
                                            $countAllBook = 0;
                                            $AGTmarket = 0;
                                            $GRPmarket = 0;
                                            $OTAmarket = 0;
                                            $OTHmarket = 0;

                                            $TotalRevenue = 0;
                                            $TotalRoomnight = 0;



                                            $sqlMarketSource = mysqli_query($con, "SELECT * FROM `all_data` WHERE `Arrival` BETWEEN '" . $select_year . "-01-01' AND '" . $select_year . "-12-31' ");
                                            while ($row_market = mysqli_fetch_array($sqlMarketSource)) {
                                                $countAllBook +=$row_market['Room_night'];

                                                if ($row_market['Source'] == 'AGT') {
                                                    $AGTmarket += $row_market['Room_night'];
                                                    $hotelPrice = ($row_market['Price']);
                                                } else if ($row_market['Source'] == 'GRP') {
                                                    $GRPmarket +=$row_market['Room_night'];
                                                    $hotelPrice = $row_market['Price'];
                                                } else if ($row_market['Source'] == 'OTA') {
                                                    $OTAmarket +=$row_market['Room_night'];
                                                    $hotelPrice = $row_market['Price'];
                                                } else if ($row_market['Source'] == 'OTH') {
                                                    $OTHmarket += $row_market['Room_night'];
                                                    $hotelPrice = $row_market['Price'];
                                                }


                                                $TotalRevenue += ($hotelPrice * $row_market['Room_night']);
                                                $TotalRoomnight += $row_market['Room_night'];
                                            }
                                            $AVGroomRate = $TotalRevenue / $TotalRoomnight;
                                            ?>

                                            <div class="chart">
                                                <!-- Sales Chart Canvas -->
                                                <canvas id="salesChart" height="250"></canvas>
                                            </div><!-- /.chart-responsive -->
                                        </div><!-- /.col -->

                                        <div class="col-md-4">
                                            <p class="text-center">
                                                <strong>Sort By Market Source<small> (Room night)</small></strong>
                                            </p>
                                            <div class="progress-group">
                                                <span class="progress-text">Travel Agent </span>
                                                <span class="progress-number"><b><?php echo number_format($AGTmarket); ?></b>/<?php echo number_format($countAllBook); ?></span>
                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-red" style="width:  <?php echo $AGTper = ($AGTmarket / $countAllBook) * 100; ?>%"></div>
                                                </div>
                                            </div><!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Group</span>
                                                <span class="progress-number"><b><?php echo number_format($GRPmarket); ?></b>/<?php echo number_format($countAllBook); ?></span>
                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-aqua" style="width: <?php echo $GRPper = ($GRPmarket / $countAllBook) * 100; ?>%"></div>
                                                </div>
                                            </div><!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Online travel agent's</span>
                                                <span class="progress-number"><b><?php echo number_format($OTAmarket); ?></b>/<?php echo number_format($countAllBook); ?></span>
                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-green" style="width: <?php echo $OTAper = ($OTAmarket / $countAllBook) * 100; ?>%"></div>
                                                </div>
                                            </div><!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Other</span>
                                                <span class="progress-number"><b><?php echo number_format($OTHmarket); ?></b>/<?php echo number_format($countAllBook); ?></span>
                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-yellow" style="width: <?php echo $OTHper = ($OTHmarket / $countAllBook) * 100; ?>%"></div>
                                                </div>
                                            </div><!-- /.progress-group -->
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
                                </div><!-- ./box-body --> 
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">                        
                                                <h5 class="description-header"><?php echo $TotalRevenueValid = number_format($TotalRevenue, 2); ?> ฿</h5>
                                                <span class="description-text">TOTAL REVENUE</span>
                                            </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">                        
                                                <h5 class="description-header"><?php echo $AVGroomRateValid = number_format($AVGroomRate, 2); ?> ฿</h5>
                                                <span class="description-text">AVG Room Rate </span>
                                            </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header"><?php echo $AVGrevenueValid = number_format(($TotalRevenue / 12), 2); ?> ฿</h5>
                                                <span class="description-text">AVG REVENUE PER MONTH</span>
                                            </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block">

                                                <h5 class="description-header"><?php echo $TotalRoomnightValid = number_format($TotalRoomnight); ?></h5>
                                                <span class="description-text">TOTAL ROOM NIGHT</span>
                                            </div><!-- /.description-block -->
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->
                        </div><!-- /.col --> 
                    </div><!--/row-->
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="box box-info">
                                <div class="box-header"> Last 10 New Booking in System
                                    <div class="box-tools pull-right"><button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div>
                                </div>
                                <div class="box-body table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>REV. Code</th>
                                            <th>Guest Name</th>
                                            <th>Arrival</th>
                                            <th>Departure</th>
                                            <th>Room Type</th>
                                        </tr>
                                        <?php
                                        $sqlNewEntry = mysqli_query($con, "SELECT * FROM `all_data` ORDER BY `id` DESC LIMIT 0 ,10");
                                        while ($row_NewEntry = mysqli_fetch_array($sqlNewEntry)) {
                                            echo "<tr>
                                                        <td>" . $row_NewEntry['REV'] . "</td>
                                                        <td>" . $row_NewEntry['GuestName'] . "</td>
                                                        <td>" . $in = date('d-M-Y', strtotime($row_NewEntry['Arrival'])) . "</td>
                                                        <td>" . $out = date('d-M-Y', strtotime($row_NewEntry['Departure'])) . "</td>                                                        
                                                        <td>" . $row_NewEntry['Room_type'] . "</td>
                                                    </tr>";
                                        }
                                        ?>                                
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="box box-success">
                                <div class="box-header"> Arrival List of <?php echo date('d-F-Y', strtotime($today))  ?>
                                    <div class="box-tools pull-right"><button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div>
                                </div>
                                <div class="box-body table-responsive">
                                   <table class="table table-striped">
                                        <tr>
                                            <th>REV. Code</th>
                                            <th>Guest Name</th>
                                            <th>Arrival</th>
                                            <th>Departure</th>
                                            <th>Hotel</th>
                                            <th>Room Type</th>
                                        </tr>
                                        <?php
                                       
                                        $sqlArrival = mysqli_query($con, "SELECT * FROM `all_data` where `Arrival` like '".$today."%'  and `REV` not like '%.%' ORDER BY `Hotel` ASC ");
                                        while ($row_Arrival = mysqli_fetch_array($sqlArrival)) {
                                            echo "<tr>
                                                        <td>" . $row_Arrival['REV'] . "</td>
                                                        <td>" . $row_Arrival['GuestName'] . "</td>
                                                        <td>" . $in = date('d-M-Y', strtotime($row_Arrival['Arrival'])) . "</td>
                                                        <td>" . $out = date('d-M-Y', strtotime($row_Arrival['Departure'])) . "</td>                                                        
                                                        <td>" . $row_Arrival['Hotel'] . "</td>
                                                        <td>" . $row_Arrival['Room_type'] . "</td>
                                                    </tr>";
                                        }
                                        ?>                                
                                    </table>
                                </div>
                            </div>                            
                        </div>
                        
                        <div class="col-sm-12 col-md-7">
                            <div class="box box-danger">
                                <div class="box-header"> Departure List <?php echo date('d-F-Y', strtotime($today))  ?>
                                    <div class="box-tools pull-right"><button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div>
                                </div>
                                <div class="box-body table-responsive">
                                   <table class="table table-striped">
                                        <tr>
                                            <th>REV. Code</th>
                                            <th>Guest Name</th>
                                            <th>Arrival</th>
                                            <th>Departure</th>
                                            <th>Hotel</th>
                                            <th>Room Type</th>
                                        </tr>
                                        <?php
                                       
                                        $sqlDeparture = mysqli_query($con, "SELECT * FROM `all_data` where `REV` not like '%.%'  AND `Departure` like '".$today."%'   ");
                                        while ($row_Departure = mysqli_fetch_array($sqlDeparture)) {
                                            echo "<tr>
                                                        <td>" . $row_Departure['REV'] . "</td>
                                                        <td>" . $row_Departure['GuestName'] . "</td>
                                                        <td>" . $in = date('d-M-Y', strtotime($row_Departure['Arrival'])) . "</td>
                                                        <td>" . $out =date('d-M-Y', strtotime($row_Departure['Departure'])) . "</td>                                                        
                                                        <td>" . $row_Departure['Hotel'] . "</td>
                                                        <td>" . $row_Departure['Room_type'] . "</td>
                                                    </tr>";
                                        }
                                        ?>                                
                                    </table>
                                </div>
                            </div>
                        </div>                    
                    </div><!--/row-->
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
        <?php include 'inc/graphOccupancy.php'; ?>
        
        
        
    </body>
</html>