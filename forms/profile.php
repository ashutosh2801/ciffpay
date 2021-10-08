<?php 
require('function.php'); 
//echo '<pre>'; print_r($_POST);
$errors = $data = [];

//$user_id = $_SESSION['user_id'];
$user_id = $_COOKIE['user_id'];


extract($_POST);
if(empty($_POST['first_name']))
$errors['first_name'] = $lang['First name can not be blank!'];
if(empty($_POST['last_name']))
$errors['last_name'] = $lang['Last name can not be blank!'];
if(empty($_POST['email']))
$errors['email'] = $lang['Email can not blank!'];
if(empty($_POST['phone_number']))
$errors['phone_number'] = $lang['Phone number can not blank!'];
if(empty($_POST['street_number']))
$errors['street_number'] = $lang['Street number can not blank!'];
if(empty($_POST['street_name']))
$errors['street_name'] = $lang['Street name can not blank!'];
if(empty($_POST['city']))
$errors['city'] = $lang['City can not blank!'];
if(empty($_POST['province']))
$errors['province'] = $lang['Province can not blank!'];
if(empty($_POST['postal_code']))
$errors['postal_code'] = $lang['Postal code can not blank!'];


if(empty($errors)) {
    $sql = "UPDATE tbl_users SET first_name='$first_name', last_name='$last_name', email='$email', phone_number='$phone_number', mailing_address='$mailing_address', street_number='$street_number', unit='$unit', street_name='$street_name', city='$city', province='$province', postal_code='$postal_code', IP='".$_SERVER['REMOTE_ADDR']."', updated='".date('Y-m-d H:i:s')."' WHERE id=$user_id";
    if($conn->query($sql)) 
    {
        $data = array('status'=>'Success', 'message'=>$lang['Your record has been updated!']);
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
