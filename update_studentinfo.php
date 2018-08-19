<?php
session_start();
  include 'db.php';
  $pd = $_GET['pd'];
  if (isset($_POST['submit'])) {
    include 'db.php';
    
      $qry = "UPDATE users SET first_name = '".$_POST['first_name']."', last_name = '".$_POST['last_name']."', phone_no = '".$_POST['contact']."', email_id= '".$_POST['email']."' WHERE pid = '$pd'";
        $sql = mysqli_query($mysqli,$qry);
        if ($sql) {
         $qery="SELECT * from `users` WHERE pid='$pd'";
      $r=mysqli_query($mysqli,$qery);
      $row = mysqli_fetch_assoc($r);
      echo $row['type'];
      if($row['type']=='Student')
      { 
        $_SESSION['$first_name'] = $_POST['first_name'];
        $_SESSION['$last_name'] = $_POST['last_name'];
        echo "<script> window.location.href = 'studentinfo.php'</script> ";
      }
      elseif ($row['type']=='Faculty')
      {

        $q = "UPDATE speakers SET speaker_fname = '".$_POST['first_name']."', speaker_lname = '".$_POST['last_name']."', speaker_contact = '".$_POST['contact']."', speaker_email= '".$_POST['email']."', description = '".$_POST['description']."' WHERE speaker_id = '$pd'";
        $sql = mysqli_query($mysqli,$q);
        $_SESSION['$first_name'] = $_POST['first_name'];
        $_SESSION['$last_name'] = $_POST['last_name'];
       echo "<script> window.location.href= 'facultyinfo.php'</script>";
      }
    } 
    else {
          echo "<script>alert('Error Updating Profile!'); window.location.href = 'studentinfo.php'</script>";
        }
    
  }
  
?>