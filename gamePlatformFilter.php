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
</style>

<body>

<div>
	<?php include 'navBar.php'; ?>
</div>

<div>
	<table>
		<tr>
			<td>Videogames Filtered By Platform</td>
		</tr>
		<tr>
			<td>Title</td>
			<td>Release Date</td>
			<td>Genre</td>
			<td>Series</td>
			<td>Developer</td>
		</tr>
		<?php
			if(!($stmt = $mysqli->prepare('SELECT vg.game_id, vg.title, vg.releaseMonth, vg.releaseDay, vg.releaseYear, g.name, d.name, gs.title FROM platform p
											LEFT JOIN games_platforms gp ON p.platform_id = gp.platform_id
											LEFT JOIN video_game vg ON gp.game_id = vg.game_id
											LEFT JOIN game_genres gg ON gg.game_id = vg.game_id
											LEFT JOIN genre g ON g.genre_id = gg.genre_id
											LEFT JOIN developer d ON vg.developer = d.developer_id
											LEFT JOIN game_series gs ON vg.gameSeries = gs.series_id
											WHERE p.platform_id  = ?'))){
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}

			//Bound the ? from above to the integer below
			if(!($stmt->bind_param("i",$_POST['platform']))){
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			}

			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($id, $title, $rMonth, $rDay, $rYear, $genre, $developer, $gSeries)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while($stmt->fetch()){
				echo "<tr>\n<td>\n" . $title . "\n</td>\n<td>\n" . $rMonth . "-" . $rDay . "-" .  $rYear . "\n</td>\n<td>\n" 
					. $genre . "\n</td>\n<td>\n" . $gSeries . "\n</td>\n<td>\n" . $developer 
					. '</td><td>
						<form method="post" action="editGame.php">' . "\n" .
						'<input type="submit" value="Edit" />' . "\n" .
						'<input type="hidden" name = "gameID" value =' . $id . ' />' . "\n" .
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

</body>
</html>