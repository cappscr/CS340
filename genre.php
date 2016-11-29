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
		
		.submitLink {
			background-color: transparent;
			text-decoration: underline;
			font-size: medium;
			border: none;
			color: blue;
			cursor: pointer;
		}
</style>

<body>

<div>
	<?php include 'navBar.php'; ?>
</div>

<div>
	<table>
		<tr>
			<td>Genres</td>
		</tr>
		<tr>
			<td>Name</td>
			<td>Number of Games in Genre</td>
		</tr>

		<?php
			//Get data from vide_game table
			if(!($stmt = $mysqli->prepare('SELECT g.genre_id, g.name, COUNT(vg.title) AS "Number of Games" FROM genre g LEFT JOIN
											game_genres gg ON g.genre_id = gg.genre_id LEFT JOIN
											video_game vg ON gg.game_id = vg.game_id
											GROUP BY g.name;')))
			{
				echo "Prepare failed: " .$stmt->errno . " " . $stmt->error;
			}
			
			if(!$stmt->execute())
			{
				echo "Execute failed: " .$mysqli->connect_errno . " " . $mysqli->connect_errnor;
			}
			
			//save results if you get some
			if(!$stmt->bind_result($id, $name, $gameCount))
			{
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			
			//display results until you run out of stuff to display
			while($stmt->fetch())
			{
				echo "<tr>\n<td>\n" . $name . "</td>\n<td>\n" . 
				'<form method = "post" action = "gameGenreFilter.php" >
				<input type = "submit" class = "submitLink" value = "' . $gameCount . '" />
				<input type = "hidden" name = "genre" value = ' . $id . ' />
				</form>
				</td><td>
				<form method="post" action="editGenreForm.php">' . "\n" . '
				<input type="submit" value="Edit" />' . "\n" . '
				<input type = "hidden" name = "genreID" value = ' . $id . ' />' . "\n" . '
				</form></td><td>' . "\n" . '
				<form method="post" action="deleteGenre.php">' . "\n" . '
				<input type="submit" value="Delete" />' . "\n" . '
				<input type = "hidden" name = "genreID" value = ' . $id . ' />' . "\n" . '
				</form></td>';
			}
			
			$stmt->close();
			
		?>
	</table>
</div>

<div>
	<form method = "post" action = "addGenre.php">
		<fieldset>
			<legend>Enter information for the new genre</legend>
			<p>Name: <input type = "text" name = "name"/></p>
			<p><input type = "submit" value = "Add Genre"/></p>
		</fieldset>
	</form>
</div>

<div>
	<form method="post" action="gameGenreFilter.php">
		<fieldset>
			<legend>See what games are in a genre</legend>
				<select name = "genre">
				<?php
					//This block builds a dropdown menu 

					//Get id and name for each series
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

</body>
</html>