<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_permission();
$model = array();
if(isset($_POST['title']) && !empty($_POST['title'])) 
{
	extract($_POST);

	$sql = "UPDATE `tbl_faqs` SET `title`='$title', `content`='$content', `title_fr`='$title_fr', `content_fr`='$content_fr', `status`='$status' WHERE id=".$_GET['id']; //exit;
	try {
		if ($conn->query($sql) === TRUE) {
			header('Location: faq_edit.php?id='.$_GET['id'].'&msg=Record updated!');
			exit;
		}

        throw new Exception(''.$conn->error);
	}
	catch(Exception $e){
		echo '<pre>'; print_r($e); exit;
	}
}

$sql = "SELECT * FROM tbl_faqs WHERE id=".$_GET['id'];
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
<title><?php echo $model->title ?> :: FAQs :: <?php echo SITENAME; ?></title>
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
                <li><a href="index.php">Dashboard</a><span>??</span></li>
                <li><a href="faqs.php">FAQs</a><span>??</span></li>
                <li><?php echo $model->title ?> <span>??</span>Update</li>
              </ul>
            </div>
          </div>
          <!-- //breadcrumbs -->
          
        <div class="inner_content_w3_agile_info two_in">
            <h2 class="w3_inner_tittle"> Update <span>??</span> <a href="faq_add_new.php" class="btn btn-success">Add New</a></h2>
            <?php echo isset($_GET['msg']) ? '<div class="alert alert-success">'.$_GET['msg'].'</div>' : ''; ?>
            <div class="forms-main_agileits">
              <div class="wthree_general graph-form agile_info_shadow ">
                 <div class="grid-1 ">
                      <div class="form-body">
                          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                              <label for="type" class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-6">
                                <select name="status" class="form-control1">
                                    <option <?php if($model->status==1) echo 'selected'; ?> value="1">Active</option>
                                    <option <?php if($model->status==0) echo 'selected'; ?> value="0">Inactive</option>
                                </select>
                              </div>
                            </div>
                          <h2>English</h2>  
                            <div class="form-group">
                              <label for="title" class="col-sm-2 control-label">Title</label>
                              <div class="col-sm-6">
                                <input type="text" required="true" class="form-control1" name="title" placeholder="Title" value="<?php echo $model->title; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="title" class="col-sm-2 control-label">Content</label>
                              <div class="col-sm-6">
                                <textarea class="form-control1" name="content" placeholder="content"><?php echo $model->content; ?></textarea>
                              </div>
                            </div>
                            <h2>French</h2>
                            <div class="form-group">
                              <label for="title" class="col-sm-2 control-label">Title</label>
                              <div class="col-sm-6">
                                <input type="text" required="true" class="form-control1" name="title_fr" placeholder="Title" value="<?php echo $model->title_fr; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="title" class="col-sm-2 control-label">Content</label>
                              <div class="col-sm-6">
                                <textarea class="form-control1" name="content_fr" placeholder="content"><?php echo $model->content_fr; ?></textarea>
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

<script type="text/javascript" src="summernote/summernote.js"></script>
<script type="text/javascript">
$(function() {
  $('textarea').summernote({
		height: 300,
  });
});
</script>

</body>
</html>