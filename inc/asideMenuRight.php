<aside class="control-sidebar control-sidebar-dark">                
  <!-- Create the tabs -->
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Home tab content -->
    <div class="tab-pane active" id="control-sidebar-home-tab">
      <h3 class="control-sidebar-heading">Online now</h3>
      <ul class='control-sidebar-menu'>
        <li>
            <div class="menu-info">
              <?php
			  
			  	include "inc/connect.php";

				$showUser = mysqli_query($con, "SELECT * FROM user WHERE online = 'active' ");                                		
                echo "<ul>";
				while($rowUser = mysqli_fetch_array($showUser))
				{
					echo "<li>".$rowUser['name']." ".$rowUser['surname']."</li>";
				}
				echo "</ul>";
			?>
            </div>
        </li>              
      </ul><!-- /.control-sidebar-menu -->

      <h3 class="control-sidebar-heading">Tasks Progress</h3> 
      <ul class='control-sidebar-menu'>
        <li>
          
        </li>                         
      </ul><!-- /.control-sidebar-menu -->         

    </div><!-- /.tab-pane -->
    <!-- Stats tab content -->
    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
    <!-- Settings tab content -->
    <div class="tab-pane" id="control-sidebar-settings-tab">            
      <h3 class="control-sidebar-heading">Last Login</h3>
      
      	<?php
		
        	$showUser = mysqli_query($con, "SELECT * FROM user");                                		

				while($rowUser = mysqli_fetch_array($showUser))
				{
					$valid_date = date( 'H:i:s d-m-y', strtotime($rowUser['lastLogin']));
					echo "<div>".$rowUser['name']." @ ".$valid_date."</div>";
				}

		?>
     
    </div><!-- /.tab-pane -->
  </div>
</aside><!-- /.control-sidebar -->