<?php
include './brugdbconn.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tabel opvragen</title>
</head>
  <body>

    <h1>data, datum en periode keuze</h1><br>
    <h2>Vul een datum- (dd-mm-jj) en een dagdeel in (1, 2, 3, 4) en kies een brug. </h2><br>
    <h2>De informatie wordt dan in een tabel getoond. </h2><br>
    <!-- <h2>Als geen datum of dagdeel wordt ingevuld dan wordt alle data getoond. </h2><br> -->
    <h3>Dagdelen zijn : <br><br>
    1 = 0-6 uur <br>
    2 = 6-12 uur <br>
    3 = 12-18 uur <br>
    4 = 18-24 uur </h3>


<?php
    // echo "<form id=\"inlog\" name=\"inlog\" action=\"ainvoer.php\" method=\"post\">
    //         <h3>Dagdeel:</h3><br>
    //         <input type=\"text\" name=\"Dagdeel\" value = \"0\"></form><br><br>";

    // echo "<br><br>";
    $sql = "SELECT * FROM bruggenlijst ORDER BY id DESC";
    $result = $conn->query($sql);

    foreach ($result as $row)
{
      $n = "0";
      $n++;
      $tabel = $row['tabelnaam'];
      $brugnaam = $row['brugnaam'];
      $button = "<form id=\"tabel\" name=\"tabel\" class =\"brug$n\" action=\"dashboarduit.php\" method=\"post\"> <br>
      <input id = \"detabel\" type = \"hidden\" name = \"detabel\" value = \"$tabel\">
      <input id = \"brugnaam\" type = \"hidden\" name = \"brugnaam\" value = \"$brugnaam\">
      DATUM:<br>
      <input id = \"datum\" type=\"text\" name=\"datum\" value = \"08-07-18\"><br><br>
      DAGDEEL:<br>
      <input id = \"dagdeel\" type=\"text\" name=\"dagdeel\" value = \"\"><br><br>
      <input id = \"knop\" type = \"button\" onclick = \"submit()\" value = \"$brugnaam\"></form>  <br>";
      echo $button;
}


echo "";
$conn = null;
?>

    <p><a href="dashboard.php">DASHBOARD</a></p><br>
    <br><br>
  </body>
</html>
