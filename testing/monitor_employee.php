<?php
include 'connect.php';
include 'header.php';

$empID = '';
if(isset($_POST['search'])){
    $empID = $_POST['empID'];
}
?>

<h3>Attendance Monitoring (By Employee)</h3>
<p><a href="index.php">Back to Menu</a></p>

<form method="post" class="d-flex my-3">
  <input type="number" class="form-control me-2" name="empID" placeholder="Input Employee #"
  value="<?php echo $empID; ?>" autocomplete="off" required>
  <button type="submit" class="btn btn-dark" name="search">Search</button>
</form>

<?php
if($empID != ''){
    $sql = "SELECT e.*, d.depName FROM employees e
            JOIN departments d ON e.depCode = d.depCode
            WHERE e.empID = $empID";
    $emp = mysqli_fetch_assoc(mysqli_query($con, $sql));

    if(!$emp){
        echo '<div class="alert alert-danger">Employee not found.</div>';
    }else{
?>

<p>Name: <b><?php echo $emp['empLName'].', '.$emp['empFName']; ?></b>
&nbsp;&nbsp;&nbsp; Department: <b><?php echo $emp['depName']; ?></b></p>

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
                WHERE empID = $empID AND attStat != 'Cancelled'
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
        $salary = $totalHours * $emp['empRPH'];
?>
  </tbody>
</table>

<div class="card">
  <div class="card-body">
    <p>Rate Per Hour: <b><?php echo number_format($emp['empRPH'], 2); ?></b></p>
    <p>Total Hours Worked: <b><?php echo number_format($totalHours, 2); ?></b></p>
    <p>Salary: <b>P<?php echo number_format($salary, 2); ?></b></p>
    <p class="mb-0">Date Generated: <b><?php echo date('n/j/Y'); ?></b></p>
  </div>
</div>

<?php
    }
}
include 'footer.php';
?>