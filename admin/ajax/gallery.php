<?php
require_once('../../includes/config.php');
require_once('../includes/functions.php');
check_permission();

$position = $_POST['position'];


$i=1;
foreach($position as $v){
	
	$sql = "UPDATE `tour_gallery` SET `tour_order` = $i WHERE `id` = $v"; 
	$conn->query($sql);

	$i++;
}

//print_r ($sql); 
?>