<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $posID = $_POST['posID'];

    $sql = "INSERT INTO candidates(candFName, candMName, candLName, posID, candStat)
    VALUES('$fname','$mname','$lname','$posID','active')";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:candidate_view.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Add Candidate</h3>
<form method="post">
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="fname" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Middle Name</label>
    <input type="text" class="form-control" name="mname" autocomplete="off">
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" name="lname" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Position</label>
    <select class="form-control" name="posID" required>
      <option value="">-- Select Position --</option>
      <?php
      $pos = mysqli_query($con, "SELECT * FROM positions WHERE posStat='open'");
      while($p = mysqli_fetch_assoc($pos)){
          echo '<option value="'.$p['posID'].'">'.$p['posName'].'</option>';
      }
      ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Submit</button>
  <a href="candidate_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>