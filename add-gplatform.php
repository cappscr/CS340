<!-- **************************************
**** filename: add-gplatform.php
**** created: November 22, 2016
**** author: Christopher Capps
**** class: Oregon State University CS 340
****************************************-->

<?php
	// Turn on error reporting
	ini_set('display_errors', 'On');

	// Connect to database
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cappsc-db","bUPxSJyB1RecNl7q","cappsc-db");

	if($mysqli->connect_errno){
		echo "Connection error: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<!-- Head information here -->
	</head>
	<style>
		/* Styling for buttons */
		a.button {
			-webkit-appearance: button;
			-moz-appearance: button;
			appearance: button;

			text-decoration: none;
			color: initial;
		}
	</style>
	<body>

	<!-- Row of navigation buttons -->
		<div>
			<table>
				<tr>
					<td><a class="button" href="developer.php">Developers</a></td>
					<td><a class="button" href="gameSeries.php">Game Series</a></td>
					<td><a class="button" href="genre.php">Genres</a></td>
					<td><a class="button" href="people.php">People</a></td>
					<td><a class="button" href="platform.php">Platforms</a></td>
					<td><a class="button" href="videogame.php">Video Games</a></td>
				</tr>
			</table>
		</div>
		<br />

<?php
	// Prepare a SQL statement to update the values for a selected row in the games_platform table 
	// the values to select the correct row are passed via a form to this page
	if (!($stmt = $mysqli->prepare("INSERT INTO games_platforms (game_id,platform_id) VALUES (?,?)"))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("ii", $_POST['gid'], $_POST['pid']))){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Inserted " . $stmt->affected_rows . " rows into games_platform.";
	}

	$stmt->close();
?>
		
		<br />
		<br />
		<a class="button" href="/~cappsc/game-platforms.php">Back to Games Platforms</a>
		<a class="button" href="/~cappsc/homePage.php">Home</a>

	</body>
</html>