<?php
	include 'db.php';
	session_start();
	$event_id = $_POST['event_id'];
	$pid = $_POST['pid'];	
	$q = "INSERT INTO `attendance` (pid,event_id,paid) VALUES ('$pid','$event_id','0')";
	if (mysqli_query($mysqli,$q)) {
		echo "<script>alert('Successfully Registered!'); window.location.href = 'student.php';</script>";
	} else {
		echo "<script>alert('Registeration Unsucessful!'); window.location.href = '".$_SESSION['$last_page'].".php';</script>";
	}
?>