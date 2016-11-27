<!-- **************************************
**** filename: update-pjob.php
**** created: November 20, 2016
**** author: Christopher Capps
**** class: Oregon State University CS 340
****************************************-->

<?php
	// Turn on error reporting
	ini_set('display_errors', 'On');

	// Connect to database
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cappsc-db","bUPxSJyB1RecNl7q","cappsc-db");

	if($mysqli->connect_errno){
		echo "Connection error: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<!-- Head information here -->
	</head>
	<style>
		/* Styling for buttons */
		a.button {
			-webkit-appearance: button;
			-moz-appearance: button;
			appearance: button;

			text-decoration: none;
			color: initial;
		}
	</style>
	<body>

<?php
	// Prepare a SQL statement to update the values for a selected row in the people_jobs table 
	// the values to select the correct row are passed via a form to this page
	if (!($stmt = $mysqli->prepare("UPDATE people_jobs SET person_id = ?, job_id = ?, game_id = ?, develop_id = ? WHERE person_id = ? AND job_id = ? AND game_id = ?"))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("iiiiiii", $_POST['pid'], $_POST['jid'], $_POST['vgid'], $_POST['did'], $_POST['oldpid'], $_POST['oldjid'], $_POST['oldvgid']))){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Updated " . $stmt->affected_rows . " rows in people_jobs.";
	}

	$stmt->close();
?>
		
		<br />
		<br />
		<a class="button" href="/~cappsc/people-jobs.php">Back to People Jobs</a>
		<a class="button" href="/~cappsc/homePage.php">Home</a>

	</body>
</html>