<?php
include 'connect.php';
include 'header.php';
?>

<h3>Election Winners</h3>

<table class="table">
  <thead>
    <tr>
      <th>Elective Position</th>
      <th>Winner</th>
      <th>Total Votes</th>
    </tr>
  </thead>
  <tbody>
<?php
$positions = mysqli_query($con, "SELECT * FROM positions ORDER BY posID");
while($p = mysqli_fetch_assoc($positions)){
    $posID = $p['posID'];
    $limit = (int)$p['numOfPositions'];

    $sql = "SELECT c.candFName, c.candMName, c.candLName, COUNT(v.candID) AS total
            FROM candidates c
            JOIN votes v ON c.candID = v.candID
            WHERE c.posID = $posID
            GROUP BY c.candID
            ORDER BY total DESC
            LIMIT $limit";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($result)){
        echo '<tr>
          <td>'.$p['posName'].'</td>
          <td>'.$row['candFName'].' '.$row['candMName'].' '.$row['candLName'].'</td>
          <td>'.$row['total'].'</td>
        </tr>';
    }
}
?>
  </tbody>
</table>

<?php include 'footer.php'; ?>