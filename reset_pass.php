<?php
	require 'db.php';
	if($_SESSION['type'] == "Administrator"){
		if(isset($_POST['pid'])){
			$pid = $_POST['pid'];
			$encrypted = password_hash('123', PASSWORD_DEFAULT);
			$qry = "UPDATE `users` SET password = '$encrypted' WHERE pid = '$pid'";
			$check = mysqli_query($mysqli,$qry);
		}
	}
?>