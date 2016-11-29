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
	<style>
			a.button {
				-webkit-appearance: button;
				-moz-appearance: button;
				appearance: button;

				text-decoration: none;
				color: initial;
			}
			
			.submitLink {
				background-color: transparent;
				text-decoration: underline;
				font-size: medium;
				border: none;
				color: blue;
				cursor: pointer;
			}
	</style>

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
<<<<<<< HEAD

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

=======
		<div>
			<?php include 'navBar.php'; ?>
		</div>
	
>>>>>>> James-Branch
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
					<td><strong>Number of Games Worked On</strong></td>
				</tr>
			</thead>
<?php
	$query = "SELECT p.person_id, p.firstName, p.lastName, p.birthMonth, p.birthDay, p.birthYear, COUNT(vg.game_id) FROM people p
				LEFT JOIN people_jobs pj ON p.person_id = pj.person_id
				LEFT JOIN video_game vg ON pj.game_id = vg.game_id
				GROUP BY p.person_id
				ORDER BY p.lastName, p.firstName ASC";

	if(!($stmt = $mysqli->prepare($query))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($id, $fname, $lname, $month, $day, $year, $gameCount)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<tr>\n<td>\n" . $fname 
		. "\n</td>\n<td>\n" . $lname 
		. "\n</td>\n<td>\n" . $month . "/" . $day . "/" . $year
		. "\n</td>\n<td>\n" .
		'<form method = "post" action = "gamePersonFilter.php" >
		<input type = "submit" class = "submitLink" value = "' . $gameCount . '" />
		<input type = "hidden" name = "person" value = ' . $id . ' />
		</form>'
		. "\n</td>\n <td>\n <form action='/~cappsc/edit-person' method='post'>\n <input type='hidden' name='id' value='" . $id . "'>\n<input type='hidden' name='fname' value='" . $fname . "'>\n<input type='hidden' name='lname' value='" . $lname . "'>\n<input type='hidden' name='month' value='" . $month . "'>\n<input type='hidden' name='day' value='" . $day . "'>\n<input type='hidden' name='year' value='" . $year . "'>\n<input type='submit' value='Edit'>\n</form></td>\n<td>\n<form action='/~cappsc/delete-person' method='post'>\n<input type='hidden' name='id' value='" . $id . "'>\n<input type='submit' value='Delete'></form>\n</td>\n</tr>\n"; 
	}

	$stmt->close();
?>

		</table>
		
		<div>
			<form method = "post" action = "addGamePerson.php">
				<legend>Add a person to a game that they worked on</legend>
				
				<select name = "gameID">
						<?php
							//This block builds a dropdown menu 

							//Get id and name for each game
							if(!($stmt = $mysqli->prepare("SELECT game_id, title FROM video_game"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							//Store the results as described below
							if(!$stmt->bind_result($id, $gname)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							//while there are new results, keep adding to the list
							while($stmt->fetch()){
								echo '<option value=" '. $id . ' "> ' . $gname . '</option>\n';
							}
							$stmt->close();
						?>
				</select>
				
				<select name = "personID">
						<?php
							//This block builds a dropdown menu 

							//Get id and name for each person
							if(!($stmt = $mysqli->prepare('SELECT person_id, CONCAT(firstName,  " ", lastName ) FROM people ORDER BY lastName, firstName'))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							//Store the results as described below
							if(!$stmt->bind_result($id, $pname)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							//while there are new results, keep adding to the list
							while($stmt->fetch()){
								echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
							}
							$stmt->close();
						?>
				</select>
				
				<select name = "jobID">
						<?php
							//This block builds a dropdown menu 

							//Get id and name for each job
							if(!($stmt = $mysqli->prepare('SELECT job_id, name FROM job ORDER BY name'))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							//Store the results as described below
							if(!$stmt->bind_result($id, $jname)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							//while there are new results, keep adding to the list
							while($stmt->fetch()){
								echo '<option value=" '. $id . ' "> ' . $jname . '</option>\n';
							}
							$stmt->close();
						?>
				</select>
				
				<p><input type = "submit" value = "Submit" /></p>
			</form>
		</div>

	</body>
</html>
