<!-- ******************************************
File Name:  people-jobs.php
Created By: Christopher Capps
Date:       November 18, 2016
Class:      Oregon State University CS 340  
******************************************* -->

<?php
	ini_set('display_errors', 'On');
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cappsc-db","bUPxSJyB1RecNl7q","cappsc-db");

	if($mysqli->connect_errno){
		echo "Connection error: " . $mysqli->connect_errno . " " . $mysqli->error;
	} 
?>

<!DOCTYPE html>
<html>
	<head>
		<!-- Head information here -->
	</head>
	<body>
		<h1>People</h1>

		<form action="add-pjob.php" method="post"> 
			<fieldset>
				<legend>Add a Person's Job</legend>
				<label for="pid">Person:</label>
				<input name="fname" value="John" required>
				<br />
				<label for="jid">Job:</label>
				<input name="lname" value="Doe" required>
				<br />
				<label for="vgid">Video Game:</label>
				<input name="fname" value="John" required>
				<br />
				<label for="did">Developer:</label>
				<input name="lname" value="Doe" required>
				<br />
				<input type="submit" value="Add">
			</fieldset>
		</form>


		<table>
			<thead>
				<tr>
					<td><strong>First Name</strong>
					<td><strong>Last Name</strong>
					<td><strong>Job</strong>
					<td><strong>Video Game</strong>
					<td><strong>Developer</strong>
				</tr>
			</thead>
<?php
	$query = "SELECT pj.person_id, pj.job_id, pj.game_id, pj.develop_id, p.firstName, p.lastName, j.name, vg.title, d.name FROM people_jobs pj LEFT JOIN people p ON p.person_id = pj.person_id LEFT JOIN job j ON j.job_id = pj.job_id LEFT JOIN video_game vg ON vg.game_id = pj.game_id LEFT JOIN developer d ON d.developer_id = pj.develop_id";

	if(!($stmt = $mysqli->prepare($query))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($pid, $jid, $gid, $did, $fname, $lname, $job, $game, $company)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $job . "</td>\n<td>\n" . $game . "</td>\n<td>\n" . $company . "\n</td>\n <td>\n <form action='/~cappsc/edit-pjob' method='post'>\n<input type='hidden' name='pid' value='" . $pid . "'>\n<input type='hidden' name='jid' value='" . $jid . "'>\n<input type='hidden' name='gid' value='" . $gid . "'>\n<input type='hidden' name='did' value='" . $did . "'>\n<input type='submit' value='Edit'>\n</form></td>\n<td>\n<form action='/~cappsc/delete-pjob' method='post'>\n<input type='hidden' name='pid' value='" . $pid . "'>\n<input type='hidden' name='jid' value='" . $jid . "'>\n<input type='hidden' name='gid' value='" . $gid . "'>\n<input type='hidden' name='did' value='" . $did . "'>\n<input type='submit' value='Delete'>\n</form>\n</td>\n</tr>\n"; 
	}

	$stmt->close();
?>

		</table>

	</body>
</html>