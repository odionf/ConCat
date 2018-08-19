<?php
  session_start();
  if(!isset($_SESSION['$pid'])){
    echo '<script type="text/javascript">alert("Login First!")</script>';
    header("Location: {$_SESSION['$last_page']}");
    exit();
  } elseif($_SESSION['$type']!='Committee') {
      echo '<script type="text/javascript">alert("Only accessible to a Committee!");</script>';
      header("Location: {$_SESSION['$last_page']}");
      exit();
    }
    else {
  require 'db.php';
}
?>
<html>
<head>
	<title>ConCat</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/loader.js"></script>
  
  <style type="text/css">
  .rcard {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    
    margin: auto;
    text-align: center;
    font-family: arial;
}
</style>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 999;">
  		<a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" alt="ConCat" style="margin-bottom: 5px;"> ConCat</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="committee.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_event.php">Add Event</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_speaker.php">Add Speaker</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="committee_view_events.php">View Events</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="view_suggestions.php>">View Suggestions</a>
      </li>
    </ul>
    <div class = "navbar-text"> Signed in as <i><?php echo $_SESSION['$first_name']; ?></i></div>
    <form action="logout.php" method="post" style="float: right; margin: 0;">
      <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
    </form>
  </div>
</nav>

<!--main content of page-->
<div id="container" style="padding-bottom: 50px; margin-bottom: 50px;">
	<?php
  include 'db.php';
  $pid=$_SESSION['$pid'];
  $n=mysqli_query($mysqli,"SELECT * FROM `users` WHERE pid='$pid'");
  $t=mysqli_fetch_assoc($n);
  $p=$t['first_name'];
  $qer="SELECT * from `suggestions` WHERE committee='$p' or committee='all' ORDER BY counter desc";
  $result=mysqli_query($mysqli,$qer);
  if($result)
  {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<br>";
        echo "<div class='card' style='margin:10px; padding 10px;   position:absoloute;'>";
        $fid=$row['pid'];
        $res=mysqli_query($mysqli,"SELECT * FROM `users` WHERE pid='$fid'");
        $ros= mysqli_fetch_assoc($res);
        
        echo "<div style='width=100%;'> <div style='float:left;'>Given by ".$ros['first_name']."  ".$ros['last_name']."</div><div style='float:right;'>".$row['timestmp']."&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></div><br> Suggestion:<br> <b>".$row['suggestion']." </b>";
        echo "</div>";
      }
  }
?>

</div>

</body>
</html>
<?php $_SESSION['$last_page'] = "committee.php"; ?>