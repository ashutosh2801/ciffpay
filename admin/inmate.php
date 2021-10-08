<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_permission();

if(isset($_GET['id']) && isset($_GET['uid']) && ($_GET['act']=='status')) {
    $status = $_GET['status'] ? 0 : 1;
	$sql = "UPDATE `tbl_inmates` SET `status`=$status WHERE id=".$_GET['id'].";";
	$conn->query($sql);

	if($conn->affected_rows) {
		$_SESSION['msg'] = 'Status has been changed.';
		header('Location: inmate.php?uid='.$_GET['uid']);
		exit;
	}
}

if(isset($_GET['id']) && isset($_GET['uid']) && ($_GET['act']=='delete')) {
	$sql = "DELETE FROM `tbl_inmates` WHERE id=".$_GET['id'].";";
	$conn->query($sql);
	if($conn->affected_rows) {
		$_SESSION['msg'] = 'Record has been deleted.';
		header('Location: inmate.php?uid='.$_GET['uid']);
		exit;
	}
}

if(isset($_GET['id']) && isset($_GET['uid']) && !empty($_GET['tracking_number'])) {
  $sql = "UPDATE tbl_inmates SET tracking_no='".$_GET['tracking_number']."' WHERE id='".intval($_GET['id'])."'";
  if($conn->query($sql)) 
  {
    $sql = "SELECT a.id, concat(a.first_name, ' ', a.last_name) as name, a.email, b.order_id, b.tracking_no, c.price FROM `tbl_users` a, `tbl_inmates` b, tbl_cheques c WHERE a.`id`=".$_GET['uid']." AND b.id=".$_GET['id']." AND b.user_id=a.id AND b.cheque_id=c.id;";
    $result = $conn->query($sql);
    $model = $result->fetch_object();
    if($model) {
      $message = 'Hello '.ucfirst($model->name).',<br><br>

        Your order #'.$model->order_id.' has been transferred.<br><br>

        Tracking number is: '.$model->tracking_no.'<br><br>

        Order amount: 
      
        Thanks & Regards<br><br>
        CIFFPay';
        $data = array(
          'name'    => $model->name, 
          'email'   => $model->email,
          'order_id'   => $model->order_id,
          'tracking_no'   => $model->tracking_no,
          'subject' => 'Your order #'.$model->order_id.' has been transferred.',
          'message' => $message,
        );
                      
        //sendMail($data); //To customer

        $msg = 'Your order '.$model->order_id.' has been transferred.';
        header('Location: inmate.php?uid='.$model->id.'&msg='.$msg);
        exit;
      
    }
    else {
      $msg = 'Something wrong!';
      header('Location: error.php?msg='.$msg);
      exit;
    }
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
<title>Inmate detail :: <?php echo SITENAME; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<link href="css/export.css" rel="stylesheet" type="text/css" media="all" />
<?php require_once('includes/header.php'); ?>
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<style>
.dropbtn { border: none; }
.dropdown { position: relative; display: inline-block; }
.dropdown-content {
    display: none;
    position: absolute;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
		padding:10px;
		background:#fff;
}
.dropdown-content a {
    text-decoration: none;
    display: block;
		padding:8px;
		margin-bottom:5px;
}
.dropdown:hover .dropdown-content {display: block;}
</style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
            <li><a href="customers.php">Customers</a><span>«</span></li>
            <li>List</li>
          </ul>
        </div>
      </div>
      <!-- //breadcrumbs -->

      <div class="inner_content_w3_agile_info two_in">
        <h2 class="w3_inner_tittle"><?php echo $model->first_name; ?>'s Inmate Details</h2>
        <!-- tables -->
        <?php
        if(!empty($_SESSION['msg'])) {
          echo '<div class="alert alert-success">'.$_SESSION['msg'].'</div>';
          $_SESSION['msg']='';
        }
        else if(!empty($_GET['msg'])) {
          echo '<div class="alert alert-success">'.$_GET['msg'].'</div>';
          }
    
        ?>
        <div class="agile-tables">
          <div class="w3l-table-info agile_info_shadow">
            <form action="" method="get" autocomplete="off">
            <input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>" />
            <div class="form-group">
            <div class="row">
              <div class="col-md-3">
              <input type="text" name="q" placeholder="e.g. Name, institute  etc" autocomplete="off" value="<?php echo isset($_GET['q'])?$_GET['q']:''?>" />
              </div>
              <!-- <div class="col-md-3">
              <input type="text" name="date" id="dates" placeholder="Date range" autocomplete="off" value="<?php //echo isset($_GET['date'])?$_GET['date']:''?>" />
              </div> -->
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
                <!-- <tr>
                  <th colspan="9" style="background:#fff">
                    <button type="submit" class="btn btn-success" name="completed"  onClick="return confirm('Do you want to COMPLETE booking?')"><i class="fa fa-check"></i> Mark as complete All</button>
                    <button type="submit" class="btn btn-success" name="export" ><i class="fa fa-file"></i> Export as .CSV</button>
                    </th>
                </tr> -->
                <tr>
                  <th width="20"><input type="checkbox" class="select-all" style="width:18px; height:18px" /></th>
                  <th>Create Date</th>
                  <th>Order No.</th>
                  <th>Tracking No.</th>
                  <th>Name</th>
                  <th>Institute</th>
                  <th>Inmate # </th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $condition = "a.user_id=".$_GET['uid'];
              if(!empty($_GET['q'])) {
                  $condition.= " AND (a.first_name like '%".$_GET['q']."%' OR a.last_name like '%".$_GET['q']."%' OR b.title like '%".$_GET['q']."%')";
              }
              $sql = "SELECT a.*, b.title, c.price FROM `tbl_inmates` a left join tbl_correctional b on a.institute=b.id join tbl_cheques c on c.id=a.cheque_id  WHERE $condition ORDER BY a.id DESC";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_object()) {
              ?>
                <tr bgcolor="#d4e8d4">
                  <td width="20"><input type="checkbox" class="checkbox" name="cust_order[]" style="width:18px; height:18px" value="<?php echo $row->id; ?>" /></td>                  
                  <td><?php echo $row->created_at; ?></td>
                  <td><?php echo $row->order_id; ?></td>
                  <td><?php echo $row->tracking_no; ?></td>
                  <td><?php echo $row->first_name.' '.$row->last_name; ?> </td>
                  <td><?php echo $row->title; ?></td>
                  <td><?php echo $row->inmate_number; ?></td>
                  <td>$<?php echo number_format($row->price,2); ?></td>
                  <td>
                    
                  
                  <a onClick="return confirm('Are you sure?')" href="<?php echo '?id='.$row->id.'&uid='.$row->user_id.'&status='.$row->status.'&act=status"'; echo $row->status?' class="badge badge-success">Paid':' class="badge badge-warning">Pending'; ?></a></td>
                  <td>
                  	<!-- <a href="customer_edit.php?id=<?php echo $row->id; ?>&uid=<?php echo $row->user_id; ?>" class="badge badge-primary"><i class="fa fa-pencil"></i> Edit</a> -->
					          <a href="<?php echo '?id='.$row->id.'&uid='.$row->user_id.'&act=delete"'; ?>" class="badge badge-danger" onClick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</a>
                    <a class="badge badge-success" title="Send FINAL Email" href="#" onclick="return myFunction('inmate.php?id=<?php echo $row->id.'&uid='.$row->user_id; ?>');" class="btn btn-primary">Send FINAL Email</a>
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
<script>
function myFunction(url) {
  var txt;
  var tracking_no = prompt("Please Enter Tracking Number");
  if (tracking_no == null || tracking_no == "") {
    return false;
  } else {
    url = url+'&tracking_number=' + tracking_no;
  }
  window.location.href = url;
}
</script>
</body>
</html>
