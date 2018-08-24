<?php
include './brugdbconn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>TABEL UITVOER</title>
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
<body>
	<?php
		$brug = $_POST["brugnaam"];


		echo "<h1>Brug:" . " " . $brug  . "</h1><br>";

?>

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
				        $sql = "SELECT * FROM $tabelnaam ORDER BY id ASC";

				        $statement = $conn->prepare($sql);
				        $statement->execute();
				        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

				     foreach ($result as $row){
								echo "<tr class=\"row100 body\">
									 <td class=\"cell100 column1\">" . $row['id'] . "</td>" .
									"<td class=\"cell100 column2\">" . $row['code'] . "</td>" .
									"<td class=\"cell100 column3\">" . $row['tijd'] . "</td>" .
									"<td class=\"cell100 column4\">" . $row['toestand'] . "</td>" .
									"</tr>";
								}

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
	<!-- </div> -->


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