<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_permission();
$model = array();
if(isset($_POST['title']) && !empty($_POST['title'])) 
{
	extract($_POST);

	$sql = "INSERT INTO `tbl_correctional` (`title`,`type`) VALUES( '$title','$type' )"; //exit;
	try {
		if ($conn->query($sql) === TRUE) {
			header('Location: institute_edit.php?uid='.$conn->insert_id.'&msg=Record added!');
			exit;
		}

        throw new Exception(''.$conn->error);
	}
	catch(Exception $e){
		echo '<pre>'; print_r($e); exit;
	}
}

?>
<!DOCTYPE html>
<html lang="en">                    
<head>
<title>Add New Institute :: <?php echo SITENAME; ?></title>
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
                <li><a href="institutions.php">Institutions</a><span>«</span></li>
                <li>Add New Institute</li>
              </ul>
            </div>
          </div>
          <!-- //breadcrumbs -->
          
        <div class="inner_content_w3_agile_info two_in">
            <h2 class="w3_inner_tittle">Add New Institute</h2>
            <?php echo isset($_GET['msg']) ? '<div class="alert alert-success">'.$_GET['msg'].'</div>' : ''; ?>
            <div class="forms-main_agileits">
              <div class="wthree_general graph-form agile_info_shadow ">
                 <div class="grid-1 ">
                      <div class="form-body">
                          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="title" class="col-sm-2 control-label">Title</label>
                              <div class="col-sm-6">
                                <input type="text" required="true" class="form-control1" name="title" placeholder="Title" value="<?php echo $model->title; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="type" class="col-sm-2 control-label">Type</label>
                              <div class="col-sm-6">
                                <select name="type" class="form-control1">
                                    <option <?php if($model->type=='Provincial') echo 'selected'; ?> value="Provincial">Provincial</option>
                                    <option <?php if($model->type=='Federal') echo 'selected'; ?> value="Federal">Federal</option>
                                </select>
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