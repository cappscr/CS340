<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","robinjam-db","TJl7rNob9kTbcPSP","robinjam-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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

<div>
	<table>
		<tr>
			<td>Videogames</td>
		</tr>
		<tr>
			<td>Title</td>
			<td>Release Date</td>
			<td>Genre</td>
			<td>Series</td>
			<td>Developer</td>
		</tr>
		<?php
			//Get data from vide_game table
			$query = "SELECT vg.game_id, vg.title, vg.releaseMonth, vg.releaseDay, vg.releaseYear, g.name, d.name, IFNULL(gs.title, ' ') FROM video_game vg
						LEFT JOIN game_genres gg ON gg.game_id = vg.game_id
						LEFT JOIN genre g ON g.genre_id = gg.genre_id
						INNER JOIN developer d ON vg.developer = d.developer_id
						LEFT JOIN game_series gs ON vg.gameSeries = gs.series_id
						ORDER BY vg.title ASC";
			
			if(!($stmt = $mysqli->prepare($query)))
			{
				echo "Prepare failed: " .$stmt->errno . " " . $stmt->error;
			}
			
			if(!$stmt->execute())
			{
				echo "Execute failed: " .$mysqli->connect_errno . " " . $mysqli->connect_errnor;
			}
			
			//save results if you get some
			if(!$stmt->bind_result($id, $title, $rMonth, $rDay, $rYear, $genre, $developer, $gSeries))
			{
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			
			//display results until you run out of stuff to display
			while($stmt->fetch())
			{				
				echo "<tr>\n<td>\n" . $title . "\n</td>\n<td>\n" . $rMonth . "-" . $rDay . "-" .  $rYear . "\n</td>\n<td>\n" 
					. $genre . "\n</td>\n<td>\n" . $gSeries . "\n</td>\n<td>\n" . $developer 
					. '</td><td>
						<form method="post" action="editGameForm.php">' . "\n" .
						'<input type="submit" value="Edit" />' . "\n" .
						'<input type = "hidden" name = "gameID" value = ' . $id . ' />' . "\n" .
						'</form></td>' . "\n" .
					'<td><form method="post" action="deleteGame.php">' . "\n" .
						'<input type="submit" value="Delete" />' . "\n" .
						'<input type = "hidden" name = "gameID" value = ' . $id . ' />' . "\n" .
						'</form></td>' . "\n";
			}
			
			$stmt->close();
			
		?>
	</table>
</div>

<div>
	<form method = "post" action = "addGame.php">
		<fieldset>
			<legend>Enter information for the new game</legend>
			<p>Title: <input type = "text" name = "title" /></p>
			<p>Release Month: <input type = "text" name = "releaseMonth" /></p>
			<p>Release Day: <input type = "text" name = "releaseDay" /></p>
			<p>Release Year: <input type = "text" name = "releaseYear" /></p>
		</fieldset>
		<fieldset>
			<legend>Game Series</legend>
			<select name = "gameSeries">
				<?php
					//This block builds a dropdown menu 

					//Get id and name for each series
					if(!($stmt = $mysqli->prepare("SELECT series_id, title FROM game_series"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					//Store the results as described below
					if(!$stmt->bind_result($id, $sname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					//while there are new results, keep adding to the list
					while($stmt->fetch()){
						echo '<option value=" '. $id . ' "> ' . $sname . '</option>\n';
					}
					$stmt->close();
				?>
			</select>
		</fieldset>
		<fieldset>			
			<legend>Developer</legend>
			<select name = "developer">
				<?php
					//This block builds a dropdown menu 

					//Get id and name for each developer
					if(!($stmt = $mysqli->prepare("SELECT developer_id, name FROM developer"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					//Store the results as described below
					if(!$stmt->bind_result($id, $dname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					//while there are new results, keep adding to the list
					while($stmt->fetch()){
						echo '<option value=" '. $id . ' "> ' . $dname . '</option>\n';
					}
					$stmt->close();
				?>
			</select>
		</fieldset>
		<fieldset>			
			<legend>Genre</legend>
			<select name = "genre">
				<?php
					//This block builds a dropdown menu 

					//Get id and name for each genre
					if(!($stmt = $mysqli->prepare("SELECT genre_id, name FROM genre"))){
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
		</fieldset>
		<p><input type = "submit" value = "Add Game"/></p>
	</form>
</div>

<div>
	<form method = "post" action = "addGamePlatform.php">
		<legend>Select a platform and game you would like to pair</legend>
		
		<select name = "gameID">
				<?php
					//This block builds a dropdown menu 

					//Get id and name for each genre
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
		
		<select name = "platformID">
				<?php
					//This block builds a dropdown menu 

					//Get id and name for each genre
					if(!($stmt = $mysqli->prepare("SELECT platform_id, name FROM platform"))){
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
		
		<p><input type = "submit" value = "Submit" /></p>
	</form>
</div>

<div>
	<form method = "post" action = "addGameCharacter.php">
		<legend>Select a character and game you would like to pair</legend>
		
		<select name = "gameID">
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
		
		<select name = "characterID">
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

<div>
	<form method="post" action="gameGenreFilter.php">
		<fieldset>
			<legend>Filter By Genre</legend>
				<select name = "genre">
				<?php
					//This block builds a dropdown menu 

					//Get id and name for each genre
					if(!($stmt = $mysqli->prepare("SELECT genre_id, name FROM genre"))){
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
		</fieldset>
		<input type="submit" value="Run Filter" />
	</form>
</div>

<div>
	<form method="post" action="gameSeriesFilter.php">
		<fieldset>
			<legend>Filter By Series</legend>
				<select name = "gameSeries">
				<?php
					//This block builds a dropdown menu 

					//Get id and name for each series
					if(!($stmt = $mysqli->prepare("SELECT series_id, title FROM game_series"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					//Store the results as described below
					if(!$stmt->bind_result($id, $sname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					//while there are new results, keep adding to the list
					while($stmt->fetch()){
						echo '<option value=" '. $id . ' "> ' . $sname . '</option>\n';
					}
					$stmt->close();
				?>
			</select>
		</fieldset>
		<input type="submit" value="Run Filter" />
	</form>
</div>

<div>
	<form method="post" action="gameSeriesFilter.php">
		<fieldset>
			<legend>Filter By Series</legend>
				<select name = "gameSeries">
				<?php
					//This block builds a dropdown menu 

					//Get id and name for each series
					if(!($stmt = $mysqli->prepare("SELECT series_id, title FROM game_series"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					//Store the results as described below
					if(!$stmt->bind_result($id, $sname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					//while there are new results, keep adding to the list
					while($stmt->fetch()){
						echo '<option value=" '. $id . ' "> ' . $sname . '</option>\n';
					}
					$stmt->close();
				?>
			</select>
		</fieldset>
		<input type="submit" value="Run Filter" />
	</form>
</div>

</body>
</html>