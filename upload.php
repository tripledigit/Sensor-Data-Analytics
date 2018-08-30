<?php
//session_start();
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
    <title>CSV UPLOAD</title>

</head>
    <body class="p-3 mb-2 bg-info text-white">
      <p ><a class="btn btn-primary p-3 mb-2 bg-success text-white" href="index.html">Terug naar indexpagina</a></p>
        <h1>Sensor Data Analytics</h1><br>

<?php
//variabelen
$tijd= date('Y-m-d h:i:s');
$tabelnaam = $_POST["tabelnaam"];
$brugnaam = $_POST["brugnaam"];
$bruggenlijst = "bruggenlijst";
$uploaddir = './uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

//echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "<h2>Bestand is geldig en is goed opgeslagen.</h2><br>\n";
} else {
    echo "<h2>Upload mislukt</h2>";
}

// $tabelnaam = "brugdepunt";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$sql = "CREATE TABLE IF NOT EXISTS $tabelnaam (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    entry VARCHAR(30),
    code VARCHAR(30),
    tijd VARCHAR(30),
    ustijd TIMESTAMP,
    toestand VARCHAR(30)
    )";

    // doe query die de tabel maakt
    $conn->exec($sql);
    echo "<h2>Tabel " . $tabelnaam . " is aangemaakt.</h2><br>";

//aantal regels per keer
$row = "1";
//ivm met end of line, er wordt hier dus geen ";" gebruikt
ini_set('auto_detect_line_endings',TRUE);
if (($handle = fopen("$uploadfile", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 100, ";")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        $entry = "09";
        for ($c=0; $c < $num; $c++) {
            //echo $data[$c] . "<br />\n";
        }
        //query om de gebruikers gegevens in de tabel in te voeren
        $sql = "INSERT INTO $tabelnaam (entry, code, tijd, toestand)
        VALUES ('$entry', '$data[0]', '$data[1]', '$data[2]')";

        //dit is de schrijfactie naar de betreffende tabel
        $conn->exec($sql);
        $lastid = $conn->lastInsertId();

        $last = $lastid;
    }
    fclose($handle);
}

$sql ="SELECT tijd FROM $tabelnaam";
  $statement = $conn->prepare($sql);
  $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row){

  $ta = substr($row['tijd'], -5, 5);
  $tb = substr($row['tijd'], -8, 2);
  $tc = substr($row['tijd'], -11, 2);
  $td = substr($row['tijd'], -14, 2);
  $tx = $row['tijd'];
  $taim = "20" . $tb . "-" . $tc . "-" . $td . " " . $ta . ":00";

$sql = "UPDATE $tabelnaam SET entry = '$last', ustijd = '$taim' WHERE tijd = '$tx'";

$last--;

  //dit is de schrijfactie naar de betreffende tabel
  $statement = $conn->prepare($sql);
  $statement->execute();
}

//query om de tabelnaam en de brugnaam in de tabellijst te zetten
$sql = "INSERT INTO $bruggenlijst (tabelnaam, brugnaam, referentiea, referentieb, referentiec, foto)
        VALUES ('$tabelnaam', '$brugnaam', 'a', 'b', 'c', 'plaatje')";

        //dit is de schrijfactie naar de betreffende tabel
        $conn->exec($sql);


$conn = null;
?>



<!-- <p><a href="dashboard.php">DASHBOARD</a></p><br>
<p><a href="brugdbsetup.php">Database- en tabel setup</a></p><br>
<p><a href="csvlezen.php">CSV bestand uitkiezen en in een tabel zetten</a></p><br> -->
    </body>
</html>
