<?php
    require 'db.php';
    session_start();
    if (!isset($_SESSION['$pid'])) {
        echo "<script>alert('Login First!'); window.location.href = '".$_SESSION['$last_page']."'</script>";
        exit();
    } else {
        if(!in_array($_SESSION['$type'], array('Student','Committee','Faculty'))) {
            echo "<script>alert('You cant edit profile!'); window.location.href = '".$_SESSION['$last_page']."'</script>";
            exit();
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . " | ConCat"; ?></title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <script src="js/jquery-3.2.1.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<style type="text/css">
.card1 {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  width: auto;
  margin: auto;
  text-align: center;
  font-family: arial;
} 
  input[type=text] {
    border: 2px solid grey;
    border-radius: 4px;
}
.button {
  display: inline-block;

  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color:#3f6396;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #027987}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
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
    width: 40%;
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
    background-color: #91a1bc;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #91a1bc;
    color: white;
}</style>

</head>

<body style="background-color: #e8f0ff;">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 9999; width: 100%">
      <a class="navbar-brand" href="aboutus.php"><img src="img/concat_logo.png" width="20px" height="20px" style="margin-bottom: 5px" alt="ConCat">     ConCat</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="student.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="studentinfo.php">Edit Profile</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="review.php">Review</a>
      </li>
    </ul>
    <div class = "navbar-text"> Signed in as <i><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?></i></div>
  <form action="logout.php" method="post" style="float: right;">
      <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
  </form>
  </div>
</nav>
<div style="width: 90%; margin-left: 5%; margin-right: 5%; align-items: center; align-self: center; align-content: center; " align="center" class="card1">
  <div class="container" style="width: 45%; float: left; background-color: #e6edec; border-radius: 15px; margin: 15px; padding: 30px; align-items: center;" class="card1">
    <h2>Interests</h2>
     <?php 
    include 'db.php';
    $p=$_SESSION['$pid'];
    $qer="SELECT * FROM `interests` WHERE pid=$p";
    $result = mysqli_query($mysqli,$qer);
    if($result->num_rows==0)
    {
      echo "NO interests selected yet";
    }
    else  {
          echo "Interests Selected are:<ul>";
          echo "<p align='center'>";
          while ($row = mysqli_fetch_assoc($result)) 
            {
              
              echo "".$row['interest']."<br>";
            }
          echo "</p>";
            
         }
  ?>
    
        
    <div style="width: 50%; background-color: #d5e5e2; float: left; border-radius: 10px;" class="card1">
      <form name="edit" method="GET" action="add_interests.php?pd=<?php echo $p; ?>" method="POST">
      <?php
      include 'db.php';
        $qry="SELECT DISTINCT `interest` FROM `interests`"; 
        $res= mysqli_query($mysqli,$qry);
        $c=($res->num_rows);
        $pd=$_SESSION['$pid'];
    echo"<select multiple='multiple' name='ai[]' size='".$c."'>";
        
        while ($row = mysqli_fetch_assoc($res)) 
          {
            echo $row['interest'];
            echo "<option name='".$row['interest']."'>".$row['interest']."</option>";
          }
          echo "</select>";
      ?>
      <br>
      <button name="submit" class="btn-info"><big>Add Interests</big></button>
      </form>
      <br><br>
    </div>
    <div style="width: 50%; background-color: #d5e5e2; float: right; border-radius: 10px;" class="card1">
      <form name="edit" method="GET" action="delete_interests.php">
      <?php
        $p=$_SESSION['$pid'];
        $qer="SELECT * FROM `interests` WHERE pid=$p";
       $result = mysqli_query($mysqli,$qer);
       
        echo"<select multiple='multiple' name='di[]' size='".$c."'>";
        
        while ($row = mysqli_fetch_assoc($result)) 
          {
            echo "<option name='".$row['interest']."'>".$row['interest']."</option>";
          }
          echo "</select>";
      ?>
<br> <button name="submit" class="btn-info"><big>Remove Interests</big></button>
</form>
<br><br>
    </div>

    
     <i> USe CTRL to select multiple </i>
  </div>
   <?php
    STATIC $run_once = true;
    if(!isset($_SESSION['submit']) && $run_once){
 
    $pd = $_SESSION['$pid'];
    $qry = "SELECT * FROM `users` where pid = '$pd'";
    $result = $mysqli->query($qry);
    if ($result) {
    
      $row = mysqli_fetch_assoc($result);
      $fname = $row['first_name'];
      $lname = $row['last_name'];
      $pswd = $row['password'];
      $mail = $row['email_id'];
      $contact = $row['phone_no'];
     
    $run_once = false;
    }
    }
  ?>
 
 <div class="container" style="width: 45%; float: left; background-color: #e6edec; border-radius: 15px; margin: 15px; padding: 30px; align-items: center;" class="card1">
  <form method="post" action="update_studentinfo.php?pd=<?php echo $pd; ?>">
    <h2>Edit Profile Details</h2>
    <div class="row">
        <div class="col-md-6 mb-3">
          <label for="first_name">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $fname; ?>" required>
        </div>

        <div class="col-md-6 mb-3" style="align-content: center;">
          <label class="mr-sm-2" for="last_name">Last Name</label><br>
          <input type="text" class="form-control" style="width: 100%;" id="last_name" name="last_name" value ="<?php echo $lname; ?>" required>
        </div>
      </div>
      <div class="row">
        <div style="width: 75%; margin: 5px 15px;">
          <label>E-Mail</label>
          <div class="form-group">
          <input type="text" class="form-control" name="email" style="width: 100%;" rows="3" value="<?php echo $mail; ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div style="width: 75%; margin: 5px 15px;">
        <label>Phone Number</label>
          <div class="form-group">
          <input type="text" class="form-control" name="contact" style="width: 100%;" rows="3" value="<?php echo $contact; ?>">
          </div>
        </div>
      </div>
      <div class="row" style="align-items: center; width: 100%">
        <button class="btn-info" type="submit" name="submit"><big>UPDATE</big></button>
      </div>
      <br><br>
    </form>
<div style="width: 90%; background-color:#8894a8 ; border-radius: 10px; margin: 10px; padding: 10px;" class="card1" >
 <!-- Trigger/Open The Modal -->
<i> Change Passwords regularly to be safe</i>

<button id="myBtn" class="button" type="button" style="width: 90%;"><big><big>Change Password</big></big></button>
<br>

</div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h5>Password Security</h5>
    </div>
    <div class="modal-body">
    
    
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

      <table>
        <tr><td><label>Enter current password</label>
        </td><td><input type="password" name="olpswd">
        </td></tr><br>
        <tr><td><label>Enter new password</label>
        </td><td><input type="password" name="npswd">
        </td></tr><br>
        <tr><td><label>Confirm new Password</label>
        </td><td><input type="password" name="cnpswd">
        </td><br>
      </table>
      
      
    </div>
    <div class="modal-footer" style="align-items: center; align-self: center; align-content: center; border-radius: 15px; ">
      <h3><button class="button" type="submit" name="submitp" >CHANGE PASSWORD</button></h3>
      </form>
    </div>
  </div>

</div>

<?php
    include 'db.php';
    if (isset($_POST['submitp'])) {
        $pid = $_SESSION['$pid'];
        $query = $mysqli->query("SELECT * FROM users WHERE pid = '$pid' LIMIT 1");
        $result = $query->fetch_assoc();
        $check = password_verify($_POST['olpswd'], $result['password']);
        $result = $mysqli->query("SELECT * FROM users WHERE pid = '$pid' AND $check LIMIT 1");
        if(!$result)
        {
          echo"<script>alert('Invalid Password!')</script>";
        }
        elseif ($_POST['npswd']!=$_POST['cnpswd']) {
            echo "<script>alert('Passwords do not match')</script>";
        }
        else
        {
            if(strlen($_POST['cnpswd'])>=8 && strlen($_POST['cnpswd'])<=20){
              $encrypted = password_hash($_POST['cnpswd'], PASSWORD_DEFAULT);
              $qry = "UPDATE `users` SET password = '$encrypted' WHERE pid='$pid'";
              $check = mysqli_query($mysqli,$qry);
              echo "<script>alert('Password Sucessfully changed')</script>";
            }
            elseif(strlen($_POST['cnpswd'])<8){
              echo "<script>alert('Password too short!')</script>";
            } elseif (strlen($_POST['cnpswd'])>20) {
              echo "<script>alert('Password too long!')</script>";
            }
         }
        
      }
  ?>



</div>
<script>
// Get the modal
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



  </div>
 
  </div>






</body>
</html>

