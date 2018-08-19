<?php
	include 'db.php';
	if(isset($_POST['event_id'])){
		if(isset($_POST['pid'])){
		$event_id = $_POST['event_id'];
		$pid = $_POST['pid'];
		$qry = mysqli_query($mysqli,"SELECT * FROM `events` WHERE event_id = $event_id");
		$qry = mysqli_fetch_assoc($qry);
		$diff = abs(strtotime($qry['event_sdate'])-strtotime($qry['event_edate']))/24/60/60;
		$qry = mysqli_query($mysqli,"SELECT paid FROM `attendance` WHERE event_id = $event_id AND pid = $pid");
		$qry = mysqli_fetch_assoc($qry);
		if($qry['paid'] == 0){
			$qry1 = mysqli_query($mysqli,"UPDATE `attendance` SET paid = '1', event_day = '1' WHERE event_id = $event_id AND pid = $pid");
			for($x = 1; $x <= $diff; $x++){
				$y=$x+1;
				$qry1 = mysqli_query($mysqli,"INSERT INTO `attendance` (pid,event_id,paid,attended,event_day) VALUES ('$pid','$event_id','1','0','$y')");
			}
		} elseif($qry['paid'] == 1) {
			for($x = 0; $x <= $diff; $x++)
				$qry1 = mysqli_query($mysqli,"UPDATE `attendance` SET paid = '0' WHERE event_id = $event_id AND pid = $pid");
		}
	}
	}
?>