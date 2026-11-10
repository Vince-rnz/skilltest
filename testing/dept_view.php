<?php
include 'connect.php';
include 'header.php';
?>

<h3>Departments Management</h3>
<p><a href="dept_add.php">Add a Department Here</a> | <a href="index.php">Back to Menu</a></p>

<table class="table">
  <thead>
    <tr>
      <th>Code</th>
      <th>Name</th>
      <th>Head</th>
      <th>Tel. No.</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
<?php
$result = mysqli_query($con, "SELECT * FROM departments ORDER BY depCode");
while($row = mysqli_fetch_assoc($result)){
    $id = $row['depCode'];
    echo '<tr>
      <td>'.$id.'</td>
      <td>'.$row['depName'].'</td>
      <td>'.$row['depHead'].'</td>
      <td>'.$row['depTelNo'].'</td>
      <td>
        <a href="dept_update.php?id='.$id.'" class="btn btn-success btn-sm">Edit</a>
        <a href="dept_delete.php?id='.$id.'" class="btn btn-danger btn-sm"
        onclick="return confirm(\'Delete this department? Its employees and their attendance will also be deleted.\')">Del</a>
      </td>
    </tr>';
}
?>
  </tbody>
</table>

<?php include 'footer.php'; ?>