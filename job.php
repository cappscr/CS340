<!-- **************************************
File Name:  job.php
Created By: Christopher Capps
Date:       November 18, 2016
Class:      Oregon State University CS 340  
***************************************** -->

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
		<style>
			a.button {
			   -webkit-appearance: button;
			   -moz-appearance: button;
			   appearance: button;
			   text-decoration: none;
			   color: initial;
			}
		</style>
	</head>
	<body>
		<div>
			<?php include "navBar.php"; ?>
		</div>
		<br />

		<h1>Jobs</h1>

		<form action="add-job.php" method="post"> 
			<fieldset>
				<legend>Add a Job</legend>
				<label for="name">Name:</label>
				<input name="name" value="Name" required>
				<br />
				<input type="submit" value="Add">
				<br />
			</fieldset>
		</form>


		<table>
			<thead>
				<tr>
					<td><strong>Name</strong>
				</tr>
			</thead>
<?php
	$query = "SELECT job_id, name FROM job";

	if(!($stmt = $mysqli->prepare($query))){
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->bind_result($id, $name)){
		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	}

	while($stmt->fetch()){
		echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n<form action='/~cappsc/edit-job.php' method='post'>\n<input type='hidden' name='id' value='" . $id . "'>\n<input type='hidden' name='name' value='" . $name . "'>\n<input type='submit' value='Edit'>\n</form>\n<form action='/~cappsc/delete-job.php' method='post'>\n<input type='hidden' name='id' value='" . $id . "'>\n<input type='submit' value='Delete'>\n</form>\n</td>\n</tr>\n"; 
	}

	$stmt->close();
?>

		</table>

	</body>
</html>