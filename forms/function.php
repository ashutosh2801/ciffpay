<?php
require('config.php'); 

//echo $_GET['lang']; exit;
if(!empty($_GET['lang']) ) {
	setcookie('lang', $_GET['lang'], time() + (86400 * 30), "/");
	header("Location: ".SITEURL); exit;
}


if( $_COOKIE['lang'] ) {
	//echo '1';
	require(__DIR__ . '/../lang/'.$_COOKIE['lang'].'.php'); 
	$lang_field =  (!empty($_COOKIE['lang']) && $_COOKIE['lang']=='fr') ? '_fr' : '';
}
else {
	//echo '2';
	require(__DIR__ . '/../lang/en.php'); 
	$lang_field = '';
}


//echo 'hello'; exit;


define('MAILGUN_KEY','key-12f062264f6fc5e55db3c3716bbf5ab5');
define('MAILGUN_DOMAIN','mg.ciffpay.com');

function sendMailer($conn, $user) 
{
	$sql = "SELECT * FROM `tbl_email_templates` WHERE slug='".$user['EMAIL_TEMPLATE']."' limit 1";
    $result = $conn->query($sql);
    $template = $result->fetch_object();
	if($template->subject) {
		$subject = $template->subject;
		$message = $template->content;
		foreach($user as $key => $data) {
			$subject = str_replace($key, $data, $subject);
			$message = str_replace($key, $data, $message);
		}

		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, 'api:'.MAILGUN_KEY);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$plain 	 = strip_tags(nl2br($message));
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.MAILGUN_DOMAIN.'/messages');

		$plain = strip_tags($message);	
		
		$post_data = array(
			'from' 				=> "CIFFPay <support@ciffpay.com>",
			'to' 				=> "$user[NAME] <$user[EMAIL]>",
			'subject' 			=> $subject,
			'html' 				=> $message,
			'text' 				=> $plain,
			'o:tracking'		=> 'yes',
			'o:tracking-clicks'	=> 'yes',
			'o:tracking-opens'	=> 'yes',
			'h:Reply-To'		=> $user['EMAIL'],  
		);			
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		
		$result = json_decode(curl_exec($ch));
		curl_close($ch);
	}
	else {
		$result = json_decode( array('message'=>'Email not found!', 'status'=>'error') );
	}
	return $result;
}

function sendMail($user) 
{

	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, 'api:'.MAILGUN_KEY);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	$plain 	 = strip_tags(nl2br($message));
	
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.MAILGUN_DOMAIN.'/messages');

	$message = $user['message'];
	$plain = strip_tags($message);
	
	// if( !empty($filename) )
	// $post_data = array(
	// 					'from' 			=> "CIFFPay <support@ciffpay.com>",
	// 					'to' 			=> "$user[name] <$user[email]>",
	// 					'subject' 		=> 'Thank you for sending money to your leved one.',
	// 					'html' 			=> $message,
	// 					'text' 			=> $plain,
	// 					'o:tracking'=>'yes',
	// 					'o:tracking-clicks'=>'yes',
	// 					'o:tracking-opens'=>'yes',
	// 					'h:Reply-To'	=> $user[0], 
	// 					'attachment[0]' =>  curl_file_create($filename[0], 'application/pdf', $filename[0])
	// 				);
	// else	
	$post_data = array(
		'from' 				=> "CIFFPay <support@ciffpay.com>",
		'to' 				=> "$user[name] <$user[email]>",
		'subject' 			=> 'We  have received you money request.',
		'html' 				=> $message,
		'text' 				=> $plain,
		'o:tracking'		=> 'yes',
		'o:tracking-clicks'	=> 'yes',
		'o:tracking-opens'	=> 'yes',
		'h:Reply-To'		=> $user['email'],  
	);			
	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	
	$result = json_decode(curl_exec($ch));
	curl_close($ch);
	return $result;
}

function pluck($conn) {
	$pluck = [];
	$sql = "SELECT * FROM `tbl_options`";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_object()) {
			$pluck[$row->field_name] = $row->field_value;
		}
	}
	return ($pluck);
}
//print_r ( pluck($conn) ); exit;
