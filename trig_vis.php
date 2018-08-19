<?php
	include 'db.php';
	if(isset($_POST['event_id'])){
		$event_id = $_POST['event_id'];
		$qry = mysqli_query($mysqli,"SELECT visibility FROM `events` WHERE event_id = $event_id");
		$qry = mysqli_fetch_assoc($qry);
		if($qry['visibility'] == 0){
			$qry1 = mysqli_query($mysqli,"UPDATE events SET visibility = 1 WHERE event_id = $event_id");
		} elseif($qry['visibility'] == 1) {
			$qry1 = mysqli_query($mysqli,"UPDATE events SET visibility = 0 WHERE event_id = $event_id");
		}
	}
?>