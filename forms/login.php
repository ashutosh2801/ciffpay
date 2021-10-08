<?php 







require('function.php'); 

if(empty($_POST['email']))
$errors['email2'] = $lang['Email can not blank!'];
if(empty($_POST['password']))
$errors['password2'] = $lang['Password can not blank!'];

if(empty($errors)) 
{
    $sql = "SELECT * FROM `tbl_users` WHERE email='".$_POST['email']."' AND password='".md5($_POST['password'])."' AND role=2 limit 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($row) {
        //print_r($row);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'];
        
        setcookie('user_id', $row['id'], time() + (86400 * 30), "/");
        setcookie('user_email', $row['email'], time() + (86400 * 30), "/");
        $data = array('status'=>'Success', 'message'=>'');
    }
    else {
        $data = array('status'=>'Error', 'message'=>$lang['Invalid email or password!']);
    }
}
else {
    $data = array('status'=>'Errors', 'message'=>$errors);
}
echo json_encode($data);
?>
