<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $evCode = $_POST['evCode'];
    $fname  = $_POST['fname'];
    $lname  = $_POST['lname'];
    $drate  = $_POST['drate'];

    $sql = "INSERT INTO participants(evCode, partFName, partLName, partDRate)
    VALUES('$evCode','$fname','$lname','$drate')";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:participant_view.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Add Participant</h3>
<form method="post">
  <div class="form-group">
    <label>Event</label>
    <select class="form-control" name="evCode" required>
      <option value="">-- Select Event --</option>
      <?php
      $events = mysqli_query($con, "SELECT * FROM events");
      while($e = mysqli_fetch_assoc($events)){
          echo '<option value="'.$e['evCode'].'">'.$e['evName'].'</option>';
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="fname" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" name="lname" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Discount Rate</label>
    <input type="number" step="0.01" class="form-control" name="drate" value="0" required>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Submit</button>
  <a href="participant_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>