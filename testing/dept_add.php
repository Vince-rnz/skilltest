<?php
include 'connect.php';
$error = '';
if(isset($_POST['submit'])){
    $code = $_POST['code'];
    $name = $_POST['name'];
    $head = $_POST['head'];
    $tel  = $_POST['tel'];

    $sql = "INSERT INTO departments(depCode, depName, depHead, depTelNo)
    VALUES('$code','$name','$head','$tel')";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:dept_view.php');
        exit;
    }else{
        $error = mysqli_error($con);
    }
}
include 'header.php';
?>

<h3>Add Department</h3>
<?php if($error != ''){ echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>

<form method="post">
  <div class="form-group">
    <label>Code</label>
    <input type="number" class="form-control" name="code" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Head</label>
    <input type="text" class="form-control" name="head" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Tel. No.</label>
    <input type="text" class="form-control" name="tel" autocomplete="off" required>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Submit</button>
  <a href="dept_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>