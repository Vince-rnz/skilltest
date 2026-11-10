<?php
include 'connect.php';
include 'header.php';

$evCode = '';
if(isset($_POST['filter'])){
    $evCode = $_POST['evCode'];
}
?>

<h3>Events Registration Monitoring</h3>

<form method="post" class="d-flex my-3">
  <select class="form-control me-2" name="evCode" required>
    <option value="">-- Select Event Name --</option>
    <?php
    $events = mysqli_query($con, "SELECT * FROM events");
    while($e = mysqli_fetch_assoc($events)){
        $selected = ($e['evCode'] == $evCode) ? 'selected' : '';
        echo '<option value="'.$e['evCode'].'" '.$selected.'>'.$e['evName'].'</option>';
    }
    ?>
  </select>
  <button type="submit" class="btn btn-dark" name="filter">Filter</button>
</form>

<?php
if($evCode != ''){
    // event info (header and fee)
    $ev = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM events WHERE evCode=$evCode"));
    echo '<h4 class="my-3">Event: '.$ev['evName'].'</h4>';
?>

<table class="table">
  <thead>
    <tr>
      <th>Event's Name</th>
      <th>Participant's Full Name</th>
      <th>Registration Date</th>
      <th>Registration Fee Paid</th>
    </tr>
  </thead>
  <tbody>
<?php
    $sql = "SELECT e.evName, p.partFName, p.partLName, r.regDate, r.regFPaid
            FROM registration r
            JOIN participants p ON r.partID = p.partID
            JOIN events e ON p.evCode = e.evCode
            WHERE e.evCode = $evCode
            ORDER BY r.regDate DESC";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($result)){
        echo '<tr>
          <td>'.$row['evName'].'</td>
          <td>'.$row['partFName'].' '.$row['partLName'].'</td>
          <td>'.$row['regDate'].'</td>
          <td>'.$row['regFPaid'].'</td>
        </tr>';
    }
?>
  </tbody>
</table>

<?php
    // aggregate functions
    $sql = "SELECT COUNT(r.regCode) AS a, SUM(r.regFPaid) AS b
            FROM registration r
            JOIN participants p ON r.partID = p.partID
            WHERE p.evCode = $evCode";
    $agg = mysqli_fetch_assoc(mysqli_query($con, $sql));

    $a = $agg['a'];
    $b = $agg['b'];
    if($b == null){ $b = 0; }

    $totalDiscount = ($a * $ev['evRFee']) - $b;
?>

<div class="card">
  <div class="card-body">
    <p>Number of Records: <b><?php echo $a; ?></b></p>
    <p>Total Registration Fees Paid: <b><?php echo $b; ?></b></p>
    <p class="mb-0">Total Amount of Discounts: <b><?php echo $totalDiscount; ?></b></p>
  </div>
</div>

<?php } ?>

<?php include 'footer.php'; ?>