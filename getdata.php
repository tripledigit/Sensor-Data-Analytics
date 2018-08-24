<?php
//session_start();
include 'brugdbconn.php';
// if(empty($_POST["detabel"]))
// {
//   header('Location: /dashboard.php');
//   exit;
// }

//data open-dicht omzetten naar 0 en 1 ofzo
$tabelnaam = "brugdepunt";
$myObj = array();
$sql = "SELECT toestand FROM $tabelnaam ORDER BY id ASC";
$result = $conn->query($sql);
$resultX = $result->setFetchMode(PDO::FETCH_ASSOC);
//$result;

foreach ($result as $row)
{ //echo $row['toestand'];
  if($row['toestand'] == "open"){$brug = "1";}
  else { $brug = "0";}

array_push($myObj,$brug );
//print_r($row);
//echo "<br><br>";
}
//var_dump($myObj);
$myJSON = json_encode($myObj);
//var_dump($myJSON);
echo $myJSON;
//holds variables from PHP
$conn = null;
?>
