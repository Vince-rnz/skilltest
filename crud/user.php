<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `crud` (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$password')";

    $result = mysqli_query($con, $sql);
    if($result){
        // echo "Data inserted successfully";
        header('location:display.php');
    }else{
        die(mysqli_error($con));
    }
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Crud Operation</title>
  </head>
  <body>

  <div class="container my-5">
    <form method="post">

      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" placeholder="Enter Name" name="name" autocomplete="off">
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" placeholder="Enter Email" name="email" autocomplete="off">
      </div>

      <div class="form-group">
        <label>Mobile</label>
        <input type="text" class="form-control" placeholder="Enter Mobile" name="mobile" autocomplete="off">
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" placeholder="Enter Password" name="password" autocomplete="off">
      </div>

      <button type="submit" class="btn btn-primary my-3" name="submit">Submit</button>

    </form>
  </div>

   
  </body>
</html>