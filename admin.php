<?php
	include 'db.php';
	session_start();
	if(!isset($_SESSION['$pid'])){
		echo '<script type="text/javascript">alert("Login First!")</script>';
		header("Location: {$_SESSION['$last_page']}");
		exit();
	} else {
		if($_SESSION['$type']!='Administrator'){
			echo '<script type="text/javascript">alert("Only accessible to a Administrator!");</script>';
			header("Location: {$_SESSION['$last_page']}");
			exit();
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . " | ConCat" ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 999;">
  		<a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" alt="ConCat" style="margin-bottom: 5px;"> ConCat</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_events.php">Events</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_speakers.php">Speakers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_users.php">Users</a>
      </li>
    </ul>
    <div class = "navbar-text"> Signed in as <i><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?></i></div>
    <form action="logout.php" method="post" style="float: right; margin: 0;">
      <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
    </form>
  </div>
</nav>
<div class="lead container" style="">
	<h3>Functions Covered by Administrator:</h3>
	<h4>User Management:</h4>
  <ul>
    <li>Adding New Users</li>
    <li>Deleting Individual Users</li>
    <li>Resetting Individual Passwords</li>
    <li>Deleting Users from select Range IDs</li>
    <li>Mass Adding Users in required numbers</li>
	</ul>
  <h4>Event Management:</h4>
  <ul>
    <li>Turning public visibility off</li>
    <li>Editing Event Details</li>
    <li>Deleting Events</li>
  </ul>
  <h4>Speaker's Database:</h4>
  <ul>
    <li>Updating Details</li>
    <li>Deleting Speakers</li>
  </ul>
  <b style="color: red;">*Each identified by above tabs</b>
</div>
</body>
</html>
<?php $_SESSION['$last_page'] = "admin.php"; ?>