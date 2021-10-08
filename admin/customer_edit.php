<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_permission();
$model = array();
if(isset($_POST['email'])) {

	extract($_POST);

	$sql = "UPDATE `tbl_users` SET 
                `email`='$email', 
                `password`='".md5($password)."', 
                `first_name`='$first_name', 
                `last_name`='$last_name', 
                `street_number`='$street_number', 
                `street_name`='$street_name', 
                `unit`='$unit', 
                `city`='$city', 
                `province`='$province', 
                `postal_code`='$postal_code', 
                `status`=1 
                WHERE id=".$_GET['uid'].";"; //exit;
	try {
		if ($conn->query($sql) === TRUE) {
			header('Location: customer_edit.php?uid='.$_GET['uid'].'&msg=Record updated!');
			exit;
		}
	}
	catch(Exception $e){
		print_r($e); exit;
	}
}

$sql = "SELECT * FROM tbl_users WHERE id=".$_GET['uid'];
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
<title><?php echo $model->first_name; ?> :: <?php echo SITENAME; ?></title>
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
                <li><a href="customers.php">Customers</a><span>«</span></li>
                <li><?php echo $model->first_name; ?> <span>«</span>Update</li>
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
                                <label for="name" class="col-sm-2 control-label"></label>
                                <div class="col-sm-6"><h3>Sender Mailing Address</h3></div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Street Number</label>
                                <div class="col-sm-6">
									<input type="number" name="street_number" id="street_number" tabindex="7" class="form-control" placeholder="Sender street number" value="<?php echo $model->street_number; ?>">
								</div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Street Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="street_name" id="street_name" tabindex="9" class="form-control" placeholder="Sender street name" value="<?php echo $model->street_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Unit</label>
                                <div class="col-sm-6">
										<input type="text" name="unit" id="unit" tabindex="8" class="form-control" placeholder="Sender Unit/Apt Number" value="<?php echo $model->unit; ?>">
									</div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">City</label>
                                <div class="col-sm-6">
                                    <input type="text" name="city" id="city" tabindex="10" class="form-control" placeholder="Sender city" value="<?php echo $model->city; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Province</label>
                                <div class="col-sm-6">
                                    <input type="text" name="province" id="province" tabindex="11" class="form-control" placeholder="Sender province" value="<?php echo $model->province; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Postal Code</label>
                                <div class="col-sm-6">
                                    <input type="text" name="postal_code" id="postal_code" maxlength="12" tabindex="6" class="form-control" placeholder="Sender Postal Code/Zipcode" value="<?php echo $model->postal_code; ?>" />
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