<?php
  include 'db.php';
  $sid = $_GET['speaker_id'];
  $sfname = $_GET['speaker_fname'];
  $slname = $_GET['speaker_lname'];
 # $simg = $_GET['speaker_img'];
  $scontact = $_GET['speaker_contact'];
  $semail = $_GET['speaker_email'];
  $visibility = $_GET['visibility'];
  $description = $_GET['description'];

  $query = "UPDATE `speakers` SET `speaker_fname` = '$sfname', `speaker_lname` = '$slname', `speaker_contact` = '$scontact', `speaker_email` = '$semail', `description` = '$description', `visibility` = '$visibility' WHERE `speakers`.`speaker_id` = '$sid'";

  mysqli_query($mysqli,$query);
?>