<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $partID = $_POST['partID'];
    $date   = $_POST['date'];
    $mode   = $_POST['mode'];

    // get event fee and participant discount
    $sql = "SELECT e.evRFee, p.partDRate FROM participants p
            JOIN events e ON p.evCode = e.evCode
            WHERE p.partID = $partID";
    $row = mysqli_fetch_assoc(mysqli_query($con, $sql));

    // compute fee to be paid
    $feePaid = $row['evRFee'] - $row['partDRate'];

    $sql = "INSERT INTO registration(partID, regDate, regFPaid, regPMode)
    VALUES('$partID','$date','$feePaid','$mode')";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:register.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Participant Registration</h3>
<form method="post">
  <div class="form-group">
    <label>Participant</label>
    <select class="form-control" name="partID" required>
      <option value="">-- Select Participant --</option>
      <?php
      $sql = "SELECT p.*, e.evName, e.evRFee FROM participants p
              JOIN events e ON p.evCode = e.evCode ORDER BY p.partLName";
      $list = mysqli_query($con, $sql);
      while($p = mysqli_fetch_assoc($list)){
          $toPay = $p['evRFee'] - $p['partDRate'];
          echo '<option value="'.$p['partID'].'">'
              .$p['partFName'].' '.$p['partLName'].' | '.$p['evName']
              .' | Fee: '.$p['evRFee'].' - Discount: '.$p['partDRate']
              .' = To Pay: '.$toPay.'</option>';
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label>Registration Date</label>
    <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>" required>
  </div>
  <div class="form-group">
    <label>Payment Mode</label>
    <select class="form-control" name="mode" required>
      <option value="Cash">Cash</option>
      <option value="Card">Card</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Register</button>
</form>

<hr>
<h4>Registration Records (Latest to Oldest)</h4>
<table class="table">
  <thead>
    <tr>
      <th>Reg. Code</th>
      <th>Participant</th>
      <th>Event</th>
      <th>Reg. Date</th>
      <th>Fee Paid</th>
      <th>Payment Mode</th>
    </tr>
  </thead>
  <tbody>
<?php
$sql = "SELECT r.*, p.partFName, p.partLName, e.evName
        FROM registration r
        JOIN participants p ON r.partID = p.partID
        JOIN events e ON p.evCode = e.evCode
        ORDER BY r.regDate DESC, r.regCode DESC";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_assoc($result)){
    echo '<tr>
      <td>'.$row['regCode'].'</td>
      <td>'.$row['partFName'].' '.$row['partLName'].'</td>
      <td>'.$row['evName'].'</td>
      <td>'.$row['regDate'].'</td>
      <td>'.$row['regFPaid'].'</td>
      <td>'.$row['regPMode'].'</td>
    </tr>';
}
?>
  </tbody>
</table>

<?php include 'footer.php'; ?>