<?php
require('inc/autoload.php');
$db = new DB();

$result = $db->multiple_row("tbl_inmates",  "1");
print_r($result);
?>