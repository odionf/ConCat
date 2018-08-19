<?php
  include 'db.php';
  $sid = $_GET['speaker_id'];
  $value = $_GET['value'];
  if($value=='delete'){
    $qry = "DELETE FROM `speakers` WHERE speaker_id = '$sid'";
    mysqli_query($mysqli,$qry);
  }
?>