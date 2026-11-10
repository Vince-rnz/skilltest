<?php
include 'connect.php';
include 'header.php';
?>

<h3>Positions</h3>
<a href="position_add.php" class="btn btn-primary my-2">Add Position</a>

<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Position</th>
      <th>No. of Positions</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php
$result = mysqli_query($con, "SELECT * FROM positions ORDER BY posID");
while($row = mysqli_fetch_assoc($result)){
    $id = $row['posID'];

    if($row['posStat'] == 'open'){
        $btn = '<a href="position_status.php?id='.$id.'&stat=closed" class="btn btn-danger btn-sm">Deactivate</a>';
    }else{
        $btn = '<a href="position_status.php?id='.$id.'&stat=open" class="btn btn-secondary btn-sm">Activate</a>';
    }

    echo '<tr>
      <td>'.$id.'</td>
      <td>'.$row['posName'].'</td>
      <td>'.$row['numOfPositions'].'</td>
      <td>'.$row['posStat'].'</td>
      <td>
        <a href="position_update.php?id='.$id.'" class="btn btn-success btn-sm">Update</a>
        '.$btn.'
      </td>
    </tr>';
}
?>
  </tbody>
</table>

<?php include 'footer.php'; ?>