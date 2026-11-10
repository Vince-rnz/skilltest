<?php
include 'connect.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM employees WHERE empID=$id";
    $result = mysqli_query($con, $sql);
    if($result){
        header('location:emp_view.php');
    }else{
        die(mysqli_error($con));
    }
}
?>