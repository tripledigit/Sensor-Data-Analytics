<?php
//session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" type="text/css" href="csvlezenstyle.css"> -->
    <title>CSV LEZEN</title>
</head>
  <body>
    <h1 class = "x">Sensor Data Analytics</h1><br>
    <h4>Door middel van de links kunnen de verschillende pagina's worden geopend.</h4><br>
    <p><a href="index.html">Terug naar begin pagina</a></p><br>
    <!-- <p><a href="brugdbsetup.php">Database- en tabel setup</a></p><br>
    <p><a href="csvlezen.php">CSV bestand uitkiezen en in een tabel zetten</a></p><br> -->



<!-- The data encoding type, enctype, MUST be specified as below -->
<form action = "upload.php" enctype="multipart/form-data" action="__URL__" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="130107" />
    Vul de nieuwe tabelnaam in: <input name="tabelnaam" type="text" /><br><br>
    Vul de naam van de brug in: <input name="brugnaam" type="text" /><br><br>
    <!-- Name of input element determines name in $_FILES array -->
    Kies het te lezen bestand: <br><input name="userfile" type="file" /><br><br>
    <input type="submit" value="Upload" /><br><br>
    Het uploaden kan even duren afhankelijk van de bestandsgrootte.
</form>

</body>







</html>
