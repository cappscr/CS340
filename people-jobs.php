<!-- ******************************************
File Name:  people-jobs.php
Created By: Christopher Capps
Date:       November 18, 2016
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

		<h1>People</h1>

		<form action="add-pjob.php" method="post"> 
			<fieldset>
				<legend>Add a Person's Job</legend>
				<label for="pid">Person:</label>
				<select name="pid">
<?php
	if(!($stmt = $mysqli->prepare("SELECT person_id, firstName, lastName FROM people"))){
		echo "Prepare failed : " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($pid, $fname, $lname)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<option value='" . $pid . "'>" . $fname . " " . $lname . "</option>\n";
	}

	$stmt->close();
?>
				</select>
				<br />
				<label for="jid">Job:</label>
				<select name="jid">
<?php
	if(!($stmt = $mysqli->prepare("SELECT job_id, name FROM job"))){
		echo "Prepare failed : " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($jid, $jname)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<option value='" . $jid . "'>" . $jname . "</option>\n";
	}

	$stmt->close();
?>
				</select>
				<br />
				<label for="vgid">Video Game:</label>
				<select name="vgid">
<?php
	if(!($stmt = $mysqli->prepare("SELECT game_id, title FROM video_game"))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($vgid, $gtitle)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<option value='" . $vgid . "'>" . $gtitle . "</option>\n";
	}

	$stmt->close();
?>
				</select>
				<br />
				<label for="did">Developer:</label>
				<select name="did">
<?php
	if(!($stmt = $mysqli->prepare("SELECT developer_id, name FROM developer"))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($did, $dname)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<option value='" . $did . "'>" . $dname . "</option>\n";
	}

	$stmt->close();
?>
				</select>
				<br />
				<input type="submit" value="Add">
			</fieldset>
		</form>


		<table>
			<thead>
				<tr>
					<td><strong>First Name</strong>
					<td><strong>Last Name</strong>
					<td><strong>Job</strong>
					<td><strong>Video Game</strong>
					<td><strong>Developer</strong>
				</tr>
			</thead>
<?php
	$query = "SELECT pj.person_id, pj.job_id, pj.game_id, pj.develop_id, p.firstName, p.lastName, j.name, vg.title, d.name FROM people_jobs pj LEFT JOIN people p ON p.person_id = pj.person_id LEFT JOIN job j ON j.job_id = pj.job_id LEFT JOIN video_game vg ON vg.game_id = pj.game_id LEFT JOIN developer d ON d.developer_id = pj.develop_id";

	if(!($stmt = $mysqli->prepare($query))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($pid, $jid, $gid, $did, $fname, $lname, $job, $game, $company)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $job . "</td>\n<td>\n" . $game . "</td>\n<td>\n" . $company . "\n</td>\n <td>\n <form action='/~cappsc/edit-pjob.php' method='post'>\n<input type='hidden' name='pid' value='" . $pid . "'>\n<input type='hidden' name='jid' value='" . $jid . "'>\n<input type='hidden' name='gid' value='" . $gid . "'>\n<input type='hidden' name='did' value='" . $did . "'>\n<input type='submit' value='Edit'>\n</form></td>\n<td>\n<form action='/~cappsc/delete-pjob.php' method='post'>\n<input type='hidden' name='pid' value='" . $pid . "'>\n<input type='hidden' name='jid' value='" . $jid . "'>\n<input type='hidden' name='gid' value='" . $gid . "'>\n<input type='hidden' name='did' value='" . $did . "'>\n<input type='submit' value='Delete'>\n</form>\n</td>\n</tr>\n"; 
	}

	$stmt->close();
?>

		</table>

	</body>
</html>