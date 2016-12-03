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
	<head>
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
			<?php include 'navBar.php'; ?>
		</div>
		<br />

<?php
	if(!($stmt = $mysqli->prepare("DELETE FROM developer WHERE developer_id = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	//Bound the ? from above to the integer below
	if(!($stmt->bind_param("i",$_POST['developerID']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	} else
		echo "You have deleted " . $stmt->affected_rows . " rows from the developer table";

	$stmt->close();
?>

		<br />
		<br />
		<a class="button" href="/~cappsc/developer.php">Back to Developers</a>
		<a class="button" href="/~cappsc/home.php">Home</a>

	</body>
</html>