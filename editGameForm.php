<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","robinjam-db","TJl7rNob9kTbcPSP","robinjam-db");

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
	<?php
		$game_id = $_POST['gameID'];
		echo $game_id;
	
		if(!($stmt = $mysqli->prepare("SELECT vg.title, vg.releaseMonth, vg.releaseDay, vg.releaseYear FROM video_game vg
											INNER JOIN game_genres gg ON gg.game_id = vg.game_id
											INNER JOIN genre g ON g.genre_id = gg.genre_id
											INNER JOIN developer d ON vg.developer = d.developer_id
											INNER JOIN game_series gs ON vg.gameSeries = gs.series_id
											WHERE vg.game_id = ?")))
			{
				echo "Prepare failed: " .$stmt->errno . " " . $stmt->error;
			}
			
			//Bound the ? from above to the integer below
			if(!($stmt->bind_param("i", $game_id))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			}
			
			if(!$stmt->execute())
			{
				echo "Execute failed: " .$mysqli->connect_errno . " " . $mysqli->connect_errnor;
			}
			
			//save results if you get some
			if(!$stmt->bind_result($title, $rMonth, $rDay, $rYear))
			{
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
	
		//create a prepopulated form
		while($stmt -> fetch())
		{
			echo 	"<form method='post' action='editGame.php'> \n
						<fieldset>\n
							<legend>Edit the game's information</legend> \n
							<p>Title: <input type = 'text' name = 'title' value = '" . $title . "' /></p>\n
							<p>Release Month: <input type = 'text' name = 'releaseMonth' value = " . $rMonth . " /></p>\n
							<p>Release Day: <input type = 'text' name = 'releaseDay'  value = " . $rDay . " /></p>\n
							<p>Release Year: <input type = 'text' name = 'releaseYear'  value = " . $rYear . " /></p>\n
						</fieldset>\n";
			 
		}
		?>
		<fieldset>
			<legend>Game Series</legend>
			<select required name = "gameSeries">
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
			<select required name = "developer">
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
		<?php echo "<p><input type = 'hidden' name = 'gameID' value = " . $_POST['gameID'] . " /></p>"; ?>
		<p><input type = "submit" value = "Submit"/></p>
	</form>
</div>
</body>
</html>