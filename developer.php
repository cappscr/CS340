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
			<td>Developers</td>
		</tr>
		<tr>
			<td>Name</td>
			<td>City</td>
		</tr>
<?php
	//Get data from vide_game table
	if(!($stmt = $mysqli->prepare("SELECT d.developer_id, d.name, d.city FROM developer d")))
	{
		echo "Prepare failed: " .$stmt->errno . " " . $stmt->error;
	}
	
	if(!$stmt->execute())
	{
		echo "Execute failed: " .$mysqli->connect_errno . " " . $mysqli->connect_errnor;
	}
	
	//save results if you get some
	if(!$stmt->bind_result($id, $name, $city))
	{
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	//display results until you run out of stuff to display
	while($stmt->fetch())
	{
		echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $city . 
		'</td><td>' . "\n" . '
		<form method="post" action="editDeveloperForm.php">' . "\n" . '
		<input type="submit" value="Edit" />' . "\n" . '
		<input type = "hidden" name = "developerID" value = ' . $id . ' />' . "\n" . '
		</form></td><td>' . "\n" . '
		<form method="post" action="deleteDeveloper.php">' . "\n" . '
		<input type="submit" value="Delete" />' . "\n" . '
		<input type = "hidden" name = "developerID" value = ' . $id . ' />' . "\n" . '
		</form></td>' . "\n";
	}
	
	$stmt->close();
	
?>
	</table>
</div>

<div>
	<form method = "post" action = "addDeveloper.php">
		<fieldset>
			<legend>Enter information for the new developer</legend>
			<p>Name: <input type = "text" name = "name"/></p>
			<p>City: <input type = "text" name = "city"/></p>
			<p><input type = "submit" value = "Add Developer"/></p>
		</fieldset>
	</form>
</div>

<div>
	<form method="post" action="gameDevFilter.php">
		<fieldset>
			<legend>See what games a developer has made</legend>
				<select name="developer">
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
		<input type="submit" value="See Games" />
	</form>
</div>

</body>
</html>