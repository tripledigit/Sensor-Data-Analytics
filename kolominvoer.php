<?php
include './brugdbconn.php';
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
	<title>Kolomdiagram opvragen</title>
</head>

  <body class="p-3 mb-2 bg-info text-white">
		<p><a class="btn btn-primary p-3 mb-2 bg-success text-white" href="index.html">Terug naar indexpagina</a></p>
    <h1>data, datum en periode keuze</h1>
    <h2>Vul een datum- (dd-mm-jj) en een dagdeel in (1, 2, 3, 4) en kies een brug. </h2>
    <h2>De informatie wordt dan in een kolomdiagram getoond. </h2>
    <!-- <h2>Als geen datum of dagdeel wordt ingevuld dan wordt alle data getoond. </h2><br> -->
    <h3>Dagdelen zijn : <br><br>
    1 = 0-6 uur <br>
    2 = 6-12 uur <br>
    3 = 12-18 uur <br>
    4 = 18-24 uur </h3>

		<div class="p-3 mb-2 bg-secondary text-white">
<?php

    $sql = "SELECT * FROM bruggenlijst ORDER BY id DESC";
    $result = $conn->query($sql);

    foreach ($result as $row)
{
      $n = "0";
      $n++;
      $tabel = $row['tabelnaam'];
      $brugnaam = $row['brugnaam'];
      $button = "<form id=\"tabel\" name=\"tabel\" class =\"brug$n\" action=\"kolomdiagram.php\" method=\"post\">
      <input id = \"detabel\" type = \"hidden\" name = \"detabel\" value = \"$tabel\">
      <input id = \"brugnaam\" type = \"hidden\" name = \"brugnaam\" value = \"$brugnaam\">
      DATUM:<br>
      <input id = \"datum\" type=\"text\" name=\"datum\" value = \"08-07-18\"><br>
      DAGDEEL:<br>
      <input id = \"dagdeel\" type=\"text\" name=\"dagdeel\" value = \"\"><br>
      <input class=\"p-1 mb-2 bg-warning text-dark\" id = \"knop\" type = \"button\" onclick = \"submit()\" value = \"$brugnaam\"></form>";
      echo $button;
}

$conn = null;
?>
		</div>
  </body>
</html>
