<?php
include 'connect.php';
$id   = $_GET['id'];
$stat = $_GET['stat'];

$sql = "UPDATE positions SET posStat='$stat' WHERE posID=$id";
$result = mysqli_query($con, $sql);
if($result){
    header('location:position_view.php');
}else{
    die(mysqli_error($con));
}
?>