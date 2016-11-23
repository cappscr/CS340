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
		$series_id = $_POST['sID'];
		echo $series_id;
	
		if(!($stmt = $mysqli->prepare("SELECT title FROM game_series
											WHERE series_id = ?")))
			{
				echo "Prepare failed: " .$stmt->errno . " " . $stmt->error;
			}
			
			//Bound the ? from above to the integer below
			if(!($stmt->bind_param("i", $series_id))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			}
			
			if(!$stmt->execute())
			{
				echo "Execute failed: " .$mysqli->connect_errno . " " . $mysqli->connect_errnor;
			}
			
			//save results if you get some
			if(!$stmt->bind_result($title))
			{
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
	
		//create a prepopulated form
		while($stmt -> fetch())
		{
			echo 	"<form method='post' action='editSeries.php'> \n
						<fieldset>\n
							<legend>Edit the series's information</legend> \n
							<p>Title: <input type = 'text' name = 'title' value = '" . $title . "' /></p>\n
						</fieldset>\n";
			 
		}
		?>
		
		<?php echo "<p><input type = 'hidden' name = 'seriesID' value = " . $series_id . " /></p>"; ?>
		<p><input type = "submit" value = "Submit"/></p>
	</form>
</div>
</body>
</html>