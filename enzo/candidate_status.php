<?php
include 'connect.php';
$id   = $_GET['id'];
$stat = $_GET['stat'];

$sql = "UPDATE candidates SET candStat='$stat' WHERE candID=$id";
$result = mysqli_query($con, $sql);
if($result){
    header('location:candidate_view.php');
}else{
    die(mysqli_error($con));
}
?>