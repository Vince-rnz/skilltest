<?php
include 'connect.php';
include 'header.php';

$from = '';
$to   = '';
if(isset($_POST['generate'])){
    $from = $_POST['from'];
    $to   = $_POST['to'];
}
?>

<h3>Attendance Monitoring (Date Range)</h3>
<p><a href="index.php">Back to Menu</a></p>

<form method="post" class="row my-3">
  <div class="col">
    <label>Date From</label>
    <input type="date" class="form-control" name="from" value="<?php echo $from; ?>" required>
  </div>
  <div class="col">
    <label>Date To</label>
    <input type="date" class="form-control" name="to" value="<?php echo $to; ?>" required>
  </div>
  <div class="col">
    <label>&nbsp;</label><br>
    <button type="submit" class="btn btn-dark" name="generate">Generate</button>
  </div>
</form>

<?php
if($from != '' && $to != ''){
?>

<h5>Attendance Records</h5>
<table class="table">
  <thead>
    <tr>
      <th>Record #</th>
      <th>Emp. ID</th>
      <th>Date/Time In</th>
      <th>Date/Time Out</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
<?php
    $totalHours = 0;
    $sql = "SELECT * FROM attendance
            WHERE DATE(attDate) BETWEEN '$from' AND '$to'
            AND attStat != 'Cancelled'
            ORDER BY attRN";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $hours = (strtotime($row['attTimeOut']) - strtotime($row['attTimeIn'])) / 3600;
        $totalHours += $hours;
        echo '<tr>
          <td>'.$row['attRN'].'</td>
          <td>'.$row['empID'].'</td>
          <td>'.date('n/j/y g:iA', strtotime($row['attTimeIn'])).'</td>
          <td>'.date('n/j/y g:iA', strtotime($row['attTimeOut'])).'</td>
          <td>'.number_format($hours, 2).'</td>
        </tr>';
    }
?>
  </tbody>
</table>

<div class="card">
  <div class="card-body">
    <p>Date Generated: <b><?php echo date('n/j/Y'); ?></b></p>
    <p class="mb-0">Total: <b><?php echo number_format($totalHours, 2); ?></b></p>
  </div>
</div>

<?php
}
include 'footer.php';
?>