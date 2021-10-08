<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_permission();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Dashboard :: <?php echo SITENAME; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<link href="css/export.css" rel="stylesheet" type="text/css" media="all" />
<?php require_once('includes/header.php'); ?>
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
					<div class="inner_content_w3_agile_info">
							<!-- /agile_top_w3_grids-->
					   	<div class="agile_top_w3_grids">
					      <ul class="ca-menu" style="overflow:auto">

						  			<li>
										<a href="setting.php">
										  <i class="fa fa-gear" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main two">
1
                        						</h4>
												<h3 class="ca-sub one">Home Page & Setting</h3>
											</div>
										</a>
									</li>

									<li>
										<a href="customers.php">
										  <i class="fa fa-users" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main three">
                        						<?php
												$sql = "SELECT id FROM `tbl_users` where role=2 ORDER BY id DESC";
												$result = $conn->query($sql);
												echo $result->num_rows ? $result->num_rows : 0;
												?>
                        						</h4>
												<h3 class="ca-sub">Customers</h3>
											</div>
										</a>
									</li>

									<li>
										<a href="cheques.php">
										  <i class="fa fa-dollar" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main">
                        						<?php
												$sql = "SELECT id FROM `tbl_cheques` ORDER BY id DESC";
												$result = $conn->query($sql);
												echo $result->num_rows ? $result->num_rows : 0;
												?>
                        						</h4>
												<h3 class="ca-sub three">Cheques Inventory</h3>
											</div>
										</a>
									</li>

									<li>
										<a href="institutions.php">
										  <i class="fa fa-building" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main one">
                        						<?php
												$sql = "SELECT * FROM `tbl_correctional` cd WHERE 1 ORDER BY title ASC";
												$result = $conn->query($sql);
												echo $result->num_rows;
												?>
                        						</h4>
												<h3 class="ca-sub two">All Institutions</h3>
											</div>
										</a>
									</li>
                  
									<li>
										<a href="pages.php">
										  <i class="fa fa-file-o" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main">
                        						<?php
												$sql = "SELECT id FROM `tbl_pages` ORDER BY id DESC";
												$result = $conn->query($sql);
												echo $result->num_rows ? $result->num_rows : 0;
												?>
                        						</h4>
												<h3 class="ca-sub three">All Pages</h3>
											</div>
										</a>
									</li>


									<li>
										<a href="email_templates.php">
										  <i class="fa fa-envelope" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main three">
                        						<?php
												$sql = "SELECT id FROM `tbl_email_templates`";
												$result = $conn->query($sql);
												echo $result->num_rows ? $result->num_rows : 0;
												?>
                        						</h4>
												<h3 class="ca-sub">Email Templates</h3>
											</div>
										</a>
									</li>

									<li>
										<a href="faqs.php">
										  <i class="fa fa-list" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main two">
                        						<?php
												$sql = "SELECT id FROM `tbl_faqs`";
												$result = $conn->query($sql);
												echo $result->num_rows ? $result->num_rows : 0;
												?>
                        						</h4>
												<h3 class="ca-sub">FAQs</h3>
											</div>
										</a>
									</li>
                  
                  
                </ul>  
                
					   	</div>
					 		<!-- //agile_top_w3_grids-->
							
						<!-- //social_media-->
				    </div>
					<!-- //inner_content_w3_agile_info-->
				</div>
		<!-- //inner_content-->
	</div>
<!-- banner -->

<?php require_once('includes/footer.php'); ?>

</body>
</html>