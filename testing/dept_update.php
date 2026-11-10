<?php
include 'connect.php';
$id = $_GET['id'];

$sql = "SELECT * FROM departments WHERE depCode=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['depName'];
$head = $row['depHead'];
$tel  = $row['depTelNo'];

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $head = $_POST['head'];
    $tel  = $_POST['tel'];

    $sql = "UPDATE departments SET depName='$name', depHead='$head', depTelNo='$tel'
    WHERE depCode=$id";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:dept_view.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Edit Department</h3>
<form method="post">
  <div class="form-group">
    <label>Code</label>
    <input type="text" class="form-control" value="<?php echo $id; ?>" disabled>
  </div>
  <div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Head</label>
    <input type="text" class="form-control" name="head" value="<?php echo $head; ?>" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Tel. No.</label>
    <input type="text" class="form-control" name="tel" value="<?php echo $tel; ?>" autocomplete="off" required>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Update</button>
  <a href="dept_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>