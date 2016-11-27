<!-- ******************************************
File Name:  edit-pjob.php
Created By: Christopher Capps
Date:       November 19, 2016
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

		<form action="update-pjob.php" method="post"> 
			<fieldset>
				<legend>Update a Person's Job</legend>
<?php
	// Add hidden inputs to pass the old values for person_id, job_id, and game_id to the 
	// update page so that the proper row can be selected
	echo "<input type='hidden' name='oldpid' value='" . $_POST['pid'] . "'>\n";
	echo "<input type='hidden' name='oldjid' value='" . $_POST['jid'] . "'>\n";
	echo "<input type='hidden' name='oldvgid' value='" . $_POST['gid'] ."'>\n"; 
?>
				<label for="pid">Person:</label>
				<select name="pid">
<?php
	// Prepare SQL statement to select people information in order to dynamically 
	// populate a drop down menu of all people in the people table
	if(!($stmt = $mysqli->prepare("SELECT person_id, firstName, lastName FROM people"))){
		echo "Prepare failed : " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	// Bind results to php variables
	if(!$stmt->bind_result($pid, $fname, $lname)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	// Loop through results and assign the selected row the selected attribute on their option tag
	while($stmt->fetch()){
		if($pid == $_POST['pid']){
			echo "<option value='" . $pid . "' selected>" . $fname . " " . $lname . "</option>\n";
		} else {
			echo "<option value='" . $pid . "'>" . $fname . " " . $lname . "</option>\n";
		}
	}

	$stmt->close();
?>
				</select>
				<br />
				<label for="jid">Job:</label>
				<select name="jid">
<?php
	// Prepare and execute a SQL statment to select all the possible jobs from job table.
	// Use the jobs to dynamically populate a dropdown menu
	if(!($stmt = $mysqli->prepare("SELECT job_id, name FROM job"))){
		echo "Prepare failed : " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($jid, $jname)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	// Use the value of the 'jid' recieved from the submitted form to assign the selected 
	// attribute to row that was selected to edit
	while($stmt->fetch()){
		if($jid == $_POST['jid']){
			echo "<option value='" . $jid . "' selected>" . $jname . "</option>\n";
		} else {
			echo "<option value='" . $jid . "'>" . $jname . "</option>\n";
		}
	}

	$stmt->close();
?>
				</select>
				<br />
				<label for="vgid">Video Game:</label>
				<select name="vgid">
<?php
	// Prepare SQL statement for execution that selects all the video game titles 
	// from the video_game table to dynamically populate the dropdown menu to select games
	if(!($stmt = $mysqli->prepare("SELECT game_id, title FROM video_game"))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($vgid, $gtitle)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	// While still fetching values display the passed value as the selected value
	while($stmt->fetch()){
		if($vgid == $_POST['gid']){
			echo "<option value='" . $vgid . "' selected>" . $gtitle . "</option>\n";
		} else {
			echo "<option value='" . $vgid . "'>" . $gtitle . "</option>\n";
		}
	}

	$stmt->close();
?>
				</select>
				<br />
				<label for="did">Developer:</label>
				<select name="did">
<?php
	// Prepare a SQL statement for execution that selects all the developers from the 
	// developer table to dynamically populate the drop down menu to select developer
	if(!($stmt = $mysqli->prepare("SELECT developer_id, name FROM developer"))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($did, $dname)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	// Assign the selected attribute to the value passed via the form submitted to this page
	while($stmt->fetch()){
		if($did == $_POST['did']){
			echo "<option value='" . $did . "' selected>" . $dname . "</option>\n";
		} else {
			echo "<option value='" . $did . "'>" . $dname . "</option>\n";
		}
	}

	$stmt->close();
?>
				</select>
				<br />
				<input type="submit" value="Update">
			</fieldset>
		</form>
	</body>
</html>