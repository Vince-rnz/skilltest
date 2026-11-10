<?php
include 'connect.php';
include 'header.php';
?>

<h3>Employees Management</h3>
<p><a href="emp_add.php">Add an Employee Here</a> | <a href="index.php">Back to Menu</a></p>

<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Dept.</th>
      <th>Lastname</th>
      <th>Firstname</th>
      <th>Rate/Hour</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
<?php
$result = mysqli_query($con, "SELECT * FROM employees ORDER BY empID");
while($row = mysqli_fetch_assoc($result)){
    $id = $row['empID'];
    echo '<tr>
      <td>'.$id.'</td>
      <td>'.$row['depCode'].'</td>
      <td>'.$row['empLName'].'</td>
      <td>'.$row['empFName'].'</td>
      <td>'.number_format($row['empRPH'], 2).'</td>
      <td>
        <a href="emp_update.php?id='.$id.'" class="btn btn-success btn-sm">Edit</a>
        <a href="emp_delete.php?id='.$id.'" class="btn btn-danger btn-sm"
        onclick="return confirm(\'Delete this employee? Their attendance records will also be deleted.\')">Del</a>
      </td>
    </tr>';
}
?>
  </tbody>
</table>

<?php include 'footer.php'; ?>