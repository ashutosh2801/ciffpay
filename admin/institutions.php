<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_permission();

if(isset($_GET['uid']) && ($_GET['act']=='delete')) {
	$sql = "DELETE FROM `tbl_correctional` WHERE id=".$_GET['uid'].";";
	$conn->query($sql);
	if($conn->affected_rows) {
		$_SESSION['msg'] = 'Record has been deleted.';
		header('Location: institutions.php');
		exit;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Institutions :: <?php echo SITENAME; ?></title>
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
    <div class="w3_agileits_top_nav">
        <?php require_once('includes/leftbar.php'); ?>
    </div>

    <div class="clearfix"></div>
    <div class="inner_content">
      <!-- breadcrumbs -->
      <div class="w3l_agileits_breadcrumbs">
        <div class="w3l_agileits_breadcrumbs_inner">
          <ul>
            <li><a href="index.php">Dashboard</a><span>«</span></li>
            <li><a href="institutions.php">Institutions</a><span>«</span></li>
            <li>List</li>
          </ul>
        </div>
      </div>
      <!-- //breadcrumbs -->

      <div class="inner_content_w3_agile_info two_in">
        <h2 class="w3_inner_tittle">Institutions <a href="institute_add_new.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a></h2>
        <!-- tables -->
        <?php
        if(!empty($_SESSION['msg'])) {
          echo '<div class="alert alert-success">'.$_SESSION['msg'].'</div>';
          $_SESSION['msg']='';
        }
        ?>
        <div class="agile-tables">
          <div class="w3l-table-info agile_info_shadow">
            <form action="" method="get" autocomplete="off">
            <div class="form-group">
            <div class="row">
              <div class="col-md-3">
              <input type="text" name="q" placeholder="e.g. title etc" autocomplete="off" value="<?php echo isset($_GET['q'])?$_GET['q']:''?>" />
              </div>
              <div class="col-md-3">
                  <div style="margin-top:8px;">
                    <button type="submit" class="btn btn-success btn-flat btn-pri"><i class="fa fa-search" aria-hidden="true"></i> Search </button>
                  </div>
              </div>
            </div>
            </div>
            </form>
            <form action="" method="post">
            <table id="table"  class="table">
              <thead>
                <tr>
                  <th width="20"><input type="checkbox" class="select-all" style="width:18px; height:18px" /></th>
                  <th>Title</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php
			  $condition='';
              if(!empty($_GET['q'])) {
                  $condition = " WHERE (
					  	title like '%".$_GET['q']."%' 
						OR type like '%".$_GET['q']."%' 
				  )";
              }
              $sql = "SELECT * FROM `tbl_correctional` $condition order by title";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_object()) {
              ?>
                <tr bgcolor="#d4e8d4">
                  <td width="20"><input type="checkbox" class="checkbox" name="cust_order[]" style="width:18px; height:18px" value="<?php echo $row->id; ?>" /></td>                  
                  <td><?php echo $row->title; ?></td>
                  <td><?php echo $row->type; ?></td>
                  <td><?php echo $row->status?'<a class="badge badge-success">Active</a>':'<a class="badge badge-warning">Inactive</a>'; ?></td>
                  <td>
                  	<a href="institute_edit.php?uid=<?php echo $row->id; ?>" class="badge badge-primary"><i class="fa fa-pencil"></i> Edit</a>
					          <a href="?uid=<?php echo $row->id; ?>&act=delete" class="badge badge-danger" onClick="return confirm('Are you sure? You will loss all the data!')"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                </tr>
              <?php
              }
              } else {
                  echo "<tr><td colspan='6'>No records found.</td></tr>";
              }
              ?>
              </tbody>
            </table>
            </form>
          </div>
        </div>
        <!-- //tables -->
      </div>
    <!-- //inner_content_w3_agile_info-->
    </div>
		<!-- //inner_content-->
</div>
<!-- banner -->

<?php require_once('includes/footer.php'); ?>
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	//$('#table').basictable();
	$(".select-all").click(function () {
     $('.checkbox').not(this).prop('checked', this.checked);
	});
	$('#dates').daterangepicker({
		locale: {
      format: 'YYYY-MM-DD'
    },
		ranges: {
			 'Today': [moment(), moment()],
			 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			 'This Month': [moment().startOf('month'), moment().endOf('month')],
			 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		}
	});
});
</script>
</body>
</html>
