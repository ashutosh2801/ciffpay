<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_permission();
$model = array();
if(isset($_POST['name']) && !empty($_POST['name'])) 
{
	extract($_POST);

	$sql = "UPDATE `tbl_email_templates` SET `name`='$name' ,`slug`='$slug', `subject`='$subject', `content`='$content', `description`='$description', `status`='$status' WHERE id=".$_GET['id']; //exit;
	try {
		if ($conn->query($sql) === TRUE) {
			header('Location: email_template_edit.php?id='.$_GET['id'].'&msg=Record updated!');
			exit;
		}

        throw new Exception(''.$conn->error);
	}
	catch(Exception $e){
		echo '<pre>'; print_r($e); exit;
	}
}

$sql = "SELECT * FROM tbl_email_templates WHERE id=".$_GET['id'];
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
<title><?php echo $model->title ?> :: Email Templates :: <?php echo SITENAME; ?></title>
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
                <li><a href="email_templates.php">Email Templates</a><span>«</span></li>
                <li><?php echo $model->name ?> <span>«</span>Update</li>
              </ul>
            </div>
          </div>
          <!-- //breadcrumbs -->
          
        <div class="inner_content_w3_agile_info two_in">
            <h2 class="w3_inner_tittle"> Update <span>«</span> <a href="email_template_add_new.php" class="btn btn-success">Add New</a></h2>
            <?php echo isset($_GET['msg']) ? '<div class="alert alert-success">'.$_GET['msg'].'</div>' : ''; ?>
            <div class="forms-main_agileits">
              <div class="wthree_general graph-form agile_info_shadow ">
                 <div class="grid-1 ">
                      <div class="form-body">
                          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="title" class="col-sm-2 control-label">Title</label>
                              <div class="col-sm-6">
                                <input type="text" required="true" class="form-control1" name="name" placeholder="Name" value="<?php echo $model->name; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="title" class="col-sm-2 control-label">Slug</label>
                              <div class="col-sm-6">
                                <input type="text" required="true" class="form-control1" name="slug" placeholder="Slug" value="<?php echo $model->slug; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="title" class="col-sm-2 control-label">Subject</label>
                              <div class="col-sm-6">
                                <input type="text" required="true" class="form-control1" name="subject" placeholder="Subject" value="<?php echo $model->subject; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="title" class="col-sm-2 control-label">Content</label>
                              <div class="col-sm-6">
                                <textarea required="true" class="form-control1" name="content" placeholder="content"><?php echo $model->content; ?></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="title" class="col-sm-2 control-label">Variables</label>
                              <div class="col-sm-6">
                              <input type="text" required="true" class="form-control1" name="description" placeholder="description" value="<?php echo $model->description; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="type" class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-6">
                                <select name="status" class="form-control1">
                                    <option <?php if($model->status==1) echo 'selected'; ?> value="1">Active</option>
                                    <option <?php if($model->status==0) echo 'selected'; ?> value="0">Inactive</option>
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