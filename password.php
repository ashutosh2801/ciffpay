<?php 
require('forms/function.php'); 
$option = pluck($conn);
require_once('header.php'); 
//$user_id = $_SESSION['user_id'];
$user_id = $_COOKIE['user_id'];
?>

<section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="<?php echo SITEURL; ?>"><?php echo $lang['Home']; ?></a></li>
          <li><a href="<?php echo SITEURL; ?>/dashboard"><?php echo $lang['Dashboard']; ?></a></li>
          <li><?php echo $lang['Change Password']; ?></li>
        </ol>
        <!-- <h2>Blog Single</h2> -->

      </div>
    </section>

    <?php
    $sql = "SELECT * FROM `tbl_users` WHERE id=$user_id";
    $result = $conn -> query($sql);
    $obj = $result -> fetch_object();
    ?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex" style="padding-top:50px">

    <div class="container">
      <div class="row">
      <h2 data-aos="fade-up"><?php echo $lang['Change Password']; ?></h2> 
        <div class="col-lg-6 d-flex flex-column justify-content-center" style="text-align:center; max-width:600px; margin:0 auto">
        <div class="form-group" id="message"></div>
            <form id="password-form" action="" method="post" role="form" onsubmit="return false;">
                
                <h4><?php echo $lang['Change Password']; ?></h4>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="password" name="password" id="password" tabindex="1" class="form-control" placeholder="<?php echo $lang['Your new password']; ?>" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="password" name="confirm_password" id="confirm_password" tabindex="2" class="form-control" placeholder="<?php echo $lang['Confirm password']; ?>">
                    </div>
                </div>

                </div>
                


                
                  

                

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="password-submit" tabindex="13" class="form-control btn btn-register" value="<?php echo $lang['Update']; ?>">
											</div>
										</div>
									</div>
        </div>
      </div>
    </div>

  </section>
  <!-- End Hero -->

<?php 
require_once('footer.php'); 
?>