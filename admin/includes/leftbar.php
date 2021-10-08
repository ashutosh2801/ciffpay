<ul id="gn-menu" class="gn-menu-main">
  <!-- /nav_agile_w3l -->
  <li class="gn-trigger">
    <a class="gn-icon gn-icon-menu"><i class="fa fa-bars" aria-hidden="true"></i><span>Menu</span></a>
    <nav class="gn-menu-wrapper">
      <div class="gn-scroller scrollbar1">
        <ul class="gn-menu agile_menu_drop">
          <li><a href="index.php"> <i class="fa fa-tachometer"></i> Dashboard</a></li>

          <li>
            <a href="customers.php"><i class="fa fa-list" aria-hidden="true"></i> Users <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
            <ul class="gn-submenu">
              <!-- <li class="mini_list_agile"><a href="add_new_tour.php"><i class="fa fa-caret-right" aria-hidden="true"></i> Add New</a></li> -->
              <li class="mini_list_w3"><a href="customers.php"> <i class="fa fa-caret-right" aria-hidden="true"></i> View Users</a></li>
            </ul>
          </li>
          
          <li>
            <a href="institutions.php"><i class="fa fa-comment-o" aria-hidden="true"></i> Institutions <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
            <ul class="gn-submenu">
              <li class="mini_list_agile"><a href="institution_add_new.php"><i class="fa fa-caret-right" aria-hidden="true"></i> Add Institution</a></li>
              <li class="mini_list_w3"><a href="institutions.php"> <i class="fa fa-caret-right" aria-hidden="true"></i> View Institutions</a></li>
            </ul>
          </li>

          <!-- <li class="page">
            <a href="#"><i class="fa fa-files-o" aria-hidden="true"></i> Pages <i class="fa fa-angle-down" aria-hidden="true"></i></a>
               <ul class="gn-submenu">
      
              <li class="mini_list_agile"> <a href="signin.html"> <i class="fa fa-caret-right" aria-hidden="true"></i> Sign In</a></li>
               <li class="mini_list_w3"><a href="signup.html"> <i class="fa fa-caret-right" aria-hidden="true"></i> Sign Up</a></li>
               <li class="mini_list_agile error"><a href="404.html"> <i class="fa fa-caret-right" aria-hidden="true"></i> Error 404 </a></li>

              <li class="mini_list_w3_line"><a href="calendar.html"> <i class="fa fa-caret-right" aria-hidden="true"></i> Calendar</a></li>
            </ul>
          </li> -->

          <li><a href="logout.php"> <i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
      </div><!-- /gn-scroller -->
    </nav>
  </li>
  <!-- //nav_agile_w3l -->
  
  <li class="second logo">
  	<h1>
    	<a href="index.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i><?php echo SITENAME; ?> </a>
    </h1>
  </li>
  
  <li class="second admin-pic">
       <ul class="top_dp_agile">
          <li class="dropdown profile_details_drop">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <div class="profile_img">	
                <span class="prfil-img">
                <?php
								$profile = array();
                $sql = "SELECT * FROM tour_users WHERE ID=".$_SESSION['user_id'];
								$query = $conn->query($sql);
								if ($query->num_rows > 0) {
									$profile = $query->fetch_object();
								}
								$image = !empty($profile->profile_image) ? $profile->profile_image : 'na';
								if(file_exists("../uploads/profile/".$image)) {
								?>
								<img src="<?php echo "../uploads/profile/".$image; ?>" alt="<?php echo $profile->$image; ?>" class="img-responsive" />
								<?php
								} else {
								?>
                <img src="images/default-avatar.png" alt="default-avatar.png" />
                <?php } ?> 
                </span> 
              </div>	
            </a>
            <ul class="dropdown-menu drp-mnu">
              <li> <a href="profile.php"><i class="fa fa-user"></i> Profile</a> </li> 
              <li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
            </ul>
          </li>
      </ul>
  </li>

  
</ul>