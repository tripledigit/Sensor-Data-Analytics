<?php


  //Database lokale verbindings variabelen
  $servername = "localhost";
  $password = "wachtwoord";
  $username = "naam";
  $dbname = "sourceDB";
  //$pijlebrug = "pijlebrug";
  //$brugdepunt = "brugdepunt";
  $testtabel = "testtabel";
  //verbind met mysql server
  $conn = new PDO("mysql:dbname=$dbname;host=$servername", $username, $password);
  // zet the PDO error mode op exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
