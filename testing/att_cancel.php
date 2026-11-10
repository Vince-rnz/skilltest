<?php
include 'connect.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "UPDATE attendance SET attStat='Cancelled' WHERE attRN=$id";
    $result = mysqli_query($con, $sql);
    if($result){
        header('location:att_view.php');
    }else{
        die(mysqli_error($con));
    }
}
?>