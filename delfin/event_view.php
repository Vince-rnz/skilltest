<?php
include 'connect.php';
include 'header.php';

$search = '';
if(isset($_POST['search'])){
    $search = $_POST['keyword'];
}
?>

<h3>Events</h3>
<a href="event_add.php" class="btn btn-primary my-2">Add Event</a>

<form method="post" class="d-flex my-3">
  <input type="text" class="form-control me-2" name="keyword" placeholder="Search event name"
  value="<?php echo htmlspecialchars($search); ?>" autocomplete="off">
  <button type="submit" class="btn btn-dark" name="search">Search</button>
</form>

<table class="table">
  <thead>
    <tr>
      <th>Code</th>
      <th>Name</th>
      <th>Date</th>
      <th>Venue</th>
      <th>Reg. Fee</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php
$sql = "SELECT * FROM events WHERE evName LIKE '%$search%' ORDER BY evCode DESC";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_assoc($result)){
    $id    = $row['evCode'];
    $name  = $row['evName'];
    $date  = $row['evDate'];
    $venue = $row['evVenue'];
    $fee   = $row['evRFee'];
    echo '<tr>
      <td>'.$id.'</td>
      <td>'.$name.'</td>
      <td>'.$date.'</td>
      <td>'.$venue.'</td>
      <td>'.$fee.'</td>
      <td>
        <a href="event_update.php?id='.$id.'" class="btn btn-success btn-sm">Update</a>
        <a href="event_delete.php?id='.$id.'" class="btn btn-danger btn-sm"
        onclick="return confirm(\'Delete this event?\')">Delete</a>
      </td>
    </tr>';
}
?>
  </tbody>
</table>

<?php include 'footer.php'; ?>