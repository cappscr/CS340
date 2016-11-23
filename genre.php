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

<div>
	<table>
		<tr>
			<td>Genres</td>
		</tr>

		<?php
			//Get data from vide_game table
			if(!($stmt = $mysqli->prepare("SELECT genre_id, name FROM genre")))
			{
				echo "Prepare failed: " .$stmt->errno . " " . $stmt->error;
			}
			
			if(!$stmt->execute())
			{
				echo "Execute failed: " .$mysqli->connect_errno . " " . $mysqli->connect_errnor;
			}
			
			//save results if you get some
			if(!$stmt->bind_result($id, $name))
			{
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			
			//display results until you run out of stuff to display
			while($stmt->fetch())
			{
				echo "<tr>\n<td>\n" . $name . 
				'</td><td>
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
</div>

</body>
</html>