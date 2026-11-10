<?php
include 'connect.php';
include 'header.php';

$search = '';
if(isset($_POST['search'])){
    $search = $_POST['keyword'];
}
?>

<h3>Participants</h3>
<a href="participant_add.php" class="btn btn-primary my-2">Add Participant</a>

<form method="post" class="d-flex my-3">
  <input type="text" class="form-control me-2" name="keyword" placeholder="Search first or last name"
  value="<?php echo htmlspecialchars($search); ?>" autocomplete="off">
  <button type="submit" class="btn btn-dark" name="search">Search</button>
</form>

<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Event</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Discount Rate</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php
$sql = "SELECT p.*, e.evName FROM participants p
        JOIN events e ON p.evCode = e.evCode
        WHERE p.partFName LIKE '%$search%' OR p.partLName LIKE '%$search%'
        ORDER BY p.partID DESC";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_assoc($result)){
    $id = $row['partID'];
    echo '<tr>
      <td>'.$id.'</td>
      <td>'.$row['evName'].'</td>
      <td>'.$row['partFName'].'</td>
      <td>'.$row['partLName'].'</td>
      <td>'.$row['partDRate'].'</td>
      <td>
        <a href="participant_update.php?id='.$id.'" class="btn btn-success btn-sm">Update</a>
        <a href="participant_delete.php?id='.$id.'" class="btn btn-danger btn-sm"
        onclick="return confirm(\'Delete this participant?\')">Delete</a>
      </td>
    </tr>';
}
?>
  </tbody>
</table>

<?php include 'footer.php'; ?>