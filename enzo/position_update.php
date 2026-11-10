<?php
include 'connect.php';
$id = $_GET['id'];

$sql = "SELECT * FROM positions WHERE posID=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['posName'];
$num  = $row['numOfPositions'];

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $num  = $_POST['num'];

    $sql = "UPDATE positions SET posName='$name', numOfPositions='$num'
    WHERE posID=$id";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:position_view.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Update Position</h3>
<form method="post">
  <div class="form-group">
    <label>Position Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Number of Positions</label>
    <input type="number" class="form-control" name="num" min="1" value="<?php echo $num; ?>" required>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Update</button>
  <a href="position_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>