<?php
//session_start();
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

    <title>CSV LEZEN</title>
</head>
  <body>
    <body class="p-3 mb-2 bg-info text-white">
      <h1 class = "x">Sensor Data Analytics</h1><br>
        <p ><a class="btn btn-primary p-3 mb-2 bg-success text-white" href="index.html">Terug naar indexpagina</a></p>
    <!-- <p><a href="brugdbsetup.php">Database- en tabel setup</a></p><br>
    <p><a href="csvlezen.php">CSV bestand uitkiezen en in een tabel zetten</a></p><br> -->
        <div class="p-3 mb-2 bg-secondary text-white">


<!-- The data encoding type, enctype, MUST be specified as below -->
<form action = "upload.php" enctype="multipart/form-data" action="__URL__" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="130107" />
    Vul de nieuwe tabelnaam in: <input name="tabelnaam" type="text" /><br><br>
    Vul de naam van de brug in: <input name="brugnaam" type="text" /><br><br>
    <!-- Name of input element determines name in $_FILES array -->
    Kies het te lezen bestand: <br><input class="btn btn-primary" name="userfile" type="file" /><br><br>
    <input class="btn btn-primary" type="submit" value="Upload" /><br><br>
    Het uploaden kan even duren afhankelijk van de bestandsgrootte.
</form>



  </div>
</body>







</html>
