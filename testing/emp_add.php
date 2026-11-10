<?php
include 'connect.php';
$error = '';
if(isset($_POST['submit'])){
    $id    = $_POST['id'];
    $dep   = $_POST['dep'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $rate  = $_POST['rate'];

    $sql = "INSERT INTO employees(empID, depCode, empFName, empLName, empRPH)
    VALUES('$id','$dep','$fname','$lname','$rate')";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:emp_view.php');
        exit;
    }else{
        $error = mysqli_error($con);
    }
}
include 'header.php';
?>

<h3>Add Employee</h3>
<?php if($error != ''){ echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>

<form method="post">
  <div class="form-group">
    <label>Employee ID</label>
    <input type="number" class="form-control" name="id" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Department</label>
    <select class="form-control" name="dep" required>
      <option value="">-- Select Department --</option>
      <?php
      $deps = mysqli_query($con, "SELECT * FROM departments ORDER BY depCode");
      while($d = mysqli_fetch_assoc($deps)){
          echo '<option value="'.$d['depCode'].'">'.$d['depCode'].' - '.$d['depName'].'</option>';
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" name="lname" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="fname" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Rate per Hour</label>
    <input type="number" step="0.01" class="form-control" name="rate" required>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Submit</button>
  <a href="emp_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>