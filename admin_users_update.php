<?php
	include 'db.php';
	$pid = $_GET['pid'];
	$value = $_GET['value'];
	if($value=='delete'){
	$q="DELETE FROM `users` WHERE pid='$pid'";}
	if($value=='reset'){
	$encrypted = password_hash('123', PASSWORD_DEFAULT);
	$q="UPDATE `users` SET password='$encrypted' WHERE pid='$pid'";}
	mysqli_query($mysqli,$q);
?>