<!-- ****************************************
**** filename: edit-job.php
**** created: November 18, 2016
**** author: Christopher Capps
**** class: Oregon State University CS 340
*******************************************-->

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
		<style>
			/* Any CSS styling here */ 
		</style>
	</head>
	<body>

		<div>
			<?php include 'navBar.php'; ?>
		</div>
		<br />
<?php
		echo "<form action='update-job.php' method='post'>";
		echo "\n<fieldset>";
		echo "\n<legend>Edit a Job</legend>";
		echo "\n<label for='name'>Name:</label>";
		echo "\n<input type='hidden' name='id' value='" . $_POST['id'] . "'>";
		echo "\n<br />";
		echo "\n<input name='job_name' value='" . $_POST['name'] . "' required>";
		echo "\n<br />\n<input type='submit' value='Update'>\n</fieldset>\n</form>";
?>

	</body>
</html>