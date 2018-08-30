<?php
include 'brugdbconn.php';
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" type="text/css" href="dashboardstyle.css"> -->
    <title>Toon Bruggendata</title>
</head>
  <body>
    <h1 class = "x">Toon bruggendata</h1><br>
    <p class = "a"><a href="index.html">Index</a></p><br>
    <!-- <p class = "b"><a href="dashboard.php">DASHBOARD</a></p><br> -->
    <p class = "c"><a href="csvlezen.php">CSV bestand uitkiezen en in een tabel zetten</a></p><br>
    <h1 class = "y">Klik op een knop om informatie in een tabel op het scherm te tonen:</h1><br>
    <h1 class = "y">Klik hier om Informatie in een tabel weer te geven:<a href="ainvoer.php">Tabel invoer</a></h1><br>
    <h1 class = "y">Klik hier om informatie in een staafdiagram weer te geven:<a href="kolominvoer.php">Staafdiagram invoer</a></h1><br>

<?php

    echo "<br><br>";
    $sql = "SELECT * FROM bruggenlijst ORDER BY id DESC";
    $result = $conn->query($sql);
    $result;
    foreach ($result as $row)
{
      $n = "0";
      $n++;
      $tabel = $row['tabelnaam'];
      $brugnaam = $row['brugnaam'];
      $button = "<form id=\"tabel\" name=\"tabel\" class =\"brug$n\" action=\"dashboarduitalles.php\" method=\"post\"> <br>
      <input id = \"detabel\" type = \"hidden\" name = \"detabel\" value = \"$tabel\">
      <input id = \"brugnaam\" type = \"hidden\" name = \"brugnaam\" value = \"$brugnaam\">
      <input id = \"knop\" type = \"button\" onclick = \"submit()\" value = \"$brugnaam\"> </form> <br>";
      echo "Tabel van alle data" . $button;
}
echo "<br><br>";
$sql = "SELECT * FROM bruggenlijst ORDER BY id DESC";
$result = $conn->query($sql);
$result;
foreach ($result as $row)
{
  $n = "0";
  $n++;
  $tabel = $row['tabelnaam'];
  $brugnaam = $row['brugnaam'];
  $button = "<form id=\"tabel\" name=\"tabel\" class =\"brug$n\" action=\"kolomdiagramalles.php\" method=\"post\"> <br>
  <input id = \"detabel\" type = \"hidden\" name = \"detabel\" value = \"$tabel\">
  <input id = \"brugnaam\" type = \"hidden\" name = \"brugnaam\" value = \"$brugnaam\">
  <input id = \"knop\" type = \"button\" onclick = \"submit()\" value = \"$brugnaam\"> </form> <br>";
  echo "Kolomdiagram van alle data" . $button;
}


$conn = null;
?>
</body>
</html>
