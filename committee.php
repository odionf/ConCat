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
	<title>Home | <?php echo $_SESSION['$first_name']?> | ConCat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/loader.js"></script>
  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});  
      google.charts.setOnLoadCallback(drawChart); 
      function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Interest', 'Number'],  
                          <?php
                          include 'db.php';
                          $query = "SELECT interest, COUNT(interest) as number FROM `interests` JOIN `users` WHERE `users`.pid = `interests`.pid GROUP by interest"; 
                          $result = mysqli_query($mysqli,$query);
                          while($row = mysqli_fetch_assoc($result))  
                          {  
                               echo "['".$row["interest"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  }
                var chart = new google.visualization.PieChart(document.getElementById('chart'));  
                chart.draw(data, options);  
           }  
  </script>
  <style type="text/css">
  div.tab {
    float: left;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 30%;
    height: 300px;
}
/* Style the buttons inside the tab */
div.tab button {
    display: block;
    background-color: inherit;
    color: black;
    padding: 22px 16px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
}
/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}
/* Create an active/current "tab button" class */
div.tab button.active {
    background-color: #ccc;
}
/* Style the tab content */
.tabcontent {
    float: left;
    padding: 0px 12px;
    border: 1px solid #ccc;
    width: 70%;
    border-left: none;
    height: 100%;
    display: none;
}
.scrollbar
{
  float: left;
  height: 300px;
  width: 65px;
  background: ##343a40;
  overflow-y: scroll;
  margin-bottom: 25px;
}
#wrapper
{
  text-align: center;
  width: 500px;
  margin: auto;
}
#style-1::-webkit-scrollbar-track
{
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  border-radius: 10px;
  background-color: ##343a40;
}
#style-1::-webkit-scrollbar
{
  width: 12px;
  background-color: #F5F5F5;
}
#style-1::-webkit-scrollbar-thumb
{
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
  background-color: #555;
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
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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
      <li class="nav-item ">
        <a class="nav-link" href="view_suggestions.php">View Suggestions</a>
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
	<!--Chart goes here-->
  <div style="width:45%; height: auto; float: left;">
    <div id="chart" style="vertical-align: middle; width: auto; height: 400px; zoom: 130%"></div>
    <p style="color:red; text-align: center;" class="lead">Interests: live from 
      <b><?php
        $result = mysqli_query($mysqli,"SELECT COUNT(*) FROM `users` where type='Student'")->fetch_assoc();
        echo implode(" ", $result);  
      ?></b>
      students</p>
  </div>
  <!--Left Div-->
	<div style="width:55%;float:right;background-color: #444444;" class="flex-container" style="overflow: hidden;">
    <div class="tab scrollbar" id="style-1" style="min-height: 91%; float: left;">
    <?php 
      require "db.php";
      $result=mysqli_query($mysqli,"SELECT distinct(interest) from `interests`");
      if($result)
      {
        while ($row=mysqli_fetch_assoc($result)) {
          echo "<button class='tablinks' href='#".$row['interest']."' id='b".$row['interest']."'>".$row['interest']."</button>";
        }
      }
    ?>
    </div>
    <div style="float: left; width:70%;">
      <table class="table" width="100%" >
      <thead style="background-color: black; color: white;">
        <th><td>Speaker Name</td><td>Average Rating</td></th>
      </thead>
    </table>
    <?php 
      require "db.php";
      $result=mysqli_query($mysqli,"SELECT distinct(interest) from `interests`");
      if($result)
      {
        while ($row=mysqli_fetch_assoc($result)) {
          echo "<div id=".$row['interest']." style='display:none;'>";
            $individual="SELECT * from `speakers` JOIN `interests` where speakers.speaker_id = interests.pid AND interests.interest='".$row['interest']."'";
            $i=mysqli_query($mysqli,$individual);
            echo "<table width='100%' class='table table-hover'>";
            if($i){
              while ($irow=mysqli_fetch_assoc($i)) {
                $speaker_id = $irow['speaker_id'];
                echo "<form method='get' action='committee_speaker.php'><button type='submit' name='speaker_id' value='".$speaker_id."' class='btn btn-primary btn-lg btn-block btn btn-light'>".$irow['speaker_fname']." ".$irow['speaker_lname']." ~ ".$irow['avg_rating']."</button></form>";
              }
            }
          echo "</table></div>"; 
           echo "<script>
            $(document).on('click', function(e){
              if($(e.target).is('#b".$row['interest']."')){
                $('#".$row['interest']."').show();
              }else{
                  $('#".$row['interest']."').hide();
              }
            });
            </script>";
        }
      }
    ?>
  </div>
</div>
</body>
</html>
<?php $_SESSION['$last_page'] = "committee.php"; ?>