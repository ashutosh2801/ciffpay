<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_permission();
$model = array();
if(isset($_POST['submit'])) 
{
    //print_r($_POST); exit;
    foreach($_POST as $key=>$value) {
        $sql = "UPDATE `tbl_options` SET `field_value`='$value' WHERE field_name='$key'"; //exit;
        $conn->query($sql);
    }
	// try {
	// 	if ($conn->query($sql) === TRUE) {
	// 		header('Location: institute_edit.php?uid='.$_GET['uid'].'&msg=Record added!');
	// 		exit;
	// 	}

    //     throw new Exception(''.$conn->error);
	// }
	// catch(Exception $e){
	// 	echo '<pre>'; print_r($e); exit;
	// }
}
?>
<!DOCTYPE html>
<html lang="en">                    
<head>
<title>Page Options :: <?php echo SITENAME; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<link href="css/export.css" rel="stylesheet" type="text/css" media="all" />
<?php require_once('includes/header.php'); ?>
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<link href="summernote/summernote.css" rel="stylesheet" type="text/css" media="all" />
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
                <li>Page Options <span>«</span>Update</li>
              </ul>
            </div>
          </div>
          <!-- //breadcrumbs -->
          
        <div class="inner_content_w3_agile_info two_in">
            <h2 class="w3_inner_tittle">Page Options Update</h2>
            <?php echo isset($_GET['msg']) ? '<div class="alert alert-success">'.$_GET['msg'].'</div>' : ''; ?>
            <div class="forms-main_agileits">
              <div class="wthree_general graph-form agile_info_shadow ">
                 <div class="grid-1 ">
                      <div class="form-body">
                          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            
                          <?php
                            $sql = "SELECT * FROM `tbl_options`";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_object()) {
                            ?>  
                          <div class="form-group">
                              <label for="<?php echo $row->field_name; ?>" class="col-sm-2 control-label"><?php echo ucwords(str_replace("_"," ",$row->field_name)); ?></label>
                              <div class="col-sm-6">
                                <textarea rows="2" required="true" class="form-control1" id="<?php echo $row->field_name; ?>" name="<?php echo $row->field_name; ?>" placeholder="<?php echo ucwords(str_replace("_"," ",$row->field_name)); ?>"><?php echo $row->field_value; ?></textarea>
                                <?php echo ($row->field_name=='price') ? '<em>Enter price value with comma separated.</em>' : ''; ?>
                              </div>
                            </div>

                            <?php } } ?>
                            
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
<script type="text/javascript" src="summernote/summernote.js"></script>
<script type="text/javascript">
$(function() {
  $('textarea').summernote({
		height: 250,
  });
});
</script>
</body>
</html>