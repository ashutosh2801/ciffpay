<?php 
require_once('function.php'); 
//echo '<pre>'; print_r($_POST);
$errors = $data = [];

extract($_POST);
if(empty($_POST['prison_type']))
$errors['prison_type'] = $lang['Prison type can not be blank!'];
if(empty($_POST['institute']))
$errors['institute'] = $lang['Institute can not be blank!'];
if(empty($_POST['amount']))
$errors['amount'] = $lang['Cheque amount can not blank!'];


if(empty($errors)) {
    //echo $_SESSION['user_id']; exit;
    $user_id = $_COOKIE['user_id'];

    $sql = "INSERT INTO tbl_inmates (user_id, prison_type, institute, cheque_id, created_at) VALUES ('".$user_id."', '$prison_type', '$institute', '$amount', '".date('Y-m-d H:i:s')."' )";
    if($conn->query($sql)) 
    {
        if( ($_GET['act']=='login') ) {
            $data = array('status'=>'Success', 'message'=>$lang['You have successfully logged in.'].' <meta http-equiv="refresh" content="0;url='.SITEURL.'/recipient/'.$conn->insert_id.'" />');
        }
        else if( ($_GET['act']=='direct') ) {
            $data = array('status'=>'Success', 'message'=>$lang['Record saved!'].' <meta http-equiv="refresh" content="0;url='.SITEURL.'/recipient/'.$conn->insert_id.'" />');
        }
        else {
            $data = array('status'=>'Success', 'message'=>$lang['Your registration was successful, you can now continue with your order. An email has been sent to you with your login details.'].' <meta http-equiv="refresh" content="3;url='.SITEURL.'/recipient/'.$conn->insert_id.'" />');
        }
    }
    else {
        $data = array('status'=>'Errors', 'message'=>$conn->error );
    }
}
else {
    $data = array('status'=>'Errors', 'message'=>$errors);
}
echo json_encode($data);
?>