<?php 
require_once('forms/config.php'); 
unset($_SESSION);
session_destroy();

unset($_COOKIE['user_id']); 
setcookie('user_id', null, -1, '/'); 
unset($_COOKIE['user_email']); 
setcookie('user_email', null, -1, '/'); 

header('Location: '.SITEURL);
exit;
?>