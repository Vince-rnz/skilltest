<?php
include 'connect.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM participants WHERE partID=$id";
    $result = mysqli_query($con, $sql);
    if($result){
        header('location:participant_view.php');
    }else{
        die(mysqli_error($con));
    }
}
?>