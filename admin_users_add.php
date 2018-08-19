<?php
	include 'db.php';
	$type = $_POST['type'];
	$password = $_POST['password'];
	$id = $_POST['pid'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$q="INSERT INTO `users` (pid, password, type, first_name, last_name) VALUES ('$id','$password','$type','$first_name','$last_name') ";
	mysqli_query($mysqli,$q);
?>