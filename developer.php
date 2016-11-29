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
			<td>Developers</td>
		</tr>
		<tr>
			<td>Name</td>
			<td>City</td>
			<td>Number of Games</td>
		</tr>
<?php
	//Get data from vide_game table
	if(!($stmt = $mysqli->prepare('SELECT d.developer_id, d.name, d.city, COUNT(vg.game_id) AS "Number Of Games" FROM developer d 
									LEFT JOIN video_game vg ON vg.developer = d.developer_id
									GROUP BY d.name;')))
	{
		echo "Prepare failed: " .$stmt->errno . " " . $stmt->error;
	}
	
	if(!$stmt->execute())
	{
		echo "Execute failed: " .$mysqli->connect_errno . " " . $mysqli->connect_errnor;
	}
	
	//save results if you get some
	if(!$stmt->bind_result($id, $name, $city, $gameCount))
	{
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	//display results until you run out of stuff to display
	while($stmt->fetch())
	{
		echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $city . "\n</td>\n<td>\n" . '
		<form method = "post" action = "gameDevFilter.php" >
		<input type = "submit" class = "submitLink" value = "' . $gameCount . '" />
		<input type = "hidden" name = "developer" value = ' . $id . ' />
		</form> 
		</td><td>' . "\n" . '
		<form method="post" action="edit-developer.php">' . "\n" . '
		<input type="submit" value="Edit" />' . "\n" . '
		<input type = "hidden" name = "developerID" value = ' . $id . ' />' . "\n" . '
		</form></td><td>' . "\n" . '
		<form method="post" action="delete-developer.php">' . "\n" . '
		<input type="submit" value="Delete" />' . "\n" . '
		<input type = "hidden" name = "developerID" value = ' . $id . ' />' . "\n" . '
		</form></td>' . "\n";
	}
	
	$stmt->close();
	
?>
	</table>
</div>

<div>
	<form method = "post" action = "add-developer.php">
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