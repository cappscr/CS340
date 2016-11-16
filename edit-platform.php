<!-- ********************************************************************************************
**** filename: edit-platform.php
**** created: November 16, 2016
**** author: Christopher Capps
**** class: Oregon State University CS 340
**********************************************************************************************-->

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
		<style>
			/* Any CSS styling here */ 
		</style>
	</head>
	<body>

<?php
		echo "<form action='update-platform.php' method='post'>";
		echo "\n<fieldset>";
		echo "\n<legend>Edit a Platform</legend>";
		echo "\n<label for='name'>Name:</label>";
		echo "\n<input name='name' id='name' value='" . $_POST['name'] . "' required>";
		echo "\n<br />";
		echo "\n<label for='manufacturer'>Manufacturer:</label>";
		echo "\n<input name='manufacturer' id='manufacturer' value='" . $_POST['manufacturer'] . "'required>";
		echo "\n<br />";
		echo "\n<label for='cost'>Cost:</label>";
				<input type="number" name="cost" id="cost" value="199.99">
		echo "\n<br />";
		echo "\n<label for='month'>Month:</label>";
				<input type="number" name="releaseMonth" id="releaseMonth" value="1">
		echo "\n<br />";
				<label for="day">Day:</label>
				<input type="number" name="releaseDay" id="releaseDay" value="1">
		echo "\n<br />";
				<label for="year">Year:</label>
				<input type="number" name="releaseYear" id="releaseYear" value="2016">
		echo "\n<br />";
				<label for="graphics">Graphics:</label>
				<input name="graphics" id="graphics" value="Nvidia GTX 750">
		echo "\n<br />";
				<label for="hard_drive">Hard Drive:</label>
				<input name="hardDrive" id="hardDrive" value="256 GB">
		echo "\n<br />";
				<label for="RAM">RAM:</label>
				<input name="RAM" id="RAM" value="8 GB">
		echo "\n<br />\n<input type='submit' name='Add'>\n</fieldset>\n</form>";

	if(!($stmt->bind_param("ssdiiisss", $_POST['name'], $_POST['manufacturer'], $_POST['cost'], $_POST['releaseMonth'], $_POST['releaseDay'], $_POST['releaseYear'], $_POST['graphics'], $_POST['hardDrive'], $_POST['RAM']))){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Added " . $stmt->affected_rows . " rows to platform.";
	}

	$stmt->close();
?>

	</body>
</html>