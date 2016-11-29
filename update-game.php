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

<?php
echo $_POST['gameID'];
	if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	if(!($stmt = $mysqli->prepare("UPDATE video_game SET title = '" . $_POST['title'] . "', releaseMonth = '" 
									. $_POST['releaseMonth'] . "', releaseDay = '" . $_POST['releaseDay'] . 
									"', releaseYear = '" . $_POST['releaseYear'] . "', gameSeries = '" 
									. $_POST['gameSeries'] . "', developer = '" . $_POST['developer'] . 
									"' WHERE game_id = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("i", $_POST['gameID']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Editted " . $_POST['title'] . " in video_game.";
	}
?>

</body>
</html>