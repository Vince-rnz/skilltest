<?php
session_start();
include 'connect.php';

$error = '';
if(isset($_POST['login'])){
    $id   = $_POST['voterID'];
    $pass = $_POST['voterPass'];

    $sql = "SELECT * FROM voters WHERE voterID='$id' AND voterPass='$pass'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if(!$row){
        $error = 'Wrong Voter ID or password.';
    }elseif($row['voterStat'] != 'active'){
        $error = 'Your voter account is inactive. You cannot vote.';
    }elseif($row['voted'] == 'Y'){
        $error = 'You have already voted. You cannot vote again.';
    }else{
        $_SESSION['voterID'] = $row['voterID'];
        header('location:vote.php');
        exit;
    }
}
include 'header.php';
?>

<h3>Voter Login</h3>

<?php
if(isset($_GET['done'])){
    echo '<div class="alert alert-success">Your vote has been submitted. Thank you!</div>';
}
if($error != ''){
    echo '<div class="alert alert-danger">'.$error.'</div>';
}
?>

<form method="post">
  <div class="form-group">
    <label>Voter ID</label>
    <input type="number" class="form-control" name="voterID" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="voterPass" required>
  </div>
  <button type="submit" class="btn btn-primary my-3" name="login">Login</button>
</form>

<?php include 'footer.php'; ?>