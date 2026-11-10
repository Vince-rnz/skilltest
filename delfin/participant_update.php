<?php
include 'connect.php';
$id = $_GET['id'];

$sql = "SELECT * FROM participants WHERE partID=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$evCode = $row['evCode'];
$fname  = $row['partFName'];
$lname  = $row['partLName'];
$drate  = $row['partDRate'];

if(isset($_POST['submit'])){
    $evCode = $_POST['evCode'];
    $fname  = $_POST['fname'];
    $lname  = $_POST['lname'];
    $drate  = $_POST['drate'];

    $sql = "UPDATE participants SET evCode='$evCode', partFName='$fname',
    partLName='$lname', partDRate='$drate' WHERE partID=$id";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:participant_view.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Update Participant</h3>
<form method="post">
  <div class="form-group">
    <label>Event</label>
    <select class="form-control" name="evCode" required>
      <?php
      $events = mysqli_query($con, "SELECT * FROM events");
      while($e = mysqli_fetch_assoc($events)){
          $selected = ($e['evCode'] == $evCode) ? 'selected' : '';
          echo '<option value="'.$e['evCode'].'" '.$selected.'>'.$e['evName'].'</option>';
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Discount Rate</label>
    <input type="number" step="0.01" class="form-control" name="drate" value="<?php echo $drate; ?>" required>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Update</button>
  <a href="participant_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>