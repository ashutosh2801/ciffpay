<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $title; ?></title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo SITEURL; ?>/assets/img/ciff-fevicon.png" rel="icon">
  <link href="<?php echo SITEURL; ?>/assets/img/ciff-fevicon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo SITEURL; ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo SITEURL; ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo SITEURL; ?>/assets/css/style.css" rel="stylesheet">

  <script>var SITEURL = '<?php echo SITEURL; ?>';</script>
  <script src="https://code.jquery.com/jquery-1.11.3.js"></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="<?php echo SITEURL; ?>" class="logo d-flex align-items-center">
        <img src="<?php echo SITEURL; ?>/assets/img/ciff-logo.png" alt="ciff.png">
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li class="dropdown">
            <a href="#"><span>
            <?php
            if($_COOKIE['lang']=='en' || empty($_COOKIE['lang'])) echo $lang['English'];
            else if($_COOKIE['lang']=='fr') echo $lang['French'];
            ?>
            </span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?php echo SITEURL; ?>/?lang=fr"><i class="bi bi-translate"></i> <?php echo $lang['French']; ?></a></li>
              <li><a href="<?php echo SITEURL; ?>/?lang=en"><i class="bi bi-translate"></i> <?php echo $lang['English']; ?></a></li>
            </ul>
          </li>
          <!-- <li><a class="nav-link scrollto" href="#contact">About us</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact us</a></li> -->
          <?php 
          //$_SESSION['user_id']
          $user_id = $_COOKIE['user_id'];
          if(isset($user_id)) { 
              $sql = "SELECT concat(first_name, ' ', last_name) as name FROM `tbl_users` WHERE id='".$user_id."' limit 1";
              $result = $conn -> query($sql);
              $row = $result -> fetch_assoc();
              if($row) { ?>
            <li class="dropdown"><a class="nav-link scrollto">Hi, <?php echo $row['name'];    ?> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a class="nav-link scrollto" href="<?php echo SITEURL; ?>/dashboard"><i class="bi bi-person-square"></i> <?php echo $lang['Dashboard']; ?></a></li>
                <li><a class="nav-link scrollto" href="<?php echo SITEURL; ?>/password"><i class="bi bi-person-square"></i> <?php echo $lang['Change Password']; ?></a></li>
                <li><a class="nav-link scrollto" href="<?php echo SITEURL; ?>/orders"><i class="bi bi-cart"></i> <?php echo $lang['My Orders']; ?></a></li>
                <li><a class="nav-link scrollto" href="<?php echo SITEURL; ?>/logout"><i class="bi bi-box-arrow-right"></i> <?php echo $lang['Log Out']; ?></a></li>
              </ul>
              </li>
          <?php } } else { ?>
            <li><a class="nav-link scrollto " id="signup" href="#"><?php echo $lang['Sign Up']; ?></a></li>
            <li><a class="nav-link scrollto " id="login" href="#"><?php echo $lang['Log In']; ?></a></li>
          <?php } ?>
          <li><a class="getstarted scrollto" href="#about">+1-647-693-1094</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

