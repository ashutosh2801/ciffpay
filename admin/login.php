<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_login();
$msg = '';
if(isset($_POST['login'])) {
	$email 		= ($_POST['email']);
	$password = ($_POST['password']);
	$sql 	= "SELECT * FROM tbl_users WHERE email='".$email."' AND password='".md5($password)."' AND status=1 AND role=1";
	//exit;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$model = $result->fetch_object();
		setcookie('admin_user_id', $model->id, time() + (86400 * 30), "/");
		$_SESSION['user_id'] = $model->id;
		//echo $_SESSION['user_id']; exit;
		//print_r($model); exit;
		header('Location: index.php');
		exit;
	} else {
			$msg = 'Invalid email or password!';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Login  :: <?php echo SITENAME; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<?php require_once('includes/header.php'); ?>
</head>
<body>
<!-- banner -->
<div class="wthree_agile_admin_info">
    <!-- /w3_agileits_top_nav-->
    <!-- /nav-->
    <div class="w3_agileits_top_nav">
      <ul id="gn-menu" class="gn-menu-main">
  
        <!-- //nav_agile_w3l -->
       
  
      </ul>
      <!-- //nav -->
    </div>
		<div class="clearfix"></div>
		<!-- //w3_agileits_top_nav-->
		
		<!-- /inner_content-->
		<div class="inner_content">
				    <!-- /inner_content_w3_agile_info-->
					<div class="inner_content_w3_agile_info">

							<div class="registration admin_agile">
								
                  <div class="signin-form profile admin">
                    <h2>Admin Login</h2>
                    <?php
                    if($msg) {
											echo '<div class="alert alert-danger">'.$msg.'</div>';
											$msg = '';
										}
										?>
                    <div class="login-form">
                      <form action="login.php" method="post">
                        <input type="text" name="email" required="" placeholder="Email">
                        <input type="password" name="password" required="" placeholder="******">
                        <div class="tp">
                          <input type="submit" name="login" value="LOGIN">
                        </div>
                      </form>
                    </div>
                  
                    <h6><a href="https://toniagaratour.com">Back To Home</a></h6>
                  </div>
				    </div>
					<!-- //inner_content_w3_agile_info-->
				</div>
		<!-- //inner_content-->
	</div>
</div>
<?php require_once('includes/footer.php'); ?>
<!-- banner -->

</body>
</html>