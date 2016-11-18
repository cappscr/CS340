<!-- **************************************
**** filename: update-platform.php
**** created: November 16, 2016
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
		a.button {
			-webkit-appearance: button;
			-moz-appearance: button;
			appearance: button;

			text-decoration: none;
			color: initial;
		}
	</style>
	<body>

<?php
	if (!($stmt = $mysqli->prepare("UPDATE platform SET name = ?, manufacturer = ?, cost = ?, releaseMonth = ?, releaseDay = ?, releaseYear = ?, graphics = ?, hardDrive = ?, RAM = ? WHERE platform_id = ?"))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("ssdiiisssi", $_POST['name'], $_POST['manufacturer'], $_POST['cost'], $_POST['releaseMonth'], $_POST['releaseDay'], $_POST['releaseYear'], $_POST['graphics'], $_POST['hardDrive'], $_POST['RAM'], $_POST['id']))){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Updated " . $stmt->affected_rows . " rows to platform.";
	}

	$stmt->close();
?>

		<a class="button" href="/~cappsc/platform.php">Back to Platforms</a>
		<a class="button" href="/~cappsc/homePage.php">Home</a>

	</body>
</html>