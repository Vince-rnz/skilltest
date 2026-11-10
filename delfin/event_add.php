<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $name  = $_POST['name'];
    $date  = $_POST['date'];
    $venue = $_POST['venue'];
    $fee   = $_POST['fee'];

    $sql = "INSERT INTO events(evName, evDate, evVenue, evRFee)
    VALUES('$name','$date','$venue','$fee')";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:event_view.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Add Event</h3>
<form method="post">
  <div class="form-group">
    <label>Event Name</label>
    <input type="text" class="form-control" name="name" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Event Date</label>
    <input type="date" class="form-control" name="date" required>
  </div>
  <div class="form-group">
    <label>Venue</label>
    <input type="text" class="form-control" name="venue" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Registration Fee</label>
    <input type="number" step="0.01" class="form-control" name="fee" required>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Submit</button>
  <a href="event_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>