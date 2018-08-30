<?php


  //Database lokale verbindings variabelen
  $servername = "localhost";
  $password = "pass";
  $username = "user";
  $dbname = "sourceDB";

  //verbind met mysql server
  $conn = new PDO("mysql:dbname=$dbname;host=$servername", $username, $password);
  // zet the PDO error mode op exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
