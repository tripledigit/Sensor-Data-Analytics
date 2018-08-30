<?php
include "brugdbconn.php";

  $brugnaam = $_POST["brugnaam"];
  $tx = $_POST["datum"];
  if ($_POST['datum'] == FALSE){$tx = "01-01-01";}
  $ta = $_POST["dagdeel"];

      //maak periode-test-variabelen aan de hand van gekozen dagdeel
      if($ta<"1" OR $ta>"4"){$tb = $tx . " 00:00";  $te = $tx . " 23:59";}
      if($ta =="1") {$tb = $tx . " 00:00";  $te = $tx . " 06:00"; $tmin = "00"; $tmax = "06";}
      if($ta =="2") {$tb = $tx . " 06:00";  $te = $tx . " 12:00"; $tmin = "06"; $tmax = "12";}
      if($ta =="3") {$tb = $tx . " 12:00";  $te = $tx . " 18:00"; $tmin = "12"; $tmax = "18";}
      if($ta =="4") {$tb = $tx . " 18:00";  $te = $tx . " 23:59"; $tmin = "18"; $tmax = "24";}
      if($ta =="5") {$tb = $tx . " 00:00";  $te = $tx . " 23:59"; $tmin = "00"; $tmax = "24";}
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
  <p><a class="btn btn-primary p-3 mb-2 bg-success text-white" href="kolominvoer.php">Terug naar invoerpagina</a></p>

<?php
      echo "<h1>Brug:" . " " . $brugnaam . " tussen" . " " . $tb . " en " . $te . "</h1><br>";

      //maak getallen van de datum te kunnen vergelijken
      $tbd = preg_replace("/[^a-zA-Z0-9]/", "",$tb);
      //echo $tbd;
      $ted = preg_replace("/[^a-zA-Z0-9]/", "",$te);
      //echo $ted;
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="chart_div"></div>

<script>
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawAxisTickColors);

function drawAxisTickColors() {
  var data = new google.visualization.DataTable();
  data.addColumn('timeofday', 'TIJD');
  data.addColumn('number', 'SENSOR1');
  data.addColumn('number', 'SENSOR2');

      data.addRows([
<?php
        // vertical $tma, $tmb , $brug
        $tx = $_POST['datum'];
        $tabelnaam = $_POST['detabel'];

        $sql = "SELECT * FROM $tabelnaam WHERE tijd LIKE :tijd ORDER BY id ASC";
        $tx = "%$tx%";
        $statement = $conn->prepare($sql);

        $statement->bindValue(':tijd', $tx);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row)
        {
          if($row['toestand'] == "open"){$brug = "100";}
          else { $brug = "50";}

        $tma = substr($row['tijd'], -5, 2);
        $tmb = substr($row['tijd'], -2, 2);

        echo "[{v: [" . $tma . "," . $tmb . ", 0],}, " . $brug . "," . $brug . "],";
        }
?>
      ]);

      var options = {
        title: '<?php   echo "Brug:" . " " . $brugnaam . " tussen" . " " . $tb . " en " . $te ;?>',
        focusTarget: 'category',
        hAxis: {
          title: 'Tijd',
          format: 'HH:MM',
          viewWindow: {
            min: [<?php echo $tmin; ?>, 0, 0],
            max: [<?php echo $tmax; ?>, 0, 0]
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
