<?php
include 'connect.php';
include 'header.php';
?>

<h3>Attendance Recording</h3>
<p><a href="att_add.php">Record Attendance Here</a> | <a href="index.php">Back to Menu</a></p>

<table class="table">
  <thead>
    <tr>
      <th>Record #</th>
      <th>Emp. ID</th>
      <th>Date/Time In</th>
      <th>Date/Time Out</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php
$result = mysqli_query($con, "SELECT * FROM attendance ORDER BY attRN");
while($row = mysqli_fetch_assoc($result)){
    $id = $row['attRN'];

    if($row['attStat'] == 'Cancelled'){
        $action = '<span class="text-danger">Cancelled</span>';
    }else{
        $action = '<a href="att_cancel.php?id='.$id.'" class="btn btn-danger btn-sm"
        onclick="return confirm(\'Cancel this attendance record?\')">Cancel</a>';
    }

    echo '<tr>
      <td>'.$id.'</td>
      <td>'.$row['empID'].'</td>
      <td>'.date('n/j/y g:iA', strtotime($row['attTimeIn'])).'</td>
      <td>'.date('n/j/y g:iA', strtotime($row['attTimeOut'])).'</td>
      <td>'.$action.'</td>
    </tr>';
}
?>
  </tbody>
</table>

<?php include 'footer.php'; ?>