<?php
include 'connect.php';
$error = '';
if(isset($_POST['submit'])){
    $empID = $_POST['empID'];
    $in    = str_replace('T', ' ', $_POST['timein']) . ':00';
    $out   = str_replace('T', ' ', $_POST['timeout']) . ':00';
    $date  = date('Y-m-d', strtotime($in));

    if(strtotime($out) <= strtotime($in)){
        $error = 'Time Out must be later than Time In.';
    }else{
        $sql = "INSERT INTO attendance(empID, attDate, attTimeIn, attTimeOut, attStat)
        VALUES('$empID','$date','$in','$out','Active')";

        $result = mysqli_query($con, $sql);
        if($result){
            header('location:att_view.php');
            exit;
        }else{
            $error = mysqli_error($con);
        }
    }
}
include 'header.php';
?>

<h3>Record Attendance</h3>
<?php if($error != ''){ echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>

<form method="post">
  <div class="form-group">
    <label>Employee</label>
    <select class="form-control" name="empID" required>
      <option value="">-- Select Employee --</option>
      <?php
      $emps = mysqli_query($con, "SELECT * FROM employees ORDER BY empLName");
      while($e = mysqli_fetch_assoc($emps)){
          echo '<option value="'.$e['empID'].'">'.$e['empID'].' - '.$e['empLName'].', '.$e['empFName'].'</option>';
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label>Date/Time In</label>
    <input type="datetime-local" class="form-control" name="timein" required>
  </div>
  <div class="form-group">
    <label>Date/Time Out</label>
    <input type="datetime-local" class="form-control" name="timeout" required>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Record</button>
  <a href="att_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>