<?php
//$con = mysqli_connect('localhost', 'root', '', 'events_db');
$con = new mysqli('127.0.0.1', 'root', '', 'events_db', 3307);

if(!$con){
    die(mysqli_connect_error());
}
?>

<!-- CREATE DATABASE events_db;
USE events_db;

CREATE TABLE events (
  evCode INT AUTO_INCREMENT PRIMARY KEY,
  evName TEXT,
  evDate DATE,
  evVenue TEXT,
  evRFee DECIMAL(10,2)
);

CREATE TABLE participants (
  partID INT AUTO_INCREMENT PRIMARY KEY,
  evCode INT,
  partFName TEXT,
  partLName TEXT,
  partDRate DECIMAL(10,2),
  FOREIGN KEY (evCode) REFERENCES events(evCode) ON DELETE CASCADE
);

CREATE TABLE registration (
  regCode INT AUTO_INCREMENT PRIMARY KEY,
  partID INT,
  regDate DATE,
  regFPaid DECIMAL(10,2),
  regPMode TEXT,
  FOREIGN KEY (partID) REFERENCES participants(partID) ON DELETE CASCADE
); -->