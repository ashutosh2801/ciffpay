<?php require_once('../forms/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home | Ciff Solution Inc.</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/ciff-logo.png" alt="ciff.png">
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li class="dropdown"><a href="#"><span>English</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <!-- <li><a class="nav-link scrollto" href="#contact">About us</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact us</a></li> -->
          <li><a class="nav-link scrollto" href="#contact">Sign Up</a></li>
          <li><a class="nav-link scrollto" href="#contact">Log In</a></li>
          <li><a class="getstarted scrollto" href="#about">+1-647-693-1094</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-12 d-flex flex-column justify-content-center" style="text-align:center;">
          <div class="hero_wra">
          <div id="step1">
            <h2 data-aos="fade-up">Send money to your loved one.</h2>
            <div class="prison_type" data-aos="fade-up" data-aos-delay="400">

              <button type="button" value="provincial" class="btn3 active">Provincial Prison</button>
              <button type="button" value="federal" class="btn3">Federal Prison</button>
              <input type="hidden" name="prison_type" id="prison_type" >

            </div>
            <div data-aos="fade-up" data-aos-delay="400">
              <select name="institute" id="institute" class="form-control" style="line-height: 2em; font-size: large;">
                <option value="">Institutes name here</option>
                <?php 
                $sql = "SELECT `title` FROM `tbl_correctional` WHERE 1 ORDER by title";
                if ($result = $mysqli -> query($sql)) {
                while ($obj = $result -> fetch_object()) {
                ?>
                  <option value="<?php echo $obj->title; ?>"><?php echo $obj->title; ?></option>
                <?php
                }
                }
                // Free result set
                $result -> free_result();               
                ?>
              </select>
          </div>
        </div>
        <div id="step2" style="display: none;">
          <h2>How much do you want to send? </h2>
            <div class="price" data-aos="fade-up" data-aos-delay="400">
              <button type="button" value="20" class="btn3 active">$20</button>
              <button type="button" value="50" class="btn3">$50</button>
              <button type="button" value="75" class="btn3">$75</button>
              <button type="button" value="100" class="btn3">$100</button>
              <button type="button" value="150" class="btn3">$150</button>
              <button type="button" value="200" class="btn3">$200</button>
              <input type="hidden" name="price" id="price" >
            </div>
            <br>
            <div data-aos="fade-up" data-aos-delay="600">
              <button type="submit" class="btn2" data-bs-toggle="modal" data-bs-target="#exampleModal">Send Now <i class="bi bi-arrow-right"></i></button>
            </div>








        </div>
        </div>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->


  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sender Registration/Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      <div class="row">
			<div class="col-md-12">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-6">
								<a href="#" id="login-form-link">Sender Login</a>
							</div>
							<div class="col-md-6">
								<a href="#" class="active" id="register-form-link">Sender Registration</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="login.php" method="post" role="form" style="display: none;" onsubmit="return false;">
									<div class="form-group">
										<input type="email" name="email" id="email2" tabindex="1" class="form-control" placeholder="Email" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password2" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="/recover" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="" method="post" role="form" style="display: block;" onsubmit="return false;">
                <div class="row">
                <div class="col-md-6">
									<div class="form-group">
										<input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="Sender First Name" value="">
									</div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
										<input type="text" name="last_name" id="last_name" tabindex="2" class="form-control" placeholder="Sender Last Name" value="">
									</div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="3" class="form-control" placeholder="Sender Email Address" value="">
									</div>
                  </div>
                  <div class="col-md-6">
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="4" class="form-control" placeholder="Sender Password">
									</div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
									<div class="form-group">
										<input type="text" name="phone_number" id="phone_number" tabindex="5" class="form-control" placeholder="Sender Phone Number" value="">
									</div>
                  </div>
                  <div class="col-md-12">
                  <div class="form-group">
                  <input type="text" name="mailing_address" id="mailing_address" tabindex="6" class="form-control" placeholder="Sender Mailing Address" />
									</div>
									</div>
									</div>


                <div class="row">
                <div class="col-md-6">
									<div class="form-group">
										<input type="number" name="street_number" id="street_number" tabindex="7" class="form-control" placeholder="Sender street number" value="">
									</div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
										<input type="text" name="unit" id="unit" tabindex="8" class="form-control" placeholder="Sender Unit/Apt Number" value="">
									</div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
									<div class="form-group">
										<input type="text" name="street_name" id="street_name" tabindex="9" class="form-control" placeholder="Sender street name" value="">
									</div>
                  </div>
                  <div class="col-md-6">
									<div class="form-group">
										<input type="text" name="city" id="city" tabindex="10" class="form-control" placeholder="Sender city">
									</div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
									<div class="form-group">
										<input type="text" name="province" id="province" tabindex="11" class="form-control" placeholder="Sender province" value="">
									</div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                  <input type="text" name="postal_code" id="postal_code" maxlength="12" tabindex="6" class="form-control" placeholder="Sender Postal Code/Zipcode" />
									</div>
									</div>
									</div>

                <div class="form-group" id="message"></div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="13" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



      </div>
      
    </div>
  </div>
</div>

  <!--<main id="main">

    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>Stoney Creek, Ontario L8E 5Z8, Canada</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+1 647-693-1094</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>support@ciffpay.com</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-clock"></i>
                  <h3>Open Hours</h3>
                  <p>Monday - Friday<br>9:00AM - 05:00PM</p>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" class="php-email-form">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>

          </div>

        </div>

      </div>

    </section>

  </main> End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="assets/img/ciff.png" alt="ciff.png">
              <span>Ciff Solution Inc.</span>
            </a>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
            
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Social</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Facebook</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Twitter</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Instagram</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              Stoney Creek, Ontario L8E 5Z8<br>
              Canada <br><br>
              <strong>Phone:</strong> +1 647-693-1094<br>
              <strong>Email:</strong> support@ciffpay.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Ciff Solution Inc.</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="https://woolance.com/">Woolance</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets/js/main.js"></script>


  <!-- Template Main JS File -->
  <script>
    $(function(){
      $('.prison_type button').click(function(){
        var dis = $(this);
        var buttons = $('.prison_type button');
        selected(dis,buttons,'#prison_type');
        return false;
      });
      $('.price button').click(function(){
        var dis = $(this);
        var buttons = $('.price button');
        selected(dis,buttons,'#price');
        return false;
      });
      $('#institute').change(function(){
        var dis = $(this);
        if(dis.val()!=='') { $('#step1').hide(); $('#step2').show(); }
      });

      $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
      });
      $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
      });

      $('#login-submit').click(function(){
        var value = $(this);
        value.val('Logging...');
        $.ajax({url:'login.php',type:'POST',data:$('#login-form').serialize(),success:function(result){console.log(result);value.val('Log In');}})
      });

      $('#register-submit').click(function(){
        var value = $(this);
        value.val('Registering...');
        $.ajax({url:'register.php',type:'POST',dataType:'JSON',data:$('#register-form').serialize(),success:function(result){
            //console.log(result);
            $('.form-group').removeClass('has-error');
            if(result.status=='Errors') {
              $.each(result.message, function(i, item) {
                $('#'+i).parent().addClass('has-error');
                //console.log(i);
              });
            }
            else if( result.status=='Error') {
              $('#message').addClass('has-error').html(result.message);
            }
            else if( result.status=='Success') {
              $('#message').addClass('has-successs').html(result.message);
            }

            value.val('Register Now');
          }
        });
      });
      
    });
    function selected(dis,buttons,vid) {
      var value = dis.val();
      $(vid).val(value);
      buttons.removeClass('active');
      dis.addClass('active');
    }
  </script>
<?php $mysqli->close(); ?>
</body>

</html>
