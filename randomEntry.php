<?php
	//Turn on error reporting
	ini_set('display_errors', 'On');
	//Connects to the database
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","robinjam-db","TJl7rNob9kTbcPSP","robinjam-db");
	
	if($mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	//Array that will be used to store id's later
	$resultsArray = array();
	
	//get a random int to choose a table with
	$randomTable = rand(1,4);
	echo $randomTable;
	
	//get a query based on the random int
	switch ($randomTable) {
		case 1:
			$randQuery1 = "SELECT person_id FROM people";
			
			$randQuery2 = "SELECT p.person_id, p.firstName, p.lastName, p.birthMonth, p.birthDay, p.birthYear, COUNT(vg.game_id) FROM people p
							LEFT JOIN people_jobs pj ON p.person_id = pj.person_id
							LEFT JOIN video_game vg ON pj.game_id = vg.game_id
							WHERE p.person_id = ?
							GROUP BY p.person_id
							ORDER BY p.lastName, p.firstName ASC";
							
			echo "Choosing a person";
			break;
		case 2:
			$randQuery1 = "SELECT platform_id FROM platform";
			
			$randQuery2 = "SELECT p.platform_id, p.name, p.manufacturer, p.cost, p.releaseMonth, p.releaseDay, p.releaseYear, p.graphics, p.hardDrive, p.RAM, COUNT(vg.game_id) FROM platform p
							LEFT JOIN games_platforms gp ON p.platform_id = gp.platform_id
							LEFT JOIN video_game vg ON gp.game_id = vg.game_id
							WHERE p.platform_id = ?
							GROUP BY p.name";
							
			echo "Choosing a platform";
			break;
		case 3:
			$randQuery1 = "SELECT developer_id FROM developer";
			
			$randQuery2 = "SELECT d.developer_id, d.name, d.city, COUNT(vg.game_id) FROM developer d 
									LEFT JOIN video_game vg ON vg.developer = d.developer_id
									WHERE d.developer_id = ?
									GROUP BY d.name";
									
			echo "Choosing a developer";
			break;
		default:
			$randQuery1 = "SELECT game_id FROM video_game";
			
			$randQuery2 = "SELECT vg.game_id, vg.title, vg.releaseMonth, vg.releaseDay, vg.releaseYear, g.name, d.name, IFNULL(gs.title, ' ') FROM video_game vg
						LEFT JOIN game_genres gg ON gg.game_id = vg.game_id
						LEFT JOIN genre g ON g.genre_id = gg.genre_id
						INNER JOIN developer d ON vg.developer = d.developer_id
						LEFT JOIN game_series gs ON vg.gameSeries = gs.series_id
						WHERE vg.game_id = ?
						ORDER BY vg.title ASC";
						
			echo "Choosing a game";
			break;
	}
	
	//make the query
	if(!($stmt = $mysqli->prepare($randQuery1)))
	{
		echo "Prepare failed: " .$stmt->errno . " " . $stmt->error;
	}
	
	if(!$stmt->execute())
	{
		echo "Execute failed: " .$mysqli->connect_errno . " " . $mysqli->connect_errnor;
	}
	
	//save results if you get some
	if(!$stmt->bind_result($id))
	{
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	//Store the results in a vector
	while($stmt->fetch())
	{				
		array_push($resultsArray, $id);
		echo $id . "<br>";
	}
	
	//length of resultsArray
	$numResults = count($resultsArray);
	echo "<br>There are " . $numResults . " elements in resultsArray <br>";
	
	//get random int to select an entry from resultsArray
	$randomEntry = rand(1, $numResults) - 1;
	echo "<br>The randomly selected entry is " . $randomEntry . "<br>";
	
	//store the id of the random entry
	$randomEntryID = $resultsArray[$randomEntry];
	echo "<br>The random entry's ID is " . $randomEntryID . "<br>";
	
	/* //get query that will get info about the random entry
	switch ($randomTable) {
		case 1:
			$randQuery2 = "SELECT p.person_id, p.firstName, p.lastName, p.birthMonth, p.birthDay, p.birthYear, COUNT(vg.game_id) FROM people p
							LEFT JOIN people_jobs pj ON p.person_id = pj.person_id
							LEFT JOIN video_game vg ON pj.game_id = vg.game_id
							GROUP BY p.person_id
							ORDER BY p.lastName, p.firstName ASC";
			echo "<br>Choosing a person<br>"
			break;
		case 2:
			$randQuery2 = "SELECT p.platform_id, p.name, p.manufacturer, p.cost, p.releaseMonth, p.releaseDay, p.releaseYear, p.graphics, p.hardDrive, p.RAM, COUNT(vg.game_id) FROM platform p
							LEFT JOIN games_platforms gp ON p.platform_id = gp.platform_id
							LEFT JOIN video_game vg ON gp.game_id = vg.game_id
							GROUP BY p.name";
			echo "<br>Choosing a platform<br>";
			break;
		case 3:
			$randQuery2 = "SELECT d.developer_id, d.name, d.city, COUNT(vg.game_id) FROM developer d 
									LEFT JOIN video_game vg ON vg.developer = d.developer_id
									GROUP BY d.name";
			echo "<br>Choosing a developer<br>";
			break;
		default:
			$randQuery2 = "SELECT vg.title, vg.releaseMonth, vg.releaseDay, vg.releaseYear, g.name, d.name, IFNULL(gs.title, ' ') FROM video_game vg
						LEFT JOIN game_genres gg ON gg.game_id = vg.game_id
						LEFT JOIN genre g ON g.genre_id = gg.genre_id
						INNER JOIN developer d ON vg.developer = d.developer_id
						LEFT JOIN game_series gs ON vg.gameSeries = gs.series_id
						WHERE vg.game_id = ?
						ORDER BY vg.title ASC";
			echo "<br>Choosing a game<br>";
			break;
	} */
	
	//execute randQuery2
	if(!$mysqli || $mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		
	if(!($stmt = $mysqli->prepare($randQuery2))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt -> bind_param("i", $randomEntryID))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Getting the random entry's info<br><br>";
	}
	
	echo "<table>\n";
	
	//bind results and display them
	//each case returns a different number of things to store
	if($randomTable == 1)
	{
		if(!$stmt->bind_result($id, $fname, $lname, $month, $day, $year, $gameCount)){
			echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
		}
		
		while($stmt->fetch()){
			echo "<tr>\n<td>\n" . $fname 
			. "\n</td>\n<td>\n" . $lname 
			. "\n</td>\n<td>\n" . $month . "/" . $day . "/" . $year
			. "\n</td>\n<td>\n" .
			'<form method = "post" action = "gamePersonFilter.php" >
			<input type = "submit" class = "submitLink" value = "' . $gameCount . '" />
			<input type = "hidden" name = "person" value = ' . $id . ' />
			</form>'
			. "\n</td>\n <td>\n <form action='/~cappsc/edit-person' method='post'>\n <input type='hidden' name='id' value='" . $id . "'>\n<input type='hidden' name='fname' value='" . $fname . "'>\n<input type='hidden' name='lname' value='" . $lname . "'>\n<input type='hidden' name='month' value='" . $month . "'>\n<input type='hidden' name='day' value='" . $day . "'>\n<input type='hidden' name='year' value='" . $year . "'>\n<input type='submit' value='Edit'>\n</form></td>\n<td>\n<form action='/~cappsc/delete-person' method='post'>\n<input type='hidden' name='id' value='" . $id . "'>\n<input type='submit' value='Delete'></form>\n</td>\n</tr>\n"; 
		}
	}	
	
	else if($randomTable == 2)
	{
		if(!$stmt->bind_result($id, $name, $manufacturer, $cost, $month, $day, $year, $graphics, $hardDrive, $RAM, $gameCount)){
			echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
		}
		
		while($stmt->fetch()){
			echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" 
					. $manufacturer . "\n</td>\n<td>\n" 
					. $cost . "\n</td>\n<td>\n" 
					. $month . "/" . $day . "/" . $year . "\n</td>\n<td>\n" 
					. $graphics . "\n</td>\n<td>\n" 
					. $hardDrive . "\n</td>\n<td>\n" 
					. $RAM 
					. "</td>\n<td>\n" . 
					'<form method = "post" action = "gamePlatformFilter.php" >
					<input type = "submit" class = "submitLink" value = "' . $gameCount . '" />
					<input type = "hidden" name = "platform" value = ' . $id . ' />
					</form>'
					. "\n</td>\n<td>\n<form action='/~cappsc/edit-platform.php' method='post'>\n <input type='submit' value='Edit'>\n <input type='hidden' name='id' value='" . $id . "'>\n<input type='hidden' name='name' value='" . $name . "'>\n<input type='hidden' name='manufacturer' value='" . $manufacturer . "'>\n<input type='hidden' name='cost' value='" . $cost . "'>\n<input type='hidden' name='month' value='" . $month . "'>\n<input type='hidden' name='day' value = '" . $day . "'>\n<input type='hidden' name='year' value='" . $year . "'>\n<input type='hidden' name='graphics' value='" . $graphics . "'>\n<input type='hidden' name='hardDrive' value='" . $hardDrive . "'>\n<input type='hidden' name='RAM' value='" . $RAM . "'>\n</form>\n<form action='/~cappsc/delete-platform.php' method='post'>\n<input type='hidden' name='id' value='" . $id . "'>\n<input type='submit' value='Delete'>\n</form>\n</td>\n</tr>";
		}
	}
		
	else if($randomTable == 3)
	{
		if(!$stmt->bind_result($id, $name, $city, $gameCount))
		{
			echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		
		while($stmt->fetch())
		{
			echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $city . "\n</td>\n<td>\n" . '
			<form method = "post" action = "gameDevFilter.php" >
			<input type = "submit" class = "submitLink" value = "' . $gameCount . '" />
			<input type = "hidden" name = "developer" value = ' . $id . ' />
			</form> 
			</td><td>' . "\n" . '
			<form method="post" action="editDeveloperForm.php">' . "\n" . '
			<input type="submit" value="Edit" />' . "\n" . '
			<input type = "hidden" name = "developerID" value = ' . $id . ' />' . "\n" . '
			</form></td><td>' . "\n" . '
			<form method="post" action="deleteDeveloper.php">' . "\n" . '
			<input type="submit" value="Delete" />' . "\n" . '
			<input type = "hidden" name = "developerID" value = ' . $id . ' />' . "\n" . '
			</form></td>' . "\n";
		}
	}	
	
	else
	{
		if(!$stmt->bind_result($id, $title, $rMonth, $rDay, $rYear, $genre, $developer, $gSeries))
		{
			echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		
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
	}
	
	echo "</table>\n";
?>