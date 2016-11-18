<!-- ****************************************
**** filename: edit-platform.php
**** created: November 16, 2016
**** author: Christopher Capps
**** class: Oregon State University CS 340
*******************************************-->

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
		echo "\n<input type='hidden' name='id' value='" . $_POST['id'] . "'>";
		echo "\n<br />";
		echo "\n<input name='name' id='name' value='" . $_POST['name'] . "' required>";
		echo "\n<br />";
		echo "\n<label for='manufacturer'>Manufacturer:</label>";
		echo "\n<input name='manufacturer' id='manufacturer' value='" . $_POST['manufacturer'] . "'required>";
		echo "\n<br />";
		echo "\n<label for='cost'>Cost:</label>";
		echo "\n<input type='number' name='cost' id='cost' value='" . $_POST['cost'] . "'>";
		echo "\n<br />";
		echo "\n<label for='month'>Month:</label>";
		echo "\n<input type='number' name='releaseMonth' id='releaseMonth' value='" . $_POST['month'] . "'>";
		echo "\n<br />";
		echo "\n<label for='day'>Day:</label>";
		echo "\n<input type='number' name='releaseDay' id='releaseDay' value='" . $_POST['day'] . "'>";
		echo "\n<br />";
		echo "\n<label for='year'>Year:</label>";
		echo "\n<input type='number' name='releaseYear' id='releaseYear' value='" . $_POST['year'] . "'>";
		echo "\n<br />";
		echo "\n<label for='graphics'>Graphics:</label>";
		echo "\n<input name='graphics' id='graphics' value='" . $_POST['graphics'] . "'>";
		echo "\n<br />";
		echo "\n<label for='hard_drive'>Hard Drive:</label>";
		echo "\n<input name='hardDrive' id='hardDrive' value='" . $_POST['hardDrive'] . "'>";
		echo "\n<br />";
		echo "\n<label for='RAM'>RAM:</label>";
		echo "\n<input name='RAM' id='RAM' value='" . $_POST['RAM'] . "'>";
		echo "\n<br />\n<input type='submit' name='Add'>\n</fieldset>\n</form>";
?>

	</body>
</html>