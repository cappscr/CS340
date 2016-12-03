<!-- **************************************
**** filename: delete-job.php
**** created: November 18, 2016
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
		<br />

<?php
	if (!($stmt = $mysqli->prepare("DELETE FROM job WHERE job_id = ?"))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("i", $_POST['id']))){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Deleted " . $stmt->affected_rows . " rows from job.";
	}

	$stmt->close();
?>

		<br />
		<br />
		<a class="button" href="/~cappsc/job.php">Back to Jobs</a>
		<a class="button" href="/~cappsc/home.php">Home</a>

	</body>
</html>