<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $num  = $_POST['num'];

    $sql = "INSERT INTO positions(posName, numOfPositions, posStat)
    VALUES('$name','$num','open')";

    $result = mysqli_query($con, $sql);
    if($result){
        header('location:position_view.php');
    }else{
        die(mysqli_error($con));
    }
}
include 'header.php';
?>

<h3>Add Position</h3>
<form method="post">
  <div class="form-group">
    <label>Position Name</label>
    <input type="text" class="form-control" name="name" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Number of Positions</label>
    <input type="number" class="form-control" name="num" min="1" required>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Submit</button>
  <a href="position_view.php" class="btn btn-secondary my-3">Back</a>
</form>

<?php include 'footer.php'; ?>