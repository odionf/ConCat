<?php
	require 'db.php';
	$encrypted = password_hash('123', PASSWORD_DEFAULT);
	$qry = "UPDATE `users` SET password = '$encrypted'";
	$check = mysqli_query($mysqli,$qry);
	echo $check;
?>