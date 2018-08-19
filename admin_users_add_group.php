<?php
	include 'db.php';
	$type = $_POST['type'];
	$password = 123;
	$s_id = $_POST['s_id'];
	$e_id = $_POST['e_id'];
	for($i=$s_id;$i<$e_id;$i++)
	{
		$q = "INSERT INTO `users` (pid, password, type) VALUES ('$i','$password','$type') ";
		mysqli_query($mysqli,$q);
	}
?>