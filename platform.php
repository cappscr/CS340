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
		<style>
			a.button {
			   -webkit-appearance: button;
			   -moz-appearance: button;
			   appearance: button;
			   text-decoration: none;
			   color: initial;
			}
		</style>
	</head>
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

		<h1>Platforms</h1>

		<!-- Form for adding a video game platform to the database -->
		<form action="add-platform.php" method="post"> 
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
				<input type="submit" name="Add">
			</fieldset>
		</form>

		<!-- Table for displaying all the people currently in the database 
		as well as buttons to edit and delete those people -->
		<table>
			<thead>
				<tr>
					<td><strong>Name</strong>
					<td><strong>Manufacturer</strong>
					<td><strong>Cost</strong>
					<td><strong>Release Date</strong>
					<td><strong>Graphics Card</strong>
					<td><strong>Hard Drive</strong>
					<td><strong>RAM</strong>
				</tr>
			</thead>
<?php
	// Query used to select all the basic platform information from the platform table
	$query = "SELECT platform_id, name, manufacturer, cost, releaseMonth, releaseDay, releaseYear, graphics, hardDrive, RAM FROM platform";

	// Prepare the SQL statment for execution
	if(!($stmt = $mysqli->prepare($query))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	// Bind results to php variables
	if(!$stmt->bind_result($id, $name, $manufacturer, $cost, $month, $day, $year, $graphics, $hardDrive, $RAM)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	// Loop through results and output html to build a table
	while($stmt->fetch()){
		echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $manufacturer . "\n</td>\n<td>\n" . $cost . "\n</td>\n<td>\n" . $month . "/" . $day . "/" . $year . "\n</td>\n<td>\n" . $graphics . "\n</td>\n<td>\n" . $hardDrive . "\n</td>\n<td>\n" . $RAM . "\n</td>\n<td>\n<form action='/~cappsc/edit-platform.php' method='post'>\n <input type='submit' value='Edit'>\n <input type='hidden' name='id' value='" . $id . "'>\n<input type='hidden' name='name' value='" . $name . "'>\n<input type='hidden' name='manufacturer' value='" . $manufacturer . "'>\n<input type='hidden' name='cost' value='" . $cost . "'>\n<input type='hidden' name='month' value='" . $month . "'>\n<input type='hidden' name='day' value = '" . $day . "'>\n<input type='hidden' name='year' value='" . $year . "'>\n<input type='hidden' name='graphics' value='" . $graphics . "'>\n<input type='hidden' name='hardDrive' value='" . $hardDrive . "'>\n<input type='hidden' name='RAM' value='" . $RAM . "'>\n</form>\n<form action='/~cappsc/delete-platform.php' method='post'>\n<input type='hidden' name='id' value='" . $id . "'>\n<input type='submit' value='Delete'>\n</form>\n</td>\n</tr>";
	}

	$stmt->close();
?>

		</table>

	</body>
</html>
