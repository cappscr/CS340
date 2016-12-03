<!-- **********************************************
**** filename: add-character.php
**** created: November 18, 2016
**** author: Christopher Capps
**** class: Oregon State University CS 340
************************************************* -->

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
		a.button {
			-webkit-appearance: button;
			-moz-appearance: button;
			appearance: button;

			text-decoration: none;
			color: initial;
		}
	</style>
	<body>
	
<div>
	<?php include 'navBar.php'; ?>
</div>

<?php
	if (!($stmt = $mysqli->prepare("INSERT INTO game_character (name) VALUES (?)"))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("s", $_POST['name']))){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Added " . $stmt->affected_rows . " rows to character.";
	}

	$stmt->close();
?>

		<br />
		<br />
		<a class="button" href="/~cappsc/character.php">Back to Characters</a>
		<a class="button" href="/~cappsc/home.php">Home</a>

	</body>
</html>