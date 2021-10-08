<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_permission();
$model = array();
if(isset($_POST['email'])) {

	extract($_POST);
	
	if($_FILES['profile_image']['name']) {
		$target_dir 	= "../uploads/profile/";
		$extension 		= strtolower(pathinfo($_FILES["profile_image"]["name"],PATHINFO_EXTENSION));
		$profile_image = date('Ymdhis').".$extension";
		$target_file 	= $target_dir . $profile_image;
		move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
		$sql2 = "`profile_image`='".addslashes($profile_image)."',";
	}
	
	$user_id = $_COOKIE['admin_user_id'];

	$sql = "UPDATE `tbl_users` SET `email`='$email', `password`='".md5($password)."', $sql2 `first_name`='$first_name', `last_name`='$last_name', `status`=1 WHERE id=".$user_id.";";
	try {
		if ($conn->query($sql) === TRUE) {
			header('Location: profile.php?msg=Record updated!');
			exit;
		}
	}
	catch(Exception $e){
		print_r($e); exit;
	}
}

//$_SESSION['user_id'];
                $user_id = $_COOKIE['admin_user_id'];

$sql = "SELECT * FROM tbl_users WHERE ID=".$user_id;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$model = $result->fetch_object();
} else {
	$msg = 'Invalid ID!';
	header('Location: error.php?msg='.$msg);
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">                    
<head>
<title>Profile :: <?php echo SITENAME; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<link href="css/export.css" rel="stylesheet" type="text/css" media="all" />
<?php require_once('includes/header.php'); ?>
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
</head>
<body>

<!-- banner -->
<div class="wthree_agile_admin_info">
		<!-- /w3_agileits_top_nav-->
		<!-- /nav-->
		<div class="w3_agileits_top_nav">
			<?php require_once('includes/leftbar.php'); ?>
		</div>
		<!-- //nav -->
			
		<div class="clearfix"></div>
		<!-- //w3_agileits_top_nav-->
		<!-- /inner_content-->
				<div class="inner_content">
        <!-- /inner_content_w3_agile_info-->
        
          <!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li><a href="index.php">Dashboard</a><span>«</span></li>
                <li><a href="profile.php">Profile</a><span>«</span></li>
                <li>Update</li>
              </ul>
            </div>
          </div>
          <!-- //breadcrumbs -->
          
					<div class="inner_content_w3_agile_info two_in">
					  <h2 class="w3_inner_tittle">View [<?php echo $model->first_name; ?>]</h2>
            <?php echo isset($_GET['msg']) ? '<div class="alert alert-success">'.$_GET['msg'].'</div>' : ''; ?>
            <div class="forms-main_agileits">
              <div class="wthree_general graph-form agile_info_shadow ">
                 <div class="grid-1 ">
                      <div class="form-body">
                          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                              <label for="name" class="col-sm-2 control-label">First Name</label>
                              <div class="col-sm-6">
                                <input type="text" required="true" class="form-control1" placeholder="First Name" name="first_name"  value="<?php echo $model->first_name; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="name" class="col-sm-2 control-label">Last Name</label>
                              <div class="col-sm-6">
                                <input type="text" required="true" class="form-control1" placeholder="Last Name" name="last_name"  value="<?php echo $model->last_name; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="email" class="col-sm-2 control-label">Email</label>
                              <div class="col-sm-6">
                                <input type="text" required="true" class="form-control1" name="email" placeholder="Email" value="<?php echo $model->email; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="password" class="col-sm-2 control-label">Password</label>
                              <div class="col-sm-6">
                                <input type="password" class="form-control1" name="password" placeholder="Password"  value="">
                              </div>
                            </div>
                            
                            

                            <div class="form-group">
                              <label for="profile_image" class="col-sm-2 control-label">Profile Image</label>
                              <div class="col-sm-6">
                                <input class="form-control1" name="profile_image" id="profile_image" type="file"> 
								<?php
								$image = !empty($model->profile_image) ? $model->profile_image : 'na'; 
                                if(file_exists("../uploads/profile/".$image)) {
								?><br>
								<img src="<?="../uploads/profile/".$image; ?>" alt="<?=$image; ?>" class="img-responsive img-rounded" />
								<?php
                                }
                                ?>
    
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-sm-2 control-label"> </label>
                              <div class="col-sm-8">
                                <button type="submit" name="submit" class="btn btn-success btn-flat btn-pri"><i class="fa fa-pencil" aria-hidden="true"></i> Update</button>
                              </div>
                            </div>
                          </form>
                      </div>
                  </div>
              </div>
        		</div>
          </div>  
        <!-- //inner_content_w3_agile_info-->
				</div>
		<!-- //inner_content-->
	</div>
<!-- banner -->

<?php require_once('includes/footer.php'); ?>
</body>
</html>