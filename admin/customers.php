<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_permission();

if(isset($_GET['uid']) && ($_GET['act']=='delete')) {
	$sql = "DELETE FROM `tbl_users` WHERE id=".$_GET['uid'].";";
	$conn->query($sql);
	if($conn->affected_rows) {

		$sql = "DELETE FROM `tbl_inmates` WHERE user_id=".$_GET['uid'].";";
		$conn->query($sql);

		
		$_SESSION['msg'] = 'Record has been deleted.';
		header('Location: inmate.php?uid='.$_GET['uid']);
		exit;
	}
}

/*
if(isset($_POST['cust_order']) && isset($_POST['completed'])) {
	foreach($_POST['cust_order'] as $id) {
		$sql = "UPDATE `".PREFIX."customers` SET `status`=4 WHERE id=".$id.";";
		$conn->query($sql);

		$sql = "UPDATE `".PREFIX."customer_detail` SET `tour_complete`=1 WHERE user_id=".$id.";";
		$conn->query($sql);
	}
	$_SESSION['msg'] = 'Booking has been updated!';
	header('Location: customers_confirm.php');
	exit;
}

if(isset($_GET['id']) && ($_GET['act']=='complete')) {
	$sql = "UPDATE `".PREFIX."customers` SET `status`=4 WHERE id=".$_GET['id'].";";
	$conn->query($sql);

	$sql = "UPDATE `".PREFIX."customer_detail` SET `tour_complete`=1 WHERE user_id=".$_GET['id'].";";
	$conn->query($sql);

	if($conn->affected_rows) {
		$_SESSION['msg'] = 'Booking has been completed.';
		header('Location: customers_confirm.php');
		exit;
	}
}
if( isset($_POST['export']) ) 
{
	$delimiter = ",";
	$filename = "confirmed-tour.csv";
	$output = fopen("php://memory", "w");

	$fields = array('ORDER ID', 'CREATED DATE', 'CUSTOMER NAME', 'CUSTOMER EMAIL', 'CUSTOMER PHONE', 'SOURCE', 'STATUS', 'TOUR DATE', 'TOUR TITLE', 'PICKUP LOCATION', 'TOUR DETAIL', 'TOUR ADD ONS', 'SUB TOTAL', 'TAX', 'GRATUITY', 'TOTAL');
	fputcsv($output, $fields, $delimiter);

	$condition = "c.id=cd.user_id AND c.status=2 AND cd.tour_date>='".date('Y-m-d')."'";
	if(!empty($_POST['q'])) {
		$condition.= " AND (c.order_id like '%".$_POST['q']."%' OR cd.name like '%".$_POST['q']."%' OR cd.phone like '%".$_GET['q']."%' OR cd.email like '%".$_POST['q']."%')";
	}
	if(!empty($_POST['date'])) {
		$explode = explode(" - ",$_POST['date']);
		$condition.= " AND cd.tour_date>'".$explode[0]."' AND cd.tour_date<='".$explode[1]."'";
	}

	$sql = "SELECT c.id, c.status, c.order_id, c.created_date, cd.* FROM `".PREFIX."customers` c, `".PREFIX."customer_detail` cd WHERE $condition ORDER BY cd.tour_date ASC";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_object()) {

			$source = '';
			if($row->url_string) {
				$url_string = json_decode($row->url_string);
				$source = $url_string->utm_source;
				//if($url_string->utm_source=='cj')
				//$source = 'CJ';
			}

			$str='';
			if($row->adults && $row->price_type=='person') {
				$str.= $row->adults.' adults X $'.$row->adults_price.' = $'.($row->adults*$row->adults_price).',';
			} else if($row->adults && $row->price_type=='group') {
				$str.= $row->adults.' adults = $'.($row->adults_price).',';
			}

			if($row->children) {
				$str.= $row->children.' children X $'.$row->children_price.' = $'.($row->children*$row->children_price).',';
			}
			if($row->seniors) {
				$str.= $row->seniors.' seniors X $'.$row->seniors_price.' = $'.($row->seniors*$row->seniors_price).',';
			} if($row->infants) {
				$str.= $row->infants.' infants X $'.$row->infants_price.' = $'.($row->infants*$row->infants_price);
			}
			$str = substr($str,0,-1);

			$addons = '';
			if(!empty($row->add_ons)) {
				$sql2 = "SELECT * FROM `".PREFIX."add_ons` WHERE addons_id IN (".$row->add_ons.")";
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0) {
					$k = 0;
					$add_ons_nom = explode(",",$row->add_ons_nom);
					while($row2 = $result2->fetch_object()) {
						$addons.= $row2->addons_title . " (".$add_ons_nom[$k].") " ." = $". $add_ons_nom[$k++]*$row2->addons_price.',';
					}
				}
			}
			$addons = substr($addons,0,-1);

			$tour_detail = tour_detail($conn, $row->tour_id);

			$status 			= $row->status ? 'Paid' : 'Balance';
			$order_id 		= $row->order_id;
			$created_date	= $row->created_date;
			$name 				= $row->name;
			$email 				= $row->email;
			$phone 				= $row->phone;
			$tour_date		= $row->tour_date;
			$title				= $tour_detail->title;
			$pic_location	= $row->pickup_location;
			$subtotal 		= '$'.number_format($row->subtotal,2);
			$tax 					= '$'.number_format($row->tax,2);
			$gratuity_amt = '$'.number_format($row->gratuity_amt,2);
			$total 				= '$'.number_format($row->total,2);

			$lineData = array($order_id, $created_date, $name, $email, $phone, $source, $status, $tour_date, $title, $pic_location, $str, $addons, $subtotal, $tax, $gratuity_amt, $total);
			fputcsv($output, $lineData, $delimiter);
		}
	}

	//move back to beginning of file
	fseek($output, 0);

	//set headers to download file rather than displayed
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="' . $filename . '";');

	//output all remaining data on a file pointer
	fpassthru($output);
	exit;
}
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>All Customers :: <?php echo SITENAME; ?></title>
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
        <h2 class="w3_inner_tittle">All Customers</h2>
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
            <div class="form-group">
            <div class="row">
              <div class="col-md-3">
              <input type="text" name="q" placeholder="e.g. Name, phone, email, order id etc" autocomplete="off" value="<?php echo isset($_GET['q'])?$_GET['q']:''?>" />
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
                  <th>Created Date</th>
                  <th>Customer Detail</th>
                  <th>Customer Mailing Detail</th>
                  <th>Inmates </th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php
			  $condition='';
              if(!empty($_GET['q'])) {
                  $condition = " WHERE (
					  	a.first_name like '%".$_GET['q']."%' 
						OR a.last_name like '%".$_GET['q']."%' 
						OR a.phone_number like '%".$_GET['q']."%' 
						OR a.email like '%".$_GET['q']."%'
				  )";
              }
              $sql = "SELECT a.*, count(b.user_id) as total FROM `tbl_users` a left join tbl_inmates b on a.id=b.user_id $condition GROUP BY b.user_id order by a.id";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_object()) {
              ?>
                <tr bgcolor="#d4e8d4">
                  <td width="20"><input type="checkbox" class="checkbox" name="cust_order[]" style="width:18px; height:18px" value="<?php echo $row->id; ?>" /></td>                  
                  <td><?php echo $row->created; ?></td>
                  <td><?php echo $row->first_name.' '.$row->last_name; ?> <br />[<a href="tel:<?php echo $row->phone_number; ?>"><?php echo $row->phone_number; ?></a>] <br /><a href="<?php echo $row->email; ?>"><?php echo $row->email; ?></a></td>
                  <td><?php echo $row->street_number . ' '. $row->street_name . ', <br>'.$row->city . ', '.$row->province . ', '.$row->postal_code; ?></td>
                  <td><a href="inmate.php?uid=<?php echo $row->id; ?>"><?php echo $row->total; ?></a></td>
                  <td><?php echo $row->status?'<a class="badge badge-success">Active</a>':'<a class="badge badge-warning">Inactive</a>'; ?></td>
                  <td>
                  	<a href="customer_edit.php?uid=<?php echo $row->id; ?>" class="badge badge-primary"><i class="fa fa-pencil"></i> Edit</a>
					<a href="?uid=<?php echo $row->id; ?>&act=delete" class="badge badge-danger" onClick="return confirm('Are you sure? You will loss all the data!')"><i class="fa fa-trash"></i> Delete</a>
                    <!-- <a href="?id=<?php echo $row->id; ?>&act=complete" class="badge badge-success" onClick="return confirm('Do you want to create Mark as COMPLETED?')"><i class="fa fa-check"></i> Mark as sent</a> -->
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
