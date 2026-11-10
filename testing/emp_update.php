<?php
include 'connect.php';
$id = $_GET['id'];

$sql = "SELECT * FROM employees WHERE empID=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$dep   = $row['depCode'];
$lname = $row['empLName'];
$fname = $row['empFName'];
$rate  = $row['empRPH'];

if(isset($_POST['submit'])){
    $dep   = $_POST['dep'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $rate  = $_POST['rate'];

    $sql = "UPDATE employees SET depCode='$dep', empFName='$fname',
    empLName='$lname', empRPH='$rate' WHERE empID=$id";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:emp_view.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Edit Employee</h3>
<form method="post">
  <div class="form-group">
    <label>Employee ID</label>
    <input type="text" class="form-control" value="<?php echo $id; ?>" disabled>
  </div>
  <div class="form-group">
    <label>Department</label>
    <select class="form-control" name="dep" required>
      <?php
      $deps = mysqli_query($con, "SELECT * FROM departments ORDER BY depCode");
      while($d = mysqli_fetch_assoc($deps)){
          $selected = ($d['depCode'] == $dep) ? 'selected' : '';
          echo '<option value="'.$d['depCode'].'" '.$selected.'>'.$d['depCode'].' - '.$d['depName'].'</option>';
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Rate per Hour</label>
    <input type="number" step="0.01" class="form-control" name="rate" value="<?php echo $rate; ?>" required>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Update</button>
  <a href="emp_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>