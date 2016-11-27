<!-- ******************************************
File Name:  game-characters.php
Created By: Christopher Capps
Date:       November 26, 2016
Class:      Oregon State University CS 340  
******************************************* -->

<?php
	// Connect to the database
	ini_set('display_errors', 'On');
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cappsc-db","bUPxSJyB1RecNl7q","cappsc-db");

	// Show connection error if one exists 
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

		<h1>Characters in Games</h1>

		<form action="add-gcharacter.php" method="post"> 
			<fieldset>
				<legend>Add a Games's Characters</legend>
				<label for="cid">Character:</label>
				<select name="cid">
<?php
	// Prepare a SQL statement for execution that selects character_id and names from 
	// the game_character table and uses that data to dynamically generate a dropdown menu
	if(!($stmt = $mysqli->prepare("SELECT char_id, name FROM game_character"))){
		echo "Prepare failed : " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($chid, $name)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<option value='" . $chid . "'>" . $name . "</option>\n";
	}

	$stmt->close();
?>
				</select>
				<br />
				<label for="gid">Game:</label>
				<select name="gid">
<?php
	// Prepare and execute a SQL statement that selects all the video game titles and ids from video_game table
	// And uses that data to dynamically generate a dropdown menu
	if(!($stmt = $mysqli->prepare("SELECT game_id, title FROM video_game"))){
		echo "Prepare failed : " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($gid, $gname)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<option value='" . $gid . "'>" . $gname . "</option>\n";
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
					<td><strong>Character Name</strong>
					<td><strong>Game Title</strong>
				</tr>
			</thead>
<?php
	// Prepare and execute a SQL statement for execution that selects video game titles and character names using joins to join the appropriate tables.
	// Data is then used to dynamically generate an HTML table of all the games available for each platform
	$query = "SELECT gc.char_id, gc.game_id, c.name, vg.title FROM game_char gc LEFT JOIN video_game vg ON vg.game_id = gc.game_id LEFT JOIN game_character c ON c.char_id = gc.char_id";

	if(!($stmt = $mysqli->prepare($query))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($cid, $gid, $cname, $gname)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<tr>\n<td>\n" . $cname . "\n</td>\n<td>\n" . $gname . "\n</td>\n <td>\n <form action='/~cappsc/edit-gcharacter.php' method='post'>\n<input type='hidden' name='cid' value='" . $cid . "'>\n<input type='hidden' name='gid' value='" . $gid . "'>\n<input type='submit' value='Edit'>\n</form></td>\n<td>\n<form action='/~cappsc/delete-gcharacter.php' method='post'>\n<input type='hidden' name='cid' value='" . $cid . "'>\n<input type='hidden' name='gid' value='" . $gid . "'>\n<input type='submit' value='Delete'>\n</form>\n</td>\n</tr>\n"; 
	}

	$stmt->close();
?>

		</table>

	</body>
</html>