<?php
include 'connect.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM departments WHERE depCode=$id";
    $result = mysqli_query($con, $sql);
    if($result){
        header('location:dept_view.php');
    }else{
        die(mysqli_error($con));
    }
}
?>