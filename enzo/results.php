<?php
include 'connect.php';
include 'header.php';
?>

<h3>Election Results</h3>

<table class="table">
  <thead>
    <tr>
      <th>Position / Candidate</th>
      <th>Total Votes</th>
      <th>Voting %</th>
    </tr>
  </thead>
  <tbody>
<?php
$positions = mysqli_query($con, "SELECT * FROM positions ORDER BY posID");
while($p = mysqli_fetch_assoc($positions)){
    $posID = $p['posID'];

    // total votes cast for this position
    $t = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM votes WHERE posID=$posID"));
    $posTotal = $t['total'];

    echo '<tr class="table-secondary"><td colspan="3"><b>'.$p['posName'].'</b></td></tr>';

    $sql = "SELECT c.candFName, c.candMName, c.candLName, COUNT(v.candID) AS total
            FROM candidates c
            LEFT JOIN votes v ON c.candID = v.candID
            WHERE c.posID = $posID
            GROUP BY c.candID
            ORDER BY c.candID";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($result)){
        if($posTotal > 0){
            $percent = $row['total'] / $posTotal * 100;
        }else{
            $percent = 0;
        }
        echo '<tr>
          <td>'.$row['candFName'].' '.$row['candMName'].' '.$row['candLName'].'</td>
          <td>'.$row['total'].'</td>
          <td>'.number_format($percent, 2).'</td>
        </tr>';
    }
}
?>
  </tbody>
</table>

<?php include 'footer.php'; ?>