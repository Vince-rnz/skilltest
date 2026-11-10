<?php
include 'connect.php';
$id = $_GET['id'];

$sql = "SELECT * FROM events WHERE evCode=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$name  = $row['evName'];
$date  = $row['evDate'];
$venue = $row['evVenue'];
$fee   = $row['evRFee'];

if(isset($_POST['submit'])){
    $name  = $_POST['name'];
    $date  = $_POST['date'];
    $venue = $_POST['venue'];
    $fee   = $_POST['fee'];

    $sql = "UPDATE events SET evName='$name', evDate='$date', evVenue='$venue', evRFee='$fee'
    WHERE evCode=$id";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:event_view.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Update Event</h3>
<form method="post">
  <div class="form-group">
    <label>Event Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Event Date</label>
    <input type="date" class="form-control" name="date" value="<?php echo $date; ?>" required>
  </div>
  <div class="form-group">
    <label>Venue</label>
    <input type="text" class="form-control" name="venue" value="<?php echo $venue; ?>" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Registration Fee</label>
    <input type="number" step="0.01" class="form-control" name="fee" value="<?php echo $fee; ?>" required>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Update</button>
  <a href="event_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>