<!-- **************************************
File Name:  character.php
Created By: Christopher Capps
Date:       November 15, 2016
Class:      Oregon State University CS 340  
***************************************** -->

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
</style>

<body>

<div>
	<?php include 'navBar.php'; ?>
</div>
<br />
<div>
		<h1>Characters</h1>

		<form action="add-character.php" method="post"> 
			<fieldset>
				<legend>Add a Character</legend>
				<label for="name">Name:</label>
				<input name="name" value="Name" required>
				<br />
				<input type="submit" value="Add">
				<br />
			</fieldset>
		</form>


		<table>
			<thead>
				<tr>
					<td><strong>Name</strong>
				</tr>
			</thead>
				<?php
					$query = "SELECT char_id, name FROM game_character";

					if(!($stmt = $mysqli->prepare($query))){
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->bind_result($id, $name)){
						echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
					}

					while($stmt->fetch()){
						echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n<form action='/~cappsc/edit-character.php' method='post'>\n<input type='hidden' name='id' value='" . $id . "'>\n<input type='hidden' name='name' value='" . $name . "'>\n<input type='submit' value='Edit'>\n</form>\n<form action='/~cappsc/delete-character.php' method='post'>\n<input type='hidden' name='id' value='" . $id . "'>\n<input type='submit' value='Delete'>\n</form>\n</td>\n</tr>\n"; 
					}

					$stmt->close();
				?>

		</table>

		
		<div>
	<form method = "post" action = "add-gcharacter.php">
		<legend>Select a character and game you would like to pair</legend>
		
		<select name = "gid">
				<?php
					//This block builds a dropdown menu 

					//Get id and name for each genre
					if(!($stmt = $mysqli->prepare("SELECT game_id, title FROM video_game ORDER BY title ASC"))){
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
		
		<select name = "cid">
				<?php
					//This block builds a dropdown menu 

					//Get id and name for each genre
					if(!($stmt = $mysqli->prepare("SELECT char_id, name FROM game_character ORDER BY name ASC"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					//Store the results as described below
					if(!$stmt->bind_result($id, $cname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					//while there are new results, keep adding to the list
					while($stmt->fetch()){
						echo '<option value=" '. $id . ' "> ' . $cname . '</option>\n';
					}
					$stmt->close();
				?>
		</select>
		
		<p><input type = "submit" value = "Submit" /></p>
	</form>
</div>
	</body>
</html>