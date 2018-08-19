<?php
	include 'db.php';
	if(isset($_POST['event_id'])){
		if(isset($_POST['pid'])){
		$event_id = $_POST['event_id'];
		$pid = $_POST['pid'];
		$event_day = $_POST['event_day'];
		$qry = mysqli_query($mysqli,"SELECT * FROM `attendance` WHERE event_id = $event_id AND pid = $pid AND event_day = $event_day");
		$qry = mysqli_fetch_assoc($qry);
		echo $qry['attended'];
		if($qry['attended'] == 0){
			$qry1 = mysqli_query($mysqli,"UPDATE `attendance` SET attended = 1 WHERE event_id = $event_id AND pid = $pid AND event_day = $event_day");
		} elseif($qry['attended'] == 1) {
			$qry1 = mysqli_query($mysqli,"UPDATE `attendance` SET attended = 0 WHERE event_id = $event_id AND pid = $pid AND event_day = $event_day");
		}
	}
	}
?>