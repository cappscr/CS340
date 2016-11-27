<!-- ******************************************
File Name:  edit-gcharacter.php
Created By: Christopher Capps
Date:       November 26, 2016
Class:      Oregon State University CS 340  
******************************************* -->

<?php
	// Connect to the database
	ini_set('display_errors', 'On');
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cappsc-db","bUPxSJyB1RecNl7q","cappsc-db");

	// Check for a connection error if one exists
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
				/* Styling for the buttons */
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

		<form action="update-gcharacter.php" method="post"> 
			<fieldset>
				<legend>Update a Game's Characters</legend>
<?php
	// Add hidden inputs to pass the old values for platform_id and game_id to the 
	// update page so that the proper row can be selected
	echo "<input type='hidden' name='oldcid' value='" . $_POST['cid'] . "'>\n";
	echo "<input type='hidden' name='oldvgid' value='" . $_POST['gid'] ."'>\n"; 
?>
				<label for="cid">Character:</label>
				<select name="cid">
<?php
	// Prepare SQL statement to select platform information in order to dynamically 
	// populate a drop down menu of all platforms in the platform table
	if(!($stmt = $mysqli->prepare("SELECT char_id, name FROM game_character"))){
		echo "Prepare failed : " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	// Bind results to php variables
	if(!$stmt->bind_result($cid, $cname)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	// Loop through results and assign the selected row the selected attribute on their option tag
	while($stmt->fetch()){
		if($cid == $_POST['cid']){
			echo "<option value='" . $cid . "' selected>" . $cname . "</option>\n";
		} else {
			echo "<option value='" . $cid . "'>" . $cname . "</option>\n";
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
				<input type="submit" value="Update">
			</fieldset>
		</form>
	</body>
</html>