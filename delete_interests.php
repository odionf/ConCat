<?php
  include 'db.php';
  session_start();
  $pd=$_SESSION['$pid'];
  if (isset($_GET['submit'])) {
        
        $intr=$_GET['di'];
        
        $p=$_SESSION['$pid'];
        
         
        foreach ($_GET['di'] as $value) {
          
        
          $qer="DELETE FROM interests WHERE pid='$p' AND interest='$value';";
          $res=mysqli_query($mysqli,$qer);
          echo "<script>alert('Sucessfully removed')</script>";
        
       
      }


       $qery="SELECT * from `users` WHERE pid='$pd'";
      $r=mysqli_query($mysqli,$qery);
      $row = mysqli_fetch_assoc($r);
      echo $row['type'];
      if($row['type']=='Student')
      {
        echo "<script> window.location.href = 'studentinfo.php'</script> ";
      }
      else{
        echo "<script> window.location.href= 'facultyinfo.php'</script>";
      }
      }
?>