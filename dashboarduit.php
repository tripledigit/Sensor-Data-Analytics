<?php
include './brugdbconn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>TABEL UITVOER</title>
	<!-- Bootstrap core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/1-col-portfolio.css" rel="stylesheet">

	<p><a class="btn btn-primary p-3 mb-2 bg-success text-white" href="ainvoer.php">Terug naar invoerpagina</a></p><br>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body div class="p-3 mb-2 bg-info text-white">
	<div class="p-3 mb-2 bg-secondary text-white">
	<?php
		$brug = $_POST["brugnaam"];
		$tx = $_POST["datum"];
		if ($_POST['datum'] == FALSE){$tx = "00-00-00";}
		$ta = $_POST["dagdeel"];

				//maak periode-test-variabelen aan de hand van gekozen dagdeel
				if($ta<"1" OR $ta>"4"){$tb = $tx . " 00:00";  $te = $tx . " 23:59";}
				if($ta =="1") {$tb = $tx . " 00:00";  $te = $tx . " 06:00";}
				if($ta =="2") {$tb = $tx . " 06:00";  $te = $tx . " 12:00";}
			  if($ta =="3") {$tb = $tx . " 12:00";  $te = $tx . " 18:00";}
				if($ta =="4") {$tb = $tx . " 18:00";  $te = $tx . " 23:59";}

		echo "<h1>Brug:" . " " . $brug . " tussen" . " " . $tb . " en " . $te . "</h1><br>";

				//maak getallen van de datum te kunnen vergelijken
				$tbd = preg_replace("/[^a-zA-Z0-9]/", "",$tb);
				//echo $tbd;
				$ted = preg_replace("/[^a-zA-Z0-9]/", "",$te);
				//echo $ted;
?>
<div class="p-3 mb-2 bg-info text-white">
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100 ver1 m-b-110">
					<div class="table100-head">
						<table>
							<thead>
								<tr class="row100 head">

									<th class="cell100 column1">Entry Nummer</th>
									<th class="cell100 column2">Sensor ID</th>
									<th class="cell100 column3">Tijd</th>
									<th class="cell100 column4">Toestand</th>
									<!-- <th class="cell100 column5">Spots</th> -->
								</tr>
							</thead>
						</table>
					</div>

					<div class="table100-body js-pscroll">
						<table>
							<tbody>

<?php

								$tabelnaam = $_POST["detabel"];
								//query met dag selectie uit de timestamp (timestamp is eigenlijk een string)
				        $sql = "SELECT * FROM $tabelnaam WHERE tijd LIKE :tijd ORDER BY id ASC";
				        $tx = "%$tx%";
				        $statement = $conn->prepare($sql);
				        //$result = $conn->query($sql); andere fetch methode
				        $statement->bindValue(':tijd', $tx);
				        $statement->execute();
				        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
				        		//echo $tx . "<br>";
				     foreach ($result as $row){
								//maak van de datum uit de database een getal
								$test = preg_replace("/[^a-zA-Z0-9]/", "",$row['tijd']);
								// echo $test; echo $tbd; echo $ted;
								// test of de gevonden tijd binnen het gekozen dagdeel valt
								//zo ja, zet de data in de tabel op het scherm
						if(($test>=$tbd) AND ($test<=$ted)){
								echo "<tr class=\"row100 body\">
									 <td class=\"cell100 column1\">" . $row['id'] . "</td>" .
									"<td class=\"cell100 column2\">" . $row['code'] . "</td>" .
									"<td class=\"cell100 column3\">" . $row['tijd'] . "</td>" .
									"<td class=\"cell100 column4\">" . $row['toestand'] . "</td>" .
									"</tr>";
								}}

$conn = null;
//							vanaf een positie karakters uit een string lezen
//              en in variabele zetten
// 			        $tma = substr($row['tijd'], -5, 2);
// 				      $tmb = substr($row['tijd'], -2, 2);
// 							echo $tma ."<br>";
// 							echo $tmb ."<br>";
?>

							</tbody>
						</table>
					</div>
				</div>



						<!-- </table>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});


	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
