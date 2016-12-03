<!-- **************************************
**** filename: add-gcharacter.php
**** created: November 26, 2016
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
		<?php include "navBar.php"; ?>
		</div>
		<br />

<?php
	// Prepare a SQL statement to add the values to a row in the game_char table 
	// the values to insert are passed via a form to this page
	if (!($stmt = $mysqli->prepare("INSERT INTO game_char (game_id,char_id) VALUES (?,?)"))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("ii", $_POST['gid'], $_POST['cid']))){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Inserted " . $stmt->affected_rows . " rows into game_char.";
	}

	$stmt->close();
?>
		
		<br />
		<br />
		<a class="button" href="/~cappsc/game-characters.php">Back to Games Characters</a>
		<a class="button" href="/~cappsc/home.php">Home</a>

	</body>
</html>