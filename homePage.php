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
	<head>

	</head>
	<body>
		<h1>Greatest Videogame Database Ever</h1>
		
		<table>
			<caption>What would you like to search for?<caption>
			<tr>
				<td><input type = "submit" value = "Videogame" id = "videogame">
				<td><input type = "submit" value = "Platform" id = "platform">
				<td><input type = "submit" value = "Developer" id = "developer">
				<td><input type = "submit" value = "Artist" id = "artist">
				<td><input type = "submit" value = "Composer" id = "composer">
				<td><input type = "submit" value = "Genre" id = "genre">
				<td><input type = "submit" value = "Series" id = "series">
				<td><input type = "submit" value = "Character" id = "character">
				<td><input type = "submit" value = "Lead Programmer" id = "programmer">
			</tr>
		</table>
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

$query = "SELECT vg.title, d.name, vg.releaseMonth, vg.releaseDay, vg.releaseYear, gs.title FROM video_game vg INNER JOIN developer d ON d.developer_id = vg.developer INNER JOIN game_series gs ON gs.series_id = vg.gameSeries WHERE vg.releaseYear >= 2015";

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