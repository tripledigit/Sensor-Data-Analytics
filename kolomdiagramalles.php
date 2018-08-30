<?php
include "brugdbconn.php";

  $brugnaam = $_POST["brugnaam"];
  //$brugnaam = "De Punt";

  $tabelnaam = $_POST['detabel'];
  //$tabelnaam = "brugdepunt";
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
  <p><a class="btn btn-primary p-3 mb-2 bg-success text-white" href="dashboardstaaf.php">Terug naar vorige pagina</a></p>

<?php

  // zoek het aantal entries
  // $sql = "SELECT COUNT(*) FROM $tabelnaam";
  // $result = $conn->query($sql);
  // $rijen = $result->fetchcolumn();

  $sql = "SELECT tijd FROM $tabelnaam ORDER BY cast(entry as unsigned) ASC LIMIT 1";
  $statement = $conn->prepare($sql);
  $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
      $tb = $row['tijd'];

      $tbdag = substr($row['tijd'], -14, 2);
      $tbmd = substr($row['tijd'], -11, 2);
      $tbmnd = $tbmd - "1";
      $tbjr = substr($row['tijd'], -8, 2);
      $tbjar = "20" . $tbjr;
      $tbuur = substr($row['tijd'], -5, 2);
      $tbmin = substr($row['tijd'], -2, 2);

      //echo $tbjar . ", " . $tbmnd . ", " . $tbdag . ", " . $tbuur . ", " . $tbmin;

  $sql = "SELECT tijd FROM $tabelnaam ORDER BY cast(entry as unsigned) DESC LIMIT 1";
  $statement = $conn->prepare($sql);
  $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
      $te = $row["tijd"];

      $tedag = substr($row['tijd'], -14, 2);
      $temd = substr($row['tijd'], -11, 2);
      $temnd = $temd - "1";
      $tejr = substr($row['tijd'], -8, 2);
      $tejar = "20" . $tbjr;
      $teuur = substr($row['tijd'], -5, 2);
      $temin = substr($row['tijd'], -2, 2);

      //$tejar . ", " . $temnd . ", " . $tedag . ", " . $teuur . ", " . $temin;


      echo "<h1>Brug:" . " " . $brugnaam . " tussen" . " " . $tb . " en " . $te . "</h1><br>";

      //maak getallen van de datum te kunnen vergelijken
      // $tbd = preg_replace("/[^a-zA-Z0-9]/", "",$tb);
      //echo $tbd;
      // $ted = preg_replace("/[^a-zA-Z0-9]/", "",$te);
      //echo $ted;
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="chart_div"></div>

<script>
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawAxisTickColors);

function drawAxisTickColors() {
  var data = new google.visualization.DataTable();
  data.addColumn('date', 'TIJD');
  data.addColumn('number', 'SENSOR1');
  data.addColumn('number', 'SENSOR2');

      data.addRows([
<?php
        //vertical $tma, $tmb , $brug
        //$tx = $_POST['datum'];
       //$tabelnaam = $_POST['detabel'];



        $sql = "SELECT * FROM $tabelnaam"; // WHERE tijd LIKE :tijd ORDER BY id ASC";
        //$tx = "%$tx%";
        $statement = $conn->prepare($sql);

        //$statement->bindValue(':tijd', $tx);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row)
        {
          if($row['toestand'] == "open"){$brug = "100";}
          else { $brug = "50";}

        $tmd = substr($row['tijd'], -14, 2);
        $tmm = substr($row['tijd'], -11, 2);
        $tmmd = $tmm - "1";
        $tjr = substr($row['tijd'], -8, 2);
        $tjar = "20" . $tjr;
        $tma = substr($row['tijd'], -5, 2);
        $tmb = substr($row['tijd'], -2, 2);
?>
        [{v: new Date(<?php echo $tjar . ", " . $tmmd . ", " . $tmd . ", " . $tma . ", " . $tmb; ?>),},
            <?php echo $brug; ?>,
            <?php echo $brug; ?>],
<?php
        }
?>
      ]);

      var options = {
        title: '<?php   echo "Brug:" . " " . $brugnaam . " tussen" . " " . $tb . " en " . $te ;?>',
        focusTarget: 'category',
        hAxis: {
          title: 'Datum',
          format: 'yyyy/M/d HH:MM',
          // gridlines: {count: 5}
          viewWindow: {
            /*21-06-18 09:47*/
            min: new Date(<?php echo $tbjar . ", " . $tbmnd . ", " . $tbdag . ", " . $tbuur . ", " . $tbmin; ?>),
            max: new Date(<?php echo $tejar . ", " . $temnd . ", " . $tedag . ", " . $teuur . ", " . $temin; ?>)
            // min: [0001, 01, 01],
            // max: [0002, 01, 01]
            // $tbdag = substr($row['tijd'], -14, 2);
            // $tbmnd = substr($row['tijd'], -11, 2);
            // $tbjr = substr($row['tijd'], -8, 2);
            // $tbjar = "20" . $tbjr;
            // $tbuur = substr($row['tijd'], -5, 2);
            // $tbmin = substr($row['tijd'], -2, 2);
          },
          textStyle: {
            fontSize: 14,
            color: '#053061',
            bold: true,
            italic: false
          },
          titleTextStyle: {
            fontSize: 18,
            color: '#053061',
            bold: true,
            italic: false
          }
        },
        vAxis: {
          title: 'Toestand OPEN-CLOSED',
          textStyle: {
            fontSize: 18,
            color: '#67001f',
            bold: false,
            italic: false
          },
          titleTextStyle: {
            fontSize: 18,
            color: '#67001f',
            bold: true,
            italic: false
          },
          bar: {
    groupWidth: 20
}
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>

<?php
$conn = null;
?>
</html>
