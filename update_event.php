<?php
  include 'db.php';
  $eid = $_GET['eid'];
  if (isset($_POST['submit'])) {
    include 'db.php';
    if ($_POST["event_sdate"]>$_POST['event_edate']) {
      echo "<script>alert('Start date cannot be after End Date!'); window.location.href = 'edit_event.php';</script>";
    } else {
            $sql = "UPDATE events SET event_name = '".$_POST['event_name']."', speaker_id = '".$_POST['speaker_id']."', event_sdate = '".$_POST['event_sdate']."', event_edate = '".$_POST['event_edate']."', event_stime = '".$_POST['event_stime']."', event_etime = '".$_POST['event_etime']."', event_desc = '".$_POST['event_desc']."', event_fee = '".$_POST['event_fee']."', event_cont = '".$_POST['event_contact']."' WHERE event_id = '$eid'";
        $sql = $mysqli->query($sql);
        if ($sql) {
          echo "<script>alert('Event Successfully Updated!'); window.location.href = 'admin_events.php'</script>";
        } else {
          echo "<script>alert('Error Updating Event!'); window.location.href = 'edit_event.php'</script>";
        }
    }
  }
  echo "srd";
?>