<?php
	include 'db.php';
	echo "<script>alert('hi from `admin_users_del_group.php`');</script>";
	$type = $_POST['type'];
	$password = 123;
	$s_id = $_POST['s_id'];
	$e_id = $_POST['e_id'];
	$q = "DELETE FROM `users` WHERE `pid` BETWEEN '$s_id' AND '$e_id' AND `type`='$type'";
	mysqli_query($mysqli,$q);
?>