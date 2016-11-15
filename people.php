<!-- ******************************************
File Name:  character.php
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
	</head>
	<body>
		<h1>People</h1>

		<form action="addPerson.php"> 
			<fieldset>
				<legend>Add a Person</legend>
				<label for="fname">First Name:</label>
				<input name="fname" id="fname" value="John" required>
				<br />
				<label for="lname">Last Name:</label>
				<input name="lname" id="lname" value="Doe" required>
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
		echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $month . "/" . $day . "/" . $year . "\n</td>\n<td>\n<button value='" . $id . "'>Edit</button><button value='" . $id . "'>Delete</button></td>"; 
	}

	$stmt->close();
?>

		</table>

	</body>
</html>
