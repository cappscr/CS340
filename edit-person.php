<!-- ****************************************
**** filename: edit-person.php
**** created: November 17, 2016
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
		echo "<form action='update-person.php' method='post'>";
		echo "\n<fieldset>";
		echo "\n<legend>Edit a Person</legend>";
		echo "\n<label for='name'>Name:</label>";
		echo "\n<input type='hidden' name='id' value='" . $_POST['id'] . "'>";
		echo "\n<br />";
		echo "\n<input name='fname' value='" . $_POST['fname'] . "' required>";
		echo "\n<br />";
		echo "\n<label for='manufacturer'>Manufacturer:</label>";
		echo "\n<input name='lname' value='" . $_POST['lname'] . "'required>";
		echo "\n<br />";
		echo "\n<label for='month'>Month:</label>";
		echo "\n<input type='number' name='month' value='" . $_POST['month'] . "'>";
		echo "\n<br />";
		echo "\n<label for='day'>Day:</label>";
		echo "\n<input type='number' name='day' value='" . $_POST['day'] . "'>";
		echo "\n<br />";
		echo "\n<label for='year'>Year:</label>";
		echo "\n<input type='number' name='year' value='" . $_POST['year'] . "'>";
		echo "\n<br />\n<input type='submit' value='Update'>\n</fieldset>\n</form>";
?>

	</body>
</html>