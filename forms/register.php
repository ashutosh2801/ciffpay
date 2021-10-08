<?php 
require('function.php'); 
//echo '<pre>'; print_r($_POST);
$errors = $data = [];

extract($_POST);
if(empty($_POST['first_name']))
$errors['first_name'] = $lang['First name can not be blank!'];
if(empty($_POST['last_name']))
$errors['last_name'] = $lang['Last name can not be blank!'];
if(empty($_POST['email']))
$errors['email'] = $lang['Email can not blank!'];
if(empty($_POST['password']))
$errors['password'] = $lang['Password can not blank!'];
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
    $sql = "SELECT * FROM `tbl_users` WHERE email='".$_POST['email']."' limit 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($row) {
        $data = array('status'=>'Error', 'message'=>$lang['The email has been already taken!']);
    }
    else {
        $sql = "INSERT INTO tbl_users (first_name, last_name, email, password, phone_number, mailing_address, street_number, unit, street_name, city, province, postal_code, IP, status, updated, created) VALUES ('$first_name', '$last_name', '$email', '".md5($password)."', '$phone_number', '$mailing_address', '$street_number', '$unit', '$street_name', '$city', '$province', '$postal_code', '".$_SERVER['REMOTE_ADDR']."', 0,  '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."' )";
        if($conn->query($sql)) 
        {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['user_email'] = $email;
            
            setcookie('user_id', $conn->insert_id, time() + (86400 * 30), "/");
            setcookie('user_email', $email, time() + (86400 * 30), "/");

            $sendData = array(
                'NAME'            => $first_name, 
                'EMAIL'           => $email,
                'PASSWORD'        => $password,
                'EMAIL_TEMPLATE'  => 'welcome-registration-email-to-user'
              );
      
            sendMailer($conn, $sendData) ; //To USER

            // Print auto-generated id
            $data = array('status'=>'Success', 'message'=>$lang['Your registration was successful, you can now continue with your order. An email has been sent to you with your login details.']);
        }
        else {
            $data = array('status'=>'Errors', 'message'=>$conn->error );
        }
    }
}
else {
    //foreach($errors as $key=>$error)
    //echo '<p class="'.$key.'">'.$error.'</p>';
    $data = array('status'=>'Errors', 'message'=>$errors);
}
echo json_encode($data);
?>
