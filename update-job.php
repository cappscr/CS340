<!-- **************************************
**** filename: update-job.php
**** created: November 18, 2016
**** author: Christopher Capps
**** class: Oregon State University CS 340
**************************************** -->

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
	if (!($stmt = $mysqli->prepare("UPDATE job SET name = ? WHERE job_id = ?"))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("si", $_POST['job_name'], $_POST['id']))){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Updated " . $stmt->affected_rows . " rows in job.";
	}

	$stmt->close();
?>
		
		<br />
		<br />
		<a class="button" href="/~cappsc/job.php">Back to Jobs</a>
		<a class="button" href="/~cappsc/homePage.php">Home</a>

	</body>
</html>