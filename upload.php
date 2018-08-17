<?php
//session_start();
include './brugdbconn.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CSV UPLOAD</title>
</head>
  <body>
    <h1>Sensor Data Analytics</h1><br>
    <h4>Door middel van de links kunnen de verschillende pagina's worden geopend.</h4><br>
    <p><a href="index.html">Index</a></p><br>
    <p><a href="dashboard.php">DASHBOARD</a></p><br>
    <p><a href="brugdbsetup.php">Database- en tabel setup</a></p><br>
    <p><a href="csvlezen.php">CSV bestand uitkiezen en in een tabel zetten</a></p><br>

  </body>
</html>

<?php
//maak een tijd-variabele met opmaak
$tijd= date('Y-m-d h:i:s');
$tabelnaam = $_POST["tabelnaam"];
$brugnaam = $_POST["brugnaam"];
$bruggenlijst = "bruggenlijst";
$uploaddir = '/var/www/html/uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

//echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Bestand is geldig en is goed opgeslagen.\n";
} else {
    echo "Upload mislukt";
}

// $tabelnaam = "brugdepunt";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$sql = "CREATE TABLE IF NOT EXISTS $tabelnaam (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(30),
    tijd TIMESTAMP,
    toestand VARCHAR(30)
    )";
    // doe query die de tabel maakt
    $conn->exec($sql);
    echo "Tabel " . $tabelnaam . " is aangemaakt.<br>";

//aantal regels per keer
$row = 1;
//ivm met end of line, er wordt hier dus geen ";" gebruikt
ini_set('auto_detect_line_endings',TRUE);
if (($handle = fopen("$uploadfile", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 100, ";")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            //echo $data[$c] . "<br />\n";
        }
        //query om de gebruikers gegevens in de tabel in te voeren
        $sql = "INSERT INTO $tabelnaam (code, tijd, toestand)
        VALUES ('$data[0]', '$data[1]', '$data[2]')";
        //dit is de schrijfactie naar de betreffende tabel
        $conn->exec($sql);


        // $sql = "CREATE TABLE IF NOT EXISTS $bruggenlijst (
        //         id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        //           gestart TIMESTAMP,
        //           tabelnaam VARCHAR(30),
        //           brugnaam VARCHAR(30),
        //           referentieb VARCHAR(30),
        //           referentiec VARCHAR(30),
        //           referentied VARCHAR(30),
        //           foto VARCHAR(50)
        //           )";

    }
    fclose($handle);

}
//query om de tabelnaam en de brugnaam in de tabellijst te zetten
$sql = "INSERT INTO $bruggenlijst (tabelnaam, brugnaam, referentiea, referentieb, referentiec, foto)
VALUES ('$tabelnaam', '$brugnaam', 'a', 'b', 'c', 'plaatje')";
//dit is de schrijfactie naar de betreffende tabel
$conn->exec($sql);


$conn = null;
?>
