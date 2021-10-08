<?php if(!isset($user_id)) { ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <?php echo $lang['Registration/Login']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      <div class="row">
			<div class="col-md-12">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-6">
								<a href="#" id="login-form-link"> <?php echo $lang['Login']; ?></a>
							</div>
							<div class="col-md-6">
								<a href="#" class="active" id="register-form-link"> <?php echo $lang['Registration']; ?></a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
                            <div class="form-group" id="message"></div>
								<form id="login-form" action="login" method="post" role="form" style="display: none;" onsubmit="return false;">
								    <input type="hidden" name="direct" value="" class="direct" />
									<div class="form-group">
										<input type="email" name="email" id="email2" tabindex="1" class="form-control" placeholder="<?php echo $lang['Email']; ?>" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password2" tabindex="2" class="form-control" placeholder="<?php echo $lang['Password']; ?>">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> <?php echo $lang['Remember Me']; ?></label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="<?php echo $lang['Log In']; ?>">
											</div>
										</div>
									</div>
									<!-- <div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="/recover" tabindex="5" class="forgot-password"><?php echo $lang['Forgot Password?']; ?></a>
												</div>
											</div>
										</div>
									</div> -->
								</form>
								<form id="register-form" action="" method="post" role="form" style="display: block;" onsubmit="return false;">
								    <input type="hidden" name="direct" value="" class="direct" />
                                    <h3><?php echo $lang['Account Holder Information']; ?></h3>
                                    <div class="row">
                                    <div class="col-md-6">
									<div class="form-group">
										<input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="<?php echo $lang['Your First Name']; ?>" value="">
									</div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
										<input type="text" name="last_name" id="last_name" tabindex="2" class="form-control" placeholder="<?php echo $lang['Your Last Name']; ?>" value="">
									</div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="3" class="form-control" placeholder="<?php echo $lang['Your Email Address']; ?>" value="">
									</div>
                  </div>
                  <div class="col-md-6">
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="4" class="form-control" placeholder="<?php echo $lang['Your Password']; ?>">
									</div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
									<div class="form-group">
										<input type="text" name="phone_number" id="phone_number" tabindex="5" class="form-control" placeholder="<?php echo $lang['Your Phone Number']; ?>" value="">
									</div>
                  </div>
                  <!-- <div class="col-md-12">
                  <div class="form-group">
                  <input type="text" name="mailing_address" id="mailing_address" tabindex="6" class="form-control" placeholder="<?php echo $lang['Your Mailing Address']; ?>" />
									</div>
									</div> -->
								</div>

                <h3><?php echo $lang['Sender Mailing Address']; ?></h3>


                <div class="row">
                <div class="col-md-6">
									<div class="form-group">
										<input type="number" name="street_number" id="street_number" tabindex="7" class="form-control" placeholder="<?php echo $lang['Your street number']; ?>" value="">
									</div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
										<input type="text" name="unit" id="unit" tabindex="8" class="form-control" placeholder="<?php echo $lang['Your Unit/Apt Number']; ?>" value="">
									</div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
									<div class="form-group">
										<input type="text" name="street_name" id="street_name" tabindex="9" class="form-control" placeholder="<?php echo $lang['Your street name']; ?>" value="">
									</div>
                  </div>
                  <div class="col-md-6">
									<div class="form-group">
										<input type="text" name="city" id="city" tabindex="10" class="form-control" placeholder="<?php echo $lang['Your city']; ?>">
									</div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
									<div class="form-group">
										<!-- <input type="text" name="province" id="province" tabindex="11" class="form-control" placeholder="<?php echo $lang['Your province']; ?>" value=""> -->
                    <select class="form-control" name="province" id="province" tabindex="11" class="form-control">
                    <option value="60">AB</option>
                    <option value="61">BC</option>
                    <option value="62">MB</option>
                    <option value="63">NB</option>
                    <option value="64">NL</option>
                    <option value="66">NS</option>
                    <option value="68">ON</option>
                    <option value="69">PE</option>
                    <option value="70">QC</option>
                    <option value="71">SK</option>
                    </select>
									</div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                  <input type="text" name="postal_code" id="postal_code" maxlength="12" tabindex="6" class="form-control" placeholder="<?php echo $lang['Your Postal Code/Zipcode']; ?>" />
									</div>
									</div>
									</div>

                

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="13" class="form-control btn btn-register" value="<?php echo $lang['Register Now']; ?>">
											</div>
										</div>
									</div><br>
                  <div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="#" tabindex="5" class="forgot-password have_an_account"><?php echo $lang['Click here if you already have an account']; ?></a>
												</div>
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
<?php } ?>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    

<div class="footer-top">
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-5 col-md-12 footer-info">
        <a href="index.html" class="logo d-flex align-items-center">
          <img src="<?php echo SITEURL; ?>/assets/img/ciff.png" alt="ciff.png">
        </a>
        <?php echo $option['footer_col_1'.$lang_field]; ?>
      </div>

      <div class="col-lg-2 col-xs-12"></div>

      <div class="col-lg-3 footer-links">
        <?php echo $option['footer_col_2'.$lang_field]; ?>        
      </div>

      <div class="col-lg-2 footer-contact">
        <?php echo $option['footer_col_3'.$lang_field]; ?>
      </div>

    </div>
  </div>
</div>

<div class="container">
  <div class="copyright">
    &copy; <?php echo $lang['Copyright']; ?> <strong><span><?php echo $lang['Ciff Solution Inc.']; ?></span></strong>. <?php echo $lang['All Rights Reserved']; ?>
  </div>
  <div class="credits">
    Designed by <a href="https://woolance.com/">Woolance</a>
  </div>
</div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?php echo SITEURL; ?>/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="<?php echo SITEURL; ?>/assets/js/main.js"></script>


<!-- Template Main JS File -->
<script>
$(function(){

  $('.have_an_account').click(function(){
    $('#login-form-link').addClass('active'); $('#register-form-link').removeClass('active');
    $('#login-form').show();$('#register-form').hide(); return false;
  });

  $('.prison_type button').click(function(){
    var dis = $(this);
    var buttons = $('.prison_type button');
    selected(dis,buttons,'#prison_type');
    return false;
  });
  $('.price button').click(function(){
    var dis = $(this);
    var buttons = $('.price button');
    selected(dis,buttons,'#amount');
    return false;
  });
  $('#institute').change(function(){
    var dis = $(this);
    if(dis.val()!=='') { $('.send_now').attr('disabled',false); }
    else { $('.send_now').attr('disabled',true); }
  });
  $('#continue').click(function(){
    var amount = $('#amount');
    if(amount.val()!=='') { $('#step1').hide(); $('#step2').show(); }
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
  
  $('#login').click(function(){
    $("#login-form").delay(100).fadeIn(100);
    $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $("#login-form-link").addClass('active');
    $('.direct').val('direct');
    $('#exampleModal').modal('show'); return false;
  });
  
  $('#signup').click(function(){
    $("#register-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $("#register-form-link").addClass('active');
    $('.direct').val('direct');
    $('#exampleModal').modal('show'); return false;
  });

  $('#send_now').on('click', function(){
      $('.direct').val('');
    var value = $(this);
    value.text('Continuing...');
    $.ajax({
        url:SITEURL+'/forms/inmate?act=direct',type:'POST',dataType:'JSON',data:$('#inmate-form').serialize(),
        success:function(result1) {  
          console.log(result1);
          value.attr('disabled',true).text('Send Now');
          $('#message').addClass('has-success').html(result1.message);
          if(result1.status=='Errors') {
            $.each(result1.message, function(i, item) {
                $('#message').append(item);
            });
          }
        }
    });
  });

  $('#login-submit').click(function(){
    var direct = $('.direct').val();
    var value = $(this);
    value.val('Logging...');
    $.ajax({url:'forms/login',type:'POST',dataType:'JSON',data:$('#login-form').serialize(),
      success:function(result){
        console.log(result);
        if(result.status=='Errors') {
          $.each(result.message, function(i, item) {
            $('#'+i).parent().addClass('has-error');
          });
        }
        else if( result.status=='Error') {
          $('#message').addClass('has-error').html(result.message);
        }
        else if(result.status=='Success' && direct=='direct') {
            window.location.reload();
        }
        else if(result.status=='Success') {
          $.ajax({
            url:SITEURL+'/forms/inmate?act=login',type:'POST',dataType:'JSON',data:$('#inmate-form').serialize(),
            success:function(result1) {  
              //console.log(result1);
              $('#message').addClass('has-success').html(result1.message);
              if(result1.status=='Errors') {
                $.each(result1.message, function(i, item) {
                  $('#message').append(item);
                });
              }
            }
          });
        }
        else {
          $('#message').addClass('has-error').html(result);
        }
        value.val('Log In');}})
  });

  $('#register-submit').click(function(){
    var direct = $('.direct').val();
    var value = $(this);
    value.val('Registering...');
    $.ajax({url:SITEURL+'/forms/register',type:'POST',dataType:'JSON',data:$('#register-form').serialize(),success:function(result){
        console.log(result);
        $('.form-group').removeClass('has-error');
        $('#message').removeClass('has-success').html('');
        if(result.status=='Errors') {
          $.each(result.message, function(i, item) {
            $('#'+i).parent().addClass('has-error');
          });
        }
        else if( result.status=='Error') {
          $('#message').addClass('has-error').html(result.message);
        }
        else if(result.status=='Success' && direct=='direct') {
            window.location.reload();
        }
        else if( result.status=='Success') {
          //console.log(  $('#inmate-form').serialize() );
          $.ajax({
            url:SITEURL+'/forms/inmate',type:'POST',dataType:'JSON',data:$('#inmate-form').serialize(),
            success:function(result1) {  console.log(result1);
              $('#message').addClass('has-success').html(result1.message);
              if(result1.status=='Errors') {
                $.each(result1.message, function(i, item) {
                  $('#message').append(item);
                });
              }
            }
          });
        }
        value.val('Register Now');
      }
    });
  });

  $('#profile-submit').click(function(){
    var direct = $('.direct').val();
    var value = $(this);
    value.val('Updating...');
    $.ajax({url:SITEURL+'/forms/profile',type:'POST',dataType:'JSON',data:$('#profile-form').serialize(),success:function(result){
        console.log(result);
        value.val('Update');
        $('.form-group').removeClass('has-error');
        $('#message').removeClass('has-success').html('');
        if(result.status=='Errors') {
          $.each(result.message, function(i, item) {
            $('#'+i).parent().addClass('has-error');
          });
        }
        else if( result.status=='Error') {
          $('#message').addClass('has-error').html(result.message);
        }
        else if( result.status=='Success') {
          $('#profile-form')[0].reset();
          $('#message').addClass('has-success').html(result.message);
        }
      }
    });
  });

  $('#password-submit').click(function(){
    var direct = $('.direct').val();
    var value = $(this);
    value.val('Updating...');
    $.ajax({url:SITEURL+'/forms/password',type:'POST',dataType:'JSON',data:$('#password-form').serialize(),success:function(result){
        console.log(result);
        value.val('Update');
        $('.form-group').removeClass('has-error');
        $('#message').removeClass('has-success').html('');
        if(result.status=='Errors') {
          $.each(result.message, function(i, item) {
            $('#'+i).parent().addClass('has-error');
          });
        }
        else if( result.status=='Error') {
          $('#message').addClass('has-error').html(result.message);
        }
        else if( result.status=='Success') {
          $('#password-form')[0].reset();
          $('#message').addClass('has-success').html(result.message);
        }
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
<?php $conn->close(); ?>
</body>

</html>
