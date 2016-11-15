<?php
	ini_set('display_errors', 'On');
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cappsc-db","bUPxSJyB1RecNl7q","cappsc-db");

	if($mysqli->connect_errno){
		echo "Connection error: " . $mysqli->connect_errno . " " . $mysqli->error;
	} 
?>

<!DOCTYPE html>
<html>
	<head>
		<!-- Head information here -->
	</head>
	<body>
		<h1>Platforms</h1>

		<form action="addPlatform.php"> 
			<fieldset>
				<legend>Add a Platform</legend>
				<label for="name">Name:</label>
				<input name="name" id="name" value="Name" required>
				<br />
				<label for="manufacturer">Manufacturer:</label>
				<input name="manufacturer" id="manufacturer" value="Manufacturer" required>
				<br />
				<label for="cost">Cost:</label>
				<input type="number" name="cost" id="cost" value="199.99">
				<br />
				<label for="month">Month:</label>
				<input type="number" name="releaseMonth" id="releaseMonth" value="1">
				<br />
				<label for="day">Day:</label>
				<input type="number" name="releaseDay" id="releaseDay" value="1">
				<br />
				<label for="year">Year:</label>
				<input type="number" name="releaseYear" id="releaseYear" value="2016">
				<br />
				<label for="graphics">Graphics:</label>
				<input name="graphics" id="graphics" value="Nvidia GTX 750">
				<br />
				<label for="hard_drive">Hard Drive:</label>
				<input name="hardDrive" id="hardDrive" value="256 GB">
				<br />
				<label for="RAM">RAM:</label>
				<input name="RAM" id="RAM" value="8 GB">
				<br />
			</fieldset>
		</form>
	</body>
</html>
