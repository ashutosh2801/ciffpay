<?php 
require('function.php'); 
//echo '<pre>'; print_r($_POST);
$errors = $data = [];

//$user_id = $_SESSION['user_id'];
$user_id = $_COOKIE['user_id'];


extract($_POST);
if(empty($_POST['password']))
$errors['password'] = $lang['Password can not blank!'];
if(empty($_POST['confirm_password']) && ($_POST['confirm_password']!=$_POST['password']) )
$errors['confirm_password'] = $lang['Confirm password should be same as password!'];


if(empty($errors)) {
    $sql = "UPDATE tbl_users SET password='".md5($password)."' WHERE id=$user_id";
    if($conn->query($sql)) 
    {
        $data = array('status'=>'Success', 'message'=>$lang['Your password has been changed!']);
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
