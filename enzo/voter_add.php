<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $pass  = $_POST['pass'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];

    $sql = "INSERT INTO voters(voterPass, voterFName, voterMName, voterLName, voterStat, voted)
    VALUES('$pass','$fname','$mname','$lname','active','N')";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:voter_view.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Add Voter</h3>
<form method="post">
  <div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" name="pass" autocomplete="off" required>
  </div>
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
  <button type="submit" class="btn btn-primary my-3" name="submit">Submit</button>
  <a href="voter_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>