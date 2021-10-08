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
          <li><?php echo $lang['My Profile']; ?></li>
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
      <h2 data-aos="fade-up"><?php echo $lang['My Dashboard']; ?></h2> 
        <div class="col-lg-6 d-flex flex-column justify-content-center" style="text-align:center; max-width:600px; margin:0 auto">
        <div class="form-group" id="message"></div>
            <form id="profile-form" action="" method="post" role="form" onsubmit="return false;">
                
                <h4><?php echo $lang['Account Holder Information']; ?></h4>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="Your First Name" value="<?php echo $obj->first_name; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="last_name" id="last_name" tabindex="2" class="form-control" placeholder="Your Last Name" value="<?php echo $obj->last_name; ?>">
                    </div>
                </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="email" name="email" id="email" tabindex="3" class="form-control" placeholder="Your Email Address" value="<?php echo $obj->email; ?>">
                        </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" name="phone_number" id="phone_number" tabindex="5" class="form-control" placeholder="Your Phone Number" value="<?php echo $obj->phone_number; ?>">
                    </div>
                  </div>
                </div>
                <br />
                <h4><?php echo $lang['Sender Mailing Address']; ?></h4>


                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="number" name="street_number" id="street_number" tabindex="7" class="form-control" placeholder="Your street number" value="<?php echo $obj->street_number; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                        <input type="text" name="unit" id="unit" tabindex="8" class="form-control" placeholder="Your Unit/Apt Number" value="<?php echo $obj->unit; ?>">
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="street_name" id="street_name" tabindex="9" class="form-control" placeholder="Your street name" value="<?php echo $obj->street_name; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="city" id="city" tabindex="10" class="form-control" placeholder="Your city" value="<?php echo $obj->city; ?>">
                    </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="province" id="province" tabindex="11" class="form-control" placeholder="Your province" value="<?php echo $obj->province; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="postal_code" id="postal_code" maxlength="12" tabindex="6" class="form-control" placeholder="Your Postal Code/Zipcode" value="<?php echo $obj->postal_code; ?>" />
					</div>
					</div>
									</div>

                

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="profile-submit" tabindex="13" class="form-control btn btn-register" value="<?php echo $lang['Update']; ?>">
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