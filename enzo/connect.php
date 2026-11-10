<?php
//$con = mysqli_connect('localhost', 'root', '', 'election_db');
$con = new mysqli('127.0.0.1', 'root', '', 'election_db', 3307);

if(!$con){
    die(mysqli_connect_error());
}
?>

<!-- CREATE DATABASE election_db;
USE election_db;

CREATE TABLE positions (
  posID INT AUTO_INCREMENT PRIMARY KEY,
  posName TEXT,
  numOfPositions INT,
  posStat VARCHAR(10) DEFAULT 'open'
);

CREATE TABLE voters (
  voterID INT AUTO_INCREMENT PRIMARY KEY,
  voterPass VARCHAR(50),
  voterFName TEXT,
  voterMName TEXT,
  voterLName TEXT,
  voterStat VARCHAR(10) DEFAULT 'active',
  voted CHAR(1) DEFAULT 'N'
);

CREATE TABLE candidates (
  candID INT AUTO_INCREMENT PRIMARY KEY,
  candFName TEXT,
  candMName TEXT,
  candLName TEXT,
  posID INT,
  candStat VARCHAR(10) DEFAULT 'active',
  FOREIGN KEY (posID) REFERENCES positions(posID)
);

CREATE TABLE votes (
  posID INT,
  voterID INT,
  candID INT,
  PRIMARY KEY (voterID, candID),
  FOREIGN KEY (posID) REFERENCES positions(posID),
  FOREIGN KEY (voterID) REFERENCES voters(voterID),
  FOREIGN KEY (candID) REFERENCES candidates(candID)
); -->