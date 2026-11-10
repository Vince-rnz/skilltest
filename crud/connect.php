
<?php
// Connect to XAMPP MariaDB on port 3307
$con = new mysqli('127.0.0.1', 'root', '', 'crudoperation', 3307);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>

<!-- create database crudoperation;
use crudoperation; 
create table crud(
    -> id INT AUTO_INCREMENT PRIMARY KEY,
    -> name VARCHAR(100),
    -> email VARCHAR(100),
    -> mobile VARCHAR(50),
    -> password VARCHAR(255)); -->
<!-- 
    <!doctype html>
<html lang="en">
  <head>
    //Required meta tags
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   //Bootstrap CSS
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>

  </body>
</html> -->