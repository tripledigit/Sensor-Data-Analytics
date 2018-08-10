<?php
  session_start();

  ?>

  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="utf-8">
      <title>DATABASE SETUP</title>
  </head>
  <body>
    <h1>Sensor Data Analytics</h1><br>
    <h4>Door middel van de links kunnen de verschillende pagina's worden geopend.</h4><br>
    <p><a href="dashboard.php">DASHBOARD</a></p><br>
    <p><a href="brugdbsetup.php">Database- en tabel setup</a></p><br>
    <p><a href="csvlezen.php">CSV bestand uitkiezen en in een tabel zetten</a></p><br>

    <form id="drop-db" name="drop-db" class = "drop-db" action="brugdbsetup.php" method="post"><br>
        Deze knop verwijdert de database: <br>
        <input type = "hidden"  id="exterminate" name="exterminate" value="exterminate"><br><br>
        <input type = "button" onclick = "submit()" value = "EXTERMINATE">
    </form>
    <form id="create-db" name="create-db" class = "create-db" action="brugdbsetup.php" method="post"><br>
        Deze knop doet de database setup: <br>
        <input type = "hidden"  id="exterminate" name="exterminate" value="create"><br><br>
        <input type = "button" onclick = "submit()" value = "CREATE">
    </form>
    <br><br>
  </body>
</html>

<?php

  //maak een tijd-variabele met opmaak en maak variabelen voor de DataBase verbinding
  $tijd= date('Y-m-d h:i:s');
  //maak variabelen voor de DataBase verbinding database naam en de 1e tabelnaam
  // $servername = "localhost";
  // $username = "arnold_blogje";
  // $password = "lFz9Tmpp8c";
    echo "Lijst van database gegevens:" . "<br>";
  $servername = "localhost";
  echo "servernaam:" . " " . $servername . "<br>";
  $password = "miner";
    echo "wachtwoord:" . " " . $password . "<br>";
  $username = "manic";
    echo "gebruikersnaam:" . " " . $username . "<br>";
  //dit is de naam van de DATABASE
  $dbname = "sourceDB";
    echo "databasenaam:" . " " . $dbname . "<br>";
  //dit is de naam van de tabel waarin de admins worden geregistreerd
  $admintabel = "admins";
    echo "admintabel:" . " " . $admintabel . "<br>";
  //dit is de naam van de tabel waarin alle gebruikers worden geregistreerd
  $gebruikerstabel = "gebruikers";
    echo "gebruikerstabel:" . " " . $gebruikerstabel . "<br>";
  //naam van de tabellenlijst
  $bruggenlijst = "bruggenlijst";
    echo "bruggenlijst:" . " " . $bruggenlijst . "<br>";

      echo "Ingevoerde tabellen:" . "<br>" . "hier komen de namen van ingevoerde tabellen te staan" . "<br>";
  //verbind met mysql server
  $conn = new PDO("mysql:host=$servername", $username, $password);
  // zet the PDO error mode op exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_POST["exterminate"]))
{
    // code...
  $reset = $_POST["exterminate"];


  if($reset == "exterminate")
{
    //verbind met mysql server
    $conn = new PDO("mysql:host=$servername", $username, $password);
    //zet the PDO error mode op exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //exterminate DataBase
    $sql = "DROP DATABASE $dbname";
    $conn->exec($sql);
    echo "Database " . $dbname . " exterminated successfully<br>";
    $conn = null;
}

  if($reset == "create")
{
    //verbind met mysql server
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // zet the PDO error mode op exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //maak database met naam Blogspul als deze nog niet bestaat:
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database " . $dbname . " created successfully<br>";
    $conn = null;

    // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //     // sql die nodig is om tabel te maken met kolommen-met-datatype
    //     $sql = "CREATE TABLE IF NOT EXISTS $blogtabel (
    //     id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     tijd TIMESTAMP,
    //     titel VARCHAR(30),
    //     naam VARCHAR(30),
    //     afbeeld VARCHAR(100),
    //     tekst TEXT,
    //     react TEXT,
    //     category VARCHAR(100)
    //     )";
    //     // use exec() because no results are returned
        // $conn->exec($sql);
        // echo "Table " . $blogtabel . " created successfully<br>";

    //maak admin tabel als deze nog niet bestaat
    // sql die nodig is om tabel te maken met kolommen-met-datatype
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $sql = "CREATE TABLE IF NOT EXISTS $admintabel (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        adminlidgew TIMESTAMP,
        admins VARCHAR(30),
        adminwoord VARCHAR(30),
        adminemail VARCHAR(30)
        )";
        // doe query die de tabel maakt
        $conn->exec($sql);
        echo "Table " . $admintabel . " created successfully<br>";
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //maak query om de gebruikers gegevens in de tabel in te voeren
        $sql = "INSERT INTO $admintabel (adminlidgew, admins, adminwoord, adminemail)
        VALUES ('$tijd', 'armandold', 'beniktemin', 'a.m.k.dijkstra@gmail.com')";
        //dit is de schrijfactie naar de betreffende tabel
        $conn->exec($sql);
          //standaar test-admin aanmaak boodschap
          echo "Hallo armandold, welkom bij de club." . "<br>";
          echo "Je wachtwoord is: beniktemin<br>";
          echo "Terug naar de beginpagina en lekker een beetje testen ofzo." . "<br>";

            // sql die nodig is om tabel te maken met kolommen-met-datatype
            // $sql = "CREATE TABLE IF NOT EXISTS $reactietabel (
            // id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            // blognum VARCHAR(30),
            // tijdr TIMESTAMP,
            // poster VARCHAR(30),
            // tekstr VARCHAR(50)
            // )";
            // // use exec() because no results are returned
            // $conn->exec($sql);
            // echo "Table " . $reactietabel . " created successfully<br>";

            //maak een tabel met naam: gebruikers als deze nog niet bestaat:
            // sql die nodig is om tabel te maken met kolommen-met-datatype
            $sql = "CREATE TABLE IF NOT EXISTS $gebruikerstabel (
                    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                      lidgew TIMESTAMP,
                      leden VARCHAR(30),
                      wachtwoord VARCHAR(30),
                      email VARCHAR(30),
                      token VARCHAR(50)
                      )";
          // doe query die de tabel maakt
          $conn->exec($sql);
          echo "Table " . $gebruikerstabel . " created successfully<br>";

          $sql = "CREATE TABLE IF NOT EXISTS $bruggenlijst (
                  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    gestart TIMESTAMP,
                    tabelnaam VARCHAR(30),
                    brugnaam VARCHAR(30),
                    referentiea VARCHAR(30),
                    referentieb VARCHAR(30),
                    referentiec VARCHAR(30),
                    foto VARCHAR(50)
                    )";
        // doe query die de tabel maakt
        $conn->exec($sql);
        echo "Table " . $bruggenlijst . " created successfully<br>";
}
}

$conn = null;

 ?>
