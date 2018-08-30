<?php
include 'brugdbconn.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" type="text/css" href="dashboardstyle.css"> -->
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/1-col-portfolio.css" rel="stylesheet">

    <title>Toon Bruggendata</title>

</head>
  <body class="p-3 mb-2 bg-info text-white">

    <p ><a class="btn btn-primary p-3 mb-2 bg-success text-white" href="index.html">Terug naar indexpagina</a></p>
    <h3 class = "x">Toon alle data van een brug.</h3>
    <!-- <p class = "b"><a href="dashboard.php">DASHBOARD</a></p><br> -->
    <div class="p-3 mb-2 bg-secondary text-white">

<?php

    //echo "<br><br>";
    $sql = "SELECT * FROM bruggenlijst ORDER BY id DESC";
    $result = $conn->query($sql);
    $result;
    foreach ($result as $row)
{
      $n = "0";
      $n++;
      $tabel = $row['tabelnaam'];
      $brugnaam = $row['brugnaam'];
      $button = "<form id=\"tabel\" name=\"tabel\" class =\"brug$n\" action=\"dashboarduitalles.php\" method=\"post\">
      <input id = \"detabel\" type = \"hidden\" name = \"detabel\" value = \"$tabel\">
      <input id = \"brugnaam\" type = \"hidden\" name = \"brugnaam\" value = \"$brugnaam\">

      <input class=\"btn btn-primary\" id = \"knop\" type = \"button\" onclick = \"submit()\" value = \"$brugnaam\"> </form> <br>";
      echo "<h4>Tabel van:</h4>" . $button;
}
//echo "<br><br>";
// $sql = "SELECT * FROM bruggenlijst ORDER BY id DESC";
// $result = $conn->query($sql);
// $result;
// foreach ($result as $row)
// {
//   $n = "0";
//   $n++;
//   $tabel = $row['tabelnaam'];
//   $brugnaam = $row['brugnaam'];
//   $button = "<form id=\"tabel\" name=\"tabel\" class =\"brug$n\" action=\"kolomdiagramalles.php\" method=\"post\"> <br>
//   <input id = \"detabel\" type = \"hidden\" name = \"detabel\" value = \"$tabel\">
//   <input id = \"brugnaam\" type = \"hidden\" name = \"brugnaam\" value = \"$brugnaam\">
//   <input id = \"knop\" type = \"button\" onclick = \"submit()\" value = \"$brugnaam\"> </form> <br>";
//   echo "Kolomdiagram van alle data" . $button;
// }


$conn = null;
?>
</div>
</body>
</html>
