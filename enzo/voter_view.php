<?php
include 'connect.php';
include 'header.php';
?>

<h3>Voters</h3>
<a href="voter_add.php" class="btn btn-primary my-2">Add Voter</a>

<table class="table">
  <thead>
    <tr>
      <th>Voter ID</th>
      <th>Password</th>
      <th>Name</th>
      <th>Status</th>
      <th>Voted</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php
$result = mysqli_query($con, "SELECT * FROM voters ORDER BY voterID");
while($row = mysqli_fetch_assoc($result)){
    $id = $row['voterID'];

    if($row['voterStat'] == 'active'){
        $btn = '<a href="voter_status.php?id='.$id.'&stat=inactive" class="btn btn-danger btn-sm">Deactivate</a>';
    }else{
        $btn = '<a href="voter_status.php?id='.$id.'&stat=active" class="btn btn-secondary btn-sm">Activate</a>';
    }

    echo '<tr>
      <td>'.$id.'</td>
      <td>'.$row['voterPass'].'</td>
      <td>'.$row['voterFName'].' '.$row['voterMName'].' '.$row['voterLName'].'</td>
      <td>'.$row['voterStat'].'</td>
      <td>'.$row['voted'].'</td>
      <td>
        <a href="voter_update.php?id='.$id.'" class="btn btn-success btn-sm">Update</a>
        '.$btn.'
      </td>
    </tr>';
}
?>
  </tbody>
</table>

<?php include 'footer.php'; ?>