<?php
include 'connect.php';
$id = $_GET['id'];

$sql = "SELECT * FROM candidates WHERE candID=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$fname = $row['candFName'];
$mname = $row['candMName'];
$lname = $row['candLName'];
$posID = $row['posID'];

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $posID = $_POST['posID'];

    $sql = "UPDATE candidates SET candFName='$fname', candMName='$mname',
    candLName='$lname', posID='$posID' WHERE candID=$id";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:candidate_view.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Update Candidate</h3>
<form method="post">
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Middle Name</label>
    <input type="text" class="form-control" name="mname" value="<?php echo $mname; ?>" autocomplete="off">
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Position</label>
    <select class="form-control" name="posID" required>
      <?php
      $pos = mysqli_query($con, "SELECT * FROM positions");
      while($p = mysqli_fetch_assoc($pos)){
          $selected = ($p['posID'] == $posID) ? 'selected' : '';
          echo '<option value="'.$p['posID'].'" '.$selected.'>'.$p['posName'].'</option>';
      }
      ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Update</button>
  <a href="candidate_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>