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
		
		.linkDescription {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background: rgba(29, 106, 154, 0.72);
			color: #fff;


			visibility: hidden;
			opacity: 0;
		}
		
		.submitLink:hover .linkDescription {
			visibility: visibility;
			opacity: 1;
		}

		submitLink:focus {
			outline: none;
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
			<td>Game Series</td>
		</tr>

		<?php
			//Get data from vide_game table
			if(!($stmt = $mysqli->prepare("SELECT series_id, title FROM game_series")))
			{
				echo "Prepare failed: " .$stmt->errno . " " . $stmt->error;
			}
			
			if(!$stmt->execute())
			{
				echo "Execute failed: " .$mysqli->connect_errno . " " . $mysqli->connect_errnor;
			}
			
			//save results if you get some
			if(!$stmt->bind_result($id, $title))
			{
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			
			//display results until you run out of stuff to display
			while($stmt->fetch())
			{
				echo '<tr><td> 
				<form method = "post" action = "gameSeriesFilter.php" >
				<input type = "submit" class = "submitLink" value = "' . $title . '" />
				<input type = "hidden" name = "gameSeries" value = ' . $id . ' />
				</form>
				<p class = "linkDescription" style ="display: none">Click to see what games are in this series</p>
				</td><td>
				<form method="post" action="editSeriesForm.php">' . "\n" . '
				<input type="submit" value="Edit" />' . "\n" . '
				<input type = "hidden" name = "sID" value = ' . $id . ' />' . "\n" . '
				</form></td>' . "\n" . '
				<td><form method="post" action="deleteSeries.php">' . "\n" . '
				<input type="submit" value="Delete" />' . "\n" . '
				<input type = "hidden" name = "sID" value = ' . $id . ' /> </form>' . "\n";
			}
			
			$stmt->close();
			
		?>
	</table>
</div>

<div>
	<form method = "post" action = "addSeries.php">
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