<?php
function check_permission() {
	if(!isset($_SESSION['user_id'])) {
		header("Location: login.php");
		exit;
	}
}

function slug($string) {
	return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function check_if_paid($conn, $cust_id, $tour_id, $agent_id) {
	$total1 = $total2 = 0;
	$sql = "SELECT * FROM `tour_user_paid` WHERE agent_id='".$agent_id."' AND customer_id='".$cust_id."' AND tour_id='".$tour_id."' AND is_paid=1;";
	$query = $conn->query($sql);
	if($query->num_rows > 0 ) {
		return '<a class="badge badge-success">Paid<a>';
	}
	return '<a class="badge badge-warning">Unpaid</a>';
}

function balance($conn, $user_id) {
	
	$total1 = $total2 = 0;
	$sql = "SELECT c.id, c.status, c.created_date, cd.*, t.ID, t.title, t.sub_title, t.slug, t.tour_thumb, t.currency, t.price_type, t.gratuity FROM `tour_customers` c, `tour_customer_detail_copy` cd, `tour_tours` t WHERE c.id=cd.user_id AND cd.user_id='".$user_id."' AND cd.tour_id=t.ID;";
	$query = $conn->query($sql);
	if($query->num_rows > 0 ) {
		$sub_total = $tax = $total = 0;
		while($model = $query->fetch_object()) {
			$total1+= $model->total;
		}
	}
	
	$sql3 = "SELECT c.id, c.status, c.order_id, c.created_date, cd.*, t.ID, t.title, t.sub_title, t.slug, t.tour_thumb, t.price_type FROM `".PREFIX."customers` c, `".PREFIX."customer_detail` cd, ".PREFIX."tours t WHERE c.id=".$user_id." AND  c.id=cd.user_id AND cd.tour_id=t.ID AND c.status=1 ORDER BY cd.tour_date DESC";
	$query3 = $conn->query($sql3);
	if($query3->num_rows > 0 ) {
		while($row3 = $query3->fetch_object()) {
			$total2+= $row3->total;
		}
	}
	$total = $total1 ? $total2 - $total1 : 0;
	return $total;
}

function query_all($conn, $table, $where=1, $order='`order` ASC') {
	$sql = "SELECT * FROM $table WHERE $where ORDER BY $order";
	$result = $conn->query($sql);
	return $result;
}

function currency($conn, $price, $from='CA', $to='CA') {
	if( (strtoupper($from)=='US') && (strtoupper($to)=='CA') ) {
		$sql = "SELECT * FROM `tour_options` WHERE name='USDCAD' LIMIT 1";
		$query = $conn->query($sql);
		if($query->num_rows > 0 ) {
			$res = $query->fetch_object();
			$price = round(($price * $res->value),2);
		}
	}
	return $price;
}

function tour_urlMap($country, $slug) {
	$country = urlMap($country);
	return SITEURL."/$country/$slug";
}

function urlMap($name) {
	return $str = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));	
}

function count_row($conn, $table, $where) {
	$model = array();
	$sql = "SELECT * FROM ".PREFIX."$table $where";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$model = $result->fetch_object();
		return count($model);
	}
	return 0;
}
	
function tour_detail($conn, $id) {
	$model = array();
	$sql = "SELECT * FROM ".PREFIX."tours WHERE ID=$id";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$model = $result->fetch_object();
		return $model;
	}
	return $model;
}

function tour_thumb($filename) {
	$filename = $filename ? $filename : 'na';
	return APPROOT."uploads/tours/thumb/$filename";
}

function tours($conn) {
	$model = array();
	$sql = "SELECT * FROM ".PREFIX."tours ORDER BY `ID` DESC";
	$result = $conn->query($sql);
	return $result;
}

function tour_list($conn, $table, $cond=1, $order="`ID` DESC") {
	$model = array();
	$sql = "SELECT * FROM ".PREFIX."$table WHERE $cond ORDER BY $order";
	$result = $conn->query($sql);
	return $result;
}

function check_login() {
	if(isset($_SESSION['user_id'])) {
		header("Location: index.php");
		exit; 
	}
}

function orderId( )
{
	return strtoupper(substr(md5(uniqid(rand(), true)),6));
}

function saveLog($conn, $user_id, $res, $type)
{
	$res = trim(str_replace(array("<",">"),"",$res));
	$sql = "INSERT INTO `tour_emails` (`user_id`, `is_sent`, `type`, `status`, `email_response`, `timestamp`) VALUES ('$user_id', '1', '$type', '1', '".$res."', CURRENT_TIMESTAMP);";
	$query = $conn->query($sql);
}

function is_delivered($conn, $user_id)
{
	$sql = "SELECT * FROM tour_emails WHERE user_id=$user_id AND is_delivered=1";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		//$model = $result->fetch_object();
		return '<a class="label label-success">Delivered</a>';
	}
	return '<a class="label label-danger">Undelivered</a>';
}

function getLog()
{
	$ch = curl_init();
		
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, 'api:'.MAILGUN_KEY);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/'.MAILGUN_DOMAIN.'/log');
	
	$result = json_decode(curl_exec($ch));
	curl_close($ch);
	return $result;
}

function sendMail($user, $subject, $message, $from = array(SITEEMAIL,SITENAME)) 
{
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, 'api:'.MAILGUN_KEY);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	$plain 	 = strip_tags(nl2br($message));
	
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/'.MAILGUN_DOMAIN.'/messages');
	curl_setopt($ch, CURLOPT_POSTFIELDS, array(
		'from' 			=> SITENAME." <".SITEEMAIL.">",
		'to' 				=> "$user[1] <$user[0]>",
		'subject' 	=> $subject,
		'html' 			=> $message,
		'text' 			=> $plain,
		'o:tracking'=> 'yes',
		'h:Reply-To'=> SITEEMAIL, 
	));
	
	$result = json_decode(curl_exec($ch));
	//$info = curl_getinfo($ch);
	//print_r($info);
	curl_close($ch);
	return $result;
}

function paginattion($current_page, $total_pages, $page_url) {
	$pagination = '';
	if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages)
	{ //verify total pages and current page number
		$pagination .= '<ul class="pagination">';
		
		$right_links    = $current_page + 3; 
		$previous       = $current_page - 3; //previous link 
		$next           = $current_page + 1; //next link
		$first_link     = true; //boolean var to decide our first link
		
		if($current_page > 1){
			$previous_link = ($previous==0)?1:$previous;
			$pagination .= '<li class="first"><a href="'.$page_url.'&page=1" title="First">&laquo;</a></li>'; //first link
			//$pagination .= '<li><a href="'.$page_url.'&page='.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
				for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
					if($i > 0){
						$pagination .= '<li><a href="'.$page_url.'&page='.$i.'">'.$i.'</a></li>';
					}
				}   
			$first_link = false; //set first link to false
		}
		
		if($first_link){ //if current active page is first link
			$pagination .= '<li class="first active"><a>'.$current_page.'</a></li>';
		}elseif($current_page == $total_pages){ //if it's the last active link
			$pagination .= '<li class="last active"><a>'.$current_page.'</a></li>';
		}else{ //regular current link
			$pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
		}
				
		for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
			if($i<=$total_pages){
				$pagination .= '<li><a href="'.$page_url.'&page='.$i.'">'.$i.'</a></li>';
			}
		}
		if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages)? $total_pages : $i;
				//$pagination .= '<li><a href="'.$page_url.'&page='.$next_link.'" >&gt;</a></li>'; //next link
				$pagination .= '<li class="last"><a href="'.$page_url.'&page='.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
		}
		
		$pagination .= '</ul>'; 
	}
	return $pagination; //return pagination links
}
?>