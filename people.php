<!-- ******************************************
File Name:  people.php
Created By: Christopher Capps
Date:       November 15, 2016
Class:      Oregon State University CS 340  
******************************************* -->

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

		<!-- Row of navigational buttons -->
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

		<h1>People</h1>

		<form action="add-person.php" method="post"> 
			<fieldset>
				<legend>Add a Person</legend>
				<label for="fname">First Name:</label>
				<input name="fname" value="John" required>
				<br />
				<label for="lname">Last Name:</label>
				<input name="lname" value="Doe" required>
				<br />
				<label for="month">Month:</label>
				<input type="number" name="month" value="1">
				<br />
				<label for="day">Day:</label>
				<input type="number" name="day" value="1">
				<br />
				<label for="year">Year:</label>
				<input type="number" name="year" value="2016">
				<br />
				<input type="submit" value="Add">
			</fieldset>
		</form>


		<table>
			<thead>
				<tr>
					<td><strong>First Name</strong>
					<td><strong>Last Name</strong>
					<td><strong>Birth Date</strong>
				</tr>
			</thead>
<?php
	$query = "SELECT person_id, firstName, lastName, birthMonth, birthDay, birthYear FROM people";

	if(!($stmt = $mysqli->prepare($query))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($id, $fname, $lname, $month, $day, $year)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $month . "/" . $day . "/" . $year . "\n</td>\n <td>\n <form action='/~cappsc/edit-person' method='post'>\n <input type='hidden' name='id' value='" . $id . "'>\n<input type='hidden' name='fname' value='" . $fname . "'>\n<input type='hidden' name='lname' value='" . $lname . "'>\n<input type='hidden' name='month' value='" . $month . "'>\n<input type='hidden' name='day' value='" . $day . "'>\n<input type='hidden' name='year' value='" . $year . "'>\n<input type='submit' value='Edit'>\n</form></td>\n<td>\n<form action='/~cappsc/delete-person' method='post'>\n<input type='hidden' name='id' value='" . $id . "'>\n<input type='submit' value='Delete'></form>\n</td>\n</tr>\n"; 
	}

	$stmt->close();
?>

		</table>

	</body>
</html>
