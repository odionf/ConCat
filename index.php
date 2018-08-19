<?php
  session_start();
  $_SESSION['$last_page'] = "index.php";
  if (isset($_SESSION['$pid'])) {
    if ($_SESSION['$type'] == 'Student') {
      header("Location: student.php");
      exit();
    } elseif ($_SESSION['$type'] == 'Committee') {
      header("Location: committee.php");
      exit();
    } elseif ($_SESSION['$type'] == 'Faculty') {
      header("Location: faculty.php");
      exit();
    }
  }
?>
<html>
<head>
	<title>ConCat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <style>
.card1 {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  width: auto;
  margin: auto;
  text-align: center;
  font-family: arial;
}


/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #8598ad;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #8598ad;
    color: white;
}
/*now for the toggle*/



.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

</head>
<body>
  <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal1-header">
      <span class="close">&times;</span>
      <h2>Add Suggestions</h2>
    </div>
    <div class="modal-footer">
      thank you
    </div>
  </div>
</div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  		<a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" style="margin-bottom: 5px" alt="ConCat"> 		ConCat</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    </ul>
    <?php
      include 'db.php';
      if (isset($_POST['submit'])) {
        $pid = mysqli_real_escape_string($mysqli,$_POST['pid']);
        $query = $mysqli->query("SELECT * FROM users WHERE pid = '$pid' LIMIT 1");
        $result = $query->fetch_assoc();
        $check = password_verify($_POST['password'], $result['password']);
        $result = $mysqli->query("SELECT * FROM users WHERE pid = '$pid' AND $check LIMIT 1");
        if (!$result) {
          echo " <div class='navbar-text' style='margin: 0px 5px; color: red;''>Invalid Details!</div> ";
        } else {
          session_start();
          $query = "SELECT pid,first_name,last_name,type FROM users WHERE pid = '$pid' LIMIT 1";
          $query = $mysqli->query($query);
          $query = $query->fetch_assoc();
          $_SESSION['$type'] = $query['type'];
          $_SESSION['$pid'] = $query['pid'];
          $_SESSION['$first_name'] = $query['first_name'];
          $_SESSION['$last_name'] = $query['last_name'];
          if ($_SESSION['$type'] == 'Student') {
            header("Location: student.php");
            exit();
          } elseif ($_SESSION['$type'] == "Committee") {
            header("Location: committee.php");
            exit();
          } elseif ($_SESSION['$type'] == "Faculty") {
            header("Location: faculty.php");
            exit();
          } elseif ($_SESSION['$type'] == "Administrator"){
            header("Location: admin.php");
            exit();
          } else {
            echo " <div class='navbar-text' style='margin: 0px 5px; color: red;'>Contact Administrator!</div> ";
            session_destroy();
          }
        }
      }
      
    ?>
    <form style="margin-bottom: 0px;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="form-row align-items-center">
  	<div class="col-auto">
      <label class="sr-only" for="pid">Username</label>
      <div class="input-group mb-2 mb-sm-0">
        <input type="text" class="form-control" id="pid" name="pid" placeholder="Username">
      </div>
    </div>
    <div class="col-auto">
      <label class="sr-only" for="password">Password</label>
      <input type="password" class="form-control mb-2 mb-sm-0" id="password" name="password" placeholder="Password">
    </div>
    <div class="col-auto">
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
    <div class="col-auto">
      <button type="button" name="myBtn" id="myBtn" class="btn btn-primary">Sign Up</button>
    </div>
  </div>
</nav>
  <div id="mainbox" class="container-fluid">
    <div style="width: 90%; margin-top: 1%">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group" style="float: right; width: 100% display: inline-block;">
        <div style="float: left;">
          <label for="sel1" style="text-align: center; margin: 5px;">Select Committee:</label>
          </div>
          <div style="float: left;"><select class="form-control" id="sel1" name="valueToSearch">
            <option value="">All</option>
            <?php 
           
            include 'db.php';
            if(isset($_POST['search'])){
              $search = $_POST['valueToSearch'];
            } else {
              $search = '';
            }
            $qry="SELECT distinct comm_name from `events` WHERE visibility='1'";
            $res=mysqli_query($mysqli,$qry);
            
               
                while ($r=mysqli_fetch_assoc($res)) {
                if ($r['comm_name']==$search) {
                  echo "<option value='".$r['comm_name']."' selected>".$r['comm_name']."</option>";
                  }
                  else {
                echo "<option value='".$r['comm_name']."'>".$r['comm_name']."</option>";
                  }
               }
            
            ?>
            
            
          </select></div>
          <div style="float: left;">&nbsp;<button type="submit" class="btn btn-primary" style="float: right;" name="search" >Find</button></div>       
        </div>
      </form>
    </div>
  <?php
    $qry = "SELECT * FROM `events` INNER JOIN `speakers` WHERE events.speaker_id = speakers.speaker_id AND events.visibility = '1' AND events.comm_name LIKE '%$search%' ORDER BY events.event_sdate";
    $count = 0;
    $result = mysqli_query($mysqli,$qry);
    if (!$result) {
    } else  {
      while ($row = mysqli_fetch_assoc($result)) {
        if(strtotime('today')<strtotime($row['event_sdate'])){
          $count++;
          echo
          "<div class='card col-md-4' id='card-resp' style='float: left; padding: 15px; margin: 2%; align-items: center'>
            <img src = 'img/" . $row['comm_name'] . "_logo.jpg' alt='" . $row['comm_name'] . "' style='width:200px; height:200px; border-radius: 100px;' align={center}>
            <br>
            <h2>".$row['event_name']."</h2>
            <p class='title'>" . $row['speaker_fname']. " " . $row['speaker_lname'] . "</p>
            <p>";
            if($row['event_sdate']!=$row['event_edate']) { echo date('dS M Y',strtotime($row['event_sdate'])) . " to " . date('dS M Y',strtotime($row['event_edate'])); } else { echo date('dS M Y',strtotime($row['event_sdate'])); }
            echo "</p>
           <p style='width:100%'><form method='post' action='view_event.php?event_id=".$row['event_id']."'><button class='btn btn-primary' type='submit' name='event_id' value='".$row['event_id']."'>More Information</button></form></p>
          </div>";
        }
        }
      }
      if ($count == 0) {
        echo "<div class = 'container-fluid' style = 'text-align: center; margin: 20px;'><h1>No Events found!</h1></div>";
      }
  ?>
  </div>
</div>
<script>



// addd suggestions
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
       
    }
}
</script>
</body>
</html>
<?php $_SESSION['$last_page']="index.php"; ?>