<?php
include 'connect.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM events WHERE evCode=$id";
    $result = mysqli_query($con, $sql);
    if($result){
        header('location:event_view.php');
    }else{
        die(mysqli_error($con));
    }
}
?>