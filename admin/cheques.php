<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_permission();

if( ($_GET['act']=='delete') && !empty($_GET['id'])) 
{
    $sql = "DELETE FROM `tbl_cheques` WHERE id=".$_GET['id']; //exit;
	try {
		if ($conn->query($sql) === TRUE) {
			header('Location: cheques.php?msg=Record deleted!');
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

        <!-- breadcrumbs -->
        <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
            <ul>
                <li><a href="index.php">Dashboard</a><span>«</span></li>
                <li><a href="cheques.php">Cheques</a><span>«</span></li>
                <li>List</li>
            </ul>
            </div>
        </div>
        <!-- //breadcrumbs -->

            <!-- /inner_content_w3_agile_info-->
            <div class="inner_content_w3_agile_info">
                <h2 class="w3_inner_tittle">All Cheques <span>«</span> <a href="cheque_add_new.php" class="btn btn-success">Add New</a></h2>
                <?php echo isset($_GET['msg']) ? '<div class="alert alert-success">'.$_GET['msg'].'</div>' : ''; ?>
				<!-- /agile_top_w3_grids-->
				<div class="agile_top_w3_grids">
					    <ul class="ca-menu" style="overflow:auto">

                        <?php
                        $sql = "SELECT * FROM `tbl_cheques` ORDER BY price DESC";
                        $result = $conn->query($sql);
                        //echo $result->num_rows ? $result->num_rows : 0;
                        while( $row = $result->fetch_object() ) {

                        ?>
                        <li>
                            <div class='hover'>
                                <a class="btn btn-sm btn-danger" href="cheques.php?id=<?php echo $row->id; ?>&act=delete" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <a class="btn btn-sm btn-success" href="cheque_edit.php?id=<?php echo $row->id; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </div>
                            <a href="cheque_edit.php?id=<?php echo $row->id; ?>">
                                <i class="fa fa-dollar" aria-hidden="true"><?php echo $row->price; ?></i>
                                <div class="ca-content">
                                    <h4 class="ca-main one"><?php echo $row->count; ?></h4>
                                    <!-- <h3 class="ca-sub two">All Cheque</h3> -->
                                </div>
                            </a>
                        </li>
                        <?php } ?>
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