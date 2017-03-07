<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <?php 
                   echo "<img src='dist/img/".$_SESSION['Username'].".jpg' class='img-circle' alt='User Image' />";
              ?>
              
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['Name']; ?></p>  
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">Main Navigation</li>
            
                <li><a href="home.php?select_year=2016"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
                <li><a href="addBooking.php"><i class="fa fa-file-text"></i> <span>Add Booking</span> </a></li>
                <li><a href="roomAviable.php"><i class="fa fa-home"></i> <span>Room avilable</span> </a></li>
                <li><a href="roomPickupReport.php"><i class="fa fa-home"></i> <span>Room Pickup Report</span> </a></li>
                <li><a href="report.php"><i class="fa fa-dashboard"></i> <span>Sample Report</span> </a></li>
                
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bed"></i> <span>Booking Transection Today</span>
                <i class="fa fa-angle-left pull-right"></i> 
              </a>
              <ul class="treeview-menu">
                <li><a href="reservationMadeToday.php"><i class="fa fa-envelope-o"></i> <span>Reservation Made Today</span> </a></li>
                <li><a href="cancelBookingToday.php"><i class="fa fa-envelope-o"></i> <span>Cancel Booking Today</span> </a></li>
              </ul>
            </li>
            
              
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bed"></i> <span>View Booking</span>
                <i class="fa fa-angle-left pull-right"></i> 
              </a>
              <ul class="treeview-menu">
              	<li><a href="actualArrival.php"><i class="fa fa-calendar"></i> <span>Arrival List</span> </a></li>
                <li><a href="actualDeparture.php"><i class="fa fa-calendar"></i> <span>Departure List</span> </a></li>
                <li><a href="reservationMadeByDate.php"><i class="fa fa-calendar"></i> <span>Reservation made By Date</span> </a></li>
                <li><a href="viewbooking.php"><i class="fa fa-calendar"></i> <span>View Booking as Table</span> </a></li>
                <li><a href="checkBookingBydate.php"><i class="fa fa-calendar"></i> <span>View Booking By Roomnight</span> </a></li>
                <li><a href="viewBookingCalendar.php"><i class="fa fa-calendar"></i> <span>View Booking as Calendar</span> </a></li>
                <li><a href="cancelBooking.php"><i class="fa fa-calendar"></i> <span>View All Cancel Booking</span> </a></li>
              </ul>
            </li>
            
            
              
              <li class="treeview">
              <a href="#">
                <i class="fa fa-gears"></i> <span>System Configuration</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="addAgent.php"><i class="fa fa-circle-o"></i> Add Agent</a></li>
                
              </ul>
            </li>
			
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>