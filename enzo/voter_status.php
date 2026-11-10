<?php
include 'connect.php';
$id   = $_GET['id'];
$stat = $_GET['stat'];

$sql = "UPDATE voters SET voterStat='$stat' WHERE voterID=$id";
$result = mysqli_query($con, $sql);
if($result){
    header('location:voter_view.php');
}else{
    die(mysqli_error($con));
}
?>