<?php
require_once('../../includes/config.php');
require_once('../includes/functions.php');
check_permission();

if(isset($_GET['id'])) {
	$sql2 = "SELECT * FROM `tour_customer_detail` WHERE user_id=".$_GET['id'].";";
	$query2 = $conn->query($sql2);
	if($query2->num_rows > 0 ) {
		$model = $query2->fetch_object();
		$title=array();
		$query2->data_seek(0); 
		//mysqli_data_seek($query2, 0);
		while($model2 = $query2->fetch_object()) {
			$sql3 = "SELECT * FROM `tour_tours` WHERE id=".$model2->tour_id." LIMIT 1;";
			$query3 = $conn->query($sql3);
			$model3 = $query3->fetch_object();
			$title[] = $model3->title;
		}

		$HTML = '<div style="width:600px; margin:0 auto; font-family:Tahoma, Geneva, sans-serif; color:#666; font-size:1.2em;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center"><a href="https://www.toniagara.com"><img src="https://www.toniagara.com/images/logo.png" alt="" height="55"></a></td>
</tr>
</table>
<p>Hi '.$model->name.'!</p>
<p>I saw you started to reserve '. implode(',',$title) .', but weren\'t able to complete it.</p>
<p>Shoot us a quick note or give us a call at +1 800-653-2242. Let us know how we can help. We\'d love to make this work for you.</p>
<p><a style="color:#ffffff;font-family:\'Helvetica Neue\',Helvetica,Arial,sans-serif;text-decoration:none;text-transform:uppercase;background-color:#8bc440;padding:15px 20px;width:250px;display:block" href="https://www.toniagara.com/checkout?token='.$model->sessionId.'">Resume Booking</a></p>
<p>Best wishes,<br />
Nick,<br />Niagara Falls Tours Specialist<br />
<a href="https://www.toniagara.com">www.toniagara.com</a></p>
</div>';
	
		echo $HTML;
		exit;
	}
}
?>