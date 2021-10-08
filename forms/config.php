<?php
session_start();
error_reporting(E_ERROR);

define('SITENAME', 'CIFFPay', true);
define('SITEURL', '/ciffpay', true);

$conn = new mysqli("localhost","root","","ciffi");

// Check connection
if ($conn->connect_errno) {
  echo "Failed to connect to MySQL: " . $conn->connect_error;
  exit();
}
?>