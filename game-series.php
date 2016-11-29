<?php
	// Turn on error reporting
	ini_set('display_errors', 'On');

	// Connect to database
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cappsc-db","bUPxSJyB1RecNl7q","cappsc-db");

	if($mysqli->connect_errno){
		echo "Connection error: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
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
			<td>Game Series</td>
		</tr>
		
		<tr>
			<td>Title</td>
			<td>Number of Games</td>
		</tr>

		<?php
			//Get data from vide_game table
			if(!($stmt = $mysqli->prepare('SELECT gs.series_id, gs.title, COUNT(vg.title) AS "Number of Games in Series" FROM game_series gs
											LEFT JOIN video_game vg ON gs.series_id = vg.gameSeries
											GROUP BY gs.title')))
			{
				echo "Prepare failed: " .$stmt->errno . " " . $stmt->error;
			}
			
			if(!$stmt->execute())
			{
				echo "Execute failed: " .$mysqli->connect_errno . " " . $mysqli->connect_errnor;
			}
			
			//save results if you get some
			if(!$stmt->bind_result($id, $title, $gameCount))
			{
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			
			//display results until you run out of stuff to display
			while($stmt->fetch())
			{
				echo "<tr>\n<td>\n" . $title . "</td>\n<td>\n" . 
				'<form method = "post" action = "gameSeriesFilter.php" >
				<input type = "submit" class = "submitLink" value = "' . $gameCount . '" />
				<input type = "hidden" name = "gameSeries" value = ' . $id . ' />
				</form>
				</td><td>
				<form method="post" action="edit-series.php">' . "\n" . '
				<input type="submit" value="Edit" />' . "\n" . '
				<input type = "hidden" name = "sID" value = ' . $id . ' />' . "\n" . '
				</form></td>' . "\n" . '
				<td><form method="post" action="delete-series.php">' . "\n" . '
				<input type="submit" value="Delete" />' . "\n" . '
				<input type = "hidden" name = "sID" value = ' . $id . ' /> </form></td>' . "\n";
			}
			
			$stmt->close();
			
		?>
	</table>
</div>

<div>
	<form method = "post" action = "add-series.php">
		<fieldset>
			<legend>Enter information for the new game series</legend>
			<p>Title: <input type = "text" name = "title"/></p>
			<p><input type = "submit" value = "Add Series"/></p>
		</fieldset>
	</form>
</div>

<div>
	<form method="post" action="gameSeriesFilter.php">
		<fieldset>
			<legend>See what games are in a series</legend>
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