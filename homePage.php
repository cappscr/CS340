<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cappsc-db",
	"bUPxSJyB1RecNl7q","cappsc-db");

if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

?>


<!DOCTYPE html>
<html>

	<style>
			a.button {
				-webkit-appearance: button;
				-moz-appearance: button;
				appearance: button;

				text-decoration: none;
				color: initial;
			}
	</style>

	<head>

	</head>
	
	<div>
		<?php include 'navBar.php'; ?>
	</div>
	
	<body>
		<h1>Greatest Videogame Database Ever</h1>
		
		<br />
		<br />
		
		<form id = "searchForm">
			<input type="text" name="search" placeholder="Search...">
		</form>
		<br />
		<br />

		<table>
			<thead>
				<tr>
					<td><strong>Title</strong></td>
					<td><strong>Developer</strong></td>
					<td><strong>Release Date</strong></td>
					<td><strong>Game Series</strong></td>
				</tr>
			</thead>

<?php

$query = "SELECT vg.title, d.name, vg.releaseMonth, vg.releaseDay, vg.releaseYear, gs.title FROM video_game vg LEFT JOIN developer d ON d.developer_id = vg.developer LEFT JOIN game_series gs ON gs.series_id = vg.gameSeries ORDER BY vg.releaseYear DESC, vg.releaseMonth DESC, vg.releaseDay DESC LIMIT 5";

	if(!($stmt = $mysqli->prepare($query))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($title, $developer, $month, $day, $year, $series)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<tr>\n<td>\n" . $title . "\n</td>\n<td>\n" . $developer . "\n</td>\n<td>\n" . $month . "/" . $day . "/" . $year . "\n</td>\n<td>\n" . $series . "\n</td></tr>";
	}

	$stmt->close();
?>
		</table>
		
		<script src = "finalProject.js"></script>
	</body>
</html>