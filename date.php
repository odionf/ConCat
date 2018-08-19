<?php if(isset($_GET['submit'])){
	$date = $_GET['date'];
	echo $date;
}
$timezone = date_default_timezone_set("Asia/Kolkata");
echo "<br>".$timezone.date("Y-m-d",strtotime("-1 day",strtotime("Today")));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>
	<form action="date.php" method="get">
		<input type="date" name="date">
		<button name="submit" value="submit">Submit</button>
	</form>
</body>
</html>