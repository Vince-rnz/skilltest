<?php
include 'connect.php';
$id = $_GET['id'];

$sql = "SELECT * FROM voters WHERE voterID=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$pass  = $row['voterPass'];
$fname = $row['voterFName'];
$mname = $row['voterMName'];
$lname = $row['voterLName'];

if(isset($_POST['submit'])){
    $pass  = $_POST['pass'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];

    $sql = "UPDATE voters SET voterPass='$pass', voterFName='$fname',
    voterMName='$mname', voterLName='$lname' WHERE voterID=$id";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:voter_view.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Update Voter</h3>
<form method="post">
  <div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" name="pass" value="<?php echo $pass; ?>" autocomplete="off" required>
  </div>
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
  <button type="submit" class="btn btn-primary my-3" name="submit">Update</button>
  <a href="voter_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>