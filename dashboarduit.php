<?php
session_start();
include 'brugdbconn.php';
if(empty($_POST["detabel"]))
{
  header('Location: /dashboard.php');
  exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="dashboarduitstyle.css">
    <title>Brug Data</title>
</head>
  <body>
    <h1 class = "x">BRUG DATA</h1><br>
    <p class = "a"><a href="index.html">Index</a></p><br>
    <p class = "b"><a href="dashboard.php">DASHBOARD</a></p><br>

<?php

//placeholder 
echo   "NUM" . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "
      . "SENSOR" . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "
      . "TIJD" . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "
      . "TOESTAND" . "<br>";
//if spost detabel = true then stabelnaam = spost detabel etc etc
$tabelnaam = $_POST["detabel"];

$sql = "SELECT * FROM $tabelnaam ORDER BY id DESC";
$result = $conn->query($sql);
$result;
foreach ($result as $row)
{
  echo    $row['id'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "
        . $row['code'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "
        . $row['tijd'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "
        . $row['toestand'] . "<br>";
}






$conn = null;
?>
</body>
</html>
