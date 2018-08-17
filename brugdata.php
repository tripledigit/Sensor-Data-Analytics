<?php
//session_start();
include 'brugdbconn.php';
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Toon Bruggendata</title>
</head>
  <body>
    <h1>Toon bruggendata</h1><br>
    <p><a href="index.html">Index</a></p><br>
    <p><a href="dashboard.php">DASHBOARD</a></p><br>
    <p><a href="brugdbsetup.php">Database- en tabel setup</a></p><br>
    <p><a href="csvlezen.php">CSV bestand uitkiezen en in een tabel zetten</a></p><br>
  </body>
</html>

<?php
  $tabelnaam = "brugdepunt";
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

      // id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      // code VARCHAR(30),
      // tijd TIMESTAMP,
      // toestand VARCHAR(30)


$conn = null;
?>
