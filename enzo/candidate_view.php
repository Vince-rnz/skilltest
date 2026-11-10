<?php
include 'connect.php';
include 'header.php';
?>

<h3>Candidates</h3>
<a href="candidate_add.php" class="btn btn-primary my-2">Add Candidate</a>

<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Position</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php
$sql = "SELECT c.*, p.posName FROM candidates c
        JOIN positions p ON c.posID = p.posID
        ORDER BY p.posID, c.candID";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_assoc($result)){
    $id = $row['candID'];

    if($row['candStat'] == 'active'){
        $btn = '<a href="candidate_status.php?id='.$id.'&stat=inactive" class="btn btn-danger btn-sm">Deactivate</a>';
    }else{
        $btn = '<a href="candidate_status.php?id='.$id.'&stat=active" class="btn btn-secondary btn-sm">Activate</a>';
    }

    echo '<tr>
      <td>'.$id.'</td>
      <td>'.$row['candFName'].' '.$row['candMName'].' '.$row['candLName'].'</td>
      <td>'.$row['posName'].'</td>
      <td>'.$row['candStat'].'</td>
      <td>
        <a href="candidate_update.php?id='.$id.'" class="btn btn-success btn-sm">Update</a>
        '.$btn.'
      </td>
    </tr>';
}
?>
  </tbody>
</table>

<?php include 'footer.php'; ?>