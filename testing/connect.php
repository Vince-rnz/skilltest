
<!-- $con = mysqli_connect('localhost', 'root', '', 'attendance_db');
if(!$con){
    die(mysqli_connect_error());
}  -->

<?php
// Connect to XAMPP MariaDB on port 3307
$con = new mysqli('127.0.0.1', 'root', '', 'attendance_db', 3307);

// Check connection
if (!$con) {
    die(mysqli_error($con));
}
?>

<!-- CREATE DATABASE attendance_db;
USE attendance_db;

CREATE TABLE departments (
  depCode INT PRIMARY KEY,
  depName VARCHAR(100),
  depHead VARCHAR(100),
  depTelNo VARCHAR(30)
);

CREATE TABLE employees (
  empID INT PRIMARY KEY,
  depCode INT,
  empFName VARCHAR(100),
  empLName VARCHAR(100),
  empRPH DECIMAL(10,2),
  FOREIGN KEY (depCode) REFERENCES departments(depCode) ON DELETE CASCADE
);

CREATE TABLE attendance (
  attRN INT AUTO_INCREMENT PRIMARY KEY,
  empID INT,
  attDate DATETIME,
  attTimeIn DATETIME,
  attTimeOut DATETIME,
  attStat VARCHAR(20) DEFAULT 'Active',
  FOREIGN KEY (empID) REFERENCES employees(empID) ON DELETE CASCADE
); -->