<?php
require_once('../forms/config.php');
require_once('includes/functions.php');
check_permission();
session_destroy();
unset($_SESSION);

unset($_COOKIE['admin_user_id']); 
setcookie('admin_user_id', null, -1, '/'); 

header('Location: login.php');
exit;
?>